<?php
namespace MagfaClient;

use SoapClient;
use SoapFault;

class AsanakClient
{

    /**
     * Make Instance of object
     */
    public $connection;

    /**
     * Max Error Value
     */
    private $ERROR_MAX_VALUE = 1000;

    /**
     * Provider respone errors
     */
    private $error;

    /**
     * Output Separetor string
     */
    private $outputSeparator = "\n";

    /**
     * Set new method to Object
     *
     * @param string $wsdl            
     * @param array $login            
     */
    public function __construct($wsdl)
    {
        $this->connection = $this->connect($datas);        
    }

    /**
     * Connect to Soap Client
     *
     * @param string $wsdl            
     * @param array $login            
     *
     * @return object
     */
    public function connect($datas)
    {
        $client = new SoapClient($datas['wsdl']);
        $this->userCredential($datas);
        return $client;
    }    
    
    /**
     * userCredential method of "Asanak" service
     *
     * @return void
     */
    public function userCredential($login)
    {
        // creating the parameter array
        $params = array(
            "username" => $login['username'],
            "password" => $login['password']
        );
    
        $this->connection->call('userCredential', $params);
    }


    /**
     * This method calls method of the webservice client object
     *
     * @access private
     * @param String $method            
     * @param Array $params            
     * @return mixed result
     */
    private function call($method, $params)
    {
        try {
            $result = $this->connection->__soapCall($method, $params);
        } catch (SoapFault $soapFault) {
            echo $soapFault . $this->outputSeparator;
            echo "REQUEST: " . $this->connection->__getLastRequest() . $this->outputSeparator;
            echo "RESPONSE: " . $this->connection->__getLastResponse() . $this->outputSeparator;
        }
        return $result;
    }
}
