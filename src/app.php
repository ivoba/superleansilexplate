<?php

use Silex\Provider\TwigServiceProvider;
use Silex\Provider\HttpCacheServiceProvider;

$app = new Silex\Application();

$app['environment'] = getenv('APP_ENV') ? getenv('APP_ENV') : 'prod';
if ($app['environment'] == 'dev') {
    $app['debug'] = true;
}

$app['cache.path']           = __DIR__ . '/../cache';
$app['http_cache.cache_dir'] = $app['cache.path'] . '/http';
$app->register(new HttpCacheServiceProvider());

$app->register(new TwigServiceProvider(), array(
    'twig.options' => array(
        'cache' => isset($app['twig.options.cache']) ? $app['twig.options.cache'] : false,
        'strict_variables' => true
    ),
    'twig.path' => array(__DIR__ . '/../resources/views')
));
