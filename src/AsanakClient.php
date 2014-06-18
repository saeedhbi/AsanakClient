<?php

class AsanakClient
{

    public $connectiontype;

    public $values;

    public $connect;

    public function __construct($values)
    {
        $this->connectiontype = $values['connectiontype'];
        
        $this->values = $values;
    }

    public function connect()
    {
        $inject = ucfirst($this->connectiontype) . 'Connection';
        $connect = new $inject($this->values);
    }
}
