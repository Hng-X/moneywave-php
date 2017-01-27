<?php

namespace Moneywave;

use Dotenv\Dotenv;
use GuzzleHttp\Client;
use Moneywave\Exceptions\MoneywaveException;

class Moneywave
{
    public $client;
    private $apiKey;
    private $secretkey;
    private $baseUrl;
    private $accessToken;

    /**
     * Moneywave constructor.
     */
    public function __construct()
    {
        $dotenv = new Dotenv(__DIR__."/../");
        $dotenv->load();

        $this->apiKey = getenv('MONEYWAVE_PUBLIC_KEY');
        $this->secretkey = getenv('MONEYWAVE_SECRET_KEY');
        $this->baseUrl = getenv('MONEYWAVE_BASE_URL');
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
        ]);
        $this->accessToken = $this->getAccessToken();
        if ($this->accessToken) {
            $this->client = new Client([
                'base_uri' => $this->baseUrl,
                'header' => [
                    'Authorization' => $this->accessToken,
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Accept' => 'application/json'
                ]
            ]);
        }
    }

    /*
    * Get Moneywave access token
    */
    private function getAccessToken()
    {
        $response = $this->client->post('/v1/merchant/verify', [
            'form_params' => [
                "apiKey" => $this->apiKey,
                "secret" => $this->secretkey]
        ]);
        $response = json_decode($response->getBody(), true);

        if ($response["status"] == "success") {
            return $response['token'];
        } else {
            throw new MoneywaveException("Authentication failed: ".print_r($response));
        }
    }

}
