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
        $this->apiKey = config("apiKey");
        $this->secretkey = config('secretKey');
        $this->baseUrl = config("baseUrl");
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
                    'Content-Type' => 'application/json',
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
        $request = new Request('POST', '/v1/merchant/verify', array(
            'form_params' => [
                "apiKey" => $this->apiKey,
                "secret" => $this->secretkey]
        ));
        $response = $this->client->send($request, ['timeout' => 2]);
        $response = json_decode($response->getBody(), true);

        if ($response["status"] == "success") {
            return $response['token'];
        } else {
            throw new MoneywaveException("Authentication failed: ".print_r($response));
        }
    }

}
