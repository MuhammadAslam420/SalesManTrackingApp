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
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->integer('stockIn')->unsigned();
            $table->integer('qty')->unsigned();
            $table->integer('sale_qty')->unsigned();
            $table->string('image')->default('product.jpg');
            $table->string('SKU')->unique();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->decimal('purchase_cost', 10, 2)->unsigned();
            $table->decimal('sale_cost', 10, 2)->unsigned();
            $table->decimal('discount_percentage', 5, 2)->nullable();
            $table->integer('discount_on_qty')->unsigned()->nullable();
            $table->date('discount_date_start')->nullable();
            $table->date('discount_date_end')->nullable();
            $table->timestamps();
            $table->foreignId('sub_category_id')->references('id')->on('sub_categories');
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
