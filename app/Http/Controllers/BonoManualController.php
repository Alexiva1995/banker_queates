<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BonoManualController extends Controller
{
    public function index(){
        $usuarios = User::all();

        foreach($usuarios as $user){
           $user->saldo_disponible = $user->getWallet->sum('amount_available');
        }

        return view('bonoManual.index' , compact('usuarios'));
    }
}
