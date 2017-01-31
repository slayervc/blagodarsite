<?php
if(!defined("B_PROLOG_INCLUDED")|| B_PROLOG_INCLUDED !== true)die();

$uris = Bitrix\Main\Config\Configuration::getValue('complex_api_uris');

$fields = [
	'sum' => 'P_SUM',
	'login' => 'CL_LOGIN',
	'name' => 'CL_NAME',
	'login_or_ean13' => 'CL_LOGIN_OR_EAN13',
	'code' => 'CL_CODE',
	'partner_id' => 'PARTNER_ID'
];


$arComponentParameters = array(
	'PARAMETERS' => array(
		'DEBUG' => [
			'NAME' => 'DEBUG',
			'TYPE' => 'CHECKBOX'
		],
		'FIELDS' => [
			'NAME' => 'FIELDS',
			'TYPE' => 'LIST',
			'MULTIPLE' => 'Y',
			'ADDITIONAL_VALUES' => 'N',
			'VALUES' => $fields,
			'REFRESH' => 'Y',
			'PARENT' => 'BASE'
		],
		'PASSED_FIELD' => [
			'NAME' => 'PASSED_FIELD',
			'TYPE' => 'LIST',
			'MULTIPLE' => 'N',
			'VALUES' => $arCurrentValues['FIELDS'],
			'ADDITIONAL_VALUES' => 'Y',
			'DEFAULT' => '',
			'PARENT' => 'BASE'
		],
		'MULTI_FIELD' => [
			'NAME' => 'MULTI_FIELD',
			'TYPE' => 'LIST',
			'VALUES' => $arCurrentValues['FIELDS'],
			'ADDITIONAL_VALUES' => 'Y',
			'DEFAULT' => '',
			'PARENT' => 'BASE'
		],
		'URI_ALIAS' => [
			'NAME' => 'URI_ALIAS',
			'TYPE' => 'LIST',
			'MULTIPLE' => 'N',
			'ADDITIONAL_VALUES' => 'N',
			'VALUES' => $uris['partner'],
			'PARENT' => 'BASE'
		],
	),
);
