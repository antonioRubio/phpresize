<?php

include 'Options.php';

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
        $this->assertInstanceOf('Options', new Options);
    }

    public function testDefaults()
    {
        $this->assertEquals($this->defaults, (new Options())->asHash());
    }

    public function testNullConfiguration()
    {
        $this->assertEquals($this->defaults, (new Options(null))->asHash());
    }

    public function testDefaultsNotOverrideConfiguration()
    {
        $configuration = array(
            'thumbnail' => true,
            'maxOnly' => true
        );
        $notNullOptions = new Options($configuration);

        $this->assertTrue($notNullOptions->asHash()['thumbnail']);
        $this->assertTrue($notNullOptions->asHash()['maxOnly']);
    }
}
