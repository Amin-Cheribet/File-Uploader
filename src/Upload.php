<?php

namespace Upload;

class Upload
{
    private $filesCollection;
    private $uploadedFilesData = [];

    public function __construct(string $field)
    {
        $this->filesCollection = new FilesCollection($field);
        $this->validator       = new Validator($this->filesCollection);
        $this->FileProcessor   = new FileProcessor($this->filesCollection);
    }

    public function exist(): bool
    {
        if ($this->filesCollection->count() > 0) {
            return true;
        }

        return false;
    }

    public function process(): FileProcessor
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

    public function save(string $dir): array
    {
        $this->verifyDirectory($dir);
        $this->fillFilesData($dir);

        return $this->resolveFilesData();
    }

    private function verifyDirectory(string $dir): bool
    {
        if (!is_dir($dir) or !is_writable($dir)) {
            throw new \Exception("can't write files in $dir", 41);
        }

        return true;
    }

    private function fillFilesData(string $dir): void
    {
        foreach ($this->filesCollection as $file) {
            $path = $dir.DIRECTORY_SEPARATOR.$file->getName().'.'.$file->getExtension();

            $this->uploadToServer($file->getPathName(), $path);

            $this->uploadedFilesData[] = [
                'id'   => uniqid(),
                'name' => $file->getName(),
                'path' => $path,
            ];
        }
    }

    private function resolveFilesData(): array
    {
        if (count($this->uploadedFilesData) === 1) {
            return $this->uploadedFilesData[0];
        }

        return $this->uploadedFilesData;
    }

    private function uploadToServer(string $tmpName, string $path): void
    {
        if (!move_uploaded_file($tmpName, $path)) {
            throw new \Exception("Error during uploading $path", 42);
        }
    }
}
