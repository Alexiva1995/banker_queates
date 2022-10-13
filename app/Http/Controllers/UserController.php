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
use App\Models\Wallet;
use App\Models\WalletSeccurity;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
        $country = Countrie::all();
        $wallet = WalletComission::where('user_id', $user->id)->get();
        $prefix = Prefix::orderBy('id', 'asc')->get();


        return view('profile.profile', compact('country', 'user', 'wallet', 'invertido', 'prefix'));
    }

    public function userView($id)
    {
        // dd($id);
        $invertido = $this->paquete();
        $user = User::find($id);
        $country = Countrie::all();
        $wallet = WalletComission::where('user_id', $user->id)->get();
        $prefix = Prefix::orderBy('id', 'asc')->get();

        return view('user.user-view', compact('country', 'user', 'wallet', 'invertido', 'prefix'));
    }

    public function listUser()
    {

        $users = User::where('admin', '0')->with('padre', 'countrie')->orderBy('id', 'desc')->get();

        return view('user.list-users', compact('users'));
    }
    /**
     * Retorna la lista con los usuarios que tienen licencias vencidas
     */
    public function ExpiredLicenseUserList()
    {
        $users = User::where('id', '!=', 1)->with('padre', 'countrie', 'investment')->get();
        $usersExpired = new Collection();
        foreach($users as $user) {

            if($user->investment !== null) {
                
                if($user->investment->expiration_date <= today()->format('Y-m-d')) {
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

        return redirect('/')->with('success', 'Has iniciado seccion en otra cuenta');
    }

    public function stop()
    {

        Auth::loginUsingId(session()->pull('impersonated_by'));

        return redirect('/')
            ->with('success', 'Has iniciado seccion con tu cuenta admin');
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

        return redirect()->route('verified-email')->with('success', 'Tu usuario ha sido verificado con éxito.');
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
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id, 'id')],
            'phone' => 'required',
            'last_name' => 'required',
        ]);

        $user->name = $data['name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        if ( $request->has('gender') ) $user->gender = $request->input('gender');
        
        $user->save();

        return back()->with('success', 'Perfil actualizado');
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

        return back()->with('success', 'Perfil actualizado');
    }
    public function photoUpdate(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $request->validate([
            'photo' => 'required'
        ]);

        $user->update($request->all());

        //Guardamos foto
        $photo = $request->file('photo');
        $name = time() . "." . $photo->extension();
        $photo->move(public_path('storage') . '/photo-profile/', $name);
        $user->photo = '' . $name;

        $user->save();

        return redirect()->back()->with('success', 'La foto fue actualizada con exito');
    }
    public function deletePhoto()
    {
        $user = Auth::user();
        $user->update(['photo' => null]);
        return redirect()->back()->with('success', 'Su foto fue removida con exito');
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
        return response()->json(['message' => 'El código de autenticación ha sido enviado a su correo electrónico.'], 201);
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
            'code_verification.required' => 'Debe ingresa un codigo de google auth correcto',
            'code_email.required' => 'Debe de ingresar el codigo enviado a su correo',
            'password_autenticator.required' => 'Debe ingresar su contraseña'
        ]);
        $auth = Auth::user();
        $desincryptarDB =  Crypt::decrypt($auth->token_sistem);
        if ((new Google2FA())->verifyKey($auth->token_auth, $request->code_verification)) {
            if ($desincryptarDB == $request->code_email) {
                if (Hash::check($request->password_autenticator, $auth->password)) {
                    return response()->json(['message' => 'Has sido verificado, ya puedes actualizar tu pin de seguridad'], 201);
                } else {
                    return response()->json(['error' => 'La contraseña es incorrecta'], 422);
                }
            } else {
                return response()->json(['error' => 'El código es incorrecto'], 422);
            }
        } else {
            return response()->json(['error' => 'El código de autenticacion es incorrecto'], 422);
        }
    }


    public function CodeUpdate(Request $request)
    {

        $user = User::find(Auth::user()->id);
        $validate = Validator::make($request->all(), [
            'code_security' => 'required|min:6|confirmed',
        ], [
            'required' => 'El código de seguridad es obligatorio.',
            'min' => 'El código de seguridad debe contener al menos 6 caracteres.',
            'confirmed' => 'El campo confirmación de código de seguridad no coincide.',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        } else {
            $user->code_security = $request['code_security'];
            $user->save();
            return redirect()->back()->with('success', 'PIN configurado');
        }
    }
    public function PasswordUpdate(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        return back()->with('success', 'Contraseña actualizada');
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
            'wallet.requered' => 'El campo wallet es requerido',
            'code.required' => 'El campo auth es requerido',
            'pin.required' => 'El pin personal es requerido'
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
                return redirect()->back()->with('success', 'Wallet actualizada correctamente ');
            } else {
                return redirect()->back()->with('error', 'Codigo auth incorrecto');
            }
        } else {
            return redirect()->back()->with('error', 'Pin incorrecto');
        }
    }

    public function referred(Request $request)
    {
        $user = User::where('id', '=', $request->user)->first();

        $user->update([
            'referred_id' => $request->referido
        ]);

        return redirect()->back()->with('success', 'Usuario Actualizado con exito');
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
        $user->update(['code_security'=> $code_encrypted]);
        $response = ['status' => 'success'];
        Mail::to($user->email)->send(new CodeSeccurity($code));
        return response()->json($response, 200);
    }
    /**
     * Guarda la wallet del usuario en db, encryptada
     */
    public function storeWalelt(Request $request)
    {
        $request->validate(
            [
                'code' => 'required',
                'wallet' => 'required'
            ],
            [
                'code' => 'El codigo es requerido',
                'wallet' => 'La wallet es requerida'
            ]
        );

        $user = Auth::user();

        if( !$user->code_security ) {
            return back()->with('error', 'Debe requerir un código de seguridad');
        }

        if( $request->code !== $user->decryptSeccurityCode() ) {
            return back()->with('error', 'El código de seguridad no coincide');
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
        
        return back()->with('success', 'Su wallet se ha guardado exitosamente!');
    }
}
