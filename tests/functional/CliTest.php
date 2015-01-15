<?php
namespace Superleansilexplate\Tests;

class CliTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->app = require __DIR__ . '/../../src/cli.php';
    }
    public function testConstruct()
    {
        $this->assertInstanceOf('Knp\Console\Application', $this->app);
        $this->assertEquals('Superleansilexplate', $this->app->getName());
        $this->assertEquals('1.0', $this->app->getVersion());
    }

    public function testCommand()
    {
        $this->assertTrue($this->app->has('superleansilexplate:hello-world'));
    }
}