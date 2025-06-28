<?php
//� 2019 Martin Peter Madsen
namespace MTM\Compress\Facts;

class Archives extends Base
{
	public function getZip($v=1)
	{
		$this->isUsign32Int($v, true);
		if ($v === 1) {
			$rObj	= new \MTM\Compress\Models\Zip\V1\Zulu();
		} else {
			throw new \Exception("Not handled for version: '".$v."'", 1111);
		}
		
		return $rObj;
	}
}