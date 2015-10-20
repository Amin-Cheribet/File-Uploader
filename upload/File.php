<?php
namespace upload;

class File extends Validate
{

  private $FilePath;

  function __construct($key)
  {
    $this->FilePath = $_FILES[$key]["tmp_name"];
    parent::__construct($this->FilePath);
    $FileName = explode(".", $_FILES[$key]["name"]);
    $this->setName($FileName[0]);
    $this->setExtension(strtolower(end(explode(".", $_FILES[$key]["name"]))));
  }

  public function Upload($newPath)
  {
    if (empty($this->errors)) {
      move_uploaded_file($this->FilePath, $newPath.DIRECTORY_SEPARATOR.$this->getName().".".$this->getExtension());
      return true;
    } else {
      return false;
    }
  }

}
