<?php

namespace Upload;

class FileInfo implements FileInfoInterface
{
    private $name;
    private $extension;
    private $size;
    private $tmpName;

    public function __construct(string $FilePath)
    {
        $this->name = $this->name ? $this->name : pathinfo($FilePath, PATHINFO_FILENAME);
        $this->size = filesize($FilePath);
        $this->tmpName = $FilePath;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $newName)
    {
        $this->name = $newName;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function setExtension(string $newExtension)
    {
        $this->extension = $newExtension;
    }

    public function getTmpName()
    {
        return $this->tmpName;
    }

    public function setTmpName(string $TmpName)
    {
        $this->tmpName = $TmpName;
    }

    public function Compress(int $quality)
    {
        $info = getimagesize($this->tmpName);

        if ($info['mime'] == 'image/jpeg') {
            $image = imagecreatefromjpeg($this->tmpName);
        } elseif ($info['mime'] == 'image/gif') {
            $image = imagecreatefromgif($this->tmpName);
        } elseif ($info['mime'] == 'image/png') {
            $image = imagecreatefrompng($this->tmpName);
        }

        imagejpeg($image, $this->tmpName, $quality);

        return $this->tmpName;
    }
}
