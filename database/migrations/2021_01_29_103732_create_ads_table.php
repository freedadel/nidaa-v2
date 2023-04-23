<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('type');
            $table->integer('state_id');
            $table->integer('locality_id');
            $table->integer('htype_id');
            $table->string('sec_status');
            $table->text('details');
            $table->string('area');
            $table->string('address');
            $table->string('phone');
            $table->string('phone2');
            $table->string('img');
            $table->integer('status');
            $table->integer('comment');
            $table->integer('updated_by');
            $table->integer('assigned_by');
            $table->integer('completed_by');
            $table->integer('confirmed_by');
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
        Schema::dropIfExists('ads');
    }
}
