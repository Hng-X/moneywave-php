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
    'baseUrl' => getenv('MONEYWAVE_BASE_URL'),
);