<?php
namespace upload;

interface FileInfoInterface
{
  public function getName();
  public function setName($newName);
  public function getSize();
  public function getExtension();
  public function setExtension($newExtension);
}
