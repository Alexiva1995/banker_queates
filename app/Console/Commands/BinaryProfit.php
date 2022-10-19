<?php

namespace App\Console\Commands;

use App\Http\Controllers\BinaryController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class BinaryProfit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'corte:ganancias:binarias';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Genera el corte y los correspondientes bonos binarios';

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
            Log::info('Inicio Generar corte y bonos binarios '. now());

            $binaryController = resolve(BinaryController::class);
            $binaryController->usdtbonobinario();

            Log::info('Fin Generar corte y bonos binarios '. now());
        } catch (\Throwable $th) {
            Log::error('Error Generar corte y bonos binarios ->'.$th);
        }
    }
}
