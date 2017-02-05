<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesInvoiceProductItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_invoice_product_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sales_invoice_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('barcode_id')->unsigned()->nullable();
            $table->string('serial_number')->nullable();
            $table->integer('qty');
            $table->integer('price_level');
            $table->decimal('price', 10, 2);
            $table->integer('discount')->default(0)->nullable();
            $table->decimal('sale_price', 10, 2);
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
        Schema::dropIfExists('sales_invoice_product_items');
    }
}
