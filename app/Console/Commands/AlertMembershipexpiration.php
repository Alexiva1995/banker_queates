<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Member;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AlertMembershipexpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alert:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Realiza una consulta a la base de datos de los usuarios con membresia activas. 
    Si a esas membresias le quedan menos de 5 dias, envia un email de alerta.';

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
        
        $memberships = Member::where("status", "activo")->with("referidos")->get();
        foreach ($memberships as $membership ) {
            $type = $membership->ordenes->membershipPackage->membershipType->name;
            $remainingDays = now()->diffInDays($membership->end_date);
            if ($remainingDays == 5 || $remainingDays == 1) {
                $dataMail = [
                    "numberDays" => $remainingDays,
                    "day" => $remainingDays == 1 ? " dia" : " dias",
                    "type" => $type,
                    'logo' => public_path('/images').'/login/connect.png'
                ];
                $email = $membership->referidos[0]->email;
                Mail::send('mails.AlertMail', $dataMail,  function ($msj) use ($email) {
                    $msj->subject('Alerta de membresias activas');
                    $msj->to($email);
                });
            }
        }
    }
}
