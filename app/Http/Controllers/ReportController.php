<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\Liquidation;
use App\Models\OrdenPurchase;
use App\Models\Order;
use App\Models\Utility;
use App\Models\WalletComission;
use Carbon\Carbon;


class ReportController extends Controller
{

    public function ordenes()
    {
        $user = auth()->user();
        if($user->admin == 1){
            $ordenes = Order::orderBy('id', 'desc')->with('coinpaymentTransaccion')->get();

        }else{
            $ordenes = Order::where('user_id', $user->id)->with('coinpaymentTransaccion')->orderBy('id', 'desc')->get();

        }

        return view('reports.index', compact('ordenes'));
    }
    public function utility()
    {
        $user = auth()->user();
        if($user->admin == 1){
            $utilities = Utility::orderBy('id', 'desc')->get();

        }else{
            $utilities = Utility::where('user_id', $user->id)->orderBy('id', 'desc')->get();
        }

        return view('reports.utilities', compact('utilities'));
    }

    public function cron()
    {
        //$date = new Carbon('yesterday');
        $hoy =  Carbon::now()->toDateTimeString();
        $orden = OrdenPurchase::where([['status', 2],['created_at', '<', $hoy]])->delete();
        //$orden->delete();
        return "listo";
    }

    public function anuales()
    {
        $ordenes = OrdenPurchase::where([['status', '!=', '2'],['type', 'anual']])->get();

        return view('reports.anuales', compact('ordenes'));
    }
    public function withdraw()
    {
        $user = auth()->user();
        if($user->admin == 1){
            $liquidactions = Liquidation::with('user')->orderBy('id', 'desc')->get();
        } else {
            $liquidactions = Liquidation::where('user_id', $user->id)->with('user')->orderBy('id', 'desc')->get();
        }
        return view('reports.withdraw', compact('liquidactions'));
    }
    public function cashflow()
    {
        //Todos los depositos
        $allDeposits = Investment::get();
        $totalDeposits = $allDeposits->count();
        $amountDeposits = $allDeposits->sum('invested');
        //Todos los depositos de tipo Bronce
        $broncePackages = Investment::where('type', 1)->get();
        $totalBroncePackages = $broncePackages->count();
        $amountBroncePackages = $broncePackages->sum('invested');
        //Todos los depositos de tipo Plata
        $plataPackages = Investment::where('type', 2)->get();
        $totalPlataPackages = $plataPackages->count();
        $amountPlataPackages = $plataPackages->sum('invested');
        //Todos los depositos de tipo Oro
        $oroPackages = Investment::where('type', 3)->get();
        $totalOroPackages = $oroPackages->count();
        $amountOroPackages = $oroPackages->sum('invested');
        //Todos los depositos de tipo Platino
        $PlatinoPackages = Investment::where('type', 4)->get();
        $totalPlatinoPackages = $PlatinoPackages->count();
        $amountPlatinoPackages = $PlatinoPackages->sum('invested');
        //Comisiones Generadas
        $comisions = WalletComission::get();
        $totalComisions = $comisions->sum('amount');
        //Liquidaciones realizadas
        $liquidactions = Liquidation::where('status', '1')->get();
        $totalLiquidactions = $liquidactions->count();
        $amountLiquidactions = $liquidactions->sum('amount_net');
        $feedLiquidactions = $liquidactions->sum('amount_fee');
        //Rentabilidad Generada
        $rentability = Utility::all();
        $amountRentability = $rentability->sum('amount');
        return view('reports.cashflow', compact('totalDeposits','amountDeposits',
        'totalBroncePackages', 'amountBroncePackages', 'totalPlataPackages',
        'amountPlataPackages', 'amountPlataPackages', 'totalOroPackages', 'amountOroPackages', 'totalPlatinoPackages',
        'amountPlatinoPackages', 'totalComisions', 'totalLiquidactions', 'amountLiquidactions', 'feedLiquidactions',
        'amountRentability'));
    }
}
