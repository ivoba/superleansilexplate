<?php

require_once __DIR__ . '/../vendor/autoload.php';

$filename = __DIR__.preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

Symfony\Component\Debug\Debug::enable();

$app = require_once __DIR__.'/../src/web.php';

if ($app['environment'] != 'prod') {
    $app->run();
}
else{
   $app['http_cache']->run();
}