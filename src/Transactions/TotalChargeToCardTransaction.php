<?php

namespace Moneywave\Transactions;


use Moneywave\Moneywave;

class TotalChargeToCardTransaction extends Transaction
{

    protected $url = "/v1/get-charge";
    protected $data = array();

    public function __construct(Moneywave $mw)
    {
        parent::__construct($mw);
        $this->data = array(
            "amount" => "",
            "fee" => ""
        );
    }


}