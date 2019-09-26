<?php
//© 2019 Martin Peter Madsen
namespace MTM\Compress\Models\Zip;

class Uncompress
{	
	public function inflate($file, $dstDir=null)
	{
		if (is_object($file) === false) {
			$file	= \MTM\FS\Factories::getFiles()->getFileFromPath($file);
		}
		if ($file->getExists() === false) {
			throw new \Exception("File does not exist");
		} elseif (extension_loaded("zip") === false) {
			throw new \Exception("The php-zip extension is not installed");
		}
		
		$zipObj 	= new \ZipArchive;
		$valid		= $zipObj->open($file->getPathAsString());
		if ($valid === true) {
			
			if ($dstDir === null) {
				//create a temp dir and unzip there
				$dstDir	= \MTM\FS\Factories::getDirectories()->getTempDirectory();
			} elseif (is_object($dstDir) === false) {
				$dstDir	= \MTM\FS\Factories::getDirectories()->getDirectory($dstDir);
			}

			$valid	= $zipObj->extractTo($dstDir->getPathAsString());
			$zipObj->close();
			if ($valid === false) {
				throw new \Exception("Failed to extract data");
			} elseif ($dstDir->getFreeBytes() < 1) {
				//extractTo is supposed to return false if there was an error
				//but it return true if it runs out of space, so we make a seperate check
				//hours of tracking down partly written files
				//obviously there is an edge case where the data fits to the byte, cannot cover that yet
				throw new \Exception("Out of disk space, extraction failed");
			}
			return $dstDir;
			
		} else {
			throw new \Exception("Failed to open file");
		}
	}
}