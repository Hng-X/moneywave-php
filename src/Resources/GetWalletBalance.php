<?php

namespace Moneywave\Resources;


use Moneywave\Moneywave;

class GetWalletBalance extends Resource{
    protected $url="/v1/wallet";

    public function __construct(Moneywave $mw)
    {
        parent::__construct($mw);
    }

    public function dispatch($method)
    {
        parent::dispatch("GET");
    }

}