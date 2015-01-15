<?php
namespace Superleansilexplate;

use Silex\Application;
use Silex\ServiceProviderInterface;

class EnvProvider implements ServiceProviderInterface
{

    private $dotEnvProvider;

    function __construct($dotEnvProvider = null)
    {
        $this->dotEnvProvider = $dotEnvProvider;
    }

    /*
     * env.vars = ['SILEX_DB_HOST' => ['required' => true,
	  'default' => 'dev',
	  'allowed' => ['dev', 'prod']]]

    set prefix
    iterate ENV & SERVER
    set all to app, remove prefix

     EnvProvider(DotenvProvider, [use_dotenv = callable, 'ENV' => ['required' => true,
	  'default' => 'dev',
	  'allowed' => ['dev', 'prod']]
]])

    'use_dotenv' => function($app){return ($app['env' !== 'prod'])},
    1. run EnvProvider, set all given vars to app
    2. if usedotenv, run dotenv run envprovider again
    3. apply options, check for required, set default etc

    use dotenv require & find methods
     */

    /**
     * Registers services on the given app.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Application $app An Application instance
     */
    public function register(Application $app)
    {
        $app['env.prefix']     = 'SILEX';
        $app['env.use_dotenv'] = function () {
            return true;
        };
        $app['env.dotenv.dir'] = __DIR__ . '/..';
        $app['env.var_config'] = [];

        $this->addEnvVarsToApp($app);

        if($app['env.use_dotenv']){
            \Dotenv::load($app['env.dotenv.dir']);
            //again pls
            $this->addEnvVarsToApp($app);
        }

    }

    /**
     * @param Application $app
     */
    protected function addEnvVarsToApp(Application $app){
        $hasPrefix = function( $elem ) use ($app) {
            return strpos($elem, $app['env.prefix'].'_') !== false;
        };
        $arrayFilterKeys = function ( $input, $callback ) {
            if ( !is_array( $input ) ) {
                trigger_error( 'array_filter_key() expects parameter 1 to be array, ' . gettype( $input ) . ' given', E_USER_WARNING );
                return null;
            }

            if ( empty( $input ) ) {
                return $input;
            }

            $filteredKeys = array_filter( array_keys( $input ), $callback );
            if ( empty( $filteredKeys ) ) {
                return array();
            }

            $input = array_intersect_key( array_flip( $filteredKeys ), $input );

            return $input;
        };

        $envVars = $arrayFilterKeys($_ENV, $hasPrefix);
        $envVars = array_merge($arrayFilterKeys($_SERVER, $hasPrefix), $envVars);

        foreach ($envVars as $envVar => $empty) {
            $var = getenv($envVar);
            if($var){
                $key = strtolower(str_replace($app['env.prefix'] . '_', '', $envVar));
                $app[$key] = getenv($envVar);
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function boot(Application $app)
    {
    }

}