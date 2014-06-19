<?php
namespace AsanakClient;

use Exceptions\AsanakSOAPException;
use ConnectionInterface;

class CurlConnection implements ConnectionInterface
{

    /**
     * Class to send values to provider
     *
     * @return object
     */
    public function sendSms()
    {
        $string = $this->createStringFromArray($values);
        /*
         * $curl = new Curl\Curl(); return $curl->get('http://www.example.com/'.$string);
         */
    }

    /**
     * Create array from string http post/get parameter
     *
     * @param array $array            
     * @param string $delimiter            
     * @param string $ke            
     * @param string $ks            
     *
     * @return Array
     */
    function createStringFromArray($array, $delimiter = '&', $ke = '=', $ks = ';')
    {
        foreach ($array as $keys => $values) {
            $string = '';
            foreach ($values as $key => $value) {
                $string[$key] = $value;
            }
            $var = implode($ks, $string);
            $output[] = $keys . $ke . $var;
        }
        return implode("&", $output);
    }
}
