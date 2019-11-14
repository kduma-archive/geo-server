<?php

namespace App\Console\Commands;

use App\Socket\LocatorsServer;
use Illuminate\Console\Command;

use Illuminate\Support\Facades\Log;
use Ratchet\Server\IoServer;

class StartLocatorsServerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'locators:run {--port=8523}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start server for incoming data from location devices';

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
     */
    public function handle()
    {
        $this->info("Starting server on port: ".$this->option('port'));
        
        IoServer::factory(
            new LocatorsServer(function ($message, $is_error) {
                if($is_error)
                    $this->error($message);
                else
                    $this->info($message);
                
                if($is_error)
                    Log::driver('locators')->warning($message);
                else
                    Log::driver('locators')->info($message);
            }),
            $this->option('port')
        )->run();
    }
}
