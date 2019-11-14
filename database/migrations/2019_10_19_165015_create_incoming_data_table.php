<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomingDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incoming_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('locator_id');
            $table->foreign('locator_id')->references('id')->on('locators');
            
            $table->string('frame');
            
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
        Schema::dropIfExists('incoming_data');
    }
}
