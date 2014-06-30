<?php namespace AsanakClient\Clients;

use Exceptions\AsanakSoapException;
use SoapClient as Soap;
use SoapFault;

class SoapClient implements ClientInterface {

    /**
     * @var array
     */
    private $values = [];

    /**
     * @var \SoapClient
     */
    private $connection;

	/**
	 * Create a new asanak soap client instance
	 *
	 * @param array $values
	 * @return \AsanakClient\Clients\SoapClient
	 */
    public function __construct($values)
    {
        $this->values = $values;
    }

	/**
	 * Create a new Soap instance
	 *
	 * @throws AsanakSoapException
	 * @return object
	 */
    public function connect()
    {
        if (!isset($this->connection)) {
	        if (!isset($this->values['wsdl'])) {
		        throw new AsanakSoapException("WSDL is not set");
	        }

            try {
                $params = array(
                    'trace' => true,
                    'exceptions' => true,
                    'compression' => SOAP_COMPRESSION_ACCEPT,
                    'connection_timeout' => 120,
                    'cache_wsdl' => WSDL_CACHE_BOTH
                );
                $this->connection = new Soap($this->values['wsdl'], $params);
            } catch (SoapFault $e) {
                throw new AsanakSoapException($e->faultstring, 401);
            }
        }
        return $this->connection;
    }

	/**
	 * Send sms with specified values to provider
	 *
	 * @throws AsanakSoapException
	 * @return object
	 */
    public function sendSms()
    {
        try {
            $s = $this->connect()->sendSms(array(
                'userCredential' => array(
                    'username' => $this->values['username'],
                    'password' => $this->values['password']
                ),
                'srcAddresses' => $this->values['srcAddresses'],
                'destAddresses' => $this->values['destAddresses'],
                'msgBody' => $this->values['msgBody'],
                'msgEncoding' => $this->values['msgEncoding']
            ));
            return $s;
        } catch (SoapFault $e) {
            throw new AsanakSoapException($e->faultstring, 401);
        }
    }

	/**
	 * Class to getReportByMsgId from provider
	 *
	 * @param  array    $msgIds
	 * @throws \Exceptions\AsanakSoapException
	 * @return object
	 */
    public function getReportByMsgIds($msgIds)
    {
        try {
            $s = $this->connect()->getReportByMsgId(array(
                'userCredential' => array(
                    'username' => $this->values['username'],
                    'password' => $this->values['password']
                ),
                'msgIds' => $msgIds
            ));
            return $s;
        } catch (SoapFault $e) {
            throw new AsanakSoapException($e->faultstring, 401);
        }
    }

	/**
	 * Class to getReceivedMsg from provider
	 *
	 * @throws AsanakSoapException
	 * @return object
	 */
    public function getReceivedMsg()
    {
        try {
            $s = $this->connect()->getReceivedMsg(array(
                'userCredential' => array(
                    'username' => $this->values['username'],
                    'password' => $this->values['password']
                ),
                'wsdl' => $this->values['wsdl'],
                'srcAddresses' => $this->values['srcAddresses'],
                'destAddresses' => $this->values['destAddresses'],
                'maxReturnedMsg' => $this->values['maxReturnedMsg'],
                'fromTime' => $this->values['fromTime']
            ));
            return $s;
        } catch (SoapFault $e) {
            throw new AsanakSoapException($e->faultstring, 401);
        }
    }

	/**
	 * Class to getUserCredit from provider
	 *
	 * @throws AsanakSoapException
	 * @return object
	 */
    public function getUserCredit()
    {
        try {
            $s = $this->connect()->getUserCredit(array(
                'userCredential' => array(
                    'username' => $this->values['username'],
                    'password' => $this->values['password']
                ),
                'wsdl' => $this->values['wsdl']
            ));
            return $s;
        } catch (SoapFault $e) {
            throw new AsanakSoapException($e->faultstring, 401);
        }
    }
}
