<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDetailedFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable()->after('name');
            $table->string('last_name')->nullable()->after('first_name');
            $table->string('country_code')->nullable()->after('last_name');
            $table->string('city')->nullable()->after('country_code');
            $table->string('postal_code')->nullable()->after('city');
            $table->string('address_line')->nullable()->after('postal_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('country_code');
            $table->dropColumn('city');
            $table->dropColumn('postal_code');
            $table->dropColumn('address_line');
        });
    }
}
