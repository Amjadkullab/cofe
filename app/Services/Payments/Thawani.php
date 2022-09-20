<?php

namespace App\Services\Payments;

use Exception;
use Illuminate\Support\Facades\Http;

class Thawani {

const TEST_BASE_URL = 'https://uatcheckout.thawani.om/api/v1';
const LIVE_BASE_URL = 'https://checkout.thawani.om/api/v1';

protected $secretkey;
protected $publishablekey;
protected $baseUrl;
protected $mode ;
public function __construct($secretkey,$publishablekey,$mode='test'){
    $this->mode = $mode ;
    $this->secretkey =$secretkey;
    $this->publishablekey = $publishablekey;

    if($mode == 'test'){
        $this->baseUrl = self::TEST_BASE_URL ;
    }else{
        $this->baseUrl= self::LIVE_BASE_URL ;
    }
}
public function createCheckoutSession($data)
{
 $response =  Http::baseUrl($this->baseUrl)->withHeaders([
    'thawani-api-key' =>$this->secretkey
])->asJson()->post('checkout/session',$data);
$body = $response->json();
if($body['success']==true && $body['code']==2004){
    return $body['data']['session_id'];
} throw new Exception(
    $body['description'],$body['code']
);
}

public function getCheckoutSession($session_id){
    $response =  Http::baseUrl($this->baseUrl)->withHeaders([
        'thawani-api-key' =>$this->secretkey
    ])->get('checkout/session/'. $session_id)->json();

    if($response['success'] == true && $response['code'] == 2000){
        return $response;
    } throw new Exception(
        $response['description'],$response['code']
    );
}
public function getpayUrl($session_id){
     if($this->mode =='test'){
        return "https://uatcheckout.thawani.om/pay/{$session_id}?key={$this->publishablekey}";
     }
        return "https://checkout.thawani.om/pay/{$session_id}?key={$this->publishablekey}";



}



}
