<?php
use Exceptions\AsanakSOAPException;

class SoapConnection
{

    private $datasets = array();

    private $connection;

    public function __construct($values)
    {
        $this->datasets = $values;
    }

    public function connect($connect)
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
                $this->connection = new SoapClient($connect['wsdl'], $params);
            } catch (SoapFault $e) {
                throw new AsanakSOAPException($e->faultstring, 401);
            }
        }
        return $this->connection;
    }

    public function sendSms()
    {
        try {
            $s = $this->connection->sendSms(array(
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

    public function getReportByMsgId()
    {
        try {
            $s = $this->connection->getReportByMsgId(array(
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

    public function getReceivedMsg($values)
    {
        try {
            $s = $this->connection->getReceivedMsg(array(
                'userCredential' => array(
                    'username' => $values['username'],
                    'password' => $values['password']
                ),
                'wsdl' => $values['wsdl'],
                'srcAddresses' => $values['srcAddresses'],
                'destAddresses' => $values['destAddresses'],
                'maxReturnedMsg' => $values['maxReturnedMsg'],
                'fromTime' => $values['fromTime']
            ));
            return $s;
        } catch (SoapFault $e) {
            throw new AsanakSOAPException($e->faultstring, 401);
        }
    }
    
    public function getUserCredit($values)
    {
        try {
            $s = $this->connection->getUserCredit(array(
                'userCredential' => array(
                    'username' => $values['username'],
                    'password' => $values['password']
                ),
                'wsdl' => $values['wsdl']
            ));
            return $s;
        } catch (SoapFault $e) {
            throw new AsanakSOAPException($e->faultstring, 401);
        }
    }
}
