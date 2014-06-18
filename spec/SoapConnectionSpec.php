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
}
