<?php

use App\Events\ReceivedNewFrameFromDevice;
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
        $locator = new \App\Device();
        $locator->uuid = '281e6b5d-e206-4dc5-9db0-a239f9511d17';
        $locator->name = 'DFRobot';
        $locator->ccid = '8901260862291107216f';
        $locator->imei = '869170031199350';
        $locator->save();
        
        if(env('IMPORT_DATA')) {
            $data = json_decode(file_get_contents(env('IMPORT_DATA')), true);
            
            foreach($data as $entry) {
                $row = new \App\DataFrame;
                $row->frame = $entry['frame'];
                $row->created_at = $entry['created_at'];
                $row->updated_at = $entry['created_at'];
                $locator->DataFrames()->save($row);
                event(new ReceivedNewFrameFromDevice($row));
            }
        }
    }
}
