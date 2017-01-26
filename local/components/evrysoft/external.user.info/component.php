<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Config\Configuration;
use GuzzleHttp\Client;

	// USER data from authorized request
	$userData = $USER->GetParam('USER_EXT_INFO');

	if (!$USER->IsAdmin()){
		$arResult['EXT_REQUEST_STATUS'] = $userData['status'];
		$arResult['USER_ALL_DATA'] = array_change_key_case($userData['info'], CASE_UPPER);
		$arResult['USER_SHOW_DATA'] = [];
		$arResult['USER_HIDDEN_DATA'] = [];

		foreach ($arParams['DONT_SHOW'] as $hideParam) {
			$param = strtolower($hideParam);
			if (array_key_exists($param, $userData['info'])) {
				$arResult['USER_HIDDEN_DATA'][$hideParam] = $userData['info'][$param];
			}
		}

		$arResult['USER_SHOW_DATA'] = array_diff($arResult['USER_ALL_DATA'], $arResult['USER_HIDDEN_DATA']);

	}

	if ($arParams['DEBUG'] == 'Y' && $USER->IsAdmin()) {

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

		$arResult['EXT_REQUEST_STATUS'] = $data['status'];

		$arResult['USER_SHOW_DATA'] = array_change_key_case($data['info'], CASE_UPPER);

	}


	$this->IncludeComponentTemplate();

