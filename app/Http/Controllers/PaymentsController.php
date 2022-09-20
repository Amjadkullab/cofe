<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\payment;
use Illuminate\Http\Request;
use App\Services\Payments\Thawani;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaymentsController extends Controller
{
    public function create()
    {
        $client = new Thawani(
            config('services.thawani.secret_key'),
            config('services.thawani.publishable_key'),
            'test'
        );
        $data = [
            'client_reference_id' => 'test payment 1',
            'mode' => 'payment',
            'products' => [
                [
                'name' => 'test product',
                'quantity' => '2',
                'unit_amount' => '100',
                ],
            ],
            'success_url' => route('payments.success'),
            'cancel_url' => route('payments.cancel'),
        ];
        try {
            $session_id =  $client->createCheckoutSession($data);
           $payment = payment::forceCreate([
                'user_id'=> Auth::id(),
                'gateway'=>'thawani',
                'reference_id'=>$session_id,
                'status'=>'pending',
                'amount'=>'100',
 ]); //هاي ال forcecreate بدل ال fillable احنا استخدمناها
            Session::put('payment_id',$payment->id);
            Session::put('session_id',$session_id);
            return redirect()->away($client->getpayUrl($session_id));
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
