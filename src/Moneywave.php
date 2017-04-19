<?php

namespace Moneywave;

use GuzzleHttp\Client;
use Moneywave\Exceptions\MoneywaveException;

class Moneywave
{
    protected $client;
    protected $apiKey;
    protected $secretkey;
    protected $baseUrl;
    protected $accessToken;

    /**
     * Moneywave constructor.
     */
    public function __construct($publicKey, $secretKey)
    {
        $this->apiKey = $publicKey;
        $this->secretkey = $secretKey;
        $this->baseUrl = "https://moneywave.herokuapp.com";
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

    public function request($method, $url, $options)
    {
        return $this->client->request($method, "https://moneywave.herokuapp.com".$url, $options);
    }

    public function getClient() {
        return $this->client;
    }

    public function getToken() {
        return $this->accessToken;
    }

    public function getApiKey() {
        return $this->apiKey;
    }

}
