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
                    'login' => $connect['username'],
                    'password' => $connect['password'], // Credientials
                    'features' => SOAP_USE_XSI_ARRAY_TYPE // Required
                                );
                $this->connection = new SoapClient($connect['wsdl']);
            } catch (SoapFault $e) {
                throw new AsanakSOAPException($e->faultstring, 401);
            }
        }
        return $this->connection;
    }
}
