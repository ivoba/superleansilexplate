<?php
require_once __DIR__ . '/../vendor/silex/silex.phar';

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

$app = new Silex\Application();

// Locale
$app['locale'] = 'en';
$app['session.default_locale'] = $app['locale'];
$app['translator.messages'] = require  __DIR__ . '/../resources/locales/translations.php';

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
// Be sure to register Symfony lib
$app['autoloader']->registerNamespace('Symfony', __DIR__.'/../vendor/symfony/src');

$app->register(new Silex\Provider\HttpCacheServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'locale_fallback' => $app['locale'],
    'translation.class_path'    => __DIR__.'/../vendor/symfony/src',
));

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path'       => __DIR__.'/../views',
    'twig.class_path' => __DIR__.'/../vendor/twig/lib',
));

//set layout template
$app->before(function () use ($app) {
            $app['twig']->addGlobal('env',$app['environment']);
            $app['twig']->addGlobal('layout', $app['twig']->loadTemplate('layout.twig'));
        });

$app->match('/', function() use ($app) {
    return $app['twig']->render('index.twig', array('title' => $app['translator']->trans('homepage')));
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
return $app;
