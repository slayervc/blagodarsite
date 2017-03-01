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
			$this->arResult['EXT_REQUEST_STATUS'] = $this->userData['status'];
			$this->arResult['USER_ALL_DATA'] = array_change_key_case($this->userData['info'], CASE_UPPER);
			$this->arResult['USER_SHOW_DATA'] = [];
			$this->arResult['USER_HIDDEN_DATA'] = [];

			foreach ($this->arParams['DONT_SHOW'] as $hideParam) {
				$param = strtolower($hideParam);
				if (array_key_exists($param, $this->userData['info'])) {
					$this->arResult['USER_HIDDEN_DATA'][$hideParam] = $this->userData['info'][$param];
				}
			}

			$this->arResult['USER_SHOW_DATA'] = $this->makeShowDataArray();

		}

		if ($USER->IsAdmin()) {
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
		$http = new ApiRequestHelper;

		$http->setHost(Configuration::getValue('complex_api_host'));
		$http->setRequestUri(Configuration::getValue('complex_api_uris')[$userType][]);

	}

}


