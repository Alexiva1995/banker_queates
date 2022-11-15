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
    //
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
    public function comisiones()
    {
        $user = auth()->user();
        if($user->admin == 1){
            $wallets = WalletComission::with('user')->orderBy('id', 'desc')->get();
        } else {
            $wallets = WalletComission::where([['user_id', '=', $user->id],['type', '=', 0]])->with('user')->orderBy('id', 'desc')->get();
        }
        return view('reports.comision', compact('wallets'));
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
           return  $walletMlm =  WalletComission::where([['user_id', $user->id],['type', 0],['status', 0]])->get();
        }

        return back()->with('error' , 'tu saldo tiene que ser mayor a 0');
    }


}
