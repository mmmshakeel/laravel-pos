<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_invoice', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quotation_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned();
            $table->integer('sales_rep_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->integer('currency_id')->unsigned();
            $table->integer('payment_method_id')->unsigned();
            $table->tinyInteger('is_draft')->default(1);
            $table->text('notes')->nullable();            
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
        Schema::dropIfExists('sales_invoice');
    }
}
