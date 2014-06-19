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
}
