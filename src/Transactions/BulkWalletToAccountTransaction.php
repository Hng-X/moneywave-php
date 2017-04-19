<?php

namespace Moneywave\Transactions;


use Moneywave\Moneywave;

class BulkWalletToAccountTransaction extends Transaction
{

    protected $url = "/v1/disburse/bulk";

    public function __construct(Moneywave $mw, $password)
    {
        parent::__construct($mw);
        $this->required = array(
            "recipients",
            "senderName",
            "ref",
        );
        $this->data = [
            "apiKey" => $mw->getApiKey(),
            "currency" => "NGN",
            "lock" => $password,
        ];
    }
}