<?php

namespace App\Console\Commands;

use App\Models\OrdenPamm;
use App\Models\User;
use App\Models\WalletComission;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class bonosPamm extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bonos:pamm';

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
        $ordenes_pamm = OrdenPamm::where('status', '0')->get();

        foreach($ordenes_pamm as $pam){
            
            $id = $pam['user_id'];
            $monto = $pam['monto'];                             //EJEMPLO: Sobre la ejecusion de trading  de los 100 generados de Juan.
            $mitad_monto = $monto *0.5;                       ///50% = US$ 50 de los cuales La Pamm reparte la mitad US$ 25 residual en 10
            $monto_residual = $mitad_monto *0.5;            ////niveles al MLM //////////////////////////////////////////////////////////
          
            $NIVELES = [
                [0.15],     //NIVEL_1      
                [0.15],     //NIVEL_2
                [0.10],     //NIVEL_3
                [0.10],     //NIVEL_4
                [0.10],     //NIVEL_5
                [0.10],     //NIVEL_6
                [0.15],     //NIVEL_7
                [0.05],     //NIVEL_8
                [0.05],     //NIVEL_9
                [0.05],     //NIVEL_10
            ];
            $ID_padre = -1;
            for($i = 0; $i < count($NIVELES); $i++){

                if( $ID_padre == -1){
                    $ID_padre = $this->padre($id , $NIVELES[$i][0],$monto_residual, $id );
                    if(isset($ID_padre) && !empty($ID_padre) && $ID_padre != null){
                        Log::info('Pagando bono NIVEL_.'.$NIVELES[$i][0].'.  a usuario '. $ID_padre);
                        
                    }
                }else{
                    $ID_padre = $this->padre($ID_padre , $NIVELES[$i][0],$monto_residual, $id );
                    if(isset($ID_padre) && !empty($ID_padre) && $ID_padre != null){
                        Log::info('Pagando bono NIVEL_.'.$NIVELES[$i][0].'.  a usuario '.  $ID_padre);
                    }
                }
            }
        }
    }

    public function padre($id,$BONO,$monto_residual, $buyer_id){
        $user = User::where('id',$id)->first('buyer_id');
        if(isset($user) && !empty($user) && $user['buyer_id'] != null) {
            $bono_pamm = [
                'user_id'=>$user['buyer_id'],
                'amount'=>$BONO * $monto_residual,
                'amount_available'=>$BONO * $monto_residual,
                'buyer_id'=>$buyer_id,
                'amount_last_liquidation',
                'type',
                'description'=>'Bono Pamm',
                'level'=>0,
                'status'=> 0,
            ];

            WalletComission::create($bono_pamm);
            return $user['buyer_id'];
        }else{
            return null;
        }
    }
}
