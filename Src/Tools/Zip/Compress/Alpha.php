<?php
//� 2019 Martin Peter Madsen
namespace MTM\Compress\Tools\Zip\Compress;

abstract class Alpha extends \MTM\Compress\Tools\Base
{
	public function addByData($zipObj, $fileName, $data)
	{
		if ($zipObj instanceof \MTM\Compress\Models\Zip\V1\Zulu === false) {
			throw new \Exception("Invalid zip object input", 1111);
		} elseif ($this->isStr($fileName, false) === false) {
			throw new \Exception("Invalid file name input", 1111);
		} elseif (strlen($data) === 0) {
			throw new \Exception("Invalid data input", 1111);
		}
		$archObj	= $zipObj->getArchive();
		$archObj->addFromString($fileName, $data);
		
		return $archObj;
	}
}