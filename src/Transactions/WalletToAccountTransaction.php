<?php

namespace Moneywave\Transactions;


use Moneywave\Exceptions\MoneywaveException;
use Moneywave\Moneywave;

class WalletToAccountTransaction extends Transaction
{
    protected $url = "/v1/disburse";

    public function __construct(Moneywave $mw, $password = "")
    {
        parent::__construct($mw);

        if (empty($password)) {
            $password = getenv("MONEYWAVE_WALLET_PASSWORD");
            if (empty($password)) {
                throw new MoneywaveException("No wallet password supplied.");
            }
        }

        $this->required = array(
            "lock" => $password,
            "amount",
            "bankcode",
            "accountNumber",
            "senderName",
            "ref",
        );

        $this->data = [
            "currency" => "NGN",
            "apiKey" => $mw->getApiKey(),
        ];
    }
}