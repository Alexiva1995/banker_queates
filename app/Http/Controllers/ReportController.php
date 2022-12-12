<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\Liquidation;
use App\Models\OrdenPurchase;
use App\Models\Order;
use App\Models\Utility;
use App\Models\WalletComission;
use Carbon\Carbon;
use Illuminate\Http\Request;


class ReportController extends Controller
{

    public function ordenes(Request $request)
    {
        $user = auth()->user();

        $user_name = null;

        $id_tx = null;

        $order_status = [];

        $created_from = null;

        $created_to = null;

        $updated_from = null;

        $updated_to = null;

        if($request->isMethod('post') && $user->admin == 1)
        {

            $query = Order::with(['user']);

            if($request->has('user_name') && $request->user_name !== null) 
            {
                $user_name = $request->user_name;

                $query->whereHas('user', function($q) use($user_name){
                    $q->where('email', $user_name);
                });
            }

            if($request->has('id_tx') && $request->id_tx !== null) 
            {
                $id_tx = $request->id_tx;

                $query->where('id', $id_tx);
            }

            if($request->has('order_status') && $request->order_status !== null)
            {

                $order_status = $request->order_status;

                foreach($order_status as $key => $status)
                {
                    if($key == 0) {
                        $query->where('status', $status);
                    } else {
                        $query->orWhere('status', $status);
                    }
                }

            }

            if($request->has('created_from') && $request->created_from !== null && $request->has('created_to') && $request->created_to != null)
            {
                $created_from = $request->created_from;

                $created_to = $request->created_to;

                $query->whereDate('created_at', '>=', $created_from)
                      ->whereDate('created_at', '<=', $created_to);
            }

            if($request->has('updated_from') && $request->updated_from !== null && $request->has('updated_to') && $request->updated_to != null)
            {
                $updated_from = $request->updated_from;

                $updated_to = $request->updated_to;

                $query->whereDate('created_at', '>=', $updated_from)
                      ->whereDate('created_at', '<=', $updated_to);
            }

            $ordenes = $query->orderBy('id', 'desc')->get();

            return view('reports.index', compact('ordenes','user_name', 'id_tx', 'order_status', 'created_from', 'created_to', 'updated_from', 'updated_to'));

        }

        if($user->admin == 1){
            $ordenes = Order::orderBy('id', 'desc')->with('user')->get();
        }else{
            $ordenes = Order::where('user_id', $user->id)->with('user')->orderBy('id', 'desc')->get();
        }

        return view('reports.index', compact('ordenes','user_name', 'id_tx', 'order_status', 'created_from', 'created_to', 'updated_from', 'updated_to'));
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
    public function withdraw(Request $request)
    {
        $user = auth()->user();

        $user_id = null;

        $user_name = null;

        $liquidation_status = [];

        $hash = null;

        $request_date_from = null;
        
        $request_date_to = null;

        $payment_date_from = null;
        
        $payment_date_to = null;

        if($request->isMethod('post') && $user->admin == 1)
        {

            $query = Liquidation::with(['user']);

            if($request->has('user_id') && $request->user_id !== null) 
            {
                $user_id = $request->user_id;

                $query->where('user_id', $user_id);
            }

            if($request->has('user_name') && $request->user_name !== null) 
            {
                $user_name = $request->user_name; 
                $query->whereHas('user', function($q) use($user_name){
                    $q->where('name', $user_name);
                });
            }

            if($request->has('buyer_name') && $request->buyer_name !== null)
            {
                $query->whereHas('buyer', function($q) use($buyer_name){
                    $q->where('name', $buyer_name);
                });
            }

            if($request->has('liquidation_status') && $request->liquidation_status !== null)
            {
                $liquidation_status = $request->liquidation_status;

                foreach($liquidation_status as $key => $status)
                {
                    if($key == 0) {
                        $query->where('status', $status);
                    } else {
                        $query->orWhere('status', $status);
                    }
                }

            }

            if($request->has('hash') && $request->hash !== null) 
            {
                $hash = $request->hash;
                $query->where('hash', $hash);
            }

            if($request->has('request_date_from') && $request->request_date_from !== null && $request->has('request_date_to') && $request->request_date_to != null)
            {
                $request_date_from = $request->request_date_from;

                $request_date_to = $request->request_date_to;

                $query->whereDate('created_at', '>=', $request_date_from)
                      ->whereDate('created_at', '<=', $request_date_to);
            }

            if($request->has('payment_date_from') && $request->payment_date_from !== null && $request->has('payment_date_to') && $request->payment_date_to != null)
            {
                $payment_date_from = $request->payment_date_from;
            
                $payment_date_to = $request->payment_date_to;

                $query->whereDate('updated_at', '>=', $payment_date_from)
                      ->whereDate('updated_at', '<=', $payment_date_to);
            }

            $liquidactions = $query->orderBy('id', 'desc')->get();

            return view('reports.withdraw', compact('liquidactions', 'user_id', 'user_name', 'liquidation_status', 'hash', 'request_date_from', 'request_date_to', 'payment_date_from', 'payment_date_to'));
        }
        
        if($user->admin == 1){
            $liquidactions = Liquidation::with('user')->orderBy('id', 'desc')->get();
        } else {
            $liquidactions = Liquidation::where('user_id', $user->id)->with('user')->orderBy('id', 'desc')->get();
        }
        return view('reports.withdraw', compact('liquidactions', 'user_id', 'user_name', 'liquidation_status', 'hash', 'request_date_from', 'request_date_to', 'payment_date_from', 'payment_date_to'));
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
