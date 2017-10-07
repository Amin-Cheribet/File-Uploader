<?php

namespace Upload;

class File extends Validate
{
    public function __construct($key, $file = false)
    {
        if (!$file) {
            $file = [
                'name'     => $_FILES[$key]['name'],
                'tmp_name' => $_FILES[$key]['tmp_name'],
            ];
        }
        $filePath = $file['tmp_name'];
        $fileName = explode('.', $file['name']);
        $this->setName(uniqid());
        $this->setExtension(strtolower(end($fileName)));
        parent::__construct($filePath);
    }

    public function upload(string $newPath)
    {
        if (is_dir($newPath) && is_writable($newPath)) {
            if (empty($this->Errors)) {
                $path = $newPath.DIRECTORY_SEPARATOR.$this->getName().'.'.$this->getExtension();
                move_uploaded_file($this->getTmpName(), $path);

                return ['name' => $this->getName().'.'.$this->getExtension(), 'dir' => $path];
            } else {
                $this->Errors[] = 'some errors accured during uploading';
                return false;
            }
        } else {
            $this->Errors[] = "No access to this directory $newPath";

            return false;
        }
    }
}
