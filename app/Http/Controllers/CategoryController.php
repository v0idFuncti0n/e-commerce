<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin-dashboard.category');
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
}
