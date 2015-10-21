<?php
namespace upload;

class FileInfo implements FileInfoInterface
{

	protected $Name;
	protected $Extension;
	protected $Size;

	function __construct($FilePath)
	{
		$this->Name = pathinfo($FilePath, PATHINFO_FILENAME);
		$this->Size = filesize($FilePath);
	}

	public function getName($File = false)
	{
		if ($File) {
			return $File["name"];
		} else {
			return $this->Name;
		}
	}
	public function setName($newName)
	{
		$this->Name = $newName;
	}

	public function getSize($File = false)
	{
		if ($File) {
			return filesize($File['tmp_name']);
		} else {
			return $this->Size;
		}
	}

	public function getExtension($File = false)
	{
		if ($File) {
			return $File["Extension"];
		} else {
			return $this->Extension;
		}
	}

	public function setExtension($newExtension)
	{
		$this->Extension = $newExtension;
	}

}
