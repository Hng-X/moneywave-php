<?php

namespace HngX\Moneywave\Transactions;


use HngX\Moneywave\Moneywave;

class TotalChargeToCardTransaction extends Transaction
{

    protected $url = "/v1/get-charge";

    public function __construct(Moneywave $mw)
    {
        parent::__construct($mw);
        $this->required = array(
            "amount" => "",
            "fee" => ""
        );
    }


}