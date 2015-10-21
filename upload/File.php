<?php
namespace upload;

class File extends Validate
{

  public $FilesToUpload = array();

  function __construct($key, $File = false)
  {
    if (!$File) {
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
    if (is_dir($newPath) && is_writable($newPath)) {
      if (empty($this->errors)) {
        foreach ($this->FilesToUpload as $File) {
          if ($File['name']) {
            $Path = $this->FilesToUpload[1]['name'] ? $newPath.DIRECTORY_SEPARATOR.$this->getName($File) : $newPath.DIRECTORY_SEPARATOR.$this->getName().'.'.$this->getExtension() ;
            var_dump($Path);
            $uploadedFiles[] = array('name' => $File['name'], 'dir' => $Path);
            move_uploaded_file($File['tmp_name'], $Path);
          }
        }
        return $uploadedFiles;
      } else {
        return false;
      }
    }else {
      $this->errors[] = "No access to this directory";
    }
  }

}
