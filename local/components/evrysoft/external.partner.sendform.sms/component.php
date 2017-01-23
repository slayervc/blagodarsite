<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Config\Configuration;
use EvrySoft\Helpers\ApiHelpers\ApiRequestHelper;
use GuzzleHttp\Client;

	// USER data from authorized request
	$userData = $USER->GetParam('USER_EXT_INFO');

	$http_request = new ApiRequestHelper();

	if (isset($_POST['submit'])) {
		$http_request->setMethod('GET')
				->setHost(Configuration::getValue('complex_api_test_host'))
				->setRequestUri(Configuration::getValue('complex_api_uris')['partner']['gen-reg-code'])
				->setQuery([
					'login' => 'mainpartner',
					'password' => 'mainpass',
					'type' => 'json'
				]);

		echo $http_request->getRequestUrl();
		die();
	}


	$arParams['FORM_ACTION'] = $_SERVER['REQUEST_URI'];
	// $http_request->send();

	// $response = $http_request->getArrayResponse();

	// $arResult['PARTNERS'] = $response['info'];

	$this->IncludeComponentTemplate();
?>
