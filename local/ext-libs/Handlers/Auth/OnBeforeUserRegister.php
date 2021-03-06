<?php

namespace EvrySoft\Handlers\Auth;

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

		$arFields['LOGIN'] = $arFields['PERSONAL_MOBILE'];

		$client = new HttpClient();

		$birthDate = $_REQUEST['REGISTER']['BIRTH_DATE'];

		$url = 'https://xn----8sbntbegpkx.xn--p1ai/v1.1/clients/add';
	
		$response = $client->request('GET', $url, [
			'verify' => false,
			'http_errors' => false,
			'query' => [
				'login' => $arFields['LOGIN'],
				'name' => sprintf('%s %s %s', 
					$arFields['LAST_NAME'], 
					$arFields['NAME'], 
					$arFields['SECOND_NAME']
				),
				'birth_date' => strtotime($birthDate),
				'agent_code' => $_REQUEST['REGISTER']['AGENT_CODE'],
				'code' => $_REQUEST['REGISTER']['USER_PHONE_CODE'],
				'email' => $arFields['EMAIL'],
				'type' => 'json'
			]
		]);

		/* Handle HTTP BadRequest code 400 */
		if ($response->getStatusCode() == 200) {
			return true;
		} else {
			$error = json_decode($response->getBody());
			$GLOBALS['APPLICATION']->ThrowException($error->info);
			return false;
		}



	}


	// public function testUser(&$arFields)
	// {

	// 	$testMobile = 2222;

	// 	$arFields['LOGIN'] = $arFields['PERSONAL_MOBILE'];

	// 	if ($testMobile == $_REQUEST['REGISTER']['USER_PHONE_CODE']) {
	// 		return true;	
	// 	} else {

	// 		$GLOBALS['APPLICATION']->ThrowException(['error' => 'USER_PHONE_CODE FAILED']);
	// 		return false;
	// 	}

	// }


}
