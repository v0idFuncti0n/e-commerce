<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('admin-dashboard.products.product', [
            'products' => $products,
        ]);
    }


    public function create()
    {
        $categories = Category::all();
        $subCategories = $categories->first()->subCategories;

        return view('admin-dashboard.products.create_product', [
            'categories' => $categories,
            'sub_categories' => $subCategories
        ]);
    }


    public function store(Request $request): \Illuminate\Http\JsonResponse
    {

        $newProduct = new Product();
        $newProduct->title = $request->title;
        $newProduct->description = $request->description;
        $newProduct->code = $request->code;
        $newProduct->quantity = $request->quantity;
        $newProduct->brand = $request->brand;
        $newProduct->color = $request->color;
        $newProduct->size = $request->size;
        $newProduct->selling_price = $request->selling_price;
        $newProduct->discount_price = $request->discount_price;
        $newProduct->status = 1;

        Category::find($request->category)->products()->save($newProduct);
        if ($request->sub_category != null) {
            SubCategory::find($request->sub_category)->products()->save($newProduct);
        } else {
            $newProduct->sub_category_id = null;
        }

        $IS_FIRST_IMAGE = true;
        foreach ($request->file('files') as $file) {

            $fileName = $file->hashName();

            $newImage = new Image();
            $newImage->name = $fileName;
            $newImage->path = 'products_images/' . $newProduct->id . '/' . $fileName;
            $newImage->is_thumbnail = $IS_FIRST_IMAGE;
            $IS_FIRST_IMAGE = false;

            $newProduct->images()->save($newImage);

            $file->move(public_path('storage/products_images/' . $newProduct->id), $fileName);
        }

        $newProduct->save();
        Session::flash('message','Product has been added');
        Session::flash('alert-type','success');
        return response()->json([
            'success' => 200
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $sub_categories = $categories->first()->subCategories;

        return view('admin-dashboard.products.edit_product', [
            'product' => $product,
            'categories' => $categories,
            'sub_categories' => $sub_categories,
        ]);
    }


    public function update(Request $request)
    {
        $product = Product::find($request->id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->code = $request->code;
        $product->quantity = $request->quantity;
        $product->brand = $request->brand;
        $product->color = $request->color;
        $product->size = $request->size;
        $product->selling_price = $request->selling_price;
        $product->discount_price = $request->discount_price;
        $product->status = 1;

        Category::find($request->category)->products()->save($product);
        if ($request->sub_category != null) {
            SubCategory::find($request->sub_category)->products()->save($product);
        } else {
            $product->sub_category_id = null;
        }

        $images = $product->images;
        foreach ($images as $image) {
            Image::destroy($image->id);
        }
        Storage::disk('public')->deleteDirectory('/products_images/' . $product->id);
        $IS_FIRST_IMAGE = true;
        foreach ($request->file('files') as $file) {

            $fileName = $file->hashName();

            $newImage = new Image();
            $newImage->name = $fileName;
            $newImage->path = 'products_images/' . $product->id . '/' . $fileName;
            $newImage->is_thumbnail = $IS_FIRST_IMAGE;
            $IS_FIRST_IMAGE = false;

            $product->images()->save($newImage);

            $file->move(public_path('storage/products_images/' . $product->id), $fileName);
        }

        $product->save();
        Session::flash('message','Product has been updated');
        Session::flash('alert-type','success');
        return response()->json([
            'success' => 200
        ]);
    }


    public function delete($id)
    {
        $product = Product::find($id);

        $images = $product->images;
        foreach ($images as $image) {
            Image::destroy($image->id);
        }
        Storage::disk('public')->deleteDirectory('/products_images/' . $product->id);

        Product::destroy($product->id);

        $notification = array(
            'message' => 'Product has been deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function getImages($id)
    {
        $product = Product::find($id);
        $images = array();
        foreach ($product->images as $image) {
            $images[] = array(
                'image' => Storage::disk('public')->url($image->path),
                'name' => $image->name
            );
        }
        return response()->json($images);
    }

    public function toggleStatus($id){
        $product = Product::find($id);
        $product->status == 1 ? $product->status = 0 : $product->status = 1;
        $product->save();
        return redirect()->route('admin.products');
    }
}
