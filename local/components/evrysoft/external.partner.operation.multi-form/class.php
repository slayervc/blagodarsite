<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CBitrixComponent::IncludeComponentClass('evrysoft:external.partner.operation.form');

use Bitrix\Main\Config\Configuration;
use EvrySoft\Helpers\ApiHelpers\ApiRequestHelper;
use EvrySoft\Helpers\CheckRequestHelper;
use GuzzleHttp\Client;


class OperationMultiFormComponent extends OperationFormComponent
{
	
	/**
	 * ExecuteComponent Code and IncludeComponentTemplate file
	 * 
	 * @return void
	 */
	public function executeComponent()
	{

		global $USER;
		global $APPLICATION;

		$this->app = $APPLICATION;
		$this->formRequest = $this->getFormRequest();

		if ($USER->IsAdmin()) {
			$this->host = Configuration::getValue('complex_api_test_host');
		} else {
			$this->host = Configuration::getValue('complex_api_host');
		}

		$this->arResult['FORM_OPTIONS'] = [];


		// Set the Form Options for Result
		$this->addFormOption('FORM_ID', $this->randString());
		$this->addFormOption('FORM_ACTION', $this->app->GetCurPage());


		// Set the Result Variables
		$this->arResult['FORM_OPTIONS'] = $this->getFormOptions();
		$this->arResult['USER_DATA'] = $this->getUserData();
		$this->arResult['SHOW_FIELDS'] = $this->getShowFields();
		$this->arResult['PASSED_FIELD_STR'] = $this->getPassedField();
		$this->arResult['MULTI_FIELD'] = $this->getMultiField();

		$this->arResult['RESPONSE_DATA'] = [];


		if (CheckRequestHelper::isAjax() && $this->checkForm()) {
			$this->app->RestartBuffer();

			if ($_REQUEST['type'] == 'get-code') {

				$request = $this->sendCodeGenRequest();
				$data = $request->getJsonResponse();

				echo $data;

			} else {
				$request = $this->sendRequest();

				echo $request->getJsonResponse();
			}
		
			die();
		} else {
			$this->IncludeComponentTemplate();
		}

	}



	public function sendCodeGenRequest()
	{
		$http = new ApiRequestHelper();

		$uri_alias = $this->arParams['URI_ALIAS_MULTI'];

		$uri = Configuration::getValue('complex_api_uris')['partner'][$uri_alias];

		$uri .= $_REQUEST['login'];

		$http->setHost($this->host)
			 ->setMethod('GET')
			 ->setRequestUri($uri)
			 ->setQuery($this->getUserData());

		$http->addQuery('type', 'json');

		$http->send();

		return $http;

	}



	protected function getMultiField()
	{
		$multi_field_id = intval($this->arParams['MULTI_FIELD']);

		return $this->arParams['FIELDS'][$multi_field_id];
	}

	
}


