<?php 

/**
* RegisterHandler Class
*/
class RegisterHandler
{
	
	public function dump()
	{

		$client = require __DIR__. '/http_client/HttpClient.php';

		var_dump($_REQUEST['REGISTER']);

		var_dump($_REQUEST['user_type']);

		die();
	}





}
