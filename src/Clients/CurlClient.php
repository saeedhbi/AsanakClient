<?php namespace AsanakClient\Clients;

use AsanakClient\ClientInterface;
use Curl\Curl;

class CurlClient implements ClientInterface {

	/**
	 * @var array
	 */
	protected $values;

	/**
	 * @var string
	 */
	protected $url;

	/**
	 * @var \Curl\Curl
	 */
	protected $curl;

	/**
	 * Create a new asanak curl client instance
	 *
	 * @param   array $values
	 * @return \AsanakClient\Clients\CurlClient
	 */
	public function __construct($values)
	{
		$this->values = $values;
	}

	/**
	 * Send sms with specified values to provider
	 *
	 * @return  void
	 */
	public function sendSms()
	{
		// TODO: determine method
		// $this->curl()->post($this->url, $this->values);
	}

	/**
	 * Send request to specified provider
	 *
	 * @param   string $method
	 * @return  mixed
	 */
	public function request($method)
	{
		// TODO: Implement request() method.
	}

	/**
	 * Create an instance of curl
	 *
	 * @return \Curl\Curl
	 */
	protected function curl()
	{
		if (!isset($this->curl)) {
			$this->curl = new Curl();
		}

		return $this->curl;
	}

}
