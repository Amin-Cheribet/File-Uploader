<?php

use PHPUnit\Framework\TestCase;

class processFileTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $_FILES = [
        'image'    => [
            'name'      => ['test.jpg'],
            'tmp_name'  => [__DIR__.'/helpers/tmpfile'],
            'type'      => ['image/jpeg'],
            'size'      => [182447],
            'error'     => [0],
        ],
    ];
        copy(__DIR__.'/helpers/testfile', __DIR__.'/helpers/tmpfile');
    }

    public function tearDown()
    {
        unlink(__DIR__.'/helpers/tmpfile');
    }

    public function testCompression()
    {
        $image = new \Upload\Upload('image');
        $image->process()->compress(50);
        $this->assertNotEquals(filesize(__DIR__.'/helpers/tmpfile'), filesize(__DIR__.'/helpers/testfile'));
    }

    public function testResize()
    {
        $image = new \Upload\Upload('image');
        $image->process()->resize(300, 100);
        $this->assertNotEquals(getimagesize(__DIR__.'/helpers/tmpfile'), getimagesize(__DIR__.'/helpers/testfile'));
    }
}
