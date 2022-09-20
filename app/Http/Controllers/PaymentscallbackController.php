<?php

namespace App\Http\Controllers;

use App\Models\payment;
use App\Services\Payments\Thawani;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentscallbackController extends Controller
{
  public function success(){
    $payment_id = Session::get('payment_id');
    $session_id = Session::get('session_id');
 if(!$payment_id && !$session_id){
    abort(404);
 }
 $payment = payment::findOrFail($payment_id);

if($payment->reference_id!== $session_id){
    abort(404);
}

if($payment->status !== 'success'){
    return 'Success';
}

$client = new Thawani(
    config('services.thawani.secret_key'),
    config('services.thawani.publishable_key'),
    'test'
);
try{
     $response = $client->getCheckoutSession($session_id);
    if($response['data']['payment_status'] == 'paid'){
        $payment->status = 'success';
        $payment->data = $response;
        $payment->save();
        dd('success!');

        Session::forget(['payment_id','session_id']);
    }
} catch(Exception $e){
    dd($e->getMessage());
}



  }
  public function cancel(){
    $payment_id = Session::get('payment_id');
    $session_id = Session::get('session_id');
 if(!$payment_id && !$session_id){
    abort(404);
 }
 $payment = payment::findOrFail($payment_id);

if($payment->reference_id !== $session_id){
    abort(404);
}
$payment->status = 'failed';
$payment->save();
dd('failed !');
  }

}

