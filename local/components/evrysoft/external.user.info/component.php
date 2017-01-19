<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Config\Configuration;


	$host = Configuration::getValue('complex_api_host');

	$client = new GuzzleHttp\Client;

	$url = trim(trim($host, '/')) . '/'.trim(trim($arParams['URI'], '/'));

	$arResult['EXT_REQUEST_URL'] = $url;

	// USER data from authorized request
	$userData = $USER->GetParam('USER_EXT_INFO');

	if (!$USER->IsAdmin()){
		$arResult['EXT_REQUEST_STATUS'] = $userData['status'];
		$arResult['USER_DATA'] = array_change_key_case($userData['info'], CASE_UPPER);
	}

	$this->IncludeComponentTemplate();
?>
