<?php

namespace Upload;

class File extends \SplFileInfo
{
    private $fileName;
    private $userFileName;
    private $definedFileName;
    private $tmpName;

    public function __construct(array $data)
    {
        $this->tmpName = $data['tmp_name'];
        $this->userFileName = $data['name'];
        parent::__construct($this->tmpName);
    }

    public function getExtension(): string
    {
        $explodedName = explode('.', $this->userFileName);

        return end($explodedName);
    }

    public function getUserFileName()
    {
        return $this->userFileName;
    }

    public function getName(): string
    {
        return $this->definedFileName ?? uniqid();
    }

    public function setName(string $name): void
    {
        $this->definedFileName = $name;
    }
}
