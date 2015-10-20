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

	public function getName()
	{
		return $this->Name;
	}
	public function setName($newName)
	{
		$this->Name = $newName;
	}

	public function getSize()
	{
		return $this->Size;
	}

	public function getExtension()
	{
		return $this->Extension;
	}

	public function setExtension($newExtension)
	{
		$this->Extension = $newExtension;
	}

}
