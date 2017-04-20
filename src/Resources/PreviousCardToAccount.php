<?php

namespace HngX\Moneywave\Resources;


use HngX\Moneywave\Exceptions\MoneywaveException;
use HngX\Moneywave\Moneywave;

class PreviousCardToAccount extends Resource{
    protected $url="/v1/transfer/";

    public function __construct(Moneywave $mw)
    {
        parent::__construct($mw);
        $this->required = array(
            "id"
        );
    }

    public function __set($key, $value)
    {
        if ($key === "id") {
        	$this->url = $this->url.$value;
        } else {
            throw new MoneywaveException("Unknown argument $key");
        }
    }
}