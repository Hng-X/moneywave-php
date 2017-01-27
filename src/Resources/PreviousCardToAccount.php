<?php

namespace Moneywave\Resources;


use Moneywave\Moneywave;

class PreviousCardToAccount extends Resource{
    protected $url="/v1/transfer/";
    protected $data = array();

    public function __construct(Moneywave $mw)
    {
        parent::__construct($mw);
        $this->data = array(
            "id" => "",
        );
    }
}