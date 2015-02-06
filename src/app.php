<?php

use Silex\Provider\HttpCacheServiceProvider;

$app = new Silex\Application();

//you might want to use https://github.com/ivoba/dotenv-service-provider here
$app['environment'] = getenv('SILEX_ENV') ? getenv('SILEX_ENV') : 'dev';
if($app['environment'] === 'dev'){
    \Dotenv::load(__DIR__ . '/../');
}
$app['debug'] = getenv('SILEX_DEBUG') ? filter_var(getenv('SILEX_DEBUG'), FILTER_VALIDATE_BOOLEAN) : true;

$app['cache.path']           = __DIR__ . '/../cache';
$app['http_cache.cache_dir'] = $app['cache.path'] . '/http';
$app->register(new HttpCacheServiceProvider());
