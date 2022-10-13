<?php

namespace App\Console\Commands;

use App\Models\Orden_pamm;
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
        $ordenes_pamm = Orden_pamm::where('status', '0')->get();

        foreach($ordenes_pamm as $pam){
            
            $id = $pam['user_id'];
            $monto = $pam['monto'];                             //EJEMPLO: Sobre la ejecusion de trading  de los 100 generados de Juan.
            $mitad_monto = $monto *0.5;                       ///50% = US$ 50 de los cuales La Pamm reparte la mitad US$ 25 residual en 10
            $monto_residual = $mitad_monto *0.5;            ////niveles al MLM //////////////////////////////////////////////////////////
          
            $NIVELES = [
                [0.15],
                [0.15],
                [0.10],
                [0.10],
                [0.10],
                [0.10],
                [0.15],
                [0.05],
                [0.05],
                [0.05],
            ];
            $ID_padre = -1;
            for($i = 0; $i < count($NIVELES); $i++){

                if( $ID_padre == -1){
                    $ID_padre = $this->padre($id , $NIVELES[$i][0]);
                    if(isset($ID_padre) && !empty($ID_padre) && $ID_padre != null){
                        Log::info('Pagando bono NIVEL_.'.$NIVELES[$i][0].'.  a usuario '. $ID_padre);
                        $i++;
                    }
                }else{
                    $ID_padre = $this->padre($ID_padre , $NIVELES[$i][0]);
                    if(isset($ID_padre) && !empty($ID_padre) && $ID_padre != null){
                        Log::info('Pagando bono NIVEL_.'.$NIVELES[$i][0].'.  a usuario '.  $ID_padre);
                    }
                }
                
            }
            /*
            //NIVEL_1 //////////////////////////////////
                $BONO_NIVEL_1  = $monto_residual * 0.15;
                $ID_padre_1 = $this->padre($id , $BONO_NIVEL_1 );
                if(isset($ID_padre_1) && !empty($ID_padre_1) && $ID_padre_1 != null){
                    Log::info('Pagando bono NIVEL_1  a usuario '. $ID_padre_1);
                }
                
            //NIVEL_2 //////////////////////////////////   
                $BONO_NIVEL_2  = $monto_residual * 0.15;
                $ID_padre_2 = $this->padre($ID_padre_1,$BONO_NIVEL_2);
                if(isset($ID_padre_2) && !empty($ID_padre_2) && $ID_padre_2 != null){
                    Log::info('Pagando bono Nivel_2 a usuario '. $ID_padre_2);
                }
            
            //NIVEL_3 //////////////////////////////////
                $BONO_NIVEL_3  = $monto_residual * 0.10;
                $ID_padre_3 = $this->padre($ID_padre_2, $BONO_NIVEL_3 );
                if(isset($ID_padre_3) && !empty($ID_padre_3) && $ID_padre_3 != null){
                    Log::info('Pagando bono NIVEL_3 a usuario '. $ID_padre_3);
                }
            
            //NIVEL_4 //////////////////////////////////    
                $BONO_NIVEL_4  = $monto_residual * 0.10;    
                $ID_padre_4 = $this->padre($ID_padre_3, $BONO_NIVEL_4);
                if(isset($ID_padre_4) && !empty($ID_padre_4) && $ID_padre_4 != null){
                    Log::info('Pagando bono NIVEL_4 a usuario '. $ID_padre_4);
                }
            
            //NIVEL_5 //////////////////////////////////    
                $BONO_NIVEL_5  = $monto_residual * 0.10;        
                $ID_padre_5 = $this->padre($ID_padre_4,$BONO_NIVEL_5 );
                if(isset($ID_padre_5) && !empty($ID_padre_5) && $ID_padre_5 != null){
                    Log::info('Pagando bono NIVEL_5 a usuario '. $ID_padre_5);
                }
            
            //NIVEL_6 //////////////////////////////////  
                $BONO_NIVEL_6  = $monto_residual * 0.10;        
                $ID_padre_6 = $this->padre($ID_padre_5,$BONO_NIVEL_6);
                if(isset($ID_padre_6) && !empty($ID_padre_6) && $ID_padre_6 != null){
                    Log::info('Pagando bono NIVEL_6 a usuario '. $ID_padre_6);
                }
            
            //NIVEL_7 //////////////////////////////////    
                $BONO_NIVEL_7  = $monto_residual * 0.15;        
                $ID_padre_7 = $this->padre($ID_padre_6,$BONO_NIVEL_7);
                if(isset($ID_padre_7) && !empty($ID_padre_7) && $ID_padre_7 != null){
                    Log::info('Pagando bono NIVEL_7 a usuario '. $ID_padre_7);
                }
            
            //NIVEL_8 //////////////////////////////////    
                $BONO_NIVEL_8  = $monto_residual * 0.05; 
                $ID_padre_8 = $this->padre($ID_padre_7,$BONO_NIVEL_8);
                if(isset($ID_padre_8) && !empty($ID_padre_8) && $ID_padre_8 != null){
                    Log::info('Pagando bono NIVEL_8 a usuario '. $ID_padre_8);
                }
    
            //NIVEL_9 //////////////////////////////////    
                $BONO_NIVEL_9  = $monto_residual * 0.05; 
                $ID_padre_9 = $this->padre($ID_padre_8,$BONO_NIVEL_9);
                if(isset($ID_padre_9) && !empty($ID_padre_9) && $ID_padre_9 != null){
                    Log::info('Pagando bono NIVEL_9 a usuario '. $ID_padre_9);
                }
    
            //NIVEL_10 //////////////////////////////////  
                $BONO_NIVEL_10  = $monto_residual * 0.05;   
                $ID_padre_10 = $this->padre($ID_padre_9,$BONO_NIVEL_10);
                if(isset($ID_padre_10) && !empty($ID_padre_10) && $ID_padre_10 != null){
                    Log::info('Pagando bono NIVEL_10 a usuario '. $ID_padre_10);
                }
                */
        }
       
    }

    public function padre($id, $BONO){
        $user = User::where('id',$id)->first('buyer_id');
        if(isset($user) && !empty($user) && $user['buyer_id'] != null) {
            $bono_pamm = [
                'user_id'=>$user['buyer_id'],
                'amount'=>$BONO,
                'amount_available'=>$BONO,
                'buyer_id'=>$id,
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
