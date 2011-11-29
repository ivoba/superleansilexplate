<?php

require_once __DIR__ . '/../vendor/silex/silex.phar';

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

$app = new Silex\Application();

// Be sure to register Symfony lib
$app['autoloader']->registerNamespace('Symfony', __DIR__.'/../vendor');

// Locale
$app['locale'] = 'en';
$app['session.default_locale'] = $app['locale'];
$app['translator.messages'] = require __DIR__ . '/../resources/locales/translations.php';
$app['languages'] = array_keys($app['translator.messages']);
// Cache
$app['cache.path'] = __DIR__ . '/../cache';

// Http cache
$app['http_cache.cache_dir'] = $app['cache.path'] . '/http';

//ENV
if (isset($_SERVER['ENVIRONMENT'])) {
    $app['environment'] = $_SERVER['ENVIRONMENT'];
    $app['debug'] = true;
} else {
    $app['environment'] = 'prod';
    $app['debug'] = false;
} 

$app->register(new Silex\Provider\HttpCacheServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'locale_fallback' => $app['locale']
));

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../views',
    'twig.class_path' => __DIR__ . '/../vendor/twig/lib',
));

//set layout template
$app->before(function () use ($app) {

            if ($locale = $app['request']->get('locale')) {
                $app['locale'] = $locale;
            }

            $app['twig']->addGlobal('env', $app['environment']);
            $app['twig']->addGlobal('layout', $app['twig']->loadTemplate('layout.twig'));
        });

$app->match('/', function() use ($app) {
            return $app->redirect("/".$app['locale']."/index");
        })->bind('homepage');
        
$app->get('/{locale}/index', function () use ($app) {
                $body = $app['twig']->render('index.twig');
                return new Response($body, 200, array('Cache-Control' => 's-maxage=3600, public'));
        })->assert('locale',implode('|', $app['languages']));
        
$app->get('/{locale}', function () use ($app) {
                return  $app->redirect("/".$app['locale']."/index");
        })->assert('locale',implode('|', $app['languages']));

//START CUSTOM CODE
//END CUSTOM CODE

$app->error(function (\Exception $e, $code) use ($app) {
            if ($app['debug']) {
                return;
            }

            switch ($code) {
                case 404:
                    return $app['twig']->render('404.twig');
                    break;
                default:
                    return $app['twig']->render('error.twig', array('code' => $code));
            }
        });
        
return $app;
