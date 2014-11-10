<?php
namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CurlConnectionSpec extends ObjectBehavior
{

    function it_is_initializable()
    {
        $this->shouldHaveType('CurlConnection');
    }

    function it_should_send_params_to_provider()
    {
        $messgae = 'Asanak Test';
        $Encoding = (mb_detect_encoding($messgae) == 'ASCII') ? "1" : "8";
        $values = array(
            'username' => array(
                'user'
            ),
            'password' => array(
                'pass'
            ),
            'wsdl' => array(
                'http://ws.asanak.ir:8082/services/CompositeSmsGateway?wsdl'
            ),
            'connectionType' => array(
                'curl'
            ),
            'srcAddresses' => array(
                '9821000000',
                '123'
            ),
            'destAddresses' => array(
                '093500000000'
            ),
            'msgBody' => array(
                $messgae
            ),
            'msgEncoding' => array(
                $Encoding
            )
        );
        $this->sendSms();
    }
}
