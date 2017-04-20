<?php

namespace HngX\Moneywave\Resources;


use HngX\Moneywave\Moneywave;

class TokenizeCard  extends Resource{

    protected $url = "/v1/transfer/charge/tokenize/card";

    public function __construct(Moneywave $mw)
    {
        parent::__construct($mw);
        $this->required = array(
            "card_no",
            "expiry_year",
            "expiry_month",
            "cvv",
        );
    }

    public function getCardToken()
    {
        return $this->getResponse()["data"]["cardToken"];
    }
}