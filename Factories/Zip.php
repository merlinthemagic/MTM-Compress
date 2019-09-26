<?php
//© 2019 Martin Peter Madsen
namespace MTM\Compress\Factories;

class Zip extends Base
{
	public function getUncompress()
	{
		if (array_key_exists(__FUNCTION__, $this->_cStore) === false) {
			$this->_cStore[__FUNCTION__]	= new \MTM\Compress\Models\Zip\Uncompress();
		}
		return $this->_cStore[__FUNCTION__];
	}
}