<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use EvrySoft\Helpers\ApiHelpers\ApiRequestHelper;
use EvrySoft\Helpers\CheckRequestHelper;
use Bitrix\Main\Config\Configuration;
use Bitrix\Main\Application;
/**
* PartnerCategoryList class
*
* 
*/
class PartnerCategoryList extends CBitrixComponent
{
	
	protected $app;

	protected $user;

	protected $response;

	protected $request;

	protected $context;

	protected $http;

	private $apiHost;

	private $uriList;

	private $userLogin;

	private $userPassword;

	public function executeComponent()
	{
		global $APPLICATION;
		global $USER;

		$this->app         = $APPLICATION;
		$this->user        = $USER;
		$this->http        = new ApiRequestHelper();
		$this->context     = Application::getInstance()->getContext();
		$this->request     = $this->context->getRequest();
		$this->response    = $this->context->getResponse();
		$this->userLogin   = $this->getUserLogin();
		$this->userPassword = $this->getUserPassword();
		$this->apiHost     = $this->getApiHost();

		$this->uriList = Configuration::getValue('complex_api_uris')['partner'];

		if ($this->request->isAjaxRequest()) {
			$this->app->RestartBuffer();

			if (!$this->user->IsAuthorized()) {
				$this->response->setStatus(401);
				$this->response->flush();
				$this->arResult['API_RESPONSE'] = $this->getUnAuthResponse();
			}

			switch ($this->request->get('type')) {
				case 'get-category-list':
					$this->arResult['API_RESPONSE'] = $this->getCategoryList();
					break;
				case 'update-category':
					$this->arResult['API_RESPONSE'] = $this->sendUpdateCategory($this->request->get('data'));
					break;
				case 'add-category':
					$this->arResult['API_RESPONSE'] = $this->addCategory($this->request->get('data'));
					break;
			}
			
			$this->IncludeComponentTemplate('ajax');
			die();
		} else {
			$this->IncludeComponentTemplate();
		}
	}


	/**
	 * Make request to API for create new category
	 * 
	 * @param array $categoryData
	 * @return json
	 */
	protected function addCategory($categoryData)
	{
		$this->http->setHost($this->apiHost)
				   ->setRequestUri($this->uriList['add-category'])
				   ->setMethod('GET');

		$this->http->setQuery([
			'login' => $this->userLogin,
			'password' => $this->userPassword,
	   		'name'  => $categoryData['name'],
	   		'descr' => $categoryData['descr'],
	   		'type'  => 'json'
		]);

		$this->http->send();

		$statusCode = $this->http->getStatusCode();
		$response = $this->http->getArrayResponse();

		$this->response->setStatus($statusCode);
		$this->response->flush();

		if (strtolower($response['status']) !== 'ok') {
			/*TODO: Доделать обработку Request Error*/
			return json_encode(['status' => 'failed', 'info' => 'Error in add category']);
		}

		return json_encode([
			'status' => 'success',
			'info' => [
				'response_code' => $statusCode,
				'message' => $response['data'],
			]
		]);


	}


	/**
	 * If User auth session is expired return json response with information
	 * 
	 * @return json
	 */
	protected function getUnAuthResponse()
	{
		return json_encode([
			'status' => 'error',
			'info' => [
				'message' => 'unauthorized error',
				'response_code' => 401,
				'type' => 'unauthorize'
			]
		]);
		die();
	}

	/**
	 * Get user login for type of user
	 * 
	 * @return string
	 */
	private function getUserLogin()
	{
		if ($this->user->IsAdmin()) {
			$userLogin = 'mainpartner';
		} else {
			$userLogin = $this->user->GetParam('USER_EXT_INFO')['info']['login'];
		}
		return $userLogin;
	}


	/**
	 * Get data for api request from user auth data
	 * 
	 * @return string
	 */
	private function getUserPassword()
	{
		if ($this->user->IsAdmin()) {
			$password = 'mainpass';
		} else {
			$password = $this->user->GetParam('API_PASSWD');;
		}
		return $password;	
	}


	/**
	 * Return api host for current user
	 * 
	 * @return string
	 */
	public function getApiHost()
	{
		return ($this->user->IsAdmin()) ? Configuration::getValue('complex_api_test_host') : Configuration::getValue('complex_api_host');
	}


	/**
	 * Send request to API for update data about category
	 * 
	 * @return json
	 */
	public function sendUpdateCategory($categoryData)
	{
		$category_id = $categoryData['id'];

		if (empty(trim($categoryData['name']))) {

			$this->response->setStatus(400);

			$this->response->flush();

			return json_encode([
				'status' => 'error',
				'response_code' => 400,
				'info' => [
					'message' => 'Имя категории не указано',
					'type' => 'empty category name'
				]
			]);

		}

		$this->http->setHost($this->apiHost)
				   ->setMethod('GET');

		$this->http->setRequestUri($this->uriList['set-category'] . $category_id);

		$this->http->setQuery([
			'login' => $this->userLogin,
			'password' => $this->userPassword,
			'name' => trim($categoryData['name']),
			'descr' => trim($categoryData['descr']),
			'type' => 'json'
		]);

		$this->http->send();

		$response = $this->http->getArrayResponse();

		$statusCode = $this->http->getStatusCode();

		$this->response->setStatus($statusCode);


		if (strtolower($response['status']) == 'ok') {
			$response['status'] = 'success';
		} elseif(strtolower($response['status']) == 'error' && $statusCode == 403) {
			$response['status'] = 'failed';
			$response['info'] = [
				'response_code' => $statusCode,
				'message' => 'Срок действия авторизации истек',
				'type' => 'Auth is expired'
			];
		} else {
			$response['status'] = 'failed';
		}

		$this->response->flush();

		return json_encode($response);

	}



	/**
	 * Get response from API with categories
	 * 
	 * @return json
	 */
	public function getCategoryList()
	{

		$this->http->setHost($this->apiHost)
			 ->setMethod('GET')
			 ->setRequestUri("partners/getcategorieslist");


		$this->http->setQuery([
			'login' => $this->userLogin,
			'password' => $this->userPassword,
			'type' => 'json'
		]);

		$this->http->send();

		return $this->http->getResponse();
	}



}
