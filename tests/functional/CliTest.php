<?php
namespace Superleansilexplate\Tests;

use Ivoba\Silex\Console\Application;

class CliTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->app = require __DIR__ . '/../../src/cli.php';
    }
    public function testConstruct()
    {
        $this->assertInstanceOf(Application::class, $this->app);
        $this->assertEquals('Superleansilexplate', $this->app->getName());
        $this->assertEquals('1.0', $this->app->getVersion());
    }

    public function testCommand()
    {
        $this->assertTrue($this->app->has('silex:hello-world'));
    }
}