<?php
namespace upload;

class MultiFile extends File
{
  private $Files = array();

  function __construct($key)
  {
    for ($i=0; $i < count($_FILES[$key]['name']); $i++) {
      $this->Files[] = array(
        'name' => $_FILES[$key]['name'][$i],
        'tmp_name' => $_FILES[$key]['tmp_name'][$i]
        );
    }
    foreach ($this->Files as $File) {
      parent::__construct($key, $File);
    }
  }
}
