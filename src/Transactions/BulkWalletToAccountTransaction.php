<?php

namespace Moneywave\Transactions;


use Moneywave\Moneywave;

class BulkWalletToAccountTransaction extends Transaction
{

    protected $url = "/v1/disburse/bulk";

    protected $data = array();

    public function __construct(Moneywave $mw, $password)
    {
        parent::__construct($mw);
        $this->data = array(
            "lock" => $password,
            "recipients" => array(
                "amount" => "",
                "bankcode" => "",
                "accountNumber" => "",
                "ref" => "",
            ),
            "currency" => "NGN",
            "apiKey" => $mw->getApiKey(),
            "senderName" => "",
            "ref" => "",
        );
    }
}