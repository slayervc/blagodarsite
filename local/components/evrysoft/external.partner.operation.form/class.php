<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


use Bitrix\Main\Config\Configuration;
use EvrySoft\Helpers\ApiHelpers\ApiRequestHelper;
use EvrySoft\Helpers\CheckRequestHelper;
use GuzzleHttp\Client;


/**
* 
*/
class OperationFormComponent extends CBitrixComponent
{
	
	protected $formOptions = [];

	protected $userData = [];

	protected $app;

	protected $host;

	protected $passedToUri;

	protected $formRequest;


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

		if (CheckRequestHelper::isAjax() && $this->checkForm()) {

			$APPLICATION->RestartBuffer();

			$request = $this->sendRequest();

			echo $request->getJsonResponse();

			die();
		}
		// Final
		$this->IncludeComponentTemplate();
	}


	/**
	 * Send request and return response from remote server
	 * 
	 * @return string|json response
	 */
	public function sendRequest()
	{
		$http = new ApiRequestHelper();

		$uriAlias = $this->getUriAliasFromRequest();

		$uri = Configuration::getValue('complex_api_uris')['partner'][$uriAlias];

		$passed = $this->getPassedField();

		if(!empty($passed)){
			$uri .= $this->formRequest[$passed];
		}
		$this->addQueryData('type', 'json');
		$this->addQueryArrayData($this->formRequest);
		$this->addQueryArrayData($this->getUserData());


		$http->setMethod('GET')
			 ->setHost($this->host)
			 ->setRequestUri($uri)
			 ->setQuery($this->queryData);

		$http->send();

		return $http;

	}


	protected function getApiUris()
	{
		return Configuration::getValue('complex_api_uris');
	}


	protected function getShowFields()
	{
		return $this->arParams['FIELDS'];
	}


	protected function getUserData()
	{
		global $USER;

		if ($USER->IsAdmin()) {
			$this->userData = ['login' => 'mainpartner', 'password' => 'mainpass'];
		} else {
			$this->userData['login'] = $USER->GetParam('USER_EXT_INFO')['info']['login'];
			$this->userData['password'] = $USER->GetParam('API_PASSWD');
		}

		return $this->userData;

	}


	public function getTemplateFolder()
	{
		return $this->GetTemplate()->GetFolder();
	}


	/**
	 * Add form option to formOptions property
	 * @param mixed $optionKey
	 * @param mixed $optionValue
	 */
	protected function addFormOption($optionKey, $optionValue)
	{
		$this->formOptions[$optionKey] = $optionValue;
	}

	/**
	 * Return uri alias from form request
	 * 
	 * @return string
	 */
	protected function getUriAliasFromRequest()
	{
		return $_REQUEST['uri_alias'];
	}


	protected function getPassedField()
	{
		$passed_id = intval($this->arParams['PASSED_FIELD']);

		return $this->arParams['FIELDS'][$passed_id];
	}


	public function getFormOptions()
	{
		return $this->formOptions;
	}


	public function getFormRequest()
	{
		return $_REQUEST['FORM'];
	}


	protected function getFormIdFromRequest()
	{
		return $_REQUEST['form_id'];
	}


	/**
	 * Check form ID from Request and formOptions
	 * @return boolean
	 */
	protected function checkForm()
	{
		return (bool) $_REQUEST['form_id'] === $this->formOptions['FORM_ID'];
	}


	protected function addQueryData($key, $value)
	{
		$this->queryData[$key] = $value;
	}

	protected function addQueryArrayData(array $inputArr)
	{
		foreach ($inputArr as $inputKey => $inputVal) {
			$this->queryData[$inputKey] = $inputVal;
		}
	}

	
}


