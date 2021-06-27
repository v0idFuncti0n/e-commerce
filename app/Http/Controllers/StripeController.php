<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function stripeOrder(Request $request){
        \Stripe\Stripe::setApiKey(

            'sk_test_51J6zCZDG2r86Ky5Vy7Q1ucWuUZJmihYNSk3oHCel6WC6dNq9FYYQi276nuxarRVsFo68Tz8qep59cp4pEIAlObWu00S7j4Z5KJ'
        );

        $token = $request->stripeToken;

        $charge = \Stripe\Charge::create([
            'amount' => Cart::total() * 100,
            'currency' => 'usd',
            'description' => 'Item ordered',
            'source' => $token,
            'metadata' => ['order_id' => '6735'],
        ]);

        dd($charge);
    }
}
