<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


use Bitrix\Main\Config\Configuration;
use EvrySoft\Helpers\ApiHelpers\ApiRequestHelper;
use EvrySoft\Helpers\CheckRequestHelper;
use GuzzleHttp\Client;


/**
* 
*/
class SendFormComponent extends CBitrixComponent
{
	

	public function executeComponent()
	{
		global $USER;
		global $APPLICATION;


		// USER data from authorized request
		$userData = $USER->GetParam('USER_EXT_INFO');

		if (isset($_POST['cl-login']) && CheckRequestHelper::isAjax()) {

			$APPLICATION->RestartBuffer();

			$data = $this->sendRequest();

			echo $data;

			die();

		}


		$arParams['FORM_ACTION'] = $_SERVER['REQUEST_URI'];

		$this->InitComponentTemplate();

		$folder_path = $this->GetTemplate()->GetFolder();

		$APPLICATION->AddHeadScript($folder_path . '/' . 'js/gencode.js');

		$this->ShowComponentTemplate();

	}


	public function sendRequest()
	{

		$http_request = new ApiRequestHelper();
		
		$http_request->setMethod('GET')
				->setHost(Configuration::getValue('complex_api_test_host'))
				->setRequestUri(Configuration::getValue('complex_api_uris')['partner']['gen-reg-code']. $_POST['cl-login'])
				->setQuery([
					'login' => 'mainpartner',
					'password' => 'mainpass',
					'type' => 'json'
				]);

		$http_request->send();

		return $http_request->getJsonResponse();

	}


	public function setHeader($header)
	{
		header($header);
	}

	
}

	