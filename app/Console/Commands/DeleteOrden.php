<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\OrdenPurchase;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class DeleteOrden extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:orden';

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
               
            Log::info('Inciar Comando delete:orden ' . Carbon::now()->format('Y-m-d'));
            $hoy =  Carbon::now()->toDateTimeString();  
            $ordenes = OrdenPurchase::where([['status', '2'],['created_at', '<', $hoy]])->get();
            $ordenes->delete();
     
        } catch (\Throwable $th) {
            Log::info('Fin Comando delete:orden ' . Carbon::now()->format('Y-m-d'));
        }
    }
}
