<?php

require_once __DIR__ . '/app.php';

#controllers
$app->match('/', function () use ($app) {
    return $app->json(['message' => 'Hello World']);
})->bind('api-index');

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }
    switch ($code) {
        case 404:
            $message = 'No such Resource!';
            break;
        default:
            $message = $e->getMessage();
    }
    return $app->json(array('title' => 'API ' . $code,
                          'desription' => $message), $code);
});

return $app;