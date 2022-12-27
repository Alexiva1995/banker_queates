<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Whizfx;
use Illuminate\Support\Facades\Http;

class updateWhizfx extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:whizfx';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiza los datos guardados en la tabla whizfx';

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
        $whizfxs = Whizfx::all();
        foreach ($whizfxs as $whizfx) {
                $url = config('services.api_whizfx.base_url');
                $url = $url . 'customer/'.$whizfx->customer_id;
                $response = Http::withHeaders([
                    'auth' => config('services.api_whizfx.x-token'),
                ])->get("{$url}");
                $customerData = $response->object();
                $whizfx->kyc_percentage = $customerData->kyc_percentage;
                
                $whizfx->save();
        }
    }
}
