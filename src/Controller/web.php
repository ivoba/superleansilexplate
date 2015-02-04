<?php
use Symfony\Component\HttpFoundation\Response;

$web = $app['controllers_factory'];

//controllers
$web->match('/', function () use ($app) {
    $message = 'Hello World!';
    $body    = $app['twig']->render('index.twig', ['message' => $message]);
    return new Response($body);
})->bind('homepage');

//add your web actions here

return $web;