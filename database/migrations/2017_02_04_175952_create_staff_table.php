<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('code', 60);
            $table->string('title', 10);
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->date('joined_date');
            $table->text('address');
            $table->string('city', 100);
            $table->integer('country_id')->unsigned();
            $table->string('telephone', 20)->nullable();
            $table->string('mobile', 20);
            $table->string('email')->nullable();
            $table->date('date_of_birth');
            $table->enum('gender', ['M', 'F'])->default('M');
            $table->string('working_hours', 100)->nullable();
            $table->string('contact_person_title', 10);
            $table->string('contact_person_first_name');
            $table->string('contact_person_last_name')->nullable();
            $table->string('contact_person_relation');
            $table->string('contact_person_contact_no', 20);
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
        Schema::dropIfExists('staff');
    }
}
