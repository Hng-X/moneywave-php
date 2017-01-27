<?php
/**
 * Created by PhpStorm.
 * User: J
 * Date: 27/01/2017
 * Time: 14:24
 */

namespace Moneywave;


class ChargeToCardTransaction extends Transaction
{

    protected $url = "/v1/get-charge";
    protected $data = array();

    public function __construct(Moneywave $mw)
    {
        parent::__construct($mw);
        $this->data = array(
            "amount" => "",
            "fee" => ""
        );
    }


}