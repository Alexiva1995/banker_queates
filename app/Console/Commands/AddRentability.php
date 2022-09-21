<?php

namespace App\Console\Commands;

use App\Services\RentabilityService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;


class AddRentability extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:rentability';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        try {
            Log::info('Inicio del cron add:rentability'. Carbon::now()->format('Y-m-d'));

            $rentabilityService = resolve(RentabilityService::class);
            $rentabilityService->applyRentability();
            
            Log::info('Fin del cron add:rentability'. Carbon::now()->format('Y-m-d'));
        } catch (\Throwable $th) {
            Log::info('Error comando add:rentability'. Carbon::now()->format('Y-m-d'));
            Log::info($th);
        }
       
    }   
}
