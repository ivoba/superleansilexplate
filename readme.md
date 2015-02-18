# Superlean Silex Starterplate

[![Build Status](https://secure.travis-ci.org/ivoba/superleansilexplate.png?branch=master)](http://travis-ci.org/ivoba/superleansilexplate)

This project is supposed to be a lean starterkit for your Silex app.  
Its superlean, so basically only essential things are included.  

If you need full power try:
https://github.com/lyrixx/Silex-Kitchen-Edition

It aims mainly at simple applications that need routing and just some additional logic.  
F.e. its a good container for javascript driven apps that get their data through API calls.  

It provides:

1. Web infrastructure
  * Skeleton CSS (http://getskeleton.com)
  * Bower
  * Modernizr
  * Twig
  * HttpCache
2. REST Api infrastructure
3. Console infrastructure
4. Misc
  * phpdotenv (https://github.com/vlucas/phpdotenv)
  * symfony vardumper (https://github.com/symfony/var-dumper) 
  * stop dumper (https://github.com/ivoba/stop)
  * symfony errors
  
## Install
Via composer create-project

    composer create-project -s dev ivoba/superleansilexplate PATH/TO/YOUR/APP 2.*
    cd PATH/TO/YOUR/APP

## Requirements
- bower, composer will call bower install

# Usage
Api and web are designed to run on their own resp. subdomains with their resp starting point in /web.
If you want to only have one starting point copy this to web.php:

    $api = require __DIR__ . '/Controller/api.php';
    $app->mount('/api', $api);


## Config
In dev environment we use dotenv for configuration, so you can use a .env file in the project root to mimic Env vars.
## Templates
Start hacking in resources/views/*.twig
## Controller
Start hacking in src/Controllers/*.php
## Provider
Add provider in src/app.php
## Cli Commands
Create cli commands in src/Command and  
register them in src/cli.php

# Run
Run it with the php integrated webserver: http://silex.sensiolabs.org/doc/web_servers.html  
or create a apache / nginx vhost.

## Run Web

     php console server:run
     
     # in prod env
     php console server:run -e prod

and open http://127.0.0.1:8000


## Run Api

     php console server:run -i api
     
and open http://127.0.0.1:8000
    
## Run Cli

    SILEX_ENV=dev php -d variables_order=EGPCS console silex:hello-world
    # for cache clear
    php console cache:clear
    

Tests
-----
`phpunit`
    
