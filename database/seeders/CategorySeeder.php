<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Category::factory()->count(15)->create();
        $category = new Category();
        $category->name = "Shirts";
        $category->save();

        $category = new Category();
        $category->name = "Sweaters";
        $category->save();

        $category = new Category();
        $category->name = "Jackets & Coats";
        $category->save();

        $category = new Category();
        $category->name = "Jeans";
        $category->save();

        $category = new Category();
        $category->name = "Shorts";
        $category->save();

        $category = new Category();
        $category->name = "Socks";
        $category->save();

    }
}
