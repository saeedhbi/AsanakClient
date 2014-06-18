<?php
namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SoapConnectionSpec extends ObjectBehavior
{

    function it_is_initializable()
    {
        $this->shouldHaveType('SoapConnection');
    }

    function let()
    {
        $messgae = 'Asanak Test';
        $Encoding = (mb_detect_encoding($messgae) == 'ASCII') ? "1" : "8";
        $values = array(
            'username' => 'opilo',
            'password' => 'opilo@7800',
            'wsdl' => 'http://ws.asanak.ir:8082/services/CompositeSmsGateway?wsdl',
            'connectionType' => 'soap',
            'srcAddresses' => '9821021000',
            'destAddresses' => '09354328595',
            'msgBody' => $messgae,
            'msgEncoding' => $Encoding
        );
        $this->beConstructedWith($values);
    }

    function it_should_connect_to_wsdl_with_error()
    {
        $messgae = 'Asanak Test';
        $Encoding = (mb_detect_encoding($messgae) == 'ASCII') ? "1" : "8";
        $values = array(
            'username' => 'opilo',
            'password' => 'opilo@7800',
            'wsdl' => 'http1://ws.asanak.ir:8082/services/CompositeSmsGateway?wsdl',
            'connectionType' => 'soap',
            'srcAddresses' => '9821021000',
            'destAddresses' => '09354328595',
            'msgBody' => $messgae,
            'msgEncoding' => $Encoding
        );
       /*  $this->shouldThrow('Exceptions\AsanakSOAPException')->during('connect', array(
            $values
        )); */
    }

    function it_should_return_object_of_soap_client()
    {
        $messgae = 'Asanak Test';
        $Encoding = (mb_detect_encoding($messgae) == 'ASCII') ? "1" : "8";
        $values = array(
            'username' => 'opilo',
            'password' => 'opilo@7800',
            'wsdl' => 'http://ws.asanak.ir:8082/services/CompositeSmsGateway?wsdl',
            'connectionType' => 'soap',
            'srcAddresses' => '9821021000',
            'destAddresses' => '09354328595',
            'msgBody' => $messgae,
            'msgEncoding' => $Encoding
        );
       /*  $this->connect($values)->shouldBeObject(); */
    }

    function it_should_send_params_to_provider()
    {
        $messgae = 'Asanak Test';
        $Encoding = (mb_detect_encoding($messgae) == 'ASCII') ? "1" : "8";
        $values = array(
            'username' => 'opilo',
            'password' => 'opilo@7800',
            'wsdl' => 'http://ws.asanak.ir:8082/services/CompositeSmsGateway?wsdl',
            'connectionType' => 'soap',
            'srcAddresses' => '9821021000',
            'destAddresses' => '09354328595',
            'msgBody' => $messgae,
            'msgEncoding' => $Encoding
        );
        /* $this->connect($values)->shouldBeObject(); */
        /* $this->sendSms($values); */
    }
    
    function it_should_send_request_methods(){
        $messgae = 'Asanak Test';
        $Encoding = (mb_detect_encoding($messgae) == 'ASCII') ? "1" : "8";
        $values = array(
            'username' => 'opilo',
            'password' => 'opilo@7800',
            'wsdl' => 'http://ws.asanak.ir:8082/services/CompositeSmsGateway?wsdl',
            'connectionType' => 'soap',
/*             'srcAddresses' => '9821021000',
            'destAddresses' => '09354328595',
            'maxReturnedMsg' => '5',
            'fromTime' => '1402932600000' */
        );
        $method = 'getUserCredit';
        $this->connect($values)->shouldBeObject();
        $this->{$method}($values);
    }
}
