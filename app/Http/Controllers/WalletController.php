<?php

namespace App\Http\Controllers;

use App\Http\Traits\Tree;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Level;
use App\Models\WalletComission;
use App\Models\Bonus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;


class WalletController extends Controller
{
    use Tree;

    public function bonoCartera(){
        $usuarios = User::where('status', '1')->orderBy('id', 'desc')->get();

        try{
            DB::beginTransaction();
            //Sumo los valores que tiene el usuario en su wallet
            foreach ($usuarios as $usuario){
                $users = $this->getChildrens($usuario, new Collection, 1)->where('nivel', 1);
                foreach($users as $user){
                    if(isset($user->inversiones)){
                        foreach($user->inversiones->where('status', 1) as $inversion){
                            dump('inversion encontrada');
                            dump($inversion);

                            $wallet = WalletComission::create([
                                'user_id'=> $usuario->id,
                                'referred_id' => $inversion->user_id,
                                'amount' => $inversion->capital * 0.01,
                                'amount_fondo' => $inversion->capital * 0.01,
                                'descripcion' => 'Bono Cartera',
                                'type' => 2,
                            ]);
                            dump('wallet registrada');
                            dump($wallet);
                        }
                    }
                }

            }

            DB::commit();

        }catch(\Throwable $th) {
            DB::rollback();
            Log::error('WalletController - bonoCartera -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }
    /**
     * Permite obtener el total disponible en comisiones
     *
     * @param integer $user_id
     * @return float
     */
    public function getTotalComision($user_id): float
    {
        try {
            $wallet = WalletComission::where([['user_id', '=', $user_id], ['status', '=', 0]])->get()->sum('amount');
            if ($user_id == 1) {
                $wallet = WalletComission::where([['status', '=', 0]])->get()->sum('amount');
            }
            return $wallet;
        } catch (\Throwable $th) {
            Log::error('Wallet - getTotalComision -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Permite el listado de comisiones
     *
     * @param integer $user_id
     * @return float
     */
    public function comisiones(Request $request)
    {
        $user = auth()->user();

        $user_id = null;
        
        $buyer_id = null;

        $user_name = null;

        $buyer_name = null;

        $comission_type = null;

        $comission_status = null;

        $date_from = null;

        $date_to = null;

        if($request->isMethod('post') && $user->admin == 1)
        {
            $query = WalletComission::with(['user', 'buyer'])->orderBy('id', 'desc');

            $user_id = $request->user_id;

            $user_name = $request->user_name;  

            $buyer_name = $request->buyer_name;   
            
            $buyer_id = $request->buyer_id;

            $comission_type = $request->comission_type;

            $comission_status = $request->comission_status;

            $date_from = $request->date_from;

            $date_to = $request->date_to;

            if($request->has('user_id') && $request->user_id !== null) 
            {
                $query->orWhere('user_id', $user_id);
            }
            
            if($request->has('buyer_id') && $request->buyer_id !== null)
            {
                $query->orWhere('buyer_id', $buyer_id);
            }

            if($request->has('user_name') && $request->user_name !== null) 
            {
                $query->whereHas('user', function($q) use($user_name){
                    $q->where('name', 'LIKE', "%{$user_name}%");
                });
            }

            if($request->has('buyer_name') && $request->buyer_name !== null)
            {
                $query->whereHas('buyer', function($q) use($buyer_name){
                    $q->where('name', 'LIKE', "%{$buyer_name}%");
                });
            }

            if($request->has('comission_type') && $request->comission_type !== null)
            {
                $query->orWhere('type', $comission_type);
            }

            if($request->has('comission_status') && $request->comission_status !== null)
            {
                $query->orWhere('status', $comission_status);
            }

            if($request->has('date_from') && $request->date_from !== null && $request->has('date_to') && $request->date_to != null)
            {
                $query->whereDate('created_at', '>=', $date_from)
                      ->whereDate('created_at', '<=', $date_to);
            }

            $wallets = $query->get();

            return view('reports.comision', compact('wallets','user_id','user_name', 'buyer_name', 'buyer_id', 'comission_type', 'comission_status', 'date_from', 'date_to'));
        }

        if($user->admin == 1){
            $wallets = WalletComission::with('user')->orderBy('id', 'desc')->get();
        } else {
            $wallets = WalletComission::where([['user_id', '=', $user->id]])->with('user')->orderBy('id', 'desc')->get();
        }
        return view('reports.comision', compact('wallets','user_id', 'user_name', 'buyer_name', 'buyer_id', 'comission_type', 'comission_status', 'date_from', 'date_to'));
    }

    public function walletOption(Request $request)
    {

        $data = $request->validate([
           'option' => 'required',
           'wallet' => 'required'
        ]);

        $wallet = WalletComission::where('id', '=', $data['wallet'])->first();

        $wallet->option = $data['option'];

        $wallet->save();

     return back()->with('success', 'la wallet a sido actualizada con Exito');
    }

    public function edit(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        if(Hash::check($request->password, $user->password)){

            $validate = $request->validate([
                'code_security' => 'required|min:6|max:6',
                'code_security_confirm' => 'required|min:6|max:6'
            ]);

            if ($request->code_security != $request->code_security_confirm){

                return redirect()->back()->with('danger', 'El código pin ingresado no coincide');
            }else{
                $user->code_security = $request->code_security;
                $user->save();
                return back()->with('success', 'Perfil actualizado exitosamente');
            }

        }else{
            return redirect()->back()->with('danger', 'la contraseña no coincide.');
        }

    }

    public function CodigoWallet3Min():bool
    {
        $wallet = WalletComission::where('user_id', Auth::id())->first();
        $result = false;
        $fechaActual = Carbon::now();
        $fechaCodeCorreo = new Carbon($wallet->code_security);
        if ($fechaCodeCorreo->diffInMinutes($fechaActual) >= 3) {
            $this->CancelEdit($wallet->id, 'Tiempo limite de codigo sobrepasado');
            $result = true;
        }

        return $result;
    }

    public function bonosView(Request $request)
    {

        $user=Auth::user();
        $level = Level::where('status', 1)->get();
        return view('configurations.bonos', compact('user','level'));
    }

    public function getLevels(Request $request)
    {

    }

    public function bonosSettings(Request $request){

        $request->validate([
            'porcentage_bono' => 'required',
            'level' => 'required',
            'bono' => 'required',
        ]);

        $percentage=$request->porcentage_bono/100;
        $level=$request->level;
        $type=$request->bono;
        try {
            //actualizar
            Bonus::where('type',$type)->where('level',$level)->update([
                'percentage'=>$percentage
            ]);
                // dd($bonus) ;
            return redirect()->back()->with('success', 'Se han modificado los valores.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Verifique los datos');
        }

    }

    public function AvaliableBonus()
    {
        $date_now = Carbon::now()->format('d');

       if($date_now >= 01 && $date_now <= 07 ){

        $bonus = DB::table('wallets_commissions')
            ->where('type', 1)
            ->where('status', 0)
            ->update(['avaliable_withdraw' => 1]);
       }else{
            $bonus = DB::table('wallets_commissions')
            ->where('type', 1)
            ->where('status', 0)
            ->update(['avaliable_withdraw' => 0]);
       }

    }

    public function transferMlm(Request $request)
    {
        //dd($request);
        $user = Auth::user();

        if($request->amount > 0){
           $wallet = new WalletComission();
           $wallet->user_id = $user->id;
           $wallet->level = 0;
           $wallet->description = 'transferencia a general';
           $wallet->amount = $request->amount;
           $wallet->amount_available = $request->amount;
           $wallet->type = 3;
           $wallet->status = 0;
           $wallet->save();
           WalletComission::where([['user_id', $user->id],['type', 5],['status', 0]])->update([
                'status' => '1',
                'transfer_id' => $wallet->id
           ]);
            return back()->with('success', 'transferencia creada con exito');
        }

        return back()->with('error' , 'tu saldo tiene que ser mayor a 0');
    }
    public function transferLicencias(Request $request)
    {
        //dd($request);
        $user = Auth::user();

        if($request->amount > 0){
           $wallet = new WalletComission();
           $wallet->user_id = $user->id;
           $wallet->level = 0;
           $wallet->description = 'transferencia a general';
           $wallet->amount = $request->amount;
           $wallet->amount_available = $request->amount;
           $wallet->type = 3;
           $wallet->status = 0;
           $wallet->save();
           WalletComission::where([['user_id', $user->id],['type', 2],['status', 0]])->update([
                'status' => '1',
                'transfer_id' => $wallet->id
           ]);
            return back()->with('success', 'transferencia creada con exito');
        }

        return back()->with('error' , 'tu saldo tiene que ser mayor a 0');
    }

}
