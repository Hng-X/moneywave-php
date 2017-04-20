<?php

namespace HngX\Moneywave\Transactions;


use HngX\Moneywave\Moneywave;
use HngX\Moneywave\Traits\NeedsValidation;

class AccountToAccountTransaction extends Transaction{

    use NeedsValidation;

    protected $url = "/v1/transfer";
    protected $validationUrl = "/v1/transfer/charge/auth/card";

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
        );
        $this->optional = array(
            "recipient",
            "recipient_id",
            "recipients",
            "pin",
            "chargeCurrency",
            "disburseCurrency",
            "charge_with",
            "card_last4",
            "sender_account_number",
            "sender_bank",
            "passcode",
            "card_id",
            "cycle",
            "startDate",
            "endDate",
        );

        $this->data = [
            "apiKey" => $mw->getApiKey(),
            "medium" => "web",
        ];
    }
}