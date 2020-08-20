<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Rajaongkir
{
    protected $ci;

    public function __construct()
    {
        $this->ci =& get_instance();
    }

    public function cost($destination)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "origin=154&destination=$destination&weight=1&courier=jne",
        CURLOPT_HTTPHEADER => array(
            "key: ff356a3882ea9f984bfee076f7b00fd9",
            "Content-Type: application/x-www-form-urlencoded"
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }
}