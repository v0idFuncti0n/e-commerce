<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::find(1);

        $subCategory = new SubCategory();
        $subCategory->name = "T-Shirts";
        $category->subCategories()->save($subCategory);

        $subCategory = new SubCategory();
        $subCategory->name = "Tank Tops";
        $category->subCategories()->save($subCategory);

        $subCategory = new SubCategory();
        $subCategory->name = "Polos";
        $category->subCategories()->save($subCategory);

        $category = Category::find(2);

        $subCategory = new SubCategory();
        $subCategory->name = "Pullovers";
        $category->subCategories()->save($subCategory);

        $subCategory = new SubCategory();
        $subCategory->name = "Cardigans";
        $category->subCategories()->save($subCategory);

        $subCategory = new SubCategory();
        $subCategory->name = "Polos";
        $category->subCategories()->save($subCategory);

        $subCategory = new SubCategory();
        $subCategory->name = "Vests";
        $category->subCategories()->save($subCategory);

        $category = Category::find(3);

        $subCategory = new SubCategory();
        $subCategory->name = "Active & Performance";
        $category->subCategories()->save($subCategory);

        $subCategory = new SubCategory();
        $subCategory->name = "Lightweight Jackets";
        $category->subCategories()->save($subCategory);

        $subCategory = new SubCategory();
        $subCategory->name = "Fleece";
        $category->subCategories()->save($subCategory);


    }
}
