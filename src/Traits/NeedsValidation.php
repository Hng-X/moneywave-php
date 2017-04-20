<?php

namespace HngX\Moneywave\Traits;


use GuzzleHttp\Exception\RequestException;

trait NeedsValidation {

    public function validate(array $data)
    {
        try {
            $result = $this->moneywave->request("POST", $this->validationUrl, array(
                "form_params" => $data,
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
}