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

		if (!CheckRequestHelper::isAjax()) {
			$this->InitComponentTemplate();

			$this->addJsFromComponentTemplate('/js/submit.js');

			$this->ShowComponentTemplate();
		} else {
			$APPLICATION->RestartBuffer();

			$json = $this->sendRequest();

			echo $json;

			die();
		}

	}

	private function getApiUris()
	{
		return Configuration::getValue('complex_api_uris');
	}


	private function getShowFields()
	{
		return $this->arParams['FIELDS'];
	}


	protected function getUserData()
	{
		global $USER;

		if ($USER->IsAdmin()) {
			$this->userData = ['login' => 'mainpartner', 'password' => 'mainpass'];
		} else {
			$this->userData = $USER->GetParam('USER_EXT_INFO');
		}

		return $this->userData;

	}


	public function getTemplateFolder()
	{
		return $this->GetTemplate()->GetFolder();
	}



	/**
	 * Add JavaScript file
	 * 
	 * @param string $fileName path to file
	 */
	public function addJsFromComponentTemplate($fileName)
	{
		$folder = $this->getTemplateFolder();

		$this->app->AddHeadScript($folder . $fileName);
	}


	/**
	 * Add form option to formOptions property
	 * @param mixed $optionKey
	 * @param mixed $optionValue
	 */
	public function addFormOption($optionKey, $optionValue)
	{
		$this->formOptions[$optionKey] = $optionValue;
	}



	/**
	 * Send request and return response from remote server
	 * 
	 * @return string|json response
	 */
	public function sendRequest()
	{
		$http = new ApiRequestHelper();

		$uri = Configuration::getValue('complex_api_uris')['partner'][$this->arParams['URI_ALIAS']];

		$passed_id = intval($this->arParams['PASSED_FIELD']);

		$passed = $this->arParams['FIELDS'][$passed_id];

		if(!empty($passed)){
			$uri .= $this->formRequest[$passed];
		}
		$this->addQueryData('type', 'json');
		$this->addQueryArrayData($this->formRequest);
		$this->addQueryArrayData($this->getUserData());

		// return $this->queryData;

		// return $this->;


		$http->setMethod('GET')
			 ->setHost($this->host)
			 ->setRequestUri($uri)
			 ->setQuery($this->queryData);

		$http->send();

		return $http->getJsonResponse();
	}


	public function getFormOptions()
	{
		return $this->formOptions;
	}


	public function getFormRequest()
	{
		return $_REQUEST;
	}


	private function getFormIdFromRequest()
	{
		return $_REQUEST['FORM_ID'];
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


