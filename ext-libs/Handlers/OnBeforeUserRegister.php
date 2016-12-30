<?php

namespace EvrySoft\Handlers;

use GuzzleHttp\Client;
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
	 * 
	 */
	public function dump()
	{
		$data = $_REQUEST;

		$client = new Client();

		// var_dump($data);

		// die();

		$url = 'https://xn----8sbntbegpkx.xn--p1ai/v1.1/clients/add';

	
		$response = $client->request('GET', $url, [
			'verify' => false,
			'http_errors' => false,
			'query' => [
				'login' => $data['REGISTER']['LOGIN'],
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

			$GLOBALS['APPLICATION']->ThrowException($error->status);
			return false;
		}

		// die();
	}

}
