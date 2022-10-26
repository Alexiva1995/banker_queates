<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Services\RangeService;

class SetRanges extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set:ranges';
    protected $rangeService;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cron para asignar un rango a los usuarios que cumplan las condiciones';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(RangeService $rangeService)
    {
        $this->rangeService = $rangeService;
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
            Log::info('Inicio asignar rangos a usuarios que cumplan requisitos - '.now());

            $this->rangeService->setUserRanges();
            
            Log::info('Fin de asignar rangos a usuarios - '.now());
        } catch (\Throwable $th) {
            Log::error('Error Cron Asginar Rangos a Usuarios -> '.$th);
        }
    }
}
