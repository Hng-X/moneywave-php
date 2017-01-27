<?php
/**
 * Created by PhpStorm.
 * User: J
 * Date: 27/01/2017
 * Time: 15:05
 */

namespace Moneywave;


class BulkWalletToAccountTransaction extends Transaction
{

    protected $url = "/v1/disburse/bulk";

    protected $data = array();

    public function __construct(Moneywave $mw)
    {
        parent::__construct($mw);
        $this->data = array(
            "lock" => "",
            "recipients" => array(
                "amount" => "",
                "bankcode" => "",
                "accountNumber" => "",
                "ref" => "",
            ),
            "currency" => "NGN",
            "apiKey" => $this->apiKey,
            "senderName" => "",
            "ref" => "",
        );
    }
}