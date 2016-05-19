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
    
If you want to base your app on this starter i recommend to do the following after create-project.  

- remove .git and init your own git (you should be prompted for this by composer already)
- remove composer.lock from .gitignore, so you can store your dependency lock
- you might want to replace the namespace from "Superleansilexplate" to something more custom

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
`vendor/bin/phpunit`
    

## Heroku
Superleansilexplate is [heroku](https://heroku.com) ready.  

Because we utilize bower, you will need to run multipacks while creating your heroku app: 

    heroku create --buildpack https://github.com/heroku/heroku-buildpack-multi
    
Then just initialize your heroku app as stated in the docs and push it:

    git push heroku master


## Docker
A docker setup for apache with php7 is provided.  

For using docker in dev environments run docker-compose and check on http://localhost:8088:

    docker-compose up
    
For a production build run:

   docker build -t superleansilexplate -f docker/apache-php7-prod/Dockerfile .
   docker run -it --rm -p 8088:80 --env SILEX_ENV=prod --name run-superleansilexplate superleansilexplate

## TODO:

 - yeoman setup with grunt/gulp usage
 - scrutinizr
