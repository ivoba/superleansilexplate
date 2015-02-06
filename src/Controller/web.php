<?php
use Symfony\Component\HttpFoundation\Response;

$web = $app['controllers_factory'];

//controllers
$web->match('/', function () use ($app) {
    $message = 'Hello World!';
    $body    = $app['twig']->render('index.twig', ['message' => $message]);
    return new Response($body, 200, array('Cache-Control' => 's-maxage=3600, public'));
})->bind('homepage');

//add your web actions here

return $web;