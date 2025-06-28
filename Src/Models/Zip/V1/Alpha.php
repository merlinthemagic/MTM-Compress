<?php
//� 2025 Martin Peter Madsen
namespace MTM\Compress\Models\Zip\V1;

abstract class Alpha extends \MTM\Compress\Models\Base
{
	protected $_phpObj=null;
	protected $_filePath="";
	protected $_fileTemp=null;
	protected $_state="un-initialized";
	
	public function __destruct()
	{
		if ($this->_fileTemp === true) {
			$fileObj	= $this->getFile(false);
			if ($fileObj !== null) {
				$fileObj->delete();
			}
		}
	}
	public function addByData($fileName, $data)
	{
		if ($this->getState() === "closed") {
			throw new \Exception("Cannot add, archive has been closed", 1111);
		}
		$this->getTool()->addByData($this, $fileName, $data);
		return $this;
	}
	public function getState()
	{
		return $this->_state;
	}
	public function getStatus()
	{
		return $this->getArchive()->status;
	}
	public function getFileCount()
	{
		return $this->getArchive()->numFiles;
	}
	public function getFileData()
	{
		$this->closeArchive();
		return $this->getFile()->getContent();
	}
	public function getTool()
	{
		return \MTM\Compress\Facts::getTools()->getZipCompress();
	}
	public function closeArchive()
	{
		if ($this->getState() === "initialized") {
			$this->getArchive()->close();
			$this->_state	= "closed";
		} elseif ($this->getState() === "closed") {
			//nada to do
		} else {
			throw new \Exception("Cannot close archive in state: '".$this->getState()."'", 1111);
		}
		return $this;
	}
	public function getArchive($filePath=null)
	{
		if ($this->_phpObj === null) {
			if (extension_loaded("zip") === false) {
				throw new \Exception("The php-zip extension is not installed", 1111);
			}
			$rObj		= new \ZipArchive();
			if ($filePath !== null) {
				$fileObj	= \MTM\FS\Factories::getFiles()->getFileFromPath($filePath);
				if ($fileObj->getExists() === false) {
					throw new \Exception("File for zip archive does not exist", 1111);
				}
			} else {
				$fileObj			= \MTM\FS\Factories::getFiles()->getTempFile("zip");
				$this->_fileTemp	= true;
			}
			//safe to over ride?
			if ($rObj->open($fileObj->getPathAsString(), \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
				throw new \Exception("Failed to open file path: '".$fileObj->getPathAsString()."' for zip archive", 1111);
			}
			$this->_phpObj			= $rObj;
			$this->_filePath		= $fileObj->getPathAsString();
			$this->_state			= "initialized";
		}
		return $this->_phpObj;
	}
	public function getFile($throw=true)
	{
		if ($this->_filePath !== "") {
			return \MTM\FS\Factories::getFiles()->getFileFromPath($this->_filePath);
		} elseif ($throw === true) {
			throw new \Exception("File has not been set", 1111);
		} else {
			return null;
		}
	}
}