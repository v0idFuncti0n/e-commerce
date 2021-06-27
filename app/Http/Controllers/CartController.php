<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request, $id){
        $product = Product::find($id);
        if($product->discount_price == NULL){
            Cart::add([
                'id' => $id,
                'name' => $product->title,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
            ]);

            return response()->json(['success' => 'Successfully added on your cart', 'cartItems' => Cart::count()]);
        }else {
            Cart::add([
                'id' => $id,
                'name' => $product->title,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
            ]);

            return response()->json(['success' => 'Successfully added on your cart', 'cartItems' => Cart::count()]);
        }
    }

    public function removeFromCart($rowId, $productId){
        Cart::remove($rowId);

        return response()->json(['success' => 'Successfully removed on your cart', 'cartItems' => Cart::count()]);
    }
}
