<?php

namespace App\Console\Commands;

use App\Models\Investment;
use App\Models\Utility;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class CreateUtility extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:utility';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este Cron se encarga de crear los registro de ultilidad, dos dias despues de la compra del paquete';

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
            Log::info('Inciar Comando create:utility ' . Carbon::now()->format('Y-m-d'));
            $investments = Investment::where('status', '1')->where('pay_utility', 0)->get();
            $monthDays = intval(date('t'));
            foreach ($investments as $investment) {
                $rentabilityPackage = $investment->membershipPackage->rentability;
                $investmentDate = Carbon::parse($investment->created_at);
                $investment2DaysFormat = $investmentDate->addDays(2)->format('Y-m-d');
                $currentDay = now()->format('Y-m-d');
                $rentability = ($rentabilityPackage / $monthDays);
                if ($investment2DaysFormat <= $currentDay) {
                    if ($investment->utilities->count() == 0) {
                        $investmentDays = intval($investmentDate->format('d'));
                        Utility::create([
                            'user_id' => $investment->user_id,
                            'investment_id' => $investment->id,
                            'amount' => ((($rentability * ($monthDays - $investmentDays)) * $investment->invested) / 100),
                            'amount_available' => ((($rentability * ($monthDays - $investmentDays)) * $investment->invested) / 100),
                            'accumulated_percentage' => $rentability * ($monthDays - $investmentDays),
                            'status' => '0',
                            'utility_log' => null,
                            'last_utility' => '1'
                        ]);
                    }
                }
            }
        } catch (\Throwable $th) {
            Log::info('Error comando create:utility' . Carbon::now()->format('Y-m-d'));
            Log::info($th);
        }
    }
}
