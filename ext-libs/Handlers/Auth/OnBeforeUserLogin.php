<?php

namespace EvrySoft\Handlers\Auth;

use Bitrix\Main\Config\Configuration;
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

		$host = Configuration::getValue('complex_api_host');
		$uris = Configuration::getValue('complex_api_uris');

		$login_type = strtolower($_REQUEST['CLIENT_TYPE']);

		$uri = $uris[$login_type]['info'];

		$client = new HttpClient([
			'base_uri' => $host
		]);

		$login = $arFields['LOGIN'];

		$password = $arFields['PASSWORD'];

		if ($password == 'external_password') {
			$APPLICATION->ThrowException('Неверный пароль');
			return false;
		}

		// Check if password is correct
		if (CheckPassword::checkByLogin($login, $password)) {
			return true;
		}

		/* TODO: Make helper for requests */


		$response = $client->request('GET', $uri, [
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
		}
	}



}