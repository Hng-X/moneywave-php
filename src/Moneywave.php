<?php

namespace Moneywave;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Moneywave\Exceptions\MoneywaveException;

class Moneywave
{
    protected $client;
    private $apiKey;
    private $secretkey;
    private $baseUrl;
    private $accessToken;

    /**
     * Moneywave constructor.
     */
    public function __construct()
    {
        $this->apiKey = env('MONEYWAVE_PUBLIC_KEY');
        $this->secretkey = env('MONEYWAVE_SECRET_KEY');
        $this->baseUrl = env('MONEYWAVE_BASE_URL');
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
        ]);
        $this->accessToken = $this->getAccessToken();
        if ($this->accessToken) {
            $authBearer = 'Bearer ' . $this->accessToken;
            $this->client = new Client([
                'base_uri' => $this->baseUrl,
                'header' => [
                    'Authorization' => $authBearer,
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
