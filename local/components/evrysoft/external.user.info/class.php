<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Config\Configuration;
use GuzzleHttp\Client;
use EvrySoft\Helpers\ApiHelpers\ApiRequestHelper;


/**
* 
*/
class UserInfoComponent extends CBitrixComponent
{

	protected $userData;

	protected $userType;

	
	public function executeComponent()
	{
	
		global $USER;

		// USER data from authorized request
		$this->userData = $USER->GetParam('USER_EXT_INFO');

		// Client|Partner
		$this->userType = $USER->GetParam('USER_API_TYPE');
		

		if (!$USER->IsAdmin()){
			$this->makeUserRequest();
		}else {
			$this->makeAdminRequest();
		}

		$this->IncludeComponentTemplate();
	}


	public function makeShowDataArray()
	{
		return array_diff_assoc($this->arResult['USER_ALL_DATA'], $this->arResult['USER_HIDDEN_DATA']);
	}


	public function makeAdminRequest()
	{
		$client = new Client;

		$host = Configuration::getValue('complex_api_test_host');

		$url = rtrim($host, '/') . '/' . 'partners/getinfo';

		$response = $client->request('GET', $url, [
			'verify' => false,
			'http_errors' => false,
			'query' => [
				'login' => 'mainpartner',
				'password' => 'mainpass',
				'type' => 'json'
			]
		]);

		$data = json_decode($response->getBody(), true);

		$this->arResult['EXT_REQUEST_STATUS'] = $data['status'];

		$this->arResult['USER_SHOW_DATA'] = array_change_key_case($data['info'], CASE_UPPER);
	}



	/**
	 * [makeUserRequest description]
	 * @return [type] [description]
	 */
	public function makeUserRequest()
	{

		global $USER;

		$http = new ApiRequestHelper;

		$http->setMethod('GET')
			 ->setHost(Configuration::getValue('complex_api_host'))
			 ->setRequestUri(Configuration::getValue('complex_api_uris')[$this->userType]['info'])
			 ->setQuery([
				'login'    => $USER->GetParam('USER_EXT_INFO')['info']['login'],
				'password' => $USER->GetParam('API_PASSWD'),
				'type'     => 'json'
			]);

		$http->send();
		
		$response = $http->getArrayResponse();

		$this->arResult['EXT_REQUEST_STATUS'] = $response['status'];
		$this->arResult['USER_ALL_DATA'] = array_change_key_case($response['info'], CASE_UPPER);
		$this->arResult['USER_SHOW_DATA'] = [];
		$this->arResult['USER_HIDDEN_DATA'] = [];

		foreach ($this->arParams['DONT_SHOW'] as $hideParam) {
			$param = strtolower($hideParam);
			if (array_key_exists($param, $response['info'])) {
				$this->arResult['USER_HIDDEN_DATA'][$hideParam] = $response['info'][$param];
			}
		}

		$this->arResult['USER_SHOW_DATA'] = $this->makeShowDataArray();

	}

}


