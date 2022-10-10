<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AlertLicenseexpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'license:expiration:alert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CrobJob para informar al admin si a un usuario se le venció su licencia';

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
            Log::info('Inicio verificar vigencia de licencias a usuarios - '.now());
            $users = User::where('id', '!=', 1)->with('investment')->get();

            foreach($users as $user) {

                if($user->investment !== null) {
                    
                    if($user->investment->expiration_date == today()->format('Y-m-d')) {
                        Log::debug("Al usuario {$user->name} se le ha vencido su licencia");
                    }
                }
            }
            Log::info('Fin de verificar vigencia de licencias a usuarios - '.now());

        } catch (\Throwable $th) {
            Log::error('Error Cron verificar vigencia de licencias a usuarios -> '.$th);
        }
    }
}
