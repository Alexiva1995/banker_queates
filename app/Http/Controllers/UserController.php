<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Prefix;
use App\Models\Countrie;
use App\Models\OrdenPurchase;
use App\Models\Liquidation;
use App\Models\WalletComission;
use App\Models\WalletLog;
use App\Models\Member;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use App\Mail\CodeEmail;
use App\Mail\CodeSeccurity;
use App\Models\Investment;
use App\Models\LogRank;
use App\Models\Pin;
use App\Models\PinSecurity;
use App\Models\Wallet;
use App\Models\WalletSeccurity;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{

    public function finanzas()
    {
        $user = Auth::user();

        $comisionesPendientes = Wallet::where([['user_id', '=', $user->id], ['tipo_transaction', 0], ['status', 0]])->count();
        $ordenesCompletas = OrdenPurchase::where([['user_id', '=', $user->id], ['status', '1']])->count();
        $retirosAprobados = Liquidation::where([['iduser', '=', $user->id], ['status', '1']])->count();
        $inversion = Investment::where('user_id', Auth::id())->where('status', 1)->orderBy('invested', 'desc')->first();
        return view('financial.finanzas', compact('inversion', 'comisionesPendientes', 'ordenesCompletas', 'retirosAprobados'));
    }

    public function profile()
    {
        $id = Auth::user()->id;
        $invertido = $this->paquete();
        $user = User::find($id);
        $country = Prefix::all();
        $wallet = WalletComission::where('user_id', $user->id)->get();
        $prefix = Prefix::orderBy('id', 'asc')->get();


        return view('profile.profile', compact('country', 'user', 'wallet', 'invertido', 'prefix'));
    }

    public function userView($id)
    {
        // dd($id);
        $invertido = $this->paquete();
        $user = User::find($id);

        $user->licencia = $user->investment->licensePackage->name;
        $user->ganancias = $user->wallets->sum('amount_available');


        $country = Countrie::all();
        $wallet = WalletComission::where('user_id', $user->id)->get();
        $prefix = Prefix::orderBy('id', 'asc')->get();

        return view('user.user-view', compact('country', 'user', 'wallet', 'invertido', 'prefix'));
    }

    public function listUser(Request $request)
    {
        $user_name = null;

        $user_email = null;

        $licenses = [];

        $pamm = null;
        
        $buyer_id = null;

        $user_status = [];

        if( $request->isMethod('post') )
        {
            // return $request;
            $query = User::with('padre', 'investment.LicensePackage', 'countrie');

            if($request->has('user_name') && $request->user_name !== null) 
            {
                $user_name = $request->user_name;

                $query->where('name', 'LIKE', $user_name);
            }
            // TODO: integrar con api?
            if($request->has('pamm') && $request->pamm !== null) 
            {
                $user_name = $request->pamm;

                // $query->whereHas('user', function($q) use($user_name){
                //     $q->where('email', $user_name);
                // });
            }
            
            if($request->has('buyer_id') && $request->buyer_id !== null) 
            {
                $buyer_id = $request->buyer_id;

                $query->where('buyer_id', $buyer_id);
            }

            if($request->has('user_email') && $request->user_email !== null) 
            {
                $user_email = $request->user_email;

                $query->where('email', $user_email);
            }

            if($request->has('licenses') && $request->licenses !== null)
            {

                $licenses = $request->licenses;
                $query->whereHas('investment.licensePackage', function($q) use($licenses){
                    $q->whereIn('id', $licenses);
                });

            }

            if($request->has('user_status') && $request->user_status !== null)
            {
                $user_status = $request->user_status;

                foreach($user_status as $key => $status)
                {
                    if($key == 0) {
                        $query->where('status', '=', $status);
                    } else {
                        $query->orWhere('status', '=', $status);
                    }
                }
            }

            $users = $query->where('admin', '0')->orderBy('id', 'desc')->get();

            return view('user.list-users', compact('users', 'user_name', 'user_email', 'licenses', 'pamm', 'buyer_id', 'user_status'));

        }

        $users = User::where('admin', '0')->with('padre', 'investment.LicensePackage', 'countrie')->orderBy('id', 'desc')->get();

        return view('user.list-users', compact('users', 'user_name', 'user_email', 'licenses', 'pamm', 'buyer_id', 'user_status'));
    }

    public function searchUsers(Request $request)
    {
        //buscar por nombre, correo o PAMM 

        if (($request->input('select') != "Filtar") && (empty($request->input('filtro')))) {
            return redirect()->back()->with('error', 'Debe colocar la información a filtrar');
        } elseif (!empty($request->input('filtro')) && ($request->input('select') == "id")) {

            $validate = $request->validate([
                'filtro' => 'bail|integer|max:5',
            ]);

            $users = User::where('id', $request->input('filtro'))->orderBy('id', 'desc')->get();
        } elseif (!empty($request->input('filtro')) && ($request->input('select') == "name")) {

            $users = User::where('name', $request->input('filtro'))->orWhere('last_name', $request->input('filtro'))->orderBy('id', 'desc')->get();
        } elseif (!empty($request->input('filtro')) && ($request->input('select') == "email")) {

            $validate = $request->validate([
                'filtro' => 'bail|email|max:5',
            ]);

            $users = User::where('email', $request->input('filtro'))->orderBy('id', 'desc')->get();
        } elseif (!empty($request->input('filtro')) && ($request->input('select') == "pamm")) {
            return redirect()->back()->with('error', 'In process');
        } else {
            $users = User::where('admin', '0')->with('padre', 'investment.LicensePackage', 'countrie')->orderBy('id', 'desc')->get();
        }

        return view('user.list-users', compact('users'));
    }

    /**
     * Retorna la lista con los usuarios que tienen licencias vencidas
     */
    public function ExpiredLicenseUserList()
    {
        $users = User::where('id', '!=', 1)->with('padre', 'countrie', 'investment')->get();
        $usersExpired = new Collection();
        foreach ($users as $user) {

            if ($user->investment !== null) {

                if ($user->investment->expiration_date <= today()->format('Y-m-d')) {
                    $usersExpired->push($user);
                }
            }
        }

        return view('user.expiredLicensesUserList', compact('usersExpired'));
    }

    public function start(User $user)
    {

        session()->put('impersonated_by', auth()->id());

        Auth::login($user);

        return redirect('/')->with('success', 'You have started a section in another account');
    }

    public function stop()
    {

        Auth::loginUsingId(session()->pull('impersonated_by'));

        return redirect('/')
            ->with('success', 'You have started section with your admin account');
    }

    public function verifiedEmail()
    {
        return view('auth.email-verified');
        //    return redirect()->route('dashboard.index')->with('success', 'Correo electrónico verificado');
    }


    public function verifyAccount($token)
    {
        $id = Crypt::decryptString($token);
        $user = User::where('id', $id)->first();
        $user->email_verified_at = Carbon::now();
        $user->save();

        return redirect()->route('verified-email')->with('success', 'Your username has been successfully verified.');
        /* }else{
                return redirect()->back()->with('alert-danger', 'El código está caducado, se ha enviado un nuevo código.');
            } */
        /* }else{
            return redirect()->route('user.verification.email')->with('alert-danger', 'El código ingresado no es válido. Por favor revise su correo.');
        } */
    }

    public function notificacionesLeidas()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return back();
    }
    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique('users')->ignore($user->id, 'id')],
            'last_name' => 'required',
            'countrie_id' => 'required'
        ]);
        
/*
        if ((strcmp($request->input('email'), $request->input('emailOrigin')) !== 0) &&
            ($request->input('email') != null && $request->input('password') == null)
        ) {

            return redirect()->back()->with('error', 'Si desea cambiar su correo electrónico, debe ingresar su contraseña de Take.');
        }

        if (($request->input('password') != null) && ($request->input('email') != null)) {
            //verificar contraseña de take para poder actualizar el correo 

            if (Hash::check($request->input('password'), Auth::user()->password)) {
                $user->email = $data['email'];
            } else {
                return redirect()->back()->with('error', 'NO coincide la contraseña ingresada, con su contraseña de Take.');
            }
        }
*/
        $user->name = $data['name'];
        $user->last_name = $data['last_name'];
        $user->prefix_id = $data['countrie_id'];
        
        if ($request->has('email')) $user->email = $data['email'];
        if ($request->has('gender')) $user->gender = $request->input('gender');

        $user->save();

        return back()->with('success', 'Updated profile');
    }
    public function updateContacto(Request $request)
    {

        $user = User::find(Auth::user()->id);

        $request->validate([
            'phone' => 'required',
            'city' => 'required',
            'code_postal' => 'required',
            'direction' => 'required',
            'countrie' => 'required',
            'prefix' => 'required'
        ]);


        $user->phone = $request->phone;
        $user->prefix_id = $request->prefix;
        $user->countrie_id = $request->countrie;
        $user->city = $request->city;
        $user->code_postal = $request->code_postal;
        $user->direction = $request->direction;

        $user->save();

        return back()->with('success', 'Updated profile');
    }
    public function photoUpdate(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $request->validate([
            'photo' => 'required|mimes:jpeg,png|max:800'
        ]);

        $user->update($request->all());

        //Guardamos foto
        $photo = $request->file('photo');
        $name = time() . "." . $photo->extension();
        $photo->move(public_path('storage') . '/photo-profile/', $name);
        $user->photo = '' . $name;

        $user->save();

        return redirect()->back()->with('success', 'The photo was successfully updated');
    }
    public function deletePhoto()
    {
        $user = Auth::user();
        $user->update(['photo' => null]);
        return redirect()->back()->with('success', 'Your photo was successfully removed');
    }

    public function sendCodeAutentication(Request $request)
    {
        $user = Auth::user();
        // $request->validate([
        //     'code_verification' => 'required'
        // ], [
        //     'code_verification.required' => 'Debe ingresa un codigo de google auth correcto'
        // ]);
        // if ((new Google2FA())->verifyKey($user->token_auth, $request->code_verification)) {
        $code_correo =  Crypt::encrypt(Str::random(10));
        $user->update(['token_sistem' => $code_correo]);
        $email = ['email' => $user->email];
        Mail::to($user->email)->send(new CodeEmail($email));
        return response()->json(['message' => 'The authentication code has been sent to your email.'], 201);
        // }else{
        //     return response()->json(['error' => 'El código de google auth es incorrecto.'], 422);
        // }

        //return response()->json(['message' => 'El código de autenticación ha sido enviado a su correo electrónico'], 201);
    }

    public function checkAutenticator(Request $request)
    {
        $request->validate([
            'code_verification' => 'required',
            'code_email' => 'required',
            'password_autenticator' => 'required'
        ], [
            'code_verification.required' => 'You must enter a correct google auth code',
            'code_email.required' => 'You must enter the code sent to your email',
            'password_autenticator.required' => 'You must enter your password'
        ]);
        $auth = Auth::user();
        $desincryptarDB =  Crypt::decrypt($auth->token_sistem);
        if ((new Google2FA())->verifyKey($auth->token_auth, $request->code_verification)) {
            if ($desincryptarDB == $request->code_email) {
                if (Hash::check($request->password_autenticator, $auth->password)) {
                    return response()->json(['message' => 'You have been verified, you can now update your security pin'], 201);
                } else {
                    return response()->json(['error' => 'Password is incorrect'], 422);
                }
            } else {
                return response()->json(['error' => 'The code is wrong'], 422);
            }
        } else {
            return response()->json(['error' => 'The authentication code is incorrect'], 422);
        }
    }


    public function CodeUpdate(Request $request)
    {

        $user = User::find(Auth::user()->id);
        $validate = Validator::make($request->all(), [
            'code_security' => 'required|min:6|confirmed',
        ], [
            'required' => 'Security code is required.',
            'min' => 'The security code must contain at least 6 characters.',
            'confirmed' => 'The security code confirmation field does not match.',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        } else {
            $user->code_security = $request['code_security'];
            $user->save();
            return redirect()->back()->with('success', 'PIN set');
        }
    }
    public function PasswordUpdate(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'confirm_password' => ['same:new_password'],
            'code_password' => 'required'
        ]);
        $code = Crypt::decryptString(Auth::user()->code_security);
        if ($request->code_password == $code) {
            User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

            return back()->with('success', 'Updated password');
        } else {
            return back()->with('error', 'Email verification failed');
        }
    }

    public function pinUpdate(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_pin' => ['required'],
            'confirm_pin' => ['same:new_pin'],
            'code_pin' => 'required'
        ]);
        $code = Crypt::decryptString(Auth::user()->code_security);
        if ($request->code_pin == $code) {
            Pin::updateOrCreate(
                ['user_id' => Auth::id()],
                ['pin' => Crypt::encryptString($request->new_pin)]
            );

            PinSecurity::updateOrCreate(
                ['user_id' => Auth::id()],
                ['pin' => Crypt::encryptString($request->new_pin)]
            );


            return back()->with('success', 'Updated PIN');
        } else {
            return back()->with('error', 'Email verification failed');
        }
    }

    public function paquete()
    {

        $paquete = "";
        $inversiones = Investment::where('status', 1)->first();

        if (isset($inversiones)) {
            switch ($inversiones->invested) {
                case $inversiones->invested >= 500 && $inversiones->invested <= 4900:
                    $paquete = 'FRESHMAN INVESTOR';
                    break;
                case $inversiones->invested >= 5000 && $inversiones->invested <= 14900:
                    $paquete = 'JUNIOR INVESTOR';
                    break;
                case $inversiones->invested >= 15000 && $inversiones->invested <= 29900:
                    $paquete = 'SENIOR INVESTOR';
                    break;
                case $inversiones->invested >= 30000 && $inversiones->invested <= 49900:
                    $paquete = 'MASTER INVESTOR';
                    break;
                case $inversiones->invested >= 50000 && $inversiones->invested <= 149000:
                    $paquete = 'MASTER PRO INVESTOR';
                    break;
                case $inversiones->invested >= 150000 && $inversiones->invested <= 299000:
                    $paquete = 'EXCELSIOR INVESTOR';
                    break;

                default:

                    break;
            }
        }
        return $paquete;
    }

    public function desloguear()
    {
        Auth::logout();

        return redirect('login');
    }

    public function memberActive()
    {
        $user = Auth::user();

        return view('member.active', compact('user'));
    }

    public function Active(Request $request)
    {

        $member = new member();
        $member->user_id = $request->user;
        $member->amount = 50;
        $member->description = "active";
        $member->save();

        return redirect()->route('dashboard.index');
    }
    //actualiza la wallet 
    public function updateWallet(Request $request)
    {

        $user = User::find(Auth::user()->id);

        $data = $request->validate([
            'wallet' => 'required',
            'code' => 'required',
            'pin' => 'required',
        ], [
            'wallet.requered' => 'The wallet field is required',
            'code.required' => 'The auth field is required',
            'pin.required' => 'The personal pin is required'
        ]);

        if ($user->code_security == $request->pin) {
            if ((new Google2FA())->verifyKey($user->token_auth, $request->code)) {
                if ($user->wallet != null) {
                    WalletLog::create([
                        'user_id' => $user->id,
                        'old_wallet' => $user->wallet,
                        'current_wallet' => Crypt::encryptString($data['wallet'])
                    ]);
                }
                $user->wallet = Crypt::encryptString($data['wallet']);
                $user->save();
                return redirect()->back()->with('success', 'Wallet updated successfully ');
            } else {
                return redirect()->back()->with('error', 'Wrong auth code');
            }
        } else {
            return redirect()->back()->with('error', 'Wrong pin');
        }
    }

    public function referred(Request $request)
    {
        $user = User::where('id', '=', $request->user)->first();

        $user->update([
            'referred_id' => $request->referido
        ]);

        return redirect()->back()->with('success', 'User Updated Successfully');
    }

    public function massiveMail()
    {
        $users = User::all();
        foreach ($users as $user) {
            Mail::send('mails.usersStatement',  ['logo' => public_path('/images') . '/login/connect.png',], function ($msj) use ($user) {
                $msj->subject('Comunicado oficial.');
                $msj->to($user->email);
                $msj->attach(public_path('files') . '/comunicado.pdf');
            });
        }
        return 'OK';
    }
    /**
     * Genera un codigo de seguridad, lo envia al correo del usuario y lo guarda encryptado en db
     */
    public function sendSeccurityCode()
    {
        $user = Auth::user();
        $code = Str::random(10);
        $code_encrypted = Crypt::encryptString($code);
        $user->update(['code_security' => $code_encrypted]);
        $response = ['status' => 'success'];
        Mail::to($user->email)->send(new CodeSeccurity($code));
        return response()->json($response, 200);
    }
    /**
     * Guarda la wallet del usuario en db, encryptada
     */
    public function storeWallet(Request $request)
    {
        $request->validate(
            [
                'code' => 'required',
                'wallet' => 'required',
                'password' => 'required'
            ],
            [
                'code' => 'The code is required',
                'wallet' => 'The wallet is required',
                'wallet' => 'Your password is required'
            ]
        );

        $user = Auth::user();

        if (!$user->code_security) {
            return back()->with('error', 'Must require a security code');
        }

        if ($request->code !== $user->decryptSeccurityCode()) {
            return back()->with('error', 'Security code does not match');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password is incorrect');
        }
        // Se guarda su wallet encriptada
        Wallet::updateOrCreate(
            ['user_id' =>  $user->id],
            ['address' => Crypt::encryptString($request->wallet)]
        );
        // Se guarda una copia de seguridad, la cual se conforma del id del usuario + su wallet. ambos encriptados.
        WalletSeccurity::updateOrCreate(
            ['user_id' =>  $user->id],
            ['encrypted' => Crypt::encryptString("{$user->id}-{$request->wallet}")]
        );

        $user->update(['code_security' => null]);

        return back()->with('success', 'Your wallet has been successfully saved!');
    }
    public function checkCode(Request $request) {      
        $user = Auth::user();
        $code = Crypt::decryptString($user->code_security);
        if ($code == $request->pin) {
            $response = ['status' => 'success'];
            return response()->json($response, 200);
        }
        $response = ['status' => 'error'];
        return response()->json($response, 200);
    }

    public function ranNotification(Request $request){
        $user = Auth::user();
        $estatus = 'error_1';
        $data = [
            'rank_id'=> $user->range_id,
            'status'=> $estatus
        ];

        $rangoAnterior = $this->verificarRango();
        
        session(['rango' => $user->range_id]);

        if($rangoAnterior != null ){
            Log::info('no es null 1');

            if($user->range_id > $rangoAnterior){

                $estatus = 'success';
                $data = [
                    'rank_id'=> $user->range_id,
                    'status'=> $estatus
                ];

                Log::info('tiene rango nuevo 2');
                return response()->json(['value'=> $data]);       
            }else{
                $estatus = 'error_2';
                $data = [
                    'rank_id'=> $user->range_id,
                    'status'=> $estatus
                ];
                return response()->json(['value'=> $data]);       
            }
        }else{
            return response()->json(['value'=> $data]);       
        }
    }

    public function verificarRango(){
        if(session()->has('rango')){
            $rango = session('rango');
            return $rango;
        }else{
            return null;
        }
    } 
    
    
    public function updateWhizfx() {      
        $user = Auth::user();
        if ($user->whizfx_id != null) {
            $url = config('services.api_whizfx.base_url');
            $url = $url . 'customer/'.$user->whizfx->customer_id;
            $response = Http::withHeaders([
                'auth' => config('services.api_whizfx.x-token'),
            ])->get("{$url}");
            $customerData = $response->object();
            $user->whizfx->kyc_percentage = $customerData->kyc_percentage;
            $user->whizfx->save();
            return back()->with('success', 'Updated data!');
        }
        return back()->with('error', 'An error happened');
    }

    public function rankHistory(Request $request){
        $id = Auth::id();
        $data = [
            'user_id'=>$id,
            'range'=>$request->newRank
        ];
        LogRank::create($data);
    }
    public function assinRank(Request $request,$id){
        $user = User::where('id',$id)->first();
        $user->range_id = $request->newRank;
        $user->update();

        return back()->with('success', 'Range Changed');
    }
}
