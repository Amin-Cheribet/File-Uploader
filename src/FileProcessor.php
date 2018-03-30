<?php

namespace Upload;

class FileProcessor
{
    private $filesCollection;

    public function __construct(FilesCollection $filesCollection)
    {
        $this->filesCollection = $filesCollection;
    }

    public function compress(int $quality): self
    {
        foreach ($this->filesCollection as $file) {
            $imageInfo = getimagesize($file->getPathname());

            switch ($imageInfo['mime']) {
                case 'image/jpeg':
                    $image = imagecreatefromjpeg($file->getPathname());
                    imagejpeg($image, $file->getPathname(), $quality);
                    break;
                case 'image/gif':
                    $image = imagecreatefromgif($file->getPathname());
                    imagegif($image, $file->getPathname(), $quality);
                    break;
                case 'image/png':
                    $image = imagecreatefrompng($file->getPathname());
                    imagepng($image, $file->getPathname(), $quality/10);
                    break;
                default:
                    throw new \Exception("compress can only be applied to images", 43);
                    break;
            }
        }

        return $this;
    }

    public function resize(int $width, int $height = null): self
    {
        foreach ($this->filesCollection as $file) {
            $imageInfo = getimagesize($file->getPathname());

            switch ($imageInfo['mime']) {
                case 'image/jpeg':
                    $image = imagecreatefromjpeg($file->getPathname());
                    $scaledImage = imagescale($image, $width, $height);
                    imagejpeg($scaledImage, $file->getPathname());
                    break;
                case 'image/gif':
                    $image = imagecreatefromgif($file->getPathname());
                    $scaledImage = imagescale($image, $width, $height);
                    imagegif($scaledImage, $file->getPathname());
                    break;
                case 'image/png':
                    $image = imagecreatefrompng($file->getPathname());
                    $scaledImage = imagescale($image, $width, $height);
                    imagepng($scaledImage, $file->getPathname());
                    break;
                default:
                    throw new \Exception("compress can only be applied to images", 43);
                    break;
            }
        }

        return $this;
    }

    public function setNames(array $names): self
    {
        foreach ($this->filesCollection as $file) {
            $file->setName(array_shift($names));
        }

        return $this;
    }
}
