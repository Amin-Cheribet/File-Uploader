<?php

namespace Upload;

interface FileInfoInterface
{
    public function getName();

    public function setName(string $newName);

    public function getSize();

    public function getExtension();

    public function setExtension(string $newExtension);

    public function getTmpName();

    public function setTmpName(string $tmpName);

    public function compress(int $quality);
}
