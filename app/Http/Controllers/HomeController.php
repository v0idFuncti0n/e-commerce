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
            $products = Product::where('quantity', '>', 0)->where('status', '=', 1)->paginate(8);
        }else {

            if($subCategory != null){
                $products = Product::where('category_id', $category)->where('sub_category_id', $subCategory)->where('quantity', '>', 0)->where('status', '=', 1)->paginate(8);
            }else{
                $products = Product::where('category_id', $category)->where('quantity', '>', 0)->where('status', '=', 1)->paginate(8);
            }

            $subCategories = Category::find($category)->subCategories;
        }
        $categories = Category::all();
        return view('e-commerce.home-page',['products' => $products, 'currentCategory' => $category, 'currentSubCategory' => $subCategory, 'categories' => $categories, 'subCategories' => $subCategories]);
    }

    public function showProduct($productId){
        $product = Product::findOrFail($productId);
        if($product->quantity <= 0 || $product->status == 0){
            return redirect()->route('home');
        }else{
            return view('e-commerce.product-page', ['product' => $product]);
        }
    }

    public function showCart() {
        return view('e-commerce.checkout-page', ['cartProducts' => Cart::content()]);
    }

    public function showSearchProduct(Request $request){
        $subCategories = null;
        $category = $request->category;
        $subCategory = $request->subCategory;
        $search = $request->search;
        if($category == 'all'){
            $products = Product::where('title','like', '%'.$search.'%' )->where('quantity', '>', 0)->where('status', '=', 1)->paginate(8);
        }else {

            if($subCategory != null){
                $products = Product::where('category_id', $category)->where('sub_category_id', $subCategory)->where('title','like', '%'.$search.'%' )->where('quantity', '>', 0)->where('status', '=', 1)->paginate(8);
            }else{
                $products = Product::where('category_id', $category)->where('title','like', '%'.$search.'%' )->where('quantity', '>', 0)->where('status', '=', 1)->paginate(8);
            }

            $subCategories = Category::find($category)->subCategories;
        }
        $categories = Category::all();
        return view('e-commerce.home-page',['products' => $products, 'currentCategory' => $category, 'currentSubCategory' => $subCategory, 'categories' => $categories, 'subCategories' => $subCategories]);
    }

}
