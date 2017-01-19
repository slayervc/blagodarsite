<?php

namespace EvrySoft\Handlers\Auth;


use GuzzleHttp\Client as HttpClient;


/**
* 
*/
class OnAfterUserLogin
{
	
	public function afterLogin(&$arFields)
	{

		global $USER;

		if ($USER->IsAdmin()) {
			return true;
		}


		$client = new HttpClient();
		
		$login = $arFields['LOGIN'];

		$password = $arFields['PASSWORD'];

		$url = 'https://xn----8sbntbegpkx.xn--p1ai/v1.1/clients/getinfo';

		$response = $client->request('GET', $url, [
			'verify' => false,
			'http_errors' => false,
			'query' => [
				'login' => $arFields['LOGIN'],
				'password' => $arFields['PASSWORD'],
				'type' => 'json'
			]
		]);

		$user_info = json_decode($response->getBody(), true);

		$USER->SetParam('API_PASSWD', $password);

		$USER->SetParam('USER_EXT_INFO', $user_info);

		return true;
	}


}