<?php

namespace Moneywave\Transactions;


use Moneywave\Moneywave;

class CardToWalletTransaction extends Transaction
{
    protected $url = "/v1/transfer";

    public function __construct(Moneywave $mw)
    {
        parent::__construct($mw);
        $this->required = array(
            "firstname",
            "lastname",
            "phonenumber",
            "email",
            "card_no",
            "cvv",
            "expiry_year",
            "expiry_month",
            "amount",
            "fee",
            "redirecturl",
            "chargeCurrency",
            "disburseCurrency",
            "charge_with",
            "card_last4",
            "sender_account_number",
            "sender_bank",
        );
        $this->data = [
            "recipient" => "wallet",
            "apiKey" => $mw->getApiKey(),
            "medium" => "web",
        ];
    }
}