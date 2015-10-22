<?php
namespace upload;

class FileInfo implements FileInfoInterface
{

	private $Name;
	private $Extension;
	private $Size;
	private $TmpName;

	function __construct($FilePath)
	{
		$this->Name = pathinfo($FilePath, PATHINFO_FILENAME);
		$this->Size = filesize($FilePath);
		$this->TmpName = $FilePath;
	}

	public function getName()
	{
		return $this->Name;
	}

	public function setName($newName)
	{
		$this->Name = $newName;
	}

	public function getSize($File = false)
	{
		return $this->Size;
	}

	public function getExtension($File = false)
	{
		return $this->Extension;
	}

	public function setExtension($newExtension)
	{
		$this->Extension = $newExtension;
	}

	public function getTmpName()
	{
		return $this->TmpName;
	}

	public function setTmpName($TmpName)
	{
		$this->TmpName = $TmpName;
	}

}
