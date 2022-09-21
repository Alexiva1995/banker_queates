<?php

namespace App\Http\Controllers;

use App\Models\Countrie;
use App\Models\Preregister;
use App\Models\WalletAdmin;
use App\Models\OrdenPurchase;
use App\Services\FutswapService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PreregisterController extends Controller
{

    public function __construct(FutswapService $futswapService = null)
    {
        $this->futswap = $futswapService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countrie = Countrie::all();
        $data = WalletAdmin::first();

        return view('auth.preregister', compact('countrie', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:preregisters'],
            'phone' => ['required', 'numeric',],
            'countrie' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($request->type_payment == 'direct') {
            $request->validate([
                'comprobante' => ['required'],
                'hash' => ['required']
            ]);
        }
        $orden = new OrdenPurchase();
        $orden->amount = $request->amount;
        $orden->hash = $request->hash;
        $orden->status = '0';
        $orden->type = 'preregistro';
        $orden->save();

        if ($request->type_payment == 'direct') {
            $image = $request->file('comprobante');
            $name = time() . "." . $image->extension();
            $image->move(public_path('storage') . '/comprobantes', $name);
            $orden->image = '' . $name;
            $orden->save();
        }
        
        $pre = new Preregister();
        $pre->name = $request->name;
        $pre->email = $request->email;
        $pre->phone = $request->phone;
        $pre->countrie_id = $request->countrie;
        $pre->password = $request->password;
        $pre->orden_purchase_id = $orden->id;
        $pre->save();

       /*  Mail::send('mails.Preregister',[
            'data' => $pre,  
            'logo' => public_path('/images').'/login/connect.png'
        ], function ($msj) use ($request){
            $msj->subject('Pre Register exitoso');
            $msj->to($request->email);
        }); */

        if ($request->type_payment == 'futswap') {
            $response = $this->futswap->createOrden($pre, intval($orden->amount), $orden->id);

            if($response[0] != 'error')
            {
                //redirecciona a la url del pago
                return redirect($response);
            }else{
                //esta esto porque no se muestran las alertas, no sé porque.
                return 'error';
                return back()->with( 'error', $response[1] );
            }
        }

        /*  mail::send('mails.Preregister',['data' => $data], function ($msj){
             $msj->subject('Nuevo usuario registrado');
             $msj->to('info@terramember.club');
         }); */

        return redirect()->route('landing')->with(['success', 'Su Pre-Registro Fue Enviado Satisfactoriamente.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}