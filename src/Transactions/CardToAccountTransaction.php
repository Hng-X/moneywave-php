<?php

namespace Moneywave\Transactions;


use Moneywave\Moneywave;

class CardToAccountTransaction extends Transaction
{

    protected $url = "/v1/transfer";

    protected $data = array();

    public function __construct(Moneywave $mw)
    {
        parent::__construct($mw);
        $this->data = array(
            "firstname" => "",
            "lastname" => "",
            "phonenumber" => "",
            "email" => "",
            "recipient_bank" => "",
            "recipient_account_number" => "",
            "card_no" => "",
            "cvv" => "",
            "expiry_year" => "",
            "expiry_month" => "",
            "apiKey" => $this->apiKey,
            "amount" => "",
            "fee" => "",
            "redirecturl" => "",
            "medium" => "web",
            "chargeCurrency" => "",
            "disburseCurrency" => "",
            "charge_with" => "",
            "card_last4" => "",
            "sender_account_number" => "",
            "sender_bank" => "",
        );
    }
}