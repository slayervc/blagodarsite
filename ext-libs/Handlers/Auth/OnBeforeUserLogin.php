<?php

namespace EvrySoft\Handlers\Auth;

use EvrySoft\Helpers\CheckPassword;
use GuzzleHttp\Client as HttpClient;




/**
* 
*/
class OnBeforeUserLogin
{
	
	public function beforeLogin(&$arFields)
	{

		global $APPLICATION;
		global $USER;

		$client = new HttpClient();

		$login = $arFields['LOGIN'];

		$password = $arFields['PASSWORD'];


		if ($password =='external_password') {
			$APPLICATION->ThrowException('Неверный пароль');
			return false;
		}

		// Check if password is correct
		if (CheckPassword::checkByLogin($login, $password)) {
			return true;
		}


		/* TODO: Make helper for requests */
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

		if ($response->getStatusCode() !== 200) {
			$error = json_decode($response->getBody());
			$GLOBALS['APPLICATION']->ThrowException($error->info);
			return false;
		} else {
			/* UPDATE */
			$user_id = \CUser::GetByLogin($login)->Fetch()['ID'];

			$USER->Update($user_id, [
				'PASSWORD' => $password,
			]);

			$USER->SetParam('API_PASSWD');
		}


	}



}