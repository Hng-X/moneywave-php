<?php

namespace Moneywave;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

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
        if($this->accessToken) {
            $authBearer = 'Bearer '. $this->accessToken;
            $this->client = new Client([
                'base_uri'  =>  $this->baseUrl,
                'header'    =>  [
                    'Authorization' => $authBearer,
                    'Content-Type'  => 'application/json',
                    'Accept'        => 'application/json'
                ]
            ]);
        }
    }

    /*
    * Get Moneywave access token
    */
    private function getAccessToken()
    {
        $request = new Request('POST', '/v1/merchant/verify',array(
            'form_params' => [
                "apiKey" => $this->apiKey,
                "secret" => $this->secretkey]
        ));
        $response = $this->client->send($request, ['timeout' => 2]);
        $response = json_decode($response->getBody(), true);

        if($response["status"] == "success") {
            return $response['token'];
        }
        else{
            return false;
        }
    }


    public function getListOfBanks()
    {
        $banks = $this->client->post("http://moneywave.herokuapp.com/banks", []);
        return json_decode($banks->getBody(), true);
    }

    public function makePaymentRequest()
    {
        //get expire month/year
        $expiry = explode('/', request()->cardExpiry);
        $data = [
            "firstname"                 =>  request()->firstname,
            "lastname"                  =>  request()->lastname,
            "phonenumber"               =>  request()->phonenumber,
            "email"                     =>  request()->email,
            "card_no"                   =>  request()->cardNumber,
            "cvv"                       =>  request()->cardCVC,
            "expiry_year"               =>  $expiry[0],
            "expiry_month"              =>  $expiry[1],
            "apiKey"                    =>  $this->apiKey,
            "recipient_bank"            =>  Config::get('moneywave.bank_name'),
            "recipient_account_number"  =>  Config::get('moneywave.account_number'),
            "amount"                    =>  intval( Config::get('moneywave.amount') ),
            "fee"                       =>  intval( Config::get('moneywave.fee') ),
            "redirecturl"               =>  Config::get('moneywave.redirect_url'),
            "medium"                    =>  "web"
        ];
        array_filter($data);
//        dd($data);
        $this->setHttpResponse('/v1/transfer', 'POST', $data);
    }
    /**
     * @param $relativeUrl
     * @param $method
     * @param array $body
     * @throws isNullException
     */
    private function setHttpResponse($relativeUrl, $method, $body = [])
    {
        if(is_null($method)){
            throw new isNullException("Empty method not allow");
        }
        $authBearer = 'Bearer '. $this->getAccessToken();
        $this->client->{strtolower($method)}("https://moneywave.herokuapp.com/v1/transfer",
            [
                "form_params"   =>  $body,
                "header"    =>  [ 'Authorization' => $authBearer ]
            ]
        );
    }

}
