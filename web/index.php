<?php
require_once __DIR__ . '/../vendor/silex/silex.phar';

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Silex\Provider\HttpCacheServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\TwigServiceProvider;

$app = new Silex\Application();

// Local
$app['locale'] = 'fr';
$app['session.default_locale'] = $app['locale'];
$app['translator.messages'] = array(
    'fr' => __DIR__.'/../resources/locales/fr.yml',
);

// Cache
$app['cache.path'] = __DIR__ . '/../cache';

// Http cache
$app['http_cache.cache_dir'] = $app['cache.path'] . '/http';
if(isset ($_SERVER['ENVIRONMENT'])){
    $app['environment'] = $_SERVER['ENVIRONMENT'];
    $app['debug'] = true;
}
else{
    $app['environment'] = 'prod';
}

$app->register(new HttpCacheServiceProvider());
$app->register(new SessionServiceProvider());
$app->register(new TranslationServiceProvider(), array(
    'locale_fallback' => $app['locale'],
));
$app['translator.messages'] = require_once __DIR__ . '/../resources/locales/translations.php';

$app->register(new TwigServiceProvider(), array(
    'twig.options'  => array('cache' => false, 'strict_variables' => true),
    'twig.path'     => array(
        __DIR__ . '/../views'
    )
));

//set layout template
$app->before(function () use ($app) {
            $app['twig']->addGlobal('env',$app['environment']);
            $app['twig']->addGlobal('layout', $app['twig']->loadTemplate('layout.twig'));
        });

$app->match('/', function() use ($app) {
    return $app['twig']->render('index.twig');
})->bind('homepage');

//START CUSTOM CODE

//END CUSTOM CODE

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    switch ($code) {
        case 404:
            $message = 'The requested page could not be found.';
            break;
        default:
            $message = 'We are sorry, but something went terribly wrong.';
    }

    return new Response($message, $code);
});

if ($app['debug']) {
    $app->run();
}
else{
   $app['http_cache']->run();
}
