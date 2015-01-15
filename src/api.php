<?php

require __DIR__ . '/app.php';

//controllers
$api = require __DIR__ . '/Controller/api.php';
$app->mount('/', $api);

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
                          'description' => $message), $code);
});

return $app;