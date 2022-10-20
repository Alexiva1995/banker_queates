<?php

namespace App\Console\Commands;

use App\Services\BonusService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DeleteBinaryPoints extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:binary:points';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cron para eliminar los puntos binarios una vez cumplan los 30 dias';

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
            Log::info('Inicio cron eliminar puntos binarios - '.now());

            $bonusService = resolve(BonusService::class);
            $bonusService->deleteBinaryPoints();
            
            Log::info('Fin de cron eliminar puntos binarios- '.now());
        } catch (\Throwable $th) {
            Log::error('Error cron eliminar puntos binarios -> '.$th);
        }
    }
}
