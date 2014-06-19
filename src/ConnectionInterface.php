<?php
namespace AsanakClient;

interface ConnectionInterface
{

    /**
     * Class to send values to provider
     *
     * @return object
     */
    public function sendSms();
}
