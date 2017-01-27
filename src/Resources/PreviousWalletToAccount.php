<?php

namespace Moneywave\Resources;


use Moneywave\Moneywave;

class PreviousWalletToAccount  extends Resource{
    protected $url="/v1/disburse/status";
    protected $data = array();

    public function __construct(Moneywave $mw)
    {
        parent::__construct($mw);
        $this->data = array(
            "ref" => "",
        );
    }
}