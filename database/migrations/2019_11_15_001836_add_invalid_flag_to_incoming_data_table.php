<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInvalidFlagToIncomingDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('incoming_data', function (Blueprint $table) {
            $table->boolean('is_invalid')->default(false)->after('frame');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('incoming_data', function (Blueprint $table) {
            $table->dropColumn('is_invalid');
        });
    }
}
