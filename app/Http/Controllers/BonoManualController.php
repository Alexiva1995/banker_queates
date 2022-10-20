<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BonoManualController extends Controller
{
    public function index(){
        $usuarios = User::all();
        return view('bonoManual.index' , compact('usuarios'));
    }
}
