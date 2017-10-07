<?php

namespace Upload;

class MultiFile
{
    public $files = [];
    public $Errors = [];

    public function __construct($key)
    {
        for ($i = 0; $i < count($_FILES[$key]['name']); $i++) {
            if (is_uploaded_file($_FILES[$key]['tmp_name'][$i])) {
                $data = [
                'name'     => $_FILES[$key]['name'][$i],
                'tmp_name' => $_FILES[$key]['tmp_name'][$i],
                ];
                $this->files[] = new File($key, $data);
            }
        }
    }

    public function upload($newPath)
    {
        $returns = [];
        if (empty($this->getErrors())) {
            foreach ($this->files as $file) {
                $returns[] = $file->Upload($newPath);
            }

            return $returns;
        } else {
            return false;
        }
    }

    public function size($size)
    {
        foreach ($this->files as $file) {
            $file->Size($size);
        }

        return $this;
    }

    public function extension($allowedExtensions)
    {
        foreach ($this->files as $file) {
            $file->extension($allowedExtensions);
        }

        return $this;
    }

    public function exist()
    {
        foreach ($this->files as $file) {
            $file->exist();
        }

        return $this;
    }

    public function compress(int $quality)
    {
        foreach ($this->files as $file) {
            $file->compress($quality);
        }

        return $this;
    }

    public function max(int $max)
    {
        if (count($this->files) > $max) {
            $this->Errors[] = "Please select Less than $max";
        }

        return $this;
    }

    public function min(int $min)
    {
        if (count($this->files) < $min) {
            $this->Errors[] = "Please select More than $min";
        }

        return $this;
    }

    public function getErrors()
    {
        foreach ($this->files as $file) {
            $this->Errors = array_merge($this->Errors, $file->Errors);
        }
        $this->Errors = array_unique($this->Errors);
        sort($this->Errors);

        return $this->Errors;
    }

    public function setNames(array $names)
    {
        for ($i=0; $i < count($this->files); $i++) {
            $this->files[$i]->setName($names[$i]);
        }
    }

    public function getNames()
    {
        $names = [];
        for ($i=0; $i < count($this->files); $i++) {
            $names[] = $this->files[$i]->getname();
        }
    }

    public function getExtensions()
    {
        $extensions = [];
        foreach ($files as $file) {
            $extensions  = $file->getExtension();
        }

        return $extensions;
    }
}
