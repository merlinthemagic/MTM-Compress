<?php
//� 2019 Martin Peter Madsen
namespace MTM\Compress\Facts;

class Tools extends Base
{
	public function getZipCompress()
	{
		if (array_key_exists(__FUNCTION__, $this->_s) === false) {
			$this->_s[__FUNCTION__]	= new \MTM\Compress\Tools\Zip\Compress\Zulu();
		}
		return $this->_s[__FUNCTION__];
	}
	public function getZipUncompress()
	{
		if (array_key_exists(__FUNCTION__, $this->_s) === false) {
			$this->_s[__FUNCTION__]	= new \MTM\Compress\Tools\Zip\Uncompress\Zulu();
		}
		return $this->_s[__FUNCTION__];
	}
}