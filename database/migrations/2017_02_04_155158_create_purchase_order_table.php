<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier_id')->unsigned();
            $table->text('supplier_contact')->nullable();
            $table->integer('ship_to_branch_id')->unsigned();
            $table->integer('purchase_rep')->unsigned();
            $table->integer('terms_id')->unsigned()->nullable();
            $table->integer('shipping_service_id')->unsigned()->nullable();
            $table->date('delivery_date')->nullable();
            $table->date('due_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->integer('currency_id')->unsigned();
            $table->string('tax_invoice_number')->nullable();
            $table->date('tax_invoice_date')->nullable();
            $table->string('supplier_invoice_number', 100)->nullable();
            $table->date('supplier_invoice_date')->nullable();
            $table->string('shipment_tracking_number', 100);
            $table->decimal('weight_kg', 10, 2)->nullable();
            $table->string('reference')->nullable();
            $table->text('notes')->nullable();
            $table->integer('location_id')->unsigned();
            $table->tinyInteger('is_draft')->default(1);
            $table->tinyInteger('is_invoiced')->default(0);
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
        Schema::dropIfExists('purchase_order');
    }
}
