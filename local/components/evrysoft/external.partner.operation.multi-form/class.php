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

		$this->addFormOption('FORM_ID', $this->randString());
		$this->addFormOption('FORM_ACTION', $this->app->GetCurPage());

		$this->arResult['FORM_OPTIONS'] = $this->getFormOptions();
		$this->arResult['USER_DATA'] = $this->getUserData();
		$this->arResult['SHOW_FIELDS'] = $this->getShowFields();
		$this->arResult['PASSED_FIELD_STR'] = $this->getPassedField();
		$this->arResult['MULTI_FIELD'] = $this->getMultiField();

		var_dump($this->arResult['MULTI_FIELD']);

		if (CheckRequestHelper::isAjax()) {

			die();

		}
		// Final
		$this->IncludeComponentTemplate();
	}

	protected function getMultiField()
	{
		return $this->arParams['MULTI_FIELD'];
	}

	
}


