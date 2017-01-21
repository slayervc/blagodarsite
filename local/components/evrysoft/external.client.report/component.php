<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Config\Configuration;
use Bitrix\Main\GroupTable;

	$host = Configuration::getValue('complex_api_host');
	$uris = Configuration::getValue('complex_api_uris');

	$userType = $USER->GetParam('USER_API_TYPE');

	$client = new GuzzleHttp\Client;

	$url = rtrim($host, '/') . '/'. $uris[$userType]['report'];

	$password = $USER->GetParam('API_PASSWD');

	$login = $USER->GetLogin();

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

	$data = json_decode($response->getBody());

	$arResult['REPORT_DATA']['RESPONSE_STATUS'] = $data->status;
	$arResult['REPORT_DATA']['ROWS_COUNT'] = $data->info->rows;
	$arResult['REPORT_DATA']['LIST'] = $data->info->list;
	
	$this->IncludeComponentTemplate();
?>
