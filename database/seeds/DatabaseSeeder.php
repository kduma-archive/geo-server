<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $locator = new \App\Locator();
        $locator->uuid = '281e6b5d-e206-4dc5-9db0-a239f9511d17';
        $locator->name = 'DFRobot';
        $locator->ccid = '8901260862291107216f';
        $locator->imei = '869170031199350';
        $locator->save();
    }
}
