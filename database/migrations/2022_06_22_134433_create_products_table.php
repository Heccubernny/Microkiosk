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
            $table->string("category_id");
            $table->string("name");
            $table->string("vendor_id")->default(1);
            $table->float("original_price");
            $table->float("selling_price");
            $table->string("slug");
            $table->double("delivery_cost");
            $table->string("image_path");
            $table->longText("description");
            $table->string('quantity');
            $table->string('tax');
            $table->tinyInteger('status')->default(true);
            $table->tinyInteger('trending');
            $table->mediumText('meta_title');
            $table->mediumText('meta_keywords');
            $table->mediumText('meta_description');
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
