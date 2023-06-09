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
            $table->integer('locality_id')->nullable();
            $table->integer('htype_id')->nullable();
            $table->string('sec_status')->nullable();
            $table->text('details');
            $table->string('area')->nullable();
            $table->string('address')->nullable();
            $table->string('phone');
            $table->string('phone2')->nullable();
            $table->string('img')->nullable();
            $table->integer('status');
            $table->string('comment')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('assigned_by')->nullable();
            $table->integer('completed_by')->nullable();
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
        Schema::dropIfExists('ads');
    }
}
