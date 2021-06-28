<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index($category, $subCategory = null){
        $subCategories = null;
        if($category == 'all'){
            $products = Product::paginate(1);
        }else {

            if($subCategory != null){
                $products = Product::where('category_id', $category)->where('sub_category_id', $subCategory)->paginate(1);
            }else{
                $products = Product::where('category_id', $category)->paginate(1);
            }

            $subCategories = Category::find($category)->subCategories;
        }
        $categories = Category::all();
        return view('e-commerce.home-page',['products' => $products, 'currentCategory' => $category, 'currentSubCategory' => $subCategory, 'categories' => $categories, 'subCategories' => $subCategories]);
    }

    public function showProduct($productId){
        $product = Product::find($productId);
        return view('e-commerce.product-page', ['product' => $product]);
    }

    public function showCart() {
        return view('e-commerce.checkout-page', ['cartProducts' => Cart::content()]);
    }

}
