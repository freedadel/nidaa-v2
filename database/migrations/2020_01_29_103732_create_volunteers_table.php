<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVolunteersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('volunteers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('place');
            $table->string('country')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('locality_id')->nullable();
            $table->integer('htype_id')->nullable();
            $table->string('area')->nullable();
            $table->string('address')->nullable();
            $table->string('phone');
            $table->string('phone2')->nullable();
            $table->integer('status');
            $table->integer('user_id')->nullable();
            $table->integer('confirmed_by')->nullable();
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
        Schema::dropIfExists('volunteers');
    }
}
