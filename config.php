<?php

return array(
    /**
     * Public Key From Moneywave Dashboard
     *
     */
    'apiKey' => getenv('MONEYWAVE_PUBLIC_KEY'),

    /**
     * Secret Key From Moneywave Dashboard
     *
     */
    'secretKey' => getenv('MONEYWAVE_SECRET_KEY'),

    /**
     * Moneywave Payment URL
     *
     */
    'baseUrl' => getenv('MONEYWAVE_PAYMENT_URL'),

    /**
     *
     */
    'redirect_url'  =>  getenv('MONEYWAVE_REDIRECT_URL'),
    /**
     * Optional email address of the merchant
     *
     */
    'merchantEmail' => getenv('MERCHANT_EMAIL'),

    /**
     * Merchant Bank Name
     */
    'bank_name'     =>  getenv('MERCHANT_BANK_NAME'),
    /**
     * Merchant Account Number
     */
    'account_number'    =>  getenv('MERCHANT_ACCOUNT_NUMBER'),

    /**
     * Merchant Bank Account Name
     */
    'account_name'     => getenv('MERCHANT_ACCOUNT_NAME'),

    /**
     * Merchant Amount to charge customers
     */
    'amount'    => getenv('MERCHANT_AMOUNT'),

    /**
     * Merchant Fee on every transaction
     */
    'fee'       => getenv('MERCHANT_FEE')
);