<?php 

namespace App\Http\Controllers;

use App\Models\Formulary;
use App\Models\OrdenPurchase;
use App\Models\AlertNotification;
use App\Models\User;
use App\Models\AlertFormularie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\Member;
use Illuminate\Database\Eloquent\Collection;
use Yajra\DataTables\DataTables;

class FormularyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $formularys = Formulary::get();
        if($request->type == 1){
           
            $notiAccoun = AlertFormularie::where([['member', $request->paquete],['status', '0'],['type', 'irv_forex']])->count();

            if($notiAccoun == 0) {
                $package = Formulary::where([['type', 'irv_forex'],['package', $request->paquete]])->get();
                $numero = Formulary::where([['type', 'irv_forex'],['package', $request->paquete]])->count();
              
                if($numero == 0){
                    $amount = $request->paquete;
                    $type = 'irv_forex';
                    return view('subadmin..package', compact('formularys','package', 'type', 'amount'));
                }else{
                    $amount = $request->paquete;
                    $type = 'irv_forex';
                    return view('subadmin..package', compact('formularys','package', 'type', 'amount'));
                }
            }else{
                 //dd($notify);
                $nootify = DB::table('alert_formularies')->where([['member', $request->paquete],['status', '0'],['type', 'irv_forex']])->update(['status' => '1']);
              
               
                $package = Formulary::where([['type', 'irv_forex'],['package', $request->paquete]])->get();
                $numero = Formulary::where([['type', 'irv_forex'],['package', $request->paquete]])->count();
              
                if($numero == 0){
                    $amount = $request->paquete;
                    $type = 'irv_forex';
                    return view('subadmin..package', compact('formularys','package', 'type', 'amount'));
                }else{
                    $amount = $request->paquete;
                    $type = 'irv_forex';
                    return view('subadmin..package', compact('formularys','package', 'type', 'amount'));
                }
            }

           
        
        }elseif($request->type == 2){
            
            $notiAccoun = AlertFormularie::where([['member', $request->paquete],['status', '0'],['type', 'irv_indices_sinteticos']])->count();
            
            if($notiAccoun == 0) {
                $package = Formulary::where([['type', 'irv_indices_sinteticos'],['package', $request->paquete]])->get();
                $numero = Formulary::where([['type', 'irv_indices_sinteticos'],['package', $request->paquete]])->count();

                if($numero == 0){
                    $amount = $request->paquete;
                    $type = 'irv_indices_sinteticos';
                    return view('subadmin..package', compact('formularys','package', 'type', 'amount'));
                }else{
                    $amount = $request->paquete;
                    $type = $package[0]['type'];
                    return view('subadmin..package', compact('formularys','package', 'type', 'amount'));
                }
            }else{
                $nootify = DB::table('alert_formularies')->where([['member', $request->paquete],['status', '0'],['type', 'irv_indices_sinteticos']])->update(['status' => '1']);
                  $package = Formulary::where([['type', 'irv_indices_sinteticos'],['package', $request->paquete]])->get();
                $numero = Formulary::where([['type', 'irv_indices_sinteticos'],['package', $request->paquete]])->count();

                if($numero == 0){
                    $amount = $request->paquete;
                    $type = 'irv_indices_sinteticos';
                    return view('subadmin..package', compact('formularys','package', 'type', 'amount'));
                }else{
                    $amount = $request->paquete;
                    $type = $package[0]['type'];
                    return view('subadmin..package', compact('formularys', 'package', 'type', 'amount'));
                } 
            }

        }elseif($request->type == 3){
            $notiAccoun = AlertFormularie::where([['member', $request->paquete],['status', '0'],['type', 'cryptos']])->count();
            if($notiAccoun == 0) {
          
                $package = Formulary::where([['type', 'cryptos'],['package', $request->paquete]])->get();
                $numero = Formulary::where([['type', 'cryptos'],['package', $request->paquete]])->count();
                  
                if($numero == 0){

                    $amount = $request->paquete;
                    $type = 'cryptos';
                    return view('subadmin..package', compact('formularys','package', 'type', 'amount'));
                   
                }else{
                    $amount = $request->paquete;
                    $type = $package[0]['type'];
                    return view('subadmin..package', compact('formularys','package', 'type', 'amount'));
                }
            }else{
                $nootify = DB::table('alert_formularies')->where([['member', $request->paquete],['status', '0'],['type', 'cryptos']])->update(['status' => '1']);
                $package = Formulary::where([['type', 'cryptos'],['package', $request->paquete]])->get();
                $numero = Formulary::where([['type', 'cryptos'],['package', $request->paquete]])->count();
                  
                if($numero == 0){

                    $amount = $request->paquete;
                    $type = 'cryptos';
                    return view('subadmin..package', compact('formularys','package', 'type', 'amount'));
                   
                }else{
                    $amount = $request->paquete;
                    $type = $package[0]['type'];
                    return view('subadmin..package', compact('formularys','package', 'type', 'amount'));
                }
            }
        } 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dataTablePackages(Request $request)
    {
        $formularys = Formulary::all(); 
        
        $ordenes = new Collection();
        foreach ($formularys as $formulary){
            if ($formulary->type != 'irv_indices_sinteticos') {
                $object = new \stdClass();
                $object->id = $formulary->id; 
                $object->username = $formulary->user->name;
                $object->useremail = $formulary->user->email;
                $object->package = $formulary->package;
                $object->type = $this->typeFormulary($formulary);
                $object->date = $formulary->created_at->format('d-m-Y');
                $object->status = $this->statusFormulary($formulary);
                $ordenes->push($object);
            }
        }
        return DataTables::of($ordenes)->toJson();
            // if(request()->has('order_by_for') && request('order_by_for') == '0'){
            //     $formularys->orderBy('id', 'desc');
            // }
            // if(request()->has('order_by_for') && request('order_by_for') == '1'){
            //     $formularys->orderBy('id', 'desc');
            // }
            // if(request()->has('order_by_for') && request('order_by_for') == '4'){
            //     $formularys->orderBy('id', 'desc');
            // }
        
    }
    public function typeFormulary($formulary) {
        if ($formulary->type == 'irv_forex') {
            $formulary->type = 'Forex';
        }
        if ($formulary->type == 'irv_indices_sinteticos') {
            $formulary->type = 'Sinteticos';
        }
        if ($formulary->type == 'cryptos') {
            $formulary->type = 'Cryptos';
        }
        return $formulary->type;
    }
    public function statusFormulary($formulary) {
        if ($formulary->status == 0) {
            $formulary->status = 'Por Instalar';
        }
        if ($formulary->status == 1) {
            $formulary->status = 'Instalado';
        }
        if ($formulary->status == 4) {
            $formulary->status = 'Rechazado';
        }
        return $formulary->status;
    }
    public function create(Request $request)
    {
        $orderId = $request->orderId;
        $order = OrdenPurchase::where('id', $request->orderId)->with('membershipPackage')->first();
        // $monto = $order->amount;
        $monto = $order->membershipPackage->amount_per_month;
        // asi obtienes el status $request->status
        return view('business.formulary', compact('orderId', 'monto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 

       $validate = $request->validate([
         'namebroker' => 'required',
         'serverBroker' => 'required',
         'numberAccount' => 'required',
         'paquete' => 'required',
         'passReal' => 'required',
        // 'passInversor' => 'required',
         'currency' => 'required',
         'plataform' => 'required',
         'amount' => 'required',
         'comprobante' => 'required',
         'type' => 'required'
        ]);

        $memberId = null;
        $memberShips = Member::where([['referred_id', Auth::id()], ["status", "activo"]])->with("ordenes")->get();
        foreach ($memberShips as $memberShip){
            $memberOrden = $memberShip->ordenes;
            if ($memberOrden->type == $request->type && $memberOrden->membershipPackage->amount_per_month == $request->paquete){
                $memberId = $memberShip->id;
            }
        }
        $formulary = new Formulary();
        $formulary->user_id  = Auth::user()->id;
        $formulary->member_id = $memberId;
        $formulary->broker_name = $request->namebroker;
        $formulary->broker_server = $request->serverBroker;
        $formulary->number_account = $request->numberAccount;
        $formulary->password_real =  $request->passReal;
       // $formulary->password_inversior = 'null';
        $formulary->package = $request->paquete;
       // $formulary->password_inversior = Crypt::encryptString( $request->passInversor );
        $formulary->currency  = $request->currency;
        $formulary->plataform = $request->plataform;
        $formulary->amount  = $request->amount;
        $formulary->comprobant  = $request->comprobante;
        $formulary->status = '0';
        $formulary->type = $request->type ;
        
        //Guardamos comprobante
        $comprobant = $request->file('comprobante');
        $name = time() . "." . $comprobant->extension();
        $comprobant->move(public_path('storage') . '/comprobante-formulario/', $name);
        $formulary->comprobant = '' . $name;
        $formulary->save();

        $notify = new AlertFormularie();
        $notify->formulary_id = $formulary->id;
        $notify->type = $request->type;
        $notify->status = '0';
        $notify->member = $request->paquete;   
        $notify->save();

        $user = Auth::user();
        Mail::send('mails.formulary.welcome',[
            'data' => $user,  
            'logo' => public_path('/images').'/login/connect.png'
        ], function ($msj) use ($user){
            $msj->subject('Felicidades');
            $msj->to($user->email);
        });
        $order = OrdenPurchase::where('id', $request->orderId)->first();
        $alert = AlertNotification::where('orden_purchase_id', $order->id)->first();
        $alert->status = '0';
        $alert->update();

        

        
        return redirect()->route('dashboard.index')->with('success', 'Felicitaciones, tu formulario se recibio con exito.  recuerda que el proceso de instalacion durara aproximadamente 2 dias hábiles para ser efectuado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Formulary  $formulary
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $package = Formulary::where('id', '=', $id)->first();
        $amount = $package->amount;
        $type = $package['type'];

        return view('subadmin.details', compact('package', 'type', 'amount'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Formulary  $formulary
     * @return \Illuminate\Http\Response
     */
    public function edit(Formulary $formulary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     **
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Formulary  $formulary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Formulary $formulary)
    {
        $formulary = Formulary::where('id', $request->formulary)->first();
        $formulary->update(['status' => $request->status]);
        $user = User::where('id', $formulary->user_id)->first();
        $member = $formulary->getMember;
         
        if($request->status == 1){
           
            Mail::send('mails.formulary.instalado',[
                'data' => $user,  
                'logo' => public_path('/images').'/login/connect.png'
            ], function ($msj) use ($user){
                $msj->subject('Formulario instalado con exito');
                $msj->to($user->email);
            });
            $member->status = 'activo';
            $member->start_date = now();
            $member->end_date = now()->addMonth();
            $member->update();
            return redirect()->back()->with('success', 'Formulario Actualizado con Exito');
        }elseif($request->status == 2){
            
            Mail::send('mails.formulary.desinstalar',[
            'data' => $user,  
            'logo' => public_path('/images').'/login/connect.png'
            ], function ($msj) use ($user){
                $msj->subject('Formulario desinstalado');
                $msj->to($user->email);
            });
            return redirect()->back()->with('success', 'Formulario Actualizado con Exito');
        }elseif($request->status == 3){
            
            Mail::send('mails.formulary.upgrade',[
            'data' => $user,  
            'logo' => public_path('/images').'/login/connect.png'
            ], function ($msj) use ($user){
                $msj->subject('Formulario su upgrade fue exitoso');
                $msj->to($user->email);
            });
            return redirect()->back()->with('success', 'Formulario Actualizado con Exito');
        }elseif($request->status == 4){
            
           Mail::send('mails.formulary.rechazado',[
            'data' => $user,  
            'logo' => public_path('/images').'/login/connect.png'
            ], function ($msj) use ($user){
                $msj->subject('Formulario Rechadazo');
                $msj->to($user->email);
            });
            $member->ordenes->alertNotification->status = 1;
            $member->ordenes->alertNotification->update();
            
            return redirect()->back()->with('success', 'Formulario Actualizado con Exito');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Formulary  $formulary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Formulary $formulary)
    {
        //
    }

    public function formulario()
    {
        $user = Auth::user();
        $formulario = formulary::where([['user_id', $user->id],['status', '4']])->first();

        return view('subadmin.update',compact('formulario'));
    }

     public function reset(Request $request)
    {
        $user = Auth::user();
        $validate = $request->validate([
         'broker_name' => 'required',
         'broker_server' => 'required',
         'number_account' => 'required',
         'currency' => 'required',
         'plataform' => 'required',
         'password_real' => 'required',
         'comprobant' => 'required',
         'amount' => 'required',
         'comprobant' => 'required',
         'type' => 'required'
        ]);
       
        $formulario = Formulary::where('id', $request->formulario_id)->first();
        $formulario->update($request->all());
        $comprobant = $request->file('comprobant');
        $name = time() . "." . $comprobant->extension();
        $comprobant->move(public_path('storage') . '/comprobante-formulario/', $name);
        $formulario->comprobant = '' . $name;
        $formulario->save();
        
        //cambiamos el status del alert 
        $alertNotification = AlertNotification::where('orden_purchase_id', $formulario->getMember->orden_purchase_id)->first();
        $alertNotification->update([
            'status' => '0'
           ]);
        $alert = AlertFormularie::where('formulary_id', $request->formulario_id)->first();
        $alert->update([
         'status' => '0'
        ]);

        Mail::send('mails.formulary.reset',[
            'data' => $user,  
            'logo' => public_path('/images').'/login/connect.png'
        ], function ($msj) use ($user){
            $msj->subject('Felicidades');
            $msj->to($user->email);
        });
       
        return redirect()->route('dashboard.index')->with('success', 'Felicitaciones, tu formulario se a actualizado con exito.  recuerda que el proceso de instalacion durara aproximadamente 48 horas para ser efectuado.');
    }
}