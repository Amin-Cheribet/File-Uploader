<?php

namespace Upload;

interface ValidateInterface
{
    public function size(int $allowedSize);

    public function extension(string $allowedExtension);

    public function exist();
}
