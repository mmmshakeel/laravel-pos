<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 60);
            $table->string('company_name');
            $table->text('address');
            $table->string('city');
            $table->integer('country_id')->unsigned();
            $table->string('contact_title', 10);
            $table->string('contact_first_name');
            $table->string('contact_last_name')->nullable();
            $table->string('contact_mobile', 20)->nullable();
            $table->string('phone', 20);
            $table->string('mail');
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
        Schema::dropIfExists('supplier');
    }
}
