<?php 

namespace EvrySoft\Handlers\Page;


/**
* 
*/
class OnBeforeProlog
{
	
	public function OnBeforeProlog()
	{
		global $USER;
		global $APPLICATION;

		$curPage = $APPLICATION->GetCurPage();
		
		if ($APPLICATION->GetFileAccessPermission($curPage) == 'D') {
			LocalRedirect('/', true, 303);
		}

	}
}

