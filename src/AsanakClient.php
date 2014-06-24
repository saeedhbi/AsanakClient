<?php
namespace AsanakClient;

class AsanakClient
{

    public $connectiontype;

    public $values;

    public $connect;

    /**
     * Set values to properties 
     *
     * @param array $values            
     *
     * @return void
     */
    public function __construct($values)
    {
        $this->connectiontype = $values['connectiontype'];
        
        $this->values = $values;
    }

    /**
     * Class to connect connection
     *
     * @return object
     */
    public function connect()
    {
        if ($this->connect) {
            $inject = ucfirst($this->connectiontype) . 'Connection';
            $this->connect = new $inject($this->values);
        }
        
        return $this->connect;
    }
}
