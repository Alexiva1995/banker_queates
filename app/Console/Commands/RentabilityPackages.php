<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Http\Controllers\InversionController;


class RentabilityPackages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pay:rentability';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Paga la rentabilidad de los paquetes';

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
            Log::info('PagarRentabilidadPaquetes- '.Carbon::now());
            $inversion = new InversionController();
            $inversion->payRentability();
        } catch (\Throwable $th) {
            Log::error('Error al Pagar la rentabilidad de los paquetes-> '.$th);
        }
    }
}
