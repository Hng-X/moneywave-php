<?php

namespace HngX\Moneywave;


use GuzzleHttp\Exception\RequestException;
use \HngX\Moneywave\Exceptions\MoneywaveException;

abstract class MoneywaveApiClient {

    protected $moneywave;

    protected $status;

    protected $url = "";

    protected $required = array();

    protected $optional = array();

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
            throw new MoneywaveException("Unknown property $key");
        }
    }

    public function __set($key, $value)
    {
        if (array_key_exists($key, $this->data)) {
            $this->data[$key] = $value;
        } else if (in_array($key, $this->required) || in_array($key, $this->optional)) {
            $this->data[$key] = $value;
        } else {
            throw new MoneywaveException("Unknown property $key");
        }
    }


    public function dispatch($method = "POST")
    {
        try {
            $result = $this->moneywave->request($method, $this->url, array(
            "form_params" => $this->data,
            "headers" => ["Authorization" => $this->moneywave->getToken()]
        ));
            $this->response = json_decode($result->getBody(), true);
            $this->responseCode = $result->getStatusCode();
            $this->status = $this->response["status"];
        } catch (RequestException $e) {
            $this->responseCode = $e->getCode();
            $this->response = json_decode($e->getResponse()->getBody(), true);
            $this->status = $e->getMessage();
        }
        return $this;
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
        return $this;
    }
}