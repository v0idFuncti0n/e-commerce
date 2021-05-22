<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
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
        $newProduct->video_link = $request->video_link;
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
            $newImage->path = 'products_images/' . $newProduct->id . '/' . $fileName;
            $newImage->is_thumbnail = $IS_FIRST_IMAGE;
            $IS_FIRST_IMAGE = false;

            $newProduct->images()->save($newImage);

            $file->move(public_path('storage/products_images/' . $newProduct->id), $fileName);
        }

        $newProduct->save();

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
        return view('admin-dashboard.products.edit_product', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }


    public function delete($id)
    {
        $product = Product::find($id);

        $images = $product->images;
        foreach ($images as $image) {
            Image::destroy($image->id);
        }
        Storage::disk('public')->deleteDirectory('/products_images/'.$product->id);

        Product::destroy($product->id);

        $notification = array(
            'message' => 'Product has been deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
