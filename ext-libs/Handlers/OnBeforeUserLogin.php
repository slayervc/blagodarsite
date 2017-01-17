<?php

namespace EvrySoft\Handlers;

use EvrySoft\Helpers\CheckPassword;
use GuzzleHttp\Client as HttpClient;




/**
* 
*/
class OnBeforeUserLogin
{
	
	public function beforeLogin(&$arFields)
	{

		// var_dump($arFields);

		$client = new HttpClient();

		$login = $arFields['LOGIN'];

		$password = $arFields['PASSWORD'];


		// Check if password is correct
		if (CheckPassword::checkByLogin($login, $password) && !CheckPassword::checkByLogin($login, 'external_password')) {
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
			echo $response->getBody();			
		} else {
			/* TODO: INSERT UPDATE VALUES IN USERS FIELDS */
			echo $response->getBody();
			var_dump($arFields);
			die();
		}


	}



}