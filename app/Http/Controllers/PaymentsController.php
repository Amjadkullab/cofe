<?php

namespace App\Http\Controllers;

use App\Services\Payments\Thawani;
use Exception;
use Illuminate\Http\Request;

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
                'unit_amount' => '200',
                ],
            ],
            'success_url' => route('payments.success'),
            'cancel_url' => route('payments.cancel'),
        ];
        try {
            $session_id =  $client->createCheckoutSession($data);
            return redirect()->away($client->getpayUrl($session_id));
        } catch (Exception $e) {
            dd($e->getmessage());
        }
    }
}
