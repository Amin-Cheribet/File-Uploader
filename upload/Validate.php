<?php

namespace Upload;

class Validate extends FileInfo implements ValidateInterface
{
    public $Errors = [];

    public function __construct(string $filePath)
    {
        if (is_uploaded_file($filePath)) {
            parent::__construct($filePath);
        } else {
            $this->Errors[] = 'Files Was Not Uploaded';
        }
    }

    public function size(int $allowedSize)
    {
        if ($this->getSize() > $allowedSize) {
            $this->Errors[] = 'File size Not Allowed : '.$this->getName();
        }

        return $this;
    }

    public function extension(string $allowedExtension)
    {
        $allowedExtension = explode(',', $allowedExtension);
        $allowedExtension = array_map('strtolower', $allowedExtension);
        if (!in_array($this->getExtension(), $allowedExtension) and $this->getExtension()) {
            $this->Errors[] = 'Extension Not Allowed : '.$this->getExtension();
        }

        return $this;
    }

    public function exist()
    {
        if (!$this->getName()) {
            $this->Errors[] = 'File was Not selected';
        }

        return $this;
    }
}
