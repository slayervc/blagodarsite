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
	 */
	public function externalRegister()
	{
		$data = $_REQUEST;

		var_dump($data);

		die();

		$client = new HttpClient();

		$url = 'https://xn----8sbntbegpkx.xn--p1ai/v1.1/clients/add';
	
		$response = $client->request('GET', $url, [
			'verify' => false,
			'http_errors' => false,
			'query' => [
				'login' => $data['REGISTER']['PERSONAL_MOBILE'],
				'name' => sprintf('%s %s %s', 
					$data['REGISTER']['NAME'], 
					$data['REGISTER']['LAST_NAME'], 
					$data['REGISTER']['SECOND_NAME']
				),		
				'code' => $data['REGISTER']['USER_PHONE_CODE'],
				'email' => $data['REGISTER']['EMAIL'],
				'type' => 'json'
			]
		]);		

		/* Handle HTTP BadRequest code 400 */
		if ($response->getStatusCode() == 400) {
			$error = json_decode($response->getBody());
			$GLOBALS['APPLICATION']->ThrowException($error->info);
			return false;
		}

		// echo $response->getBody();
		die();


	}

}
