<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('persons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->date('birthday')->nullable();
            $table->string('gender')->nullable();
            $table->timestamps();

        });
        Schema::create('person_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('person_id')->unsigned();
            $table->string('address')->nullable();
            $table->string('post_code')->nullable();
            $table->string('city_name')->nullable();
            $table->string('country_name');
            $table->timestamps();
            $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('person_addresses');
        Schema::dropIfExists('persons');
    }
}
