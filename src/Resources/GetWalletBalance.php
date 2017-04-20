<?php

namespace HngX\Moneywave\Resources;


use HngX\Moneywave\Moneywave;

class GetWalletBalance extends Resource {
    protected $url="/v1/wallet";

    public function __construct(Moneywave $mw)
    {
        parent::__construct($mw);
    }

    public function dispatch($method = "POsT")
    {
        parent::dispatch("GET");
    }

}