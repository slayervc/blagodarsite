<?php

namespace EvrySoft\Handlers;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\RequestException;


/**
* OnBeforeUserRegister handler
* 
* @see Event: OnBeforeUserRegister
*/
class OnBeforeUserRegister
{
	/**
	 *
	 * 
	 */
	public function externalRegister(&$arParams)
	{
		$data = $_REQUEST;

		$arParams['LOGIN'] = $arParams['PERSONAL_MOBILE'];

		var_dump($arParams);

		die();

		$client = new HttpClient();

		$url = 'https://xn----8sbntbegpkx.xn--p1ai/v1.1/clients/add';
	
		$response = $client->request('GET', $url, [
			'verify' => false,
			'http_errors' => false,
			'query' => [
				'login' => $arParams['LOGIN'],
				'name' => sprintf('%s %s %s', 
					$arParams['NAME'], 
					$arParams['LAST_NAME'], 
					$arParams['SECOND_NAME']
				),		
				'code' => $arParams['USER_PHONE_CODE'],
				'email' => $arParams['EMAIL'],
				'type' => 'json'
			]
		]);		

		/* Handle HTTP BadRequest code 400 */
		if ($response->getStatusCode() == 400) {
			$error = json_decode($response->getBody());
			$GLOBALS['APPLICATION']->ThrowException($error->info);
			return false;
		}

	}

}
