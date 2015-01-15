<?php

use Silex\Provider\TwigServiceProvider;
use Silex\Provider\HttpCacheServiceProvider;

$app = new Silex\Application();

//Dotenv::load(__DIR__ . '/..');

$app['environment'] = getenv('SILEX_ENV') ? getenv('SILEX_ENV') : 'dev';
$app['debug'] = getenv('SILEX_DEBUG') ? getenv('SILEX_DEBUG') : false;

$app['cache.path']           = __DIR__ . '/../cache';
$app['http_cache.cache_dir'] = $app['cache.path'] . '/http';
$app->register(new HttpCacheServiceProvider());
$app->register(new \Superleansilexplate\EnvProvider());

$app->register(new TwigServiceProvider(), array(
    'twig.options' => array(
        'cache' => isset($app['twig.options.cache']) ? $app['twig.options.cache'] : false,
        'strict_variables' => true
    ),
    'twig.path' => array(__DIR__ . '/../resources/views')
));