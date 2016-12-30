<?php 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

/**
 * TODO: переместить логику страниц в какое нибудь приложение с composer и т.д
 */

$token = Bitrix\Main\Config\Configuration::getValue('complex_api_token');

$http = new Client();

$method = 'GET';

$request_settings = [
	
	'host' => 'https://xn----8sbntbegpkx.xn--p1ai',
	'version' => 'v1.1',
	'path' => 'clients',
	'action' => 'gencode'

];

$url = implode('/', $request_settings);


$errors = [];

if (isset($_GET['login'])) {
	$login = $_GET['login'];
} else {
	$errors['login_exception'] = 'Empty login';
}

if (!empty($errors)) {
	echo json_encode($errors);
	return;
}

if (isset($_GET['type'])) {
	$type = $_GET['type'];
} else {
	$type = '';
}

$request_settings = [
	'verify' => false,
	'http_errors' => false,
	'query' => [
		'login' => $login,
		'token' => $token,
		'type' => $type
	]
];


$response = $http->request($method, $url, $request_settings);

echo $response->getBody();



