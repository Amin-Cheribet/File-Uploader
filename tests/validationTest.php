<?php

use PHPUnit\Framework\TestCase;

class validationTest extends TestCase
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

    public function testSize()
    {
        $file = new \Upload\Upload('image');
        $file->validate()->size(0, 1);
        $this->assertTrue($file->isValide());
        $file->validate()->size(10, 20);
        $this->assertFalse($file->isValide());

        $files = new \Upload\Upload('images');
        $files->validate()->size(0, 1);
        $this->assertTrue($files->isValide());
        $files->validate()->size(10, 20);
        $this->assertFalse($files->isValide());
    }

    public function testExtension()
    {
        $file = new \Upload\Upload('image');
        $file->validate()->extension(['jpg']);
        $this->assertTrue($file->isValide());
        $file->validate()->extension(['png', 'mp3']);
        $this->assertFalse($file->isValide());

        $files = new \Upload\Upload('images');
        $files->validate()->extension(['jpg']);
        $this->assertTrue($files->isValide());
        $files->validate()->extension(['png', 'mp3']);
        $this->assertFalse($files->isValide());
    }

    public function testMinimumNumber()
    {
        $file = new \Upload\Upload('image');
        $file->validate()->number(1);
        $this->assertTrue($file->isValide());
        $file->validate()->number(2);
        $this->assertFalse($file->isValide());

        $files = new \Upload\Upload('images');
        $files->validate()->number(2);
        $this->assertTrue($files->isValide());
        $files->validate()->number(3);
        $this->assertFalse($files->isValide());
    }

    public function testBetweenNumber()
    {
        $file = new \Upload\Upload('image');
        $file->validate()->number(1, 3);
        $this->assertTrue($file->isValide());
        $file->validate()->number(2, 5);
        $this->assertFalse($file->isValide());

        $files = new \Upload\Upload('images');
        $files->validate()->number(1, 3);
        $this->assertTrue($files->isValide());
        $files->validate()->number(3, 5);
        $this->assertFalse($files->isValide());
    }
}
