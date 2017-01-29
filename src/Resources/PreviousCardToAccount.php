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

    public function __set($key, $value)
    {
        if (array_key_exists($key, $this->data)) {
            $this->data[$key] = $value;
        }
        if ($key === "id") {
        	$this->url = $this->url.$value;
        }
    }
}