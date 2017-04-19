<?php

namespace Moneywave\Resources;


use Moneywave\Moneywave;

class RetryFailedTransaction extends Resource{
    protected $url="/v1/transfer/disburse/retry";
    protected $data = array();

    public function __construct(Moneywave $mw)
    {
        parent::__construct($mw);
        $this->required = array(
            "id",
            "recipient_account_number",
            "recipient_bank",
        );
    }
}