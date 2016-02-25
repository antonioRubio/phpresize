<?php
require 'ImagePath.php';

class ImagePathTest extends PHPUnit_Framework_TestCase
{

    public function testIsSanitizedAtInstatiation()
    {
        $url = 'https://www.google.es/webhp?sourceid=chrome-instant&ion=1&espv=2&ie=UTF-8#q=dictionary%20caspa%20vupor';
        $expected = 'https://www.google.es/webhp?sourceid=chrome-instant&ion=1&espv=2&ie=UTF-8#q=dictionary caspa vupor';
        $this->assertEquals($expected, (new ImagePath($url))->sanitizedPath());
    }

    public function testIsHttpProtocol()
    {
        $url = 'https://example.com';
        $this->assertTrue((new ImagePath($url))->isHttpProtocol());
        $newUri = 'ftp://example.com';
        $this->assertFalse((new ImagePath($newUri))->isHttpProtocol());
        $this->assertFalse((new ImagePath(null))->isHttpProtocol());
    }

    public function testObtainFilename()
    {
        $url = 'http://martinfowler.com/mf.jpg?query=hello&s=fowler';
        $this->assertEquals('mf.jpg', (new ImagePath($url))->obtainFilename());
    }
}
