<?php namespace AsanakClient;

class ClientManager {

	/**
	 * @var array
	 */
	public $values;

	/**
	 * @var \AsanakClient\ClientInterface
	 */
	public $connector;

	/**
	 * @var string
	 */
	private $connectionType;

	/**
	 * Create a new asanak ClientManager instance
	 *
	 * @param   array   $values
	 * @param   string  $connectionType
	 * @return  \AsanakClient\ClientManager
	 */
    public function __construct($values, $connectionType = 'soap')
    {
        $this->values = $values;
	    $this->connectionType = $connectionType;
    }

    /**
     * Connect to Asanak with specified method
     *
     * @return object
     */
    public function connect()
    {
        if ($this->connector) {
            $connector = ucfirst($this->connectionType) . 'Client';
            $this->connector = new $connector($this->values);
        }
        
        return $this->connector;
    }

	public function checkStatus($msgIds)
	{
		return $this->connect()->getReportByMsgIds($msgIds);
	}

	/**
	 * Dynamically pass calls to the specified client
	 *
	 * @param   string  $method
	 * @param   string  $parameters
	 * @return  mixed
	 */
	public function __call($method, $parameters)
	{
		$callable = [$this->connect(), $method];
		return call_user_func_array($callable, $parameters);
	}

}
