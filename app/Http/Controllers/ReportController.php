<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\Liquidation;
use App\Models\ManualBonusLog;
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
    public function manualBonusHistory(Request $request)
    {
        $user_name = null;
        $author_name = null;
        $date_from = null;
        $date_to = null;
        $actions = [];

        if($request->isMethod('post'))
        {
            $query = ManualBonusLog::with(['user','author']);

            if($request->has('user_name') && $request->user_name !== null)
            {
                $user_name = $request->user_name;

                $query->whereHas('user', function($q) use($user_name){
                    $q->where('name', $user_name);
                });
            }

            if($request->has('author_name') && $request->author_name !== null)
            {
                $author_name = $request->author_name;

                $query->whereHas('author', function($q) use($author_name){
                    $q->where('name', $author_name);
                });
            }
            
            if($request->has('actions') && $request->actions !== null)
            {
                $actions = $request->actions;

                foreach($actions as $key => $action)
                {
                    if($key == 0) {
                        $query->where('action', 'LIKE', "%$action%");
                    } else {
                        $query->orWhere('action', 'LIKE', "%$action%");
                    }
                }

            }

            if($request->has('date_from') && $request->date_from !== null && $request->has('date_to') && $request->date_to != null)
            {
                $date_from = $request->date_from;

                $date_to = $request->date_to;

                $query->whereDate('created_at', '>=', $date_from)
                      ->whereDate('created_at', '<=', $date_to);
            }

            $history = $query->get();

            return view('reports.manualBonusHistory', compact('history', 'user_name', 'author_name', 'date_from','date_to', 'actions'));

        }



        $history = ManualBonusLog::with(['user','author'])->get();

        return view('reports.manualBonusHistory', compact('history', 'user_name', 'author_name', 'date_from','date_to', 'actions'));
    }

    public function cron()
    {
        //$date = new Carbon('yesterday');
        $hoy =  Carbon::now()->toDateTimeString();
        $orden = OrdenPurchase::where([['status', 2],['created_at', '<', $hoy]])->delete();
        //$orden->delete();
        return "listo";
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
}
