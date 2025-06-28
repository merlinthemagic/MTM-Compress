<?php
//� 2019 Martin Peter Madsen
namespace MTM\Compress;

class Facts
{
	private static $_s=array();
	
	//USE: $aFact		= \MTM\Compress\Facts::$METHOD_NAME();
	
	public static function getArchives()
	{
		if (array_key_exists(__FUNCTION__, self::$_s) === false) {
			self::$_s[__FUNCTION__]	= new \MTM\Compress\Facts\Archives();
		}
		return self::$_s[__FUNCTION__];
	}
	public static function getTools()
	{
		if (array_key_exists(__FUNCTION__, self::$_s) === false) {
			self::$_s[__FUNCTION__]	= new \MTM\Compress\Facts\Tools();
		}
		return self::$_s[__FUNCTION__];
	}
}