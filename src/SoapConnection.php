<?php
namespace AsanakClient;

use Exceptions\AsanakSOAPException;
use ConnectionInterface;

class SoapConnection implements ConnectionInterface
{

    /**
     * Dataset overload data
     *
     * @var array
     */
    private $datasets = array();

    /**
     * Connection property to return instance.
     */
    private $connection;

    /**
     * Set values to properties
     *
     * @param array $values            
     *
     * @return void
     */
    public function __construct($values)
    {
        $this->datasets = $values;
    }

    /**
     * Class to connect connection
     *
     * @return object
     */
    public function connect()
    {
        if (empty($this->connection)) {
            try {
                $params = array(
                    'trace' => true,
                    'exceptions' => true,
                    'compression' => SOAP_COMPRESSION_ACCEPT,
                    'connection_timeout' => 120,
                    'cache_wsdl' => WSDL_CACHE_BOTH
                );
                $this->connection = new SoapClient($this->datasets['wsdl'], $params);
            } catch (SoapFault $e) {
                throw new AsanakSOAPException($e->faultstring, 401);
            }
        }
        return $this->connection;
    }

    /**
     * Class to send values to provider
     *
     * @return object
     */
    public function sendSms()
    {
        try {
            $s = $this->connect()->sendSms(array(
                'userCredential' => array(
                    'username' => $this->datasets['username'],
                    'password' => $this->datasets['password']
                ),
                'srcAddresses' => $this->datasets['srcAddresses'],
                'destAddresses' => $this->datasets['destAddresses'],
                'msgBody' => $this->datasets['msgBody'],
                'msgEncoding' => $this->datasets['msgEncoding']
            ));
            return $s;
        } catch (SoapFault $e) {
            throw new AsanakSOAPException($e->faultstring, 401);
        }
    }

    /**
     * Class to getReportByMsgId from provider
     *
     * @return object
     */
    public function getReportByMsgId()
    {
        try {
            $s = $this->connect()->getReportByMsgId(array(
                'userCredential' => array(
                    'username' => $this->datasets['username'],
                    'password' => $this->datasets['password']
                ),
                'msgIds' => $this->datasets['msgIds']
            ));
            return $s;
        } catch (SoapFault $e) {
            throw new AsanakSOAPException($e->faultstring, 401);
        }
    }

    /**
     * Class to getReceivedMsg from provider
     *
     * @return object
     */
    public function getReceivedMsg()
    {
        try {
            $s = $this->connect()->getReceivedMsg(array(
                'userCredential' => array(
                    'username' => $this->datasets['username'],
                    'password' => $this->datasets['password']
                ),
                'wsdl' => $this->datasets['wsdl'],
                'srcAddresses' => $this->datasets['srcAddresses'],
                'destAddresses' => $this->datasets['destAddresses'],
                'maxReturnedMsg' => $this->datasets['maxReturnedMsg'],
                'fromTime' => $this->datasets['fromTime']
            ));
            return $s;
        } catch (SoapFault $e) {
            throw new AsanakSOAPException($e->faultstring, 401);
        }
    }

    /**
     * Class to getUserCredit from provider
     *
     * @return object
     */
    public function getUserCredit()
    {
        try {
            $s = $this->connect()->getUserCredit(array(
                'userCredential' => array(
                    'username' => $this->datasets['username'],
                    'password' => $this->datasets['password']
                ),
                'wsdl' => $this->datasets['wsdl']
            ));
            return $s;
        } catch (SoapFault $e) {
            throw new AsanakSOAPException($e->faultstring, 401);
        }
    }
}
