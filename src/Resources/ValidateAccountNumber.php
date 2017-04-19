<?php

namespace Moneywave\Resources;


use Moneywave\Moneywave;
use Moneywave\MoneywaveApiClient;

class ValidateAccountNumber extends MoneywaveApiClient{
    protected $url = "/v1/resolve/account";

    protected $data = array();

    public function __construct(Moneywave $mw)
    {
        parent::__construct($mw);
        $this->required = array(
            "account_number",
            "bank_code"
        );
    }
}