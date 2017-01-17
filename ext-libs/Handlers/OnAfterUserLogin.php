<?php 

namespace EvrySoft\Handlers;

use GuzzleHttp\Client as HttpClient;


/**
* 
*/
class OnAfterUserLogin
{
	
	public function afterLogin(&$arFields)
	{

		// global $USER;

		// $client = new HttpClient();

		// $login = $arFields['LOGIN'];

		// $password = $arFields['PASSWORD'];

		// $url = 'https://xn----8sbntbegpkx.xn--p1ai/v1.1/clients/getinfo';

		// var_dump($arFields);

		// die()

		// $response = $client->request('GET', $url, [
		// 	'verify' => false,
		// 	'http_errors' => false,
		// 	'query' => [
		// 		'login' => $arFields['LOGIN'],
		// 		'password' => $arFields['PASSWORD'],
		// 		'type' => 'json'
		// 	]
		// ]);

		// echo $password;

		// $USER->SetParam('API_PASSWD', $password);

		// echo $response->getBody();
	}


}