# Superlean Silex Starterplate

- web
- api
- console

## Install
- composer create-project

    composer create-project ivoba/superleansilexplate . 1.*

- bower install

## Requirements
- bower

## Features
- console provider
- http_cache
- dotenv
- twig

### Debug
- symfony vardumper and stop
- symfony errors


# Run
http://silex.sensiolabs.org/doc/web_servers.html
FOO=BAR php -d variables_order=EGPCS -S localhost:9090 /tmp/test.php
## Run Web

    php -S localhost:8080 -t web web/index.php

## Run Api

    php -S localhost:8088 -t web web/api.php
    
## Run Cli

    php console superleansilexplate:hello-world
    
## TODO
- composer create-project
- dotenv provider
