<?php

namespace App\Console\Commands;

use App\Events\ReceivedNewDataFromLocator;
use App\IncomingData;
use App\Position;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class BackProcessPreviuosIncomingData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'locators:backprocess';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse and process previous incoming data.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \Exception
     */
    public function handle()
    {
        $frames = IncomingData::whereIsInvalid(false)->whereDoesntHave('position')->get();

        foreach($frames as $frame){
            event(new ReceivedNewDataFromLocator($frame));
        }
    }
}
