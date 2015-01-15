<?php

use Symfony\Component\HttpFoundation\Response;

require __DIR__ . '/app.php';

//controllers
$web = require __DIR__ . '/Controller/web.php';
$app->mount('/', $web);

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

