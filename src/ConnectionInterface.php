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

    /**
     * Send request to specified provider
     *
     * @param string $method            
     * @param string $data            
     * @return mixed
     */
    public function request($method);
}
