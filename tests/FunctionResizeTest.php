<?php

include 'Configuration.php';

class FunctionResizeTest extends PHPUnit_Framework_TestCase
{
    protected $defaults;

    public function setUp()
    {
        $this->defaults = array(
            'crop' => false,
            'scale' => 'false',
            'thumbnail' => false,
            'maxOnly' => false,
            'canvas-color' => 'transparent',
            'output-filename' => false,
            'cacheFolder' => './cache/',
            'remoteFolder' => './cache/remote/',
            'quality' => 90,
            'cache_http_minutes' => 20
        );
    }
    public function testOpts()
    {
        $this->assertInstanceOf('Configuration', new Configuration);
    }

    public function testDefaults()
    {
        $this->assertEquals($this->defaults, (new Configuration())->asHash());
    }

    public function testNullConfiguration()
    {
        $this->assertEquals($this->defaults, (new Configuration(null))->asHash());
    }

    public function testDefaultsNotOverrideConfiguration()
    {
        $opts = array(
            'thumbnail' => true,
            'maxOnly' => true
        );
        $notNullOptions = new Configuration($opts);

        $this->assertTrue($notNullOptions->asHash()['thumbnail']);
        $this->assertTrue($notNullOptions->asHash()['maxOnly']);
    }

    public function testObtainCache()
    {
        $this->assertEquals('./cache/', (new Configuration())->obtainCache());
    }

    public function testObtainRemote()
    {
        $this->assertEquals('./cache/remote/', (new Configuration())->obtainRemote());
    }

    public function testObtainConvertPath()
    {
        $this->assertEquals('convert', (new Configuration())->obtainConvertPath());
    }
}
