<?php

namespace App\Console\Commands;

use App\Models\User;
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
        $usuarios = User::all();

        //NIVEL_1 //////////////////////////////////
            $id = 3;
            $Nivel_1 = $this->padre($id);
            if(isset($Nivel_1) && !empty($Nivel_1) && $Nivel_1 != null){
                Log::info('Pagando bono a usuario '. $Nivel_1);
            }
            
        //NIVEL_2 //////////////////////////////////    
            $Nivel_2 = $this->padre($Nivel_1);
            if(isset($Nivel_2) && !empty($Nivel_2) && $Nivel_2 != null){
                Log::info('Pagando bono a usuario '. $Nivel_2);
            }
        
        //NIVEL_3 //////////////////////////////////    
            $Nivel_3 = $this->padre($Nivel_2);
            if(isset($Nivel_3) && !empty($Nivel_3) && $Nivel_3 != null){
                Log::info('Pagando bono a usuario '. $Nivel_3);
            }
        
        //NIVEL_4 //////////////////////////////////    
            $Nivel_4 = $this->padre($Nivel_3);
            if(isset($Nivel_4) && !empty($Nivel_4) && $Nivel_4 != null){
                Log::info('Pagando bono a usuario '. $Nivel_4);
            }
        
        //NIVEL_5 //////////////////////////////////    
            $Nivel_5 = $this->padre($Nivel_4);
            if(isset($Nivel_5) && !empty($Nivel_5) && $Nivel_5 != null){
                Log::info('Pagando bono a usuario '. $Nivel_5);
            }
        
        //NIVEL_6 //////////////////////////////////    
            $Nivel_6 = $this->padre($Nivel_5);
            if(isset($Nivel_6) && !empty($Nivel_6) && $Nivel_6 != null){
                Log::info('Pagando bono a usuario '. $Nivel_6);
            }
        
        //NIVEL_7 //////////////////////////////////    
            $Nivel_7 = $this->padre($Nivel_6);
            if(isset($Nivel_7) && !empty($Nivel_7) && $Nivel_7 != null){
                Log::info('Pagando bono a usuario '. $Nivel_7);
            }
        
        //NIVEL_8 //////////////////////////////////    
            $Nivel_8 = $this->padre($Nivel_7);
            if(isset($Nivel_8) && !empty($Nivel_8) && $Nivel_8 != null){
                Log::info('Pagando bono a usuario '. $Nivel_8);
            }

        //NIVEL_9 //////////////////////////////////    
            $Nivel_9 = $this->padre($Nivel_8);
            if(isset($Nivel_9) && !empty($Nivel_9) && $Nivel_9 != null){
                Log::info('Pagando bono a usuario '. $Nivel_9);
            }

        //NIVEL_10 //////////////////////////////////    
            $Nivel_10 = $this->padre($Nivel_9);
            if(isset($Nivel_10) && !empty($Nivel_10) && $Nivel_10 != null){
                Log::info('Pagando bono a usuario '. $Nivel_10);
            }
    }

    public function padre($id){
        $user = User::where('id',$id)->first('buyer_id');
        if(isset($user) && !empty($user)){
            return $user['buyer_id'];
        }else{
            return null;
        }
    }
}
