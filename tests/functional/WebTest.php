<?php

use Silex\WebTestCase;
use Silex\Application;

class WebTest extends WebTestCase
{
    public function createApplication()
    {
        $app = require __DIR__ . '/../../src/web.php';
        return $app;
    }

    public function testIndex()
    {
        $client = $this->createClient();

        $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function test404()
    {
        $client = $this->createClient();

        $client->request('GET', '/404');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

}