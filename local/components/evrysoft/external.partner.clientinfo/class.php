<?php
if(!defined("B_PROLOG_INCLUDED")|| B_PROLOG_INCLUDED !== true)die();

use Bitrix\Main\Application;
use Bitrix\Main\Config\Configuration;
use EvrySoft\Helpers\ApiHelpers\ApiRequestHelper;
use EvrySoft\Helpers\CheckRequestHelper;

/**
*	ClientInfoComponent
*
* 
*/
class ClientInfoComponent extends CBitrixComponent
{
	
	public function executeComponent()
	{

		global $APPLICATION;

		if (!empty($_REQUEST['cl_field'])) {


			$data = $this->getResponseFromClField($_REQUEST['cl_field']);

			if (CheckRequestHelper::isAjax()) {

				$APPLICATION->RestartBuffer();

				echo $data;

				die();

			} else {
				$arResult['CLIENT_INFO'] = json_decode($data, true);
			}
		}

		// var_dump($APPLICATION->GetCurPage());

		$this->arResult['FORM_ACTION'] = $APPLICATION->GetCurPage();

		$this->InitComponentTemplate();

		$APPLICATION->AddHeadScript($this->GetTemplate()->GetFolder() . '/js/ajax-client-info.js');

		$this->ShowComponentTemplate();

	}


	protected function getResponseFromClField($field, $returnBody = true)
	{
		global $USER;

		$http = new ApiRequestHelper();
		$http->setMethod('GET');


		if ($USER->IsAdmin()) {

			$partner_login = 'mainpartner';
			$partner_password = 'mainpass';

			$http->setHost(Configuration::getValue('complex_api_test_host'));

		} else {

			$http->setHost(Configuration::getValue('complex_api_host'));
			/*TODO: Make its for non admin*/
		}

		$uris = Configuration::getValue('complex_api_uris');
		$http->setRequestUri($uris['partner']['get-client-info'] . $field);
		$http->setQuery([
			'login' => $partner_login,
			'password' => $partner_password,
			'type' => 'json'
		]);

		$http->send();

		$response = ($returnBody) ? $http->getJsonResponse() : $http->getArrayResponse();

		return $response;

	}




}