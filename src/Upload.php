<?php

namespace Upload;

class Upload
{
    private $filesCollection;
    private $filesData         = [];
    private $uploadedFilesData = [];

    public function __construct(string $field)
    {
        $this->filesCollection = new FilesCollection($field);
        $this->validator       = new Validator($this->filesCollection);
        $this->FileProcessor   = new FileProcessor($this->filesCollection);
    }

    public function process()
    {
        return $this->FileProcessor;
    }

    public function validate(): Validator
    {
        return $this->validator;
    }

    public function isValide(): bool
    {
        return count($this->validator->getErrors()) ? false : true;
    }

    public function getErrors(): array
    {
        return $this->validator->getErrors();
    }

    public function getUploadedFilesData(): array
    {
        return $this->uploadedFilesData;
    }

    public function save(string $dir): void
    {
        if (!is_dir($dir) or !is_writable($dir)) {
            throw new \Exception("can't write files in $dir", 41);
        }

        foreach ($this->filesCollection as $file) {
            $path = $dir.DIRECTORY_SEPARATOR.$file->getName().'.'.$file->getExtension();

            if (!move_uploaded_file($file->getPathName(), $path)) {
                throw new \Exception("Error during uploading $path", 42);
            }

            $this->uploadedFilesData[] = [
                'id'   => uniqid(),
                'name' => $file->getName(),
                'path' => $path,
            ];
        }
    }
}
