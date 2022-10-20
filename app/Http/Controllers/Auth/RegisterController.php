<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TreController;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\WalletComission;
use App\Models\Prefix;
use App\Services\FutswapService;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $error = null;
    protected $treController;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(FutswapService $futswapService = null, TreController $treController)
    {
        $this->middleware('guest');
        $this->futswap = $futswapService;
        $this->treController = $treController;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $request)
    {

        $data=Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|confirmed|unique:users',
            'username' => 'required|string|max:10|alpha_dash|unique:users,username',
            'password' => 'required|string|min:8|confirmed',
            'countrie_id' => 'required',
            'buyer_id' => 'nullable|exists:users,id',
        ], $messages=['buyer_id.exists' => 'El usuario referido no existe.',]);
        if ($data->fails())
        {
            return redirect()->back()->withInput()->withErrors($data->errors());
        }
        return $data;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(Request $request)
    {   
        // dd(intval($request['buyer_id']));
        $this->Validator($request);
        $binary_side = '';
        $binary_id = 0;
        if (isset($request->buyer_id)) {
            $userR = User::findOrFail($request['buyer_id']);
            $binary_id = $this->treController->getPosition(intval($request['buyer_id']),$request['binary'], $request['binary']);

            $binary_side = $request['binary'];
        }

        //$this->validate($request, ['recaptcha_token' => ['required', new   ReCaptchaRule($request->recaptcha_token)]]);
        $userName = explode(' ', $request->name, 3);

        if( count($userName) > 2){
            $name=$userName[0].' '.$userName[1];
            $lastname=$userName[2];
        } else if( count($userName) < 2){
            $name=$userName[0];
            $lastname=null;
        } else{
            $name=$userName[0];
            $lastname=$userName[1];
        }
        try {
            $user = User::create([
                'username' => $request->username,
                'name' => $name,
                'binary_id' => $binary_id,
                'binary_side' => $binary_side,
                'last_name' => $lastname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'buyer_id' => $request->buyer_id ?? 1,
                'countrie_id' => $request->countrie_id,
                'status' => '0',
            ]);
            // $dataEmail = [
            //     'user' => $user,
            //   ];
            // Mail::send('mail.VerificationEmail',  ['data' => $dataEmail,  'logo' => public_path('/images') . '/logo/projecas.png',], function ($msj) use ($user)
            // {
            //     $msj->subject('Verificación de correo electrónico.');
            //     $msj->to($user->email);
            // });
            // return redirect()->route('login')->with('success', 'Se ha enviado un correo de Verificación a su email');
            // return redirect()->route('dashboard.index')->with('success', 'Se ha enviado un correo de Verificación a su email');
            return redirect()->route('auth.verify', $user);
            // return $user;

        } catch (\Throwable $th) {
            return back()->with('error', 'Hubo un error, verifica tus datos.');
        }

        // $orden = new OrdenPurchase();
        // $orden->user_id = $user->id;
        // $orden->amount = $data['amount'];
        // $orden->hash = $request['hash'];
        // $orden->status = '0';
        // $orden->type = 'anual';
        // $orden->save();

        // if ($data['type_payment'] == 'direct') {
        //     if($request->hasfile('comprobante')){
        //         $image = $request->file('comprobante');
        //         $name = time() . "." . $image->extension();
        //         $image->move(public_path('storage') . '/comprobantes', $name);
        //         $orden->image = '' . $name;
        //         $orden->save();
        //     }
        // }

        // Mail::send('mails.preregister',[
        //     'data' => $user,
        //     'logo' => public_path('/images').'/login/connect.png'
        // ], function ($msj) use ($user){
        //     $msj->subject('Pre Register exitoso');
        //     $msj->to($user->email);
        // });


        // if ($data['type_payment'] == 'futswap') {
        //     $response = $this->futswap->createOrden($user, intval($orden->amount), $orden->id);

        //     if($response[0] != 'error')
        //     {
        //         //redirecciona a la url del pago
        //         $this->redirectTo = route('scanQr', $response);
        //     }else{
        //         $this->error = $response[1];
        //     }
        // }

        /*  mail::send('mails.Preregister',['data' => $data], function ($msj){
             $msj->subject('Nuevo usuario registrado');
             $msj->to('info@terramember.club');
         }); */
    }

    // Register
    public function showRegistrationForm()
    {
        // $countrie = Countrie::all();
        $countries = Prefix::all();
        $data = WalletComission::first();
        return view('/auth/register',compact('countries', 'data'));
    }

    protected function registered(Request $request, $user)
    {
        if ($this->error != null) {
            return redirect()->route('verification.notice')->with('error', $this->error);
        }else{
            return redirect($this->redirectTo);
        }
    }

    public function redirectTo()
    {
            if (session()->has('redirect_to'))
                return session()->pull('redirect_to');

            return $this->redirectTo;
    }
}
