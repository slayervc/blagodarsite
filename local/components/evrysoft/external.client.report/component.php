<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Config\Configuration;
use Bitrix\Main\GroupTable;
use EvrySoft\Helpers\ApiHelpers\ApiHelper;

	$host = Configuration::getValue('complex_api_host');
	$uris = Configuration::getValue('complex_api_uris');

	$userType = $USER->GetParam('USER_API_TYPE');

	$client = new GuzzleHttp\Client;

	if ($arParams['DEBUG'] == 'Y' && $USER->IsAdmin()) {
		$userType = 'partner';
		$password = 'mainpass';
		$login = 'mainpartner';
		$host = Configuration::getValue('complex_api_test_host');
	} else {
		$password = $USER->GetParam('API_PASSWD');
		$login = $USER->GetLogin();
	}

	$url = rtrim($host, '/') . '/'. $uris[$userType]['report'];


	$response = $client->request('GET', $url, [
		'verify' => false,
		'http_errors' => false,
		'query' => [
			'login' => $login,
			'password' => $password,
			'xls' => 'false',
			'type' => 'json'
		]
	]);

	$data = json_decode($response->getBody(), true);


	$arResult['REPORT_DATA']['RESPONSE_STATUS'] = $data['status'];
	$arResult['REPORT_DATA']['ROWS_COUNT'] = $data['info']['rows'];

	$arResult['REPORT_DATA']['FULL_LIST'] = $data['info']['list'];

	$dontShowArray = ['transaction', 'operation_code', 'sum_minus_partner', 'sum_comission_partner'];

	$arResult['REPORT_DATA']['HIDDEN_LIST'] = [];

	$arResult['REPORT_DATA']['LIST'] = [];

	$arResult['REPORT_DATA']['HIDDEN_LIST'] = ApiHelper::makeHiddenArray($arResult['REPORT_DATA']['FULL_LIST'], $dontShowArray);


	$arResult['REPORT_DATA']['LIST'] = ApiHelper::clearFromArray($arResult['REPORT_DATA']['FULL_LIST'], $arResult['REPORT_DATA']['HIDDEN_LIST']);

	$arResult['REPORT_DATA']['LIST_HEADERS'] = array_keys($arResult['REPORT_DATA']['LIST'][0]);

	$this->IncludeComponentTemplate();
?>
