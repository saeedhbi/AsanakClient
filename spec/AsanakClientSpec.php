<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AsanakClientSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AsanakClient');
    }
    
    function let(){    
        $values = array('connectiontype'=>'curl');    
        $this->beConstructedWith($values);
    }
    
    function it_should_connect_to_connection_type() {
        $this->connect();        
    }
}
