<?php

namespace App\Listeners;

use App\Events\ReceivedNewFrameFromDevice;
use App\Position;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ParseIncomingFrameFromDevice implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param ReceivedNewFrameFromDevice $event
     * @return void
     * @throws \Exception
     */
    public function handle(ReceivedNewFrameFromDevice $event)
    {
        $frame = $event->getIncomingData();
        
        $data_string = trim($frame->frame, "<>|");
        [$gps, $gsm, $charge, $percent, $voltage] = explode('|', $data_string);

        if(!Str::contains($gps, ',') || !Str::contains($gsm, ',')){
            $frame->is_invalid = true;
            $frame->save();
            return;
        }

        [$mode, $fix, $utctime, $lat, $lon, $altitude, $speed,,,,,,,$sat_in_sight, $sat_in_use] = explode(',', $gps);

        if($mode == 1 && $fix == 1){
            $position = new Position;
            $position->is_from_gsm = false;
            $position->data_frame_id = $frame->id;
            $position->device_id = $frame->device_id;
            $position->latitude = $lat;
            $position->longitude = $lon;
            $position->altitude = $altitude;
            $position->speed = $speed;
            $position->time = (new Carbon(substr($utctime, 0,4).'-'.substr($utctime, 4,2).'-'.substr($utctime, 6,2).' '.substr($utctime, 8,2).':'.substr($utctime, 10,2).':'.substr($utctime, 12,2), 'UTC'))->setTimeZone(config('app.timezone'));
            $position->save();
            return;
        }

        [$code, $lon, $lat, $date, $time] = explode(',', $gsm);

        if($code == 0){
            $position = new Position;
            $position->is_from_gsm = true;
            $position->data_frame_id = $frame->id;
            $position->device_id = $frame->device_id;
            $position->latitude = $lat;
            $position->longitude = $lon;
            $position->time = (new Carbon($date.' '.$time, 'UTC'))->setTimeZone(config('app.timezone'));
            $position->save();
            return;
        }

        $frame->is_invalid = true;
        $frame->save();
    }
}
