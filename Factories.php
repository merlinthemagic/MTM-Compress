<?php
//© 2019 Martin Peter Madsen
namespace MTM\Compress;

class Factories
{
	private static $_cStore=array();
	
	//USE: $aFact		= \MTM\Compress\Factories::$METHOD_NAME();
	
	public static function getZip()
	{
		if (array_key_exists(__FUNCTION__, self::$_cStore) === false) {
			self::$_cStore[__FUNCTION__]	= new \MTM\Compress\Factories\Zip();
		}
		return self::$_cStore[__FUNCTION__];
	}
}