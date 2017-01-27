<?php

namespace Moneywave;


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
        $result = $this->moneywave->post($this->url, $this->data);
        $response = json_decode($result->getBody(), true);
        $this->response = $response;
        $this->responseCode = $result->getStatusCode();
        $this->status = $response["status"];
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
}