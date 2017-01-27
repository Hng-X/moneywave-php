<?php

namespace Moneywave\Transactions;


use Moneywave\Moneywave;

class Transaction
{

    protected $moneywave;

    protected $status;

    protected $url = "";

    protected $data = array();

    protected $responseCode;

    private $response;

    public function __construct(Moneywave $moneywave)
    {
        $this->moneywave = $moneywave;
    }

    public function __get($key)
    {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }
    }

    public function __set($key, $value)
    {
        if (array_key_exists($key, $this->data)) {
            $this->data[$key] = $value;
        }
    }


    public function dispatch()
    {
        $result = $this->moneywave->post(getenv("MONEYWAVE_BASE_URL").$this->url, $this->data);
        $this->response = json_decode($result->getBody(), true);
        $this->responseCode = $result->getStatusCode();
        $this->status = $this->response["status"];
    }

    public function getFullResponse()
    {
        return $this->response;
    }

    public function getStatus()
    {
        return array(
            "status" => $this->status,
            "code" => $this->responseCode,
        );
    }

    public function successful()
    {
        return $this->status == "success";
    }

    public function setDetails(array $data)
    {
        $this->data = $data;
    }
}