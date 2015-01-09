<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Knp\Provider\ConsoleServiceProvider;
use Superleansilexplate\Command\HelloWorldCommand;
use Symfony\Component\Debug\ExceptionHandler;
use Symfony\Component\Debug\ErrorHandler;

ExceptionHandler::register();
ErrorHandler::register();

require_once __DIR__ . '/app.php';

//register your tasks
$app->register(new ConsoleServiceProvider(), array(
    'console.name' => 'Superleansilexplate',
    'console.version' => '0.1',
    'console.project_directory' => __DIR__
));

$console = $app['console'];
$console->add(new HelloWorldCommand());

return $console;