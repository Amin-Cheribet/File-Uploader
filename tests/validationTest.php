<?php

use PHPUnit\Framework\TestCase;

class validationTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $_FILES = [
        'image'    =>  [
            'name'      =>  ['test.jpg'],
            'tmp_name'  =>  [__DIR__ . '/helpers/tmpfile'],
            'type'      =>  ['image/jpeg'],
            'size'      =>  [182447],
            'error'     =>  [0],
        ]
    ];
    copy(__DIR__.'/helpers/testfile', __DIR__.'/helpers/tmpfile');
    }

    public function tearDown()
    {
        unlink(__DIR__.'/helpers/tmpfile');
    }

    public function testSize()
    {
        $file = new Upload\Upload('image');
        $file->validate()->size(0, 0.1);
        $this->assertFalse($file->isValide());
    }

    public function testExtension()
    {
        $file = new Upload\Upload('image');
        $file->validate()->extension(['jpg']);
        $this->assertTrue($file->isValide());
        $file->validate()->extension(['png', 'mp3']);
        $this->assertFalse($file->isValide());
    }

    public function testMinimumNumber()
    {
        $file = new Upload\Upload('image');
        $file->validate()->number(1);
        $this->assertTrue($file->isValide());
        $file->validate()->number(2);
        $this->assertFalse($file->isValide());
    }

    public function testBetweenNumber()
    {
        $file = new Upload\Upload('image');
        $file->validate()->number(1,3);
        $this->assertTrue($file->isValide());
        $file->validate()->number(2,5);
        $this->assertFalse($file->isValide());
    }
}
