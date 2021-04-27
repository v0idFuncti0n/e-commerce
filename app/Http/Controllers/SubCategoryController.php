<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;


class SubCategoryController extends Controller
{
    public function index(){
        $sub_categories = SubCategory::all();
        $categories = Category::all();
        return view('admin-dashboard.categories.sub_category', ['sub_categories' => $sub_categories, 'categories' => $categories]);
    }

    public function store(Request $request){

        $request->validate([
            'sub_category_name' => 'required|unique:sub_categories,name|max:255'
        ]);

        $subCategory = new SubCategory();
        $subCategory->name = $request->sub_category_name;
        Category::find($request->category_id)->subCategories()->save($subCategory);

        $notification = array(
            'message' => 'Sub category has been added successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function delete($id){
        SubCategory::destroy($id);

        $notification = array(
            'message' => 'Sub category has been deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function update(Request $request, $id){

        $request->validate([
            'sub_category_name' => 'required|unique:sub_categories,name|max:255'
        ]);

        $subCategory = SubCategory::find($id);
        $subCategory->name = $request->sub_category_name;

        $subCategory->category()->associate(Category::find($request->category_id));

        $subCategory->save();


        $notification = array(
            'message' => 'Sub category has been updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
