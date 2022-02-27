<?php

use PHPUnit\Framework\TestCase;

class uploadTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $_FILES = [
        'image'    => [
            'name'      => 'test.jpg',
            'tmp_name'  => __DIR__.'/helpers/tmpfile',
            'type'      => 'image/jpeg',
            'size'      => 182447,
            'error'     => 0,
            ],
        'image2'   => [
            'name'      => '',
            'tmp_name'  => '',
            'type'      => '',
            'size'      => '',
            'error'     => '',
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

    public function tearDown(): void
    {
        unlink(__DIR__.'/helpers/tmpfile');
        unlink(__DIR__.'/helpers/tmpfile1');
        unlink(__DIR__.'/helpers/tmpfile2');
    }

    public function testExist()
    {
        $upload = new \Upload\Upload('image');
        $this->assertTrue($upload->exist());

        $upload = new \Upload\Upload('images');
        $this->assertTrue($upload->exist());

        $upload = new \Upload\Upload('image2');
        $this->assertTrue($upload->exist());
    }

    public function testProcess()
    {
        $upload = new \Upload\Upload('image');
        $process = $upload->process();
        $this->assertInstanceOf(\Upload\FileProcessor::class, $process);
    }

    public function testValidate()
    {
        $upload = new \Upload\Upload('image');
        $validate = $upload->validate();
        $this->assertInstanceOf(\Upload\Validator::class, $validate);
    }

    public function testIsValide()
    {
        $upload = new \Upload\Upload('image');
        $this->assertTrue($upload->isValide());
        $upload->validate()->extension(['exe']);
        $this->assertFalse($upload->isValide());
    }

    public function testGetErrors()
    {
        $upload = new \Upload\Upload('image');
        $upload->validate()->size(1, 2)->extension(['mp3']);
        $this->assertTrue(is_array($upload->getErrors()));

        $uploads = new \Upload\UPload('images');
        $uploads->validate()->size(1, 2)->extension(['mp3']);
        $this->assertTrue(is_array($uploads->getErrors()));
    }
}
