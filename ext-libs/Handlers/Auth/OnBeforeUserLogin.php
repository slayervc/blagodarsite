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
			
			$user_id = \CUser::GetByLogin($login)->Fetch()['ID'];

			var_dump($user_id);

			if (!$user_id) {
				$res = json_decode($response->getBody(), true)['info'];
				$user = new \CUser;

				$user_name = explode(' ', $res['name']);
			
				$user_email = !empty($res['email']) ? $res['email'] : 'email.field@email.field';

				$userData = [
					'LOGIN' => $res['login'],
					'PASSWORD' => $_REQUEST['USER_PASSWORD'],
					'CONFIRM_PASSWORD' => $_REQUEST['USER_PASSWORD'],
					'NAME' => $user_name[1],
					'LAST_NAME' => $user_name[0],
					'SECOND_NAME' => $user_name[2],
					'EMAIL' => $user_email
				];

				$user_id = $user->Add($userData);

				if (intval($user_id) > 0) {
					return true;
				} else {
					return false;
				}

			} else {
				$USER->Update($user_id, [
					'PASSWORD' => $password,
				]);
			}
			
		}
	}



}