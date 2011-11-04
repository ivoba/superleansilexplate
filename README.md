This project is supposed to be a lean starterkit for your Silex app.

It aims mainly at simple applications that need routing and just some additional logic. 
F.e. its a good container for javascript driven apps that get their data through API calls.

It provides:

*  HTML5 boilerplate (http://html5boilerplate.com/)
  *  Build
  *  Project structure
  *  CSS reset (optional)
*  Skeleton CSS (http://getskeleton.com)
*  Twig
*  Translation
*  Session

Installation
------------

*  `git clone`
*  `git submodule update --init --recursive`
*  `chmod 777 -R cache/ intermediate/ publish/`

Start hacking in `src/app.php`

Build
-----
*  `cd build`
*  `ant copyviews minify`

Your optimized site is now in publish, upload it your production server from there to:

*  publish/views => views
*  delete publish/views
*  publish/* => web/*

or change your FTP configs in /build/config/project.properties
and run:

*  `ant ftpupload`


Tests
-----
`phpunit`


------------
If you need more power try:
https://github.com/lyrixx/Silex-Kitchen-Edition