<?php
/**
 * Created by PhpStorm.
 * User: J
 * Date: 27/01/2017
 * Time: 15:01
 */

namespace Moneywave;


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