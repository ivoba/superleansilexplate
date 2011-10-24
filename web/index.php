<?php
$app = require_once __DIR__.'/../src/app.php';

if ($app['debug']) {
    $app->run();
}
else{
   $app['http_cache']->run();
}
