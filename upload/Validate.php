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
      $errors[] = "Files where Not Uploaded";
    }
  }

  public function Size($AllowedSize)
  {
    if($this->getSize() > $AllowedSize) {
      $this->errors[] = "File size not Allowed";
    }
    return $this;
  }

  public function Extension($AllowedExtension)
  {
    $AllowedExtension = explode(",", $AllowedExtension);
    $AllowedExtension = array_map('strtolower', $AllowedExtension);
    var_dump($AllowedExtension);
    if (!in_array($this->getExtension(), $AllowedExtension)) {
      $this->errors[] = "Extension Not Allowed ".$this->getExtension();
    }
    return $this;
  }

}

 ?>
