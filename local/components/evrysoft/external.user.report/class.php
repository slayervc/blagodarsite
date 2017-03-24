<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Config\Configuration;
use Bitrix\Main\Application; 
use EvrySoft\Helpers\ApiHelpers\ApiHelper;
use EvrySoft\Helpers\ApiHelpers\ApiRequestHelper;
use EvrySoft\Helpers\CheckRequestHelper;

/**
* 
*/
class UserReportComponent extends CBitrixComponent
{
	
	protected $page_limit = 5;

	protected $convertedToFloat = [
		'balance_before',
		'balance_after',
		'sum_comission_partner',
		'sum_minus_partner',
		'sum_plus_partner'
	];

	public function executeComponent()
	{

		global $USER;
		global $APPLICATION;

		$request = Application::getInstance()->getContext()->getRequest();

		$this->arResult['REQUEST_PAGE'] = $APPLICATION->GetCurPage();
		$this->arResult['REPORT_DATA']['HIDDEN_LIST'] = [];
		$this->arResult['REPORT_DATA']['LIST'] = [];

		$uris = Configuration::getValue('complex_api_uris');

		$userType = $USER->GetParam('USER_API_TYPE');

		$http = new ApiRequestHelper;


		/**
		 * Check on user permissions
		 * TODO: Rework this method
		 */
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

		$viewType = $this->getViewParam();

		$startPageId = isset($_REQUEST['NEXT_PAGE_ID']) ? $_REQUEST['NEXT_PAGE_ID'] : 0;

		$http->setMethod('GET')
			 ->setHost($host)
			 ->setRequestUri($uris[$userType]['report'])
			 ->setQuery([
			 	'login' => $login,
			 	'password' => $password,
			 	'type' => 'json',
			 	'xls' => 'false',
			 	'start' => $startPageId
			]);

		/**
		 * Check if component params have a limit value
		 */
		if (intval($this->arParams['LIMIT']) > 0) {
			$http->addQuery('limit', $this->arParams['LIMIT']);
		}


		/**
		 * Make request
		 */
		$http->send();


		/**
		 * Set data with request response
		 * @var array
		 */
		$data = $http->getArrayResponse();


		/**
		 * Set arResult fields after request
		 */
		$this->arResult['REPORT_DATA']['RESPONSE_STATUS'] = $data['status'];
		$this->arResult['REPORT_DATA']['ROWS_COUNT'] = $data['info']['rows'];
		$this->arResult['REPORT_DATA']['NEXT_PAGE_ID'] = $data['info']['next'];
		$this->arResult['REPORT_DATA']['PREV_PAGE_ID'] = $data['info']['prev'];
		$this->arResult['REPORT_DATA']['FULL_LIST'] = $data['info']['list'];


		/**
		 * Hidden fields for output
		 * @var array
		 */
		$dontShowArray = [];


		/**
		 * Setter for hidden fields
		 */
		if (is_array($this->arParams['DONT_SHOW'])) {
			$dontShowArray = $this->arParams['DONT_SHOW'];	
		}


		/**
		 * 
		 */
		$this->arResult['REPORT_DATA']['HIDDEN_LIST'] = ApiHelper::makeHiddenArray($this->arResult['REPORT_DATA']['FULL_LIST'], $dontShowArray);


		/**
		 * Make sanitizied result list and list with headers
		 */
		$this->makeResultList();


		/**
		 *	Main Output statement for ajax
		 */
		if (CheckRequestHelper::isAjax()) {
			$APPLICATION->RestartBuffer();

			if ($request->getQuery('type') == 'refresh') {
				$this->showReportJson();
			}

			$this->showJson();
		}


		/**
		 * Main Output statement for component view
		 */
		if ($viewType == 'FILE') {
			$this->IncludeComponentTemplate('xls_button');
		} elseif ($viewType == 'TABLE') {
			$this->IncludeComponentTemplate('table');
		} elseif ($viewType == 'BLOCK') {
			$this->IncludeComponentTemplate('block');
		} else {
			$this->IncludeComponentTemplate();
		}
	}


	protected function showReportJson()
	{
		echo json_encode([
			'list' => $this->arResult['REPORT_DATA']['LIST']
		], JSON_UNESCAPED_UNICODE);

		die();
	}


	/**
	 * Return Json for page
	 * @return json
	 */
	protected function showJson()
	{
		echo json_encode([
			'list' => $this->arResult['REPORT_DATA']['LIST'],
			'next_page' => $this->arResult['REPORT_DATA']['NEXT_PAGE_ID']
		], JSON_UNESCAPED_UNICODE);

		die();
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
		$this->arResult['REPORT_DATA']['LIST'] = $this->makeFloatFieldsInArray($this->arResult['REPORT_DATA']['LIST'], $this->convertedToFloat);
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



	/**
	 * Update array fields which needs update to float value
	 * @param  array  $sourceArray main array
	 * @param  array  $changeKeys  changes for array
	 * @return array
	 */
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

	

	/**
	 * Get view type from component
	 * @return string
	 */
	protected function getViewParam()
	{
		return $this->arParams['VIEW_TYPE'];
	}


}
