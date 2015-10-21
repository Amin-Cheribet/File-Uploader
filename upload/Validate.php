<?php
namespace upload;

class Validate extends FileInfo implements ValidateInterface
{

  public $errors = array();

  function __construct($FilePath)
  {
    if (is_uploaded_file($FilePath)) {
      parent::__construct($FilePath);
    } else {
      $errors[] = "Files Was Not Uploaded";
      $this->errors = array_unique($this->errors);
    }
  }

  public function Size($AllowedSize)
  {
    foreach ($this->FilesToUpload as $File) {
      if($this->getSize($File) > $AllowedSize) {
        $this->errors[] = "File size Not Allowed : ".$this->getName($File);
        $this->errors = array_unique($this->errors);
      }
    }
    return $this;
  }

  public function Extension($AllowedExtension)
  {
    $AllowedExtension = explode(",", $AllowedExtension);
    $AllowedExtension = array_map('strtolower', $AllowedExtension);
    foreach ($this->FilesToUpload as $File ) {
      if (!in_array($this->getExtension($File), $AllowedExtension) and $this->getExtension($File)) {
        $this->errors[] = "Extension Not Allowed ".$this->getExtension($File);
        $this->errros = array_unique($this->errors);
      }
    }
    return $this;
  }
  public function Exist()
  {
    foreach ($this->FilesToUpload as $File ) {
      if (!$this->getName($File)) {
        $this->errors[] = "File was Not selected";
        $this->errors = array_unique($this->errors);
      }
    }
    return $this;
  }

}

 ?>
