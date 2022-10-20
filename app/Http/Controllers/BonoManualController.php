<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BonoManualController extends Controller
{
    public function index(){
        return view('bonoManual.index');
    }
}
