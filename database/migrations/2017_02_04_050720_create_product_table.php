<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('description');
            $table->integer('category_id')->unsigned();
            $table->integer('brand_id')->unsigned();
            $table->integer('model_id')->unsigned();
            $table->integer('branch_id')->unsigned();
            $table->decimal('cost', 10, 2);
            $table->decimal('average_cost', 10, 2)->nullable();
            $table->decimal('price_level1', 10, 2);
            $table->decimal('price_level2', 10, 2)->nullable();
            $table->decimal('price_level3', 10, 2)->nullable();
            $table->decimal('price_level4', 10, 2)->nullable();
            $table->integer('total_stock')->nullable();
            $table->string('rack_id', 60)->nullable();
            $table->integer('product_type_id')->unsigned();
            $table->enum('active_status', ['A', 'P', 'I'])->default('P');
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
        Schema::dropIfExists('product');
    }
}
