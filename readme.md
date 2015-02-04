# Superlean Silex Starterplate

This project is supposed to be a lean starterkit for your Silex app.

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

    composer create-project -s dev ivoba/superleansilexplate PATH/TO/YOUR/APP 1.*
    cd PATH/TO/YOUR/APP

## Requirements
- bower

# Usage

## Config
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

## Run Web

    SILEX_ENV=dev php -d variables_order=EGPCS -S localhost:8080 -t web web/index.php

## Run Api

    SILEX_ENV=dev php -d variables_order=EGPCS -S localhost:8088 -t web web/api.php
    
## Run Cli

    SILEX_ENV=dev php -d variables_order=EGPCS console superleansilexplate:hello-world
    
or create a apache / nginx vhost.
    
## TODO
- .htaccess from h5bp
- composer create-project, check if works
- suggest block in composer.json
- different controller structure:
- index.php->app.php->mount(web)->mount(api) ?
- explain dotenv

