<?php
/**
 * Created by PhpStorm.
 * User: J
 * Date: 27/01/2017
 * Time: 14:10
 */

namespace Moneywave;


class Transaction {

    protected $moneywave;

    protected $status;

    protected $url ="";

    protected $data = array();

    public function __construct(Moneywave $moneywave)
    {
        $this->moneywave = $moneywave;
    }

    public function __get($key)
{
    if(array_key_exists($key, $this->data)) {
        return $this->data[$key];
    }
}

    public function __set($key, $value)
    {
        if(array_key_exists($key, $this->data)) {
            $this->data[$key] = $value;
        }
    }


    public function dispatch() {
        $response = $this->mw->post($this->url, $this->data);
        $response = json_decode($response, true);
        return $response;
    }
}