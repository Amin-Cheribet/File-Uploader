<?php

namespace Upload;

interface ValidateInterface
{
    public function Size($AllowedSize);

    public function Extension($AllowedExtension);

    public function Exist();
}
