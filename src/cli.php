<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Ivoba\Silex\Provider\ConsoleServiceProvider;
use Superleansilexplate\Command\HelloWorldCommand;
use Superleansilexplate\Command\ClearCacheCommand;
use Superleansilexplate\Command\ServerRunCommand;
use Symfony\Component\Debug\ExceptionHandler;
use Symfony\Component\Debug\ErrorHandler;

ExceptionHandler::register();
ErrorHandler::register();

require __DIR__ . '/app.php';

//register your tasks
$app->register(new ConsoleServiceProvider(), [
    'console.name' => 'Superleansilexplate',
    'console.version' => '1.0',
    'console.project_directory' => __DIR__
]);

$app['console']->add(new HelloWorldCommand());
//$app['console']->add(new ClearCacheCommand($app['cache.path']));
//$app['console']->add(new ServerRunCommand());


//$app['console']->all();
//dump($app['console']->all());

return $app['console'];
