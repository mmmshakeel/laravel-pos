<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductItemDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_item_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('product_batch_id')->unsigned();
            $table->string('barcode')->nullable();
            $table->date('expiry_date')->nullable();
            $table->decimal('cost', 10, 2);
            $table->decimal('price1', 10, 2);
            $table->decimal('price2', 10, 2)->nullable();
            $table->decimal('price3', 10, 2)->nullable();
            $table->decimal('price4', 10, 2)->nullable();
            $table->integer('item_count');
            $table->boolean('enabled');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_item_details');
    }
}
