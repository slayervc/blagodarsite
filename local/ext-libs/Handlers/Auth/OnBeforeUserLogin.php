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

		$arFields['login_type'] = strtolower($_REQUEST['CLIENT_TYPE']);

		if (!$arFields['login_type']) {
			$APPLICATION->ThrowException('Авторизация без типа пользователя');
			return false;
		}

		$uri = $uris[$arFields['login_type']]['info'];

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

			$user_id = \CUser::GetByLogin($login)->Fetch()['ID'];

			$user_groups = \Bitrix\Main\UserTable::getUserGroupIds($user_id);

			foreach ($user_groups as $userGroupId) {
				$userGroupData = \CGroup::GetById($userGroupId)->Fetch();

				$userGroupData['STRING_ID'] = strtolower($userGroupData['STRING_ID']);

				if ($userGroupData['STRING_ID'] == $arFields['login_type'] || $userGroupData['ID'] == 1) {
					return true;
				}
			}

			return false;
		}

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

			$APPLICATION->throwException($error->info);
			
			return false;
		} else {
			
			$user_id = \CUser::GetByLogin($login)->Fetch()['ID'];


			if (!$user_id) {
				$res = json_decode($response->getBody(), true)['info'];

				$user = new \CUser;

				$user_name = explode(' ', $res['name']);
			
				$user_email = !empty($res['email']) ? $res['email'] : 'email.field@email.field';

				$userDataLogin = ($arFields['login_type'] == 'partner') ? $res['login'] : $res['tel'];

				$userData = [
					'LOGIN' => $userDataLogin,
					'PASSWORD' => $_REQUEST['USER_PASSWORD'],
					'CONFIRM_PASSWORD' => $_REQUEST['USER_PASSWORD'],
					'NAME' => $user_name[1],
					'LAST_NAME' => $user_name[0],
					'SECOND_NAME' => $user_name[2],
					'EMAIL' => $user_email
				];

				$user_id = $user->Add($userData);



				if ($arFields['login_type'] == 'partner') {
					$group_id = 6;
				} else {
					$group_id = 5;
				}
				

				if (intval($user_id) > 0) {
					$user->Update($user_id, [
						'GROUP_ID' => [$group_id]
					]);

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