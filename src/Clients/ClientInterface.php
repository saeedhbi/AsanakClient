<?php namespace AsanakClient\Clients;

interface ClientInterface {

	/**
	 * Send sms with specified values to provider
	 *
	 * @return  mixed
	 */
    public function sendSms();

}
