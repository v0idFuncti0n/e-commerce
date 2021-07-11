<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class StripeController extends Controller
{
    public function stripeOrder(Request $request){

        if(!Auth::check()){
            return redirect()->to('login');
        }

        \Stripe\Stripe::setApiKey(

            'sk_test_51J6zCZDG2r86Ky5Vy7Q1ucWuUZJmihYNSk3oHCel6WC6dNq9FYYQi276nuxarRVsFo68Tz8qep59cp4pEIAlObWu00S7j4Z5KJ'
        );

        $token = $request->stripeToken;

        $amount = Cart::total(2, '.', '') * 100;
        if(Session::has('coupon')){
            $amount = (Cart::total(2, '.', '') * 100)  - ((Cart::total(2, '.', '') * 100) * session()->get('coupon')['discount'] / 100);
        }

        $order = new Order();
        $order->user_id = Auth::id();
        $order->firstName = $request->firstName;
        $order->lastName = $request->lastName;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->zip = $request->zip;
        $order->total = $amount / 100;
        $order->quantity = Cart::count();
        $order->shipped = false;
        $order->save();


        $charge = \Stripe\Charge::create([
            'amount' => $amount,
            'currency' => 'usd',
            'description' => 'Item ordered',
            'source' => $token,
            'metadata' => ['order_id' => $order->id],
        ]);

        $carts = Cart::content();
        foreach($carts as $cart){
            $orderItem = new OrderItem();

            $product = Product::find($cart->id);

            $orderItem->order_id = $order->id;
            $orderItem->product_id = $cart->id;
            $orderItem->color = $cart->options->color;
            $orderItem->size = $cart->options->size;
            $orderItem->quantity = $cart->qty;
            $orderItem->price = $cart->price * $cart->qty;

            $orderItem->save();

            $product->quantity -= $cart->qty;
            $product->save();
        }
        if(Session::has('coupon')){
            Session::forget('coupon');
        }
        Cart::destroy();
        Session::flash('message', 'Order has been sent successfully');
        Session::flash('alert-type', 'success');
        return redirect()->to('/products/all');

    }
}
