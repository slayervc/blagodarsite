<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Config\Configuration;
use Bitrix\Main\GroupTable;
use EvrySoft\Helpers\ApiHelpers\ApiHelper;
use EvrySoft\Helpers\ApiHelpers\ApiRequestHelper;


/**
* 
*/
class UserReportComponent extends CBitrixComponent
{
	
	protected $page_limit = 5;


	public function executeComponent()
	{

		global $USER;
		global $APPLICATION;

		$this->arResult['REPORT_DATA']['HIDDEN_LIST'] = [];
		$this->arResult['REPORT_DATA']['LIST'] = [];

		$uris = Configuration::getValue('complex_api_uris');

		$userType = $USER->GetParam('USER_API_TYPE');

		$client = new GuzzleHttp\Client;

		if ($USER->IsAdmin()) {
			$userType = 'partner';
			$password = 'mainpass';
			$login = 'mainpartner';
			$host = Configuration::getValue('complex_api_test_host');
		} else {
			$password = $USER->GetParam('API_PASSWD');
			$login = $USER->GetLogin();
			$host = Configuration::getValue('complex_api_host');
		}

		$url = rtrim($host, '/') . '/'. $uris[$userType]['report'];

		$http = new ApiRequestHelper;

		$viewType = $this->getViewParam();

		$http->setMethod('GET')
			 ->setHost($host)
			 ->setRequestUri($uris[$userType]['report'])
			 ->setQuery([
			 	'login' => $login,
			 	'password' => $password,
			 	'type' => 'json',
			 	'xls' => 'false',
			 	'start' => 0
			]);


		if (intval($this->arParams['LIMIT']) > 0) {
			$http->addQuery('limit', $this->arParams['LIMIT']);
		}


		$http->send();

		$data = $http->getArrayResponse();

		$this->arResult['REPORT_DATA']['RESPONSE_STATUS'] = $data['status'];
		$this->arResult['REPORT_DATA']['ROWS_COUNT'] = $data['info']['rows'];
		$this->arResult['REPORT_DATA']['NEXT_PAGE_ID'] = $data['info']['next'];
		$this->arResult['REPORT_DATA']['PREV_PAGE_ID'] = $data['info']['prev'];
		$this->arResult['REPORT_DATA']['FULL_LIST'] = $data['info']['list'];

		$dontShowArray = [];

		if (is_array($this->arParams['DONT_SHOW'])) {
			$dontShowArray = $this->arParams['DONT_SHOW'];	
		}

		$this->arResult['REPORT_DATA']['HIDDEN_LIST'] = ApiHelper::makeHiddenArray($this->arResult['REPORT_DATA']['FULL_LIST'], $dontShowArray);

		$this->makeResultList();

		if ($viewType == 'FILE') {
			$this->InitComponentTemplate('xls_button');
		} elseif ($viewType == 'TABLE') {
			$this->InitComponentTemplate('table');
		} elseif ($viewType == 'BLOCK') {
			$this->InitComponentTemplate('block');
		} else {
			$this->InitComponentTemplate();
		}

		$this->ShowComponentTemplate();
	}


	protected function makeResultList()
	{
		$this->makeClearList();

		$this->updateFloatListFields();

		$this->makeListHeaders();

		foreach ($this->arResult['REPORT_DATA']['LIST'] as &$listItem) {
			$date = new Bitrix\Main\Type\DateTime($listItem['date']);

			$listItem['date'] = $date->format('d-m-Y h:m');
		}
	}



	private function makeClearList()
	{
		$this->arResult['REPORT_DATA']['LIST'] = ApiHelper::clearFromArray($this->arResult['REPORT_DATA']['FULL_LIST'], $this->arResult['REPORT_DATA']['HIDDEN_LIST']);
	}


	private function updateFloatListFields()
	{
		$this->arResult['REPORT_DATA']['LIST'] = $this->makeFloatFieldsInArray($this->arResult['REPORT_DATA']['LIST'], ['balance_before', 'balance_after', 'sum_comission_partner']);
	}


	/**
	 * Make List headers in result array
	 * 
	 * @return Void
	 */
	private function makeListHeaders()
	{
		$this->arResult['REPORT_DATA']['LIST_HEADERS'] = array_keys($this->arResult['REPORT_DATA']['LIST'][0]);
	}



	protected function makeFloatFieldsInArray(array $sourceArray, array $changeKeys)
	{
		foreach ($sourceArray as $listItemKey => $listItem) {

			foreach ($changeKeys as $changeKey) {
				$listItem[$changeKey] = floatval($listItem[$changeKey]);
			}

			$sourceArray[$listItemKey] = $listItem;
		}

		return $sourceArray;
	}

	
	protected function getViewParam()
	{
		return $this->arParams['VIEW_TYPE'];
	}



	protected function getCurrentReportPage()
	{
		return $_REQUEST['page'];
	}


}
