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
        'images' => [
            'name' => [
                'file1.jpg',
                'file2.jpg',
            ],
            'type' => [
                'image/jpeg',
                'image/jpeg',
            ],
            'tmp_name' => [
                __DIR__.'/helpers/tmpfile1',
                __DIR__.'/helpers/tmpfile2',
            ],
            'error' => [
                0,
                0,
            ],
            'size' => [
                182447,
                182447,
            ],
        ],
    ];
        copy(__DIR__.'/helpers/testfile', __DIR__.'/helpers/tmpfile');
        copy(__DIR__.'/helpers/testfile', __DIR__.'/helpers/tmpfile1');
        copy(__DIR__.'/helpers/testfile', __DIR__.'/helpers/tmpfile2');
    }

    public function tearDown()
    {
        unlink(__DIR__.'/helpers/tmpfile');
        unlink(__DIR__.'/helpers/tmpfile1');
        unlink(__DIR__.'/helpers/tmpfile2');
    }

    public function testCompression()
    {
        $image = new \Upload\Upload('image');
        $image->process()->compress(50);
        $this->assertNotEquals(filesize(__DIR__.'/helpers/tmpfile'), filesize(__DIR__.'/helpers/testfile'));

        $images = new \Upload\Upload('images');
        $images->process()->compress(75);
        $this->assertNotEquals(filesize(__DIR__.'/helpers/testfile'), filesize(__DIR__.'/helpers/tmpfile1'));
        $this->assertNotEquals(filesize(__DIR__.'/helpers/testfile'), filesize(__DIR__.'/helpers/tmpfile2'));
    }

    public function testResize()
    {
        $image = new \Upload\Upload('image');
        $image->process()->resize(300, 100);
        $this->assertNotEquals(getimagesize(__DIR__.'/helpers/testfile'), getimagesize(__DIR__.'/helpers/tmpfile'));

        $images = new \Upload\Upload('images');
        $images->process()->resize(100, 100);
        $this->assertNotEquals(getimagesize(__DIR__.'/helpers/testfile'), getimagesize(__DIR__.'/helpers/tmpfile1'));
        $this->assertNotEquals(getimagesize(__DIR__.'/helpers/testfile'), getimagesize(__DIR__.'/helpers/tmpfile2'));
    }

    public function testSetNames()
    {
        $image = new \Upload\Upload('image');
        $image->process()->setNames(['hi']);
        // geting the private property 'filesCollection'
        $imageReflection = new ReflectionClass($image);
        $property = $imageReflection->getProperty('filesCollection');
        $property->setAccessible(true);
        $filesCollection = $property->getValue($image);
        // getting the private property from filesCollection 'definedFileName'
        $filesCollectionReflection = new ReflectionClass($filesCollection[0]);
        $property = $filesCollectionReflection->getProperty('definedFileName');
        $property->setAccessible(true);
        $definedFileName = $property->getValue($filesCollection[0]);

        $this->assertEquals($definedFileName, 'hi');
    }
}
