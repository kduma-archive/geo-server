<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameLocatorsTableToDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('locators', 'devices');
        Schema::rename('incoming_data', 'data_frames');
        
        Schema::table('positions', function (Blueprint $table) {
            $table->renameColumn('locator_id', 'device_id');
        });
        Schema::table('positions', function (Blueprint $table) {
            $table->renameColumn('incoming_data_id', 'data_frame_id');
        });
        Schema::table('data_frames', function (Blueprint $table) {
            $table->renameColumn('locator_id', 'device_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_frames', function (Blueprint $table) {
            $table->renameColumn('device_id', 'locator_id');
        });
        Schema::table('positions', function (Blueprint $table) {
            $table->renameColumn('device_id', 'locator_id');
        });
        Schema::table('positions', function (Blueprint $table) {
            $table->renameColumn('data_frame_id', 'incoming_data_id');
        });
        Schema::rename('data_frames', 'incoming_data');
        Schema::rename('devices', 'locators');
    }
}
