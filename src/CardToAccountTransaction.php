<?php
/**
 * Created by PhpStorm.
 * User: J
 * Date: 27/01/2017
 * Time: 14:33
 */

namespace Moneywave;


class CardToAccountTransaction extends Transaction{

    protected $url = "";
    
    protected $data = array();

    public function __construct(Moneywave $mw) {
        parent::__construct($mw);
        $this->data = array(
            "firstname"                 =>  "",
            "lastname"                  =>  "",
            "phonenumber"               =>  "",
            "email"                     =>  "",
            "recipient_bank"            => "",
            "recipient_account_number"  => "",
            "card_no"                   =>  "",
            "cvv"                       =>  "",
            "expiry_year"               =>  "",
            "expiry_month"              =>  "",
            "apiKey"                    =>  $this->apiKey,
            "amount"                    => "",
            "fee"                       => "",
            "redirecturl"               => "",
            "medium"                    => "web"
        );
    }
}