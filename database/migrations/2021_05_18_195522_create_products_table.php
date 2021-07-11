<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id');
            $table->foreignId('sub_category_id')->nullable(true);

            $table->string('title');
            $table->text('description');
            $table->string('code');
            $table->integer('quantity');
            $table->string('brand');
            $table->string('color');
            $table->string('size');
            $table->double('selling_price', 10, 2);
            $table->double('discount_price', 10, 2)->nullable();
            $table->string('status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
