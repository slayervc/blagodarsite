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
	public function beforeRegister(&$arFields)
	{


		$data = $_REQUEST;

		$arFields['LOGIN'] = $arFields['PERSONAL_MOBILE'];

		$client = new HttpClient();

		$url = 'https://xn----8sbntbegpkx.xn--p1ai/v1.1/clients/add';
	
		$response = $client->request('GET', $url, [
			'verify' => false,
			'http_errors' => false,
			'query' => [
				'login' => $arFields['LOGIN'],
				'name' => sprintf('%s %s %s', 
					$arFields['NAME'], 
					$arFields['LAST_NAME'], 
					$arFields['SECOND_NAME']
				),		
				'code' => $arFields['USER_PHONE_CODE'],
				'email' => $arFields['EMAIL'],
				'type' => 'json'
			]
		]);		

		/* Handle HTTP BadRequest code 400 */
		if ($response->getStatusCode() == 400) {
			$error = json_decode($response->getBody());
			$GLOBALS['APPLICATION']->ThrowException($error->info);
			return false;
		} else {
			
		}

		echo $response->getBody();

		die();


	}

}
