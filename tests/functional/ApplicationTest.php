<?php
use Silex\WebTestCase;
use Symfony\Component\HttpFoundation\SessionStorage\FilesystemSessionStorage;

class ApplicationTest extends WebTestCase
{
    public function createApplication()
    {
        // Silex
        $this->app = require __DIR__.'/../../src/app.php';
        // Tests mode
        $this->app['debug'] = true;
        unset($this->app['exception_handler']);
        
        // Use FilesystemSessionStorage to store session
        $this->app['session.storage'] = $this->app->share(function() {
            return new FilesystemSessionStorage(sys_get_temp_dir());
        });
        return $app;
    }

    public function test404()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/give-me-a-404');
        $this->assertTrue($client->getResponse()->isNotFound());
    }
    public function testIndex(){
    	$client = $this->createClient();
	$crawler = $client->request('GET', '');
	$this->assertTrue($client->getResponse()->isOk());
    }
    public function testTranslate(){
        $client = $this->createClient();
	$crawler = $client->request('GET', '');
	$this->assertTrue($client->getResponse()->isOk());
	//TODO fetch values from translations
	$this->assertTrue($crawler->filter('html:contains("Homepage")')->count() > 0);
    }
    public function testTranslateDe(){
        $this->app['locale'] = 'de';
	$client = $this->createClient();
	$crawler = $client->request('GET', '');
	$this->assertTrue($client->getResponse()->isOk());
	//TODO fetch values from translations
	$this->assertTrue($crawler->filter('html:contains("Startseite")')->count() > 0);
    }
}
