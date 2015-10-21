<?php
namespace upload;

class File extends Validate
{

  private $FilesToUpload = array();

  function __construct($key, $File = false)
  {
    if (!isset($File)) {
      $File = array(
        'name' => $_FILES[$key]['name'],
        'tmp_name' => $_FILES[$key]['tmp_name']
      );
    }
    $FilePath = $File['name'];
    $FileName = explode(".", $File["name"]);
    $this->setName($FileName[0]);
    $this->setExtension(strtolower(end(explode(".", $File["name"]))));
    // $File Will be passed to $FilesToUpload so Upload() be able to upload multipal Files
    $File['Extension'] = $this->getExtension();
    $this->FilesToUpload[] = $File;

    parent::__construct($FilePath);
  }

  public function Upload($newPath)
  {
    if (empty($this->errors) && is_dir($newPath) && is_writable($newPath)) {
      foreach ($this->FilesToUpload as $File) {
        $Path = $newPath.DIRECTORY_SEPARATOR.$File['name'];
        move_uploaded_file($File['tmp_name'], $Path);
      }
      return true;
    } else {
      $this->errors[] = "No access this directory";
      return false;
    }
  }

}
