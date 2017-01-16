<?php

namespace EvrySoft\Handlers;

use EvrySoft\Helpers\CheckPassword;
use GuzzleHttp\Client as HttpClient;




/**
* 
*/
class OnBeforeUserLogin
{
	
	public function beforeLogin(&$arParams)
	{

		// var_dump($arParams);

		$client = new HttpClient();

		$login = $arParams['LOGIN'];

		$password = $arParams['PASSWORD'];

		if (CheckPassword::checkByLogin($login, $password) && !CheckPassword::checkByLogin($login, 'external_password')) {
			return true;
		}

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

		if ($response->getResponseCode() == 200) {
			/* TODO: INSERT UPDATE VALUES IN USERS FIELDS */
		}

	}



}