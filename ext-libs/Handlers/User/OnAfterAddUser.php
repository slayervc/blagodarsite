<?php 

namespace EvrySoft\Handlers\User;






/**
* OnAfterAddUser handler
* 
* @see Bitrix Event OnAfterAddUser
*/
class OnAfterAddUser
{
	
	public function afterAddUser(&$arFields)
	{
		var_dump($arFields);

		die();
	}


}


