<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->increments('id');
            
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('locator_id');
            
            $table->dateTimeTz('time')->nullable();
            $table->decimal('latitude', 14, 10)->nullable();
            $table->decimal('longitude', 14, 10)->nullable();
            $table->decimal('altitude', 8, 3)->nullable();
            $table->decimal('speed', 6, 2)->nullable();
            
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
        Schema::dropIfExists('positions');
    }
}
