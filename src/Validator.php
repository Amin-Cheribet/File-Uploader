<?php

namespace Upload;

class Validator
{
    private $filesCollection;
    private $errors = [];

    public function __construct(FilesCollection $filesCollection)
    {
        $this->filesCollection = $filesCollection;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function size(float $min, float $max): self
    {
        foreach ($this->filesCollection as $file) {
            if ($file->getSize() < $min*pow(1024,2) or $file->getSize() > $max*pow(1024,2)) {
                $this->errors[] = substr($file->getUserFileName(),0 , 10)." file size must be between: $min MB & $max MB";
            }
        }

        return $this;
    }

    public function extension(array $extensions): self
    {
        foreach ($this->filesCollection as $file) {
            if (!in_array($file->getExtension(), $extensions)) {
                $this->errors[] = $file->getUserFileName()." Allowed extensions are: ".implode(', ', $extensions);
            }
        }

        return $this;
    }

    public function number(int $min, int $max = null): self
    {
        $number = $this->filesCollection->count();
        if ($number < $min) {
            $this->errors[] = "Minimum files required is: $min";
        }
        if (!is_null($max) && $number > $max) {
            throw new \Exception("trying to upload over limited number of files", 39);
        }

        return $this;
    }
}
