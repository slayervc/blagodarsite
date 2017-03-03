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

				$userGroupData['STRING_ID'] = trim(strtolower($userGroupData['STRING_ID']));

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

				// var_dump($res);
				// die();
				$user = new \CUser;

				$user_name = explode(' ', $res['name']);
			
				$user_email = !empty($res['email']) ? $res['email'] : 'email.field@email.field';

				$userDataLogin = ($arFields['login_type'] == 'partner') ? $res['login'] : $res['tel'];

				$userData = [
					'LOGIN' => $userDataLogin,
					'PASSWORD' => $_REQUEST['USER_PASSWORD'],
					'CONFIRM_PASSWORD' => $_REQUEST['USER_PASSWORD'],
					'EMAIL' => $user_email
				];

				if (count($user_name) == 1) {
					$userData['NAME'] = $user_name[0];
				} elseif (count($user_name) == 2) {
					$userData['NAME'] = $user_name[0];
					$userData['SECOND_NAME'] = $user_name[1];
				} else {
					$userData['NAME'] = $user_name[1];
					$userData['LAST_NAME'] = $user_name[2];
					$userData['SECOND_NAME'] = $user_name[0];
				}


				$group = \CGroup::GetList($by = "c_sort", $order = "asc", [
					"STRING_ID" => $arFields['login_type']
				]);

				if (!$group_id = $group->Fetch()['ID']) {
					throw new \Exception("В системе нет группы с кодом {$arFields['login_type']}");
				}

				// Add user
				$user_id = $user->Add($userData);

				// Check if user added and passed group for him
				if (intval($user_id) > 0) {
					$user->Update($user_id, [
						'GROUP_ID' => [$group_id]
					]);

					return true;
				} else {
					$APPLICATION->ThrowException('Пароль не должен быть менее 6 символов');
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