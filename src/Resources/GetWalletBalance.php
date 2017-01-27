<?php

namespace Moneywave\Resources;


use Moneywave\Moneywave;

class GetWalletBalance extends Resource{
    protected $url="/v1/wallet";

    public function __construct(Moneywave $mw)
    {
        parent::__construct($mw);
    }

    public function dispatch($method = "GET")
    {
        $result = $this->moneywave->client->request($method, getenv("MONEYWAVE_BASE_URL").$this->url, array(
            "form_params" => $this->data
        ));
        $this->response = json_decode($result->getBody(), true);
        $this->responseCode = $result->getStatusCode();
        $this->status = $this->response["status"];
    }

}