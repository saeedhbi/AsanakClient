<?php
namespace MagfaClient;

use SoapClient;
use SoapFault;

class MagfaClient
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
     * Method to set errors
     *
     * @return array
     */
    public function error()
    {
        $this->error[1]['title'] = 'INVALID_RECIPIENT_NUMBER';
        $this->error[1]['desc'] = 'the string you presented as recipient numbers are not valid phone numbers, please check them again';
        
        $this->error[2]['title'] = 'INVALID_SENDER_NUMBER';
        $this->error[2]['desc'] = 'the string you presented as sender numbers(3000-xxx) are not valid numbers, please check them again';
        
        $this->error[3]['title'] = 'INVALID_ENCODING';
        $this->error[3]['desc'] = 'are You sure You\'ve entered the right encoding for this message? You can try other encodings to bypass this error code';
        
        $this->error[4]['title'] = 'INVALID_MESSAGE_CLASS';
        $this->error[4]['desc'] = 'entered MessageClass is not valid. for a normal MClass, leave this entry empty';
        
        $this->error[6]['title'] = 'INVALID_UDH';
        $this->error[6]['desc'] = 'entered UDH is invalid. in order to send a simple message, leave this entry empty';
        
        $this->error[12]['title'] = 'INVALID_ACCOUNT_ID';
        $this->error[12]['desc'] = 'you\'re trying to use a service from another account??? check your UN/Password/NumberRange again';
        
        $this->error[13]['title'] = 'NULL_MESSAGE';
        $this->error[13]['desc'] = 'check the text of your message. it seems to be null';
        
        $this->error[14]['title'] = 'CREDIT_NOT_ENOUGH';
        $this->error[14]['desc'] = 'Your credit\'s not enough to send this message. you might want to buy some credit.call';
        
        $this->error[15]['title'] = 'SERVER_ERROR';
        $this->error[15]['desc'] = 'something bad happened on server side, you might want to call MAGFA Support about this:';
        
        $this->error[16]['title'] = 'ACCOUNT_INACTIVE';
        $this->error[16]['desc'] = 'Your account is not active right now, call -- to activate it';
        
        $this->error[17]['title'] = 'ACCOUNT_EXPIRED';
        $this->error[17]['desc'] = 'looks like Your account\'s reached its expiration time, call -- for more information';
        
        $this->error[18]['title'] = 'INVALID_USERNAME_PASSWORD_DOMAIN'; // todo : note : one of them are empty
        $this->error[18]['desc'] = 'the combination of entered Username/Password/Domain is not valid. check\'em again';
        
        $this->error[19]['title'] = 'AUTHENTICATION_FAILED'; // todo : note : wrong arguments supplied ...
        $this->error[19]['desc'] = 'You\'re not entering the correct combination of Username/Password';
        
        $this->error[20]['title'] = 'SERVICE_TYPE_NOT_FOUND';
        $this->error[20]['desc'] = 'check the service type you\'re requesting. we don\'t get what service you want to use. your sender number might be wrong, too.';
        
        $this->error[22]['title'] = 'ACCOUNT_SERVICE_NOT_FOUND';
        $this->error[22]['desc'] = 'your current number range doesn\'t have the permission to use Webservices';
        
        $this->error[23]['title'] = 'SERVER_BUSY';
        $this->error[23]['desc'] = 'Sorry, Server\'s under heavy traffic pressure, try testing another time please';
        
        $this->error[24]['title'] = 'INVALID_MESSAGE_ID';
        $this->error[24]['desc'] = 'entered message-id seems to be invalid, are you sure You entered the right thing?';
        
        $this->error[102]['title'] = 'WEB_RECIPIENT_NUMBER_ARRAY_SIZE_NOT_EQUAL_MESSAGE_CLASS_ARRAY';
        $this->error[102]['desc'] = 'this happens when you try to define MClasses for your messages. in this case you must define one recipient number for each MClass';
        
        $this->error[103]['title'] = 'WEB_RECIPIENT_NUMBER_ARRAY_SIZE_NOT_EQUAL_SENDER_NUMBER_ARRAY';
        $this->error[103]['desc'] = 'This error happens when you have more than one sender-number for message. when you have more than one sender number, for each sender-number you must define a recipient number...';
        
        $this->error[104]['title'] = 'WEB_RECIPIENT_NUMBER_ARRAY_SIZE_NOT_EQUAL_MESSAGE_ARRAY';
        $this->error[104]['desc'] = 'this happens when you try to define UDHs for your messages. in this case you must define one recipient number for each udh';
        
        $this->error[106]['title'] = 'WEB_RECIPIENT_NUMBER_ARRAY_IS_NULL';
        $this->error[106]['desc'] = 'array of recipient numbers must have at least one member';
        
        $this->error[107]['title'] = 'WEB_RECIPIENT_NUMBER_ARRAY_TOO_LONG';
        $this->error[107]['desc'] = 'the maximum number of recipients per message is 90';
        
        $this->error[108]['title'] = 'WEB_SENDER_NUMBER_ARRAY_IS_NULL';
        $this->error[108]['desc'] = 'array of sender numbers must have at least one member';
        
        $this->error[109]['title'] = 'WEB_RECIPIENT_NUMBER_ARRAY_SIZE_NOT_EQUAL_ENCODING_ARRAY';
        $this->error[109]['desc'] = 'this happens when you try to define encodings for your messages. in this case you must define one recipient number for each Encoding';
        
        $this->error[110]['title'] = 'WEB_RECIPIENT_NUMBER_ARRAY_SIZE_NOT_EQUAL_CHECKING_MESSAGE_IDS__ARRAY';
        $this->error[110]['desc'] = 'this happens when you try to define checking-message-ids for your messages. in this case you must define one recipient number for each checking-message-id';
        
        $this->error[- 1]['title'] = 'NOT_AVAILABLE';
        $this->error[- 1]['desc'] = 'The target of report is not available(e.g. no message is associated with entered IDs)';
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
