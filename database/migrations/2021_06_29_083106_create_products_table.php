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
            $table->string('title');
            $table->string('product_code');
            $table->string('product_quantity');
            $table->integer('category_id');
            $table->string('brand_id')->nullable();
            $table->string('company_id')->nullable();
            $table->string('product_unit');
            $table->string('product_sell_unit');
            $table->string('product_purchase_unit');
            $table->string('product_cost_price');
            $table->string('price');
            $table->string('pos_display');
            $table->string('image');
            $table->string('description')->nullable();
            $table->string('product_promotion')->nullable();
            $table->string('promotional_price')->nullable();
            $table->string('promotion_start_date')->nullable();
            $table->string('promotion_end_date')->nullable();
            $table->string('status')->default(0);
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
