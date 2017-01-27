<?php

return array(

    /**
     * Public Key From Moneywave Dashboard
     *
     */
    'apiKey' => env('MONEYWAVE_PUBLIC_KEY'),

    /**
     * Secret Key From Moneywave Dashboard
     *
     */
    'secretKey' => env('MONEYWAVE_SECRET_KEY'),

    /**
     * Moneywave Payment URL
     *
     */
    'baseUrl' => env('MONEYWAVE_BASE_URL', "https://moneywave.herokuapp.com/"),
);