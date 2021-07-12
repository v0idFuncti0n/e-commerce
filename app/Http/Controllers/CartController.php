<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $product = Product::find($id);
        if ($product->discount_price == NULL) {
            Cart::add([
                'id' => $id,
                'name' => $product->title,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'color' => $request->color,
                    'size' => $request->size
                ]
            ]);

            return response()->json(['success' => 'Successfully added on your cart', 'cartItems' => Cart::count()]);
        } else {
            Cart::add([
                'id' => $id,
                'name' => $product->title,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'color' => $request->color,
                    'size' => $request->size
                ]
            ]);

            return response()->json(['success' => 'Successfully added on your cart', 'cartItems' => Cart::count()]);
        }
    }

    public function removeFromCart($rowId, $productId)
    {
        Cart::remove($rowId);

        return response()->json(['success' => 'Successfully removed on your cart', 'cartItems' => Cart::count()]);
    }

    public function applyCoupon(Request $request)
    {
        if (!Session::has('coupon')) {
            $coupon = Coupon::where('coupon', $request->coupon)->first();
            if ($coupon != null) {
                if(\Carbon\Carbon::now() < \Carbon\Carbon::createFromDate($coupon->created_at)->addDays($coupon->validity_days)){
                    Session::put('coupon', [
                        'coupon' => $coupon->coupon,
                        'discount' => $coupon->discount,
                    ]);
                }else{
                    return response()->json(['error'=>'This coupon is no longer valid'], 404);
                }
            }else{
                return response()->json(['error'=>'This coupon does not exist'], 404);
            }
            return response()->json(['success' => 200]);
        }
    }

    public function removeCoupon(){
        if(Session::has('coupon')){
            Session::remove('coupon');
        }
        return response()->json(['success' => 200]);
    }

    public function incrementItem($rowId, $id) {
        $product = Product::find($id);
        $qty = Cart::get($rowId)->qty;
        if($product->quantity != $qty){
            Cart::update($rowId, ++$qty);
            $total = Session::has('coupon') ? number_format(Cart::total() - (Cart::total() * session()->get('coupon')['discount'] / 100),2) : Cart::total();
            return response()->json(['qty' => Cart::get($rowId)->qty, 'total' => $total, 'count' => Cart::count()]);
        }else{
            return response()->json(['error' => 'qty passed'], 404);
        }

    }

    public function decrementItem($rowId, $id) {
        $qty = Cart::get($rowId)->qty;
        if($qty > 1){
            Cart::update($rowId, --$qty);
            $total = Session::has('coupon') ? number_format(Cart::total() - (Cart::total() * session()->get('coupon')['discount'] / 100),2) : Cart::total();
            return response()->json(['qty' => Cart::get($rowId)->qty, 'total' => $total, 'count' => Cart::count()]);
        }else{
            return response()->json(['error' => "qty can't be less than 0"], 404);
        }

    }

}
