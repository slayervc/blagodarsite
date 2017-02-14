<?php 

namespace EvrySoft\Helpers\ApiHelpers;

use GuzzleHttp\Client;


/**
* 
*/
class ApiRequestHelper
{

	protected $client;

	protected $method;

	protected $host;

	protected $request_uri;

	protected $request_options = [];

	protected $query_string;

	protected $response;


	public function __construct($host = null)
	{
		if (!empty($host)) {
			$this->host = $host;
		}
		
		$this->client = new Client();

		$this->request_options = [
			'verify' => false,
			'http_errors' => false
		];

	}

	/**
	 * Set host for request
	 * 
	 * @param string $host
	 */
	public function setHost($host)
	{
		$this->host = $host;

		return $this;
	}



	/**
	 * [setRequestUri description]
	 * @param [type] $uri [description]
	 */
	public function setRequestUri($uri)
	{
		$this->request_uri = $uri;

		return $this;
	}


	/**
	 * Set http method for request
	 * 
	 * @param string $method
	 */
	public function setMethod($method)
	{
		$this->method = $method;

		return $this;
	}


	/**
	 * Generate url for request
	 * 
	 * @return string url
	 */
	private function makeRequestUrl()
	{
		$url = trim(trim($this->host), '/') . '/' . ltrim(trim($this->request_uri), '/');

		return $url;
	}


	/**
	 * Return url for request
	 * 
	 * @return string request url
	 */
	public function getRequestUrl()
	{
		return $this->makeRequestUrl();
	}


	/**
	 * Set query string for request via property query_string
	 * 
	 * @param array $query
	 * @return ApiRequestHelper | $this chaining
	 */
	public function setQuery($query)
	{
		$this->query_string = $query;

		if ($this->method == 'GET') {
			$this->setRequestOption('query', $this->query_string);
		}

		return $this;
	}


	/**
	 * Add query key value pair for request option
	 * @param string $key
	 * @param mixed $query
	 */
	public function addQuery($key, $query)
	{
		$this->request_options['query'][$key] = $query;

		return $this;
	}



	/**
	 * Set request option via key
	 * @param string $key
	 * @param mixed $option
	 */
	public function setRequestOption($key, $option)
	{
		$this->request_options[$key] = $option;

		return $this;
	}


	/**
	 * Return response in JSON
	 * 
	 * @return json response body
	 */
	public function getResponse()
	{
		return $this->response->getBody();
	}


	/**
	 * Return array response from request
	 * 
	 * @return array
	 */
	public function getArrayResponse()
	{
		return json_decode($this->response->getBody(), true);
	}


	/**
	 * [getJsonResponse description]
	 * @return [type] [description]
	 */
	public function getJsonResponse()
	{
		return $this->getResponse();
	}


	/**
	 * Send request with request options
	 * 
	 * @param  string|null $uri
	 * @return void
	 */
	public function send($uri = null)
	{
		if (!empty($uri)) {
			$this->request_uri = $uri;
		}

		$this->response = $this->client->request(
			$this->method, 
			$this->makeRequestUrl(), 
			$this->request_options
		);
	}


}



