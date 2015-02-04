<?php

$api = $app['controllers_factory'];

$api->match('/', function () use ($app) {
    return $app->json(['message' => 'Hello World']);
})->bind('api-index');

//add your api actions here

return $api;