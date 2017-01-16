<?php 

namespace EvrySoft\Handlers;

use GuzzleHttp\Client as HttpClient;




/**
* 
*/
class OnAfterUserLogin
{
	
	public function externalLogin(&$arParams)
	{

		global $USER;

		$client = new HttpClient();

		$login = $arParams['LOGIN'];

		$password = $arParams['PASSWORD'];

		$url = 'https://xn----8sbntbegpkx.xn--p1ai/v1.1/clients/getinfo';

		$response = $client->request('GET', $url, [
			'verify' => false,
			'http_errors' => false,
			'query' => [
				'login' => $arParams['LOGIN'],
				'password' => $arParams['PASSWORD'],
				'type' => 'json'
			]
		]);

		echo $password;

		$USER->SetParam('API_PASSWD', $password);

		// echo $response->getBody();
	}


}