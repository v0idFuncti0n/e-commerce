<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin-dashboard.categories.category',['categories' => Category::all()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories,name|max:255'
        ]);

        $category = new Category();
        $category->name = $request->category_name;
        $category->save();

        $notification = array(
            'message' => 'Category has been added successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function delete($id){
        Category::destroy($id);

        $notification = array(
            'message' => 'Category has been deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /** @noinspection PhpUndefinedMethodInspection */
    public function update(Request $request, $id){
        $request->validate([
            'category_name' => 'required|unique:categories,name|max:255'
        ]);

        $category = Category::find($id);
        $category->name = $request->category_name;
        $category->save();

        $notification = array(
            'message' => 'Category has been updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function getSubCategories($categoryId) {
        $subCategories = Category::find($categoryId)->subCategories;
        return response()->json(array('subCategories'=> $subCategories));
    }
}
