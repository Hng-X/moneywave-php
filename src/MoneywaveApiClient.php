<?php

namespace Moneywave;


abstract class MoneywaveApiClient {

    protected $moneywave;

    protected $status;

    protected $url = "";

    protected $data = array();

    protected $responseCode;

    protected $response;

    public function __construct(Moneywave $moneywave)
    {
        $this->moneywave = $moneywave;
    }

    public function __get($key)
    {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        } else {
            return "";
        }
    }

    public function __set($key, $value)
    {
        if (array_key_exists($key, $this->data)) {
            $this->data[$key] = $value;
        }
    }


    public function dispatch($method = "POST")
    {
        $result = $this->moneywave->request($method, $this->url, array(
            "form_params" => $this->data,
            "headers" => ["Authorization" => $this->moneywave->getToken()]
        ));
        $this->response = json_decode($result->getBody(), true);
        $this->responseCode = $result->getStatusCode();
        $this->status = $this->response["status"];
    }

    public function getResponse()
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