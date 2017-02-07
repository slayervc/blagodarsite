<?php 

namespace EvrySoft\Helpers;



/**
* 
*/
class CheckRequestHelper
{
	
	public static function isAjax()
	{
		$isAjax = $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ? true : false;
			
		return $isAjax;
	}


}
