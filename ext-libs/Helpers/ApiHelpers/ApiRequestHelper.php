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


	public function setHost(string $host)
	{
		$this->host = $host;

		return $this;
	}


	public function setRequestUri(string $uri)
	{
		$this->request_uri = $uri;

		return $this;
	}


	public function setMethod(string $method)
	{
		$this->method = $method;

		return $this;
	}


	private function makeRequestUrl()
	{
		$url = trim(trim($this->host), '/') . '/' . ltrim(trim($this->request_uri), '/');

		return $url;
	}

	public function getRequestUrl()
	{
		return $this->makeRequestUrl();
	}


	public function setQuery(array $query)
	{
		$this->query_string = $query;

		if ($this->method == 'GET') {
			$this->setRequestOption('query', $this->query_string);
		}

		return $this;
	}


	public function setRequestOption($key, $option)
	{
		$this->request_options[$key] = $option;

		return $this;
	}

	public function getResponse()
	{
		return $this->response->getBody();
	}

	public function getArrayResponse()
	{
		return json_decode($this->response->getBody(), true);
	}

	public function getJsonResponse()
	{
		return $this->getResponse();
	}

	public function send(string $uri = null)
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



