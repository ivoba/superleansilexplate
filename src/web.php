<?php

use Symfony\Component\HttpFoundation\Response;

require_once __DIR__ . '/app.php';

#controllers
$app->match('/', function () use ($app) {
    $message = 'Hello World!';
    $body    = $app['twig']->render('index.twig', ['message' => $message]);
    return new Response($body);
})->bind('homepage');

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    switch ($code) {
        case 404:
            $message = 'The requested page could not be found.';
            $body    = $app['twig']->render('404.twig', ['code' => $code, 'message' => $message]);
            break;
        default:
            $message = 'We are sorry, but something went terribly wrong.';
            $body    = $app['twig']->render('error.twig', ['code' => $code, 'message' => $message]);
    }

    return new Response($body, $code);
});

return $app;

