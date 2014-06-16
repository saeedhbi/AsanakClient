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
    public function __construct($wsdl, $login)
    {
        $this->error();
        $this->connection = $this->connect($wsdl, $login);        
    }

    /**
     * Connect to Soap Client
     *
     * @param string $wsdl            
     * @param array $login            
     *
     * @return object
     */
    public function connect($wsdl, $login)
    {
        return new SoapClient($wsdl, $login);
    }    

    /**
     * enqueue method of "Magfa" service
     *
     * @param array $params            
     * @return void
     */
    public function enqueue($params)
    {
        $params = array(
            'domain' => $params['domain'],
            'messageBodies' => array(
                $params['messageBodies']
            ),
            'recipientNumbers' => $params['recipientNumbers'],
            'senderNumbers' => array(
                $params['senderNumbers']
            )
        );      
        
        $response = $this->call('enqueue', $params);        
        
        foreach ($response as $result) {
            // compare the response with the ERROR_MAX_VALUE
            if ($result <= $this->ERROR_MAX_VALUE) {
                var_dump("Error Code : $result ; Error Title : " . $this->error[$result]['title'] . ' {' . $this->error[$result]['desc'] . '}' . $this->outputSeparator);
            } else {
                var_dump("Message has been successfully sent");
            }
        }
    }

    /**
     * getCredit method of "Magfa" service
     *
     * @param array $params            
     * @return void
     */
    public function getCredit($params)
    {
        
        // creating the parameter array
        $params = array(
            'domain' => $params['domain']
        );
        
        // sending the request via webservice
        $response = $this->call('getCredit', $params);
        
        // display the result
        echo 'Your Credit : ' . $response . $this->outputSeparator;
    }

    /**
     * getAllMessages method of "Magfa" service
     *
     * @param array $params            
     * @return void
     */
    public function getAllMessages($params)
    {
        
        // creating the parameter array
        $params = array(
            'domain' => $params['domain'],
            'numberOfMessasges' => $params['numberOfMessasges']
        );
        
        // sending the request via webservice
        $response = $this->call('getAllMessages', $params);
        
        // display the result
        if (count($response) == 0) {
            echo "No new message" . $this->outputSeparator;
        } else {
            // display the incoming message(s)
            foreach ($response as $result) {
                echo "Message:" . $this->outputSeparator;
                var_dump($result);
            }
        }
    }

    /**
     * getAllMessagesWithNumber method of "Magfa" service
     *
     * @param array $params            
     * @return void
     */
    public function getAllMessagesWithNumber($params)
    {
        // creating the parameter array
        $params = array(
            'domain' => $params['domain'],
            'numberOfMessages' => $params['numberOfMessages'],
            'destNumber' => $params['destNumber']
        );
        $response = $this->call('getAllMessagesWithNumber', $params);
        
        if (count($response) == 0) {
            echo "No new message" . $this->outputSeparator;
        } else {
            // display the incoming message(s)
            foreach ($response as $result) {
                echo "Message:" . $this->outputSeparator;
                var_dump($result);
            }
        }
    }

    /**
     * getMessageId method of "Magfa" service
     *
     * @param array $params            
     * @return void
     */
    public function getMessageId($params)
    {
        // creating the parameter array
        $params = array(
            'domain' => $params['domain'],
            'checkingMessageId' => $params['checkingMessageId']
        );
        $result = $this->call('getMessageId', $params);
        
        // compare the response with the ERROR_MAX_VALUE
        if ($result <= $this->ERROR_MAX_VALUE) {
            echo "An error occured" . $this->outputSeparator;
            echo "Error Code : $result ; Error Title : " . $this->error[$result]['title'] . ' {' . $this->error[$result]['desc'] . '}' . $this->outputSeparator;
        } else {
            echo "MessageId : $result" . $this->outputSeparator;
        }
    }

    /**
     * getMessageStatus method of "Magfa" service
     *
     * @param array $params            
     * @return void
     */
    public function getMessageStatus($params)
    {
        // creating the parameter array
        $params = array(
            'messageId' => $params['messageId']
        );
        $result = $this->call('getMessageStatus', $params);
        
        // compare the response with the ERROR_MAX_VALUE
        if ($result == - 1) {
            echo "An error occured" . $this->outputSeparator;
            echo "Error Code : $result ; Error Title : " . $this->error[$result]['title'] . ' {' . $this->error[$result]['desc'] . '}' . $this->outputSeparator;
        } else {
            echo "Message Status : $result" . $this->outputSeparator;
        }
    }

    /**
     * getMessageStatuses method of "Magfa" service
     *
     * @param array $params            
     * @return void
     */
    public function getMessageStatuses($params)
    {
        // creating the parameter array
        $params = array(
            'messageId' => $params['messageId']
        );
        
        // sending the request via webservice
        $response = $this->call('getMessageStatuses', $params);
        
        // checking the response
        foreach ($response as $result) {
            if ($result == - 1) {
                echo "An error occured" . $this->outputSeparator;
                echo "Error Code : $result ; Error Title : " . $this->error[$result]['title'] . ' {' . $this->error[$result]['desc'] . '}' . $this->outputSeparator;
            } else {
                echo "Message Status : $result" . $this->outputSeparator;
            }
        }
    }

    /**
     * getRealMessageStatuses method of "Magfa" service
     *
     * @param array $params            
     * @return void
     */
    public function getRealMessageStatuses($params)
    {
        // creating the parameter array
        $params = array(
            'messageId' => $params['messageId']
        );
        
        // sending the request via webservice
        $response = $this->call('getRealMessageStatuses', $params);
        
        // checking the response
        foreach ($response as $result) {
            if ($result == - 1) {
                echo "An error occured" . $this->outputSeparator;
                echo "Error Code : $result ; Error Title : " . $this->error[$result]['title'] . ' {' . $this->error[$result]['desc'] . '}' . $this->outputSeparator;
            } else {
                echo "Message Status : $result" . $this->outputSeparator;
            }
        }
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
