<?php

namespace EvrySoft\Handlers\Auth;


use Bitrix\Main\Config\Configuration;
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

		$host = Configuration::getValue('complex_api_host');

		$uris = Configuration::getValue('complex_api_uris');

		$login_type = strtolower($_REQUEST['CLIENT_TYPE']);

		$client = new HttpClient();
		
		$login = $arFields['LOGIN'];

		$password = $arFields['PASSWORD'];

		$url = $host . $uris[$login_type]['info'];

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

		$USER->SetParam('USER_API_TYPE', $login_type);

		if ($USER->GetParam('USER_EXT_INFO')['status'] == 'OK') {
			LocalRedirect("/profile/{$login_type}/", true, 303);
		} else {
			LocalRedirect("/", true, 303);
		}

	}


}