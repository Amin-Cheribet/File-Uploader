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
    if($this->getSize() > $AllowedSize) {
      $this->errors[] = "File size Not Allowed : ".$this->getName();
    }
    return $this;
  }

  public function Extension($AllowedExtension)
  {
    $AllowedExtension = explode(",", $AllowedExtension);
    $AllowedExtension = array_map('strtolower', $AllowedExtension);
    if (!in_array($this->getExtension(), $AllowedExtension) and $this->getExtension()) {
      $this->errors[] = "Extension Not Allowed ".$this->getExtension();
    }
    return $this;
  }
  public function Exist()
  {
    if (!$this->getName()) {
      $this->errors[] = "File was Not selected";
    }
    return $this;
  }

}

 ?>
