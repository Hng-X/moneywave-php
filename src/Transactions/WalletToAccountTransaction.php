<?php

namespace Moneywave\Transactions;


use Moneywave\Moneywave;

class WalletToAccountTransaction extends Transaction
{
    protected $url = "/v1/disburse";

    protected $data = array();

    public function __construct(Moneywave $mw)
    {
        parent::__construct($mw);
        $this->data = array(
            "lock" => "",
            "amount" => "",
            "bankcode" => "",
            "accountNumber" => "",
            "currency" => "NGN",
            "apiKey" => $this->apiKey,
            "senderName" => "",
            "ref" => "",
        );
    }
}