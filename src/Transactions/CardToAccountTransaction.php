<?php

namespace Moneywave\Transactions;


use Moneywave\Moneywave;

class CardToAccountTransaction extends Transaction
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
            "recipient_bank",
            "recipient_account_number",
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
        $this->optional = array(
            "recipient_id",
        );

        $this->data = [
            "apiKey" => $mw->getApiKey(),
            "medium" => "web",
        ];
    }
}