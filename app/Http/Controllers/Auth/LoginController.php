<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Mail\Auth2faActive;
use App\Mail\CodeEmail;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FA;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Writer as BaconQrCodeWriter;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Rules\ReCaptchaRule;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);
    }
    public function login(Request $request, $is_active = false)
    {
        $this->validateLogin($request);
        //$this->validate($request, ['recaptcha_token' => ['required', new   ReCaptchaRule($request->recaptcha_token)]]);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        $user = User::where('username', '=', $request->login)->orWhere('email', '=', $request->login)->first();
        if (password_verify($request->password, optional($user)->password)) {
            $this->clearLoginAttempts($request);
            $request->session()->regenerate();

            Auth::login($user);
              return redirect()->route('dashboard.index');

            // $urlQR = "";
            // $userEmail = user::where('email', $request->email )->first();

            // if ($userEmail->token_auth == null || $userEmail->auth_status == 0) {

            //         $user->update(['token_auth' => (new Google2FA)->generateSecretKey()]);

            //         $urlQR = $this->createUserUrlQR($user);

            //         $twofa = ['name' => 'joelgoyo'];
            //         Mail::to($userEmail->email)->send(new Auth2faActive($twofa,$user));

            //     return view("auth.2fa", compact('urlQR', 'user', 'is_active'));
            // }else{
            //     $urlQR = null;
            //     $is_active = false;
            //     return view("auth.2fa", compact('urlQR', 'user', 'is_active'));
            // }
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

   /*public function login(Request $request, $is_active = false) {-
        $this->validateLogin($request);

         if ($this->hasTooManyLoginAttempts($request)) {
             $this->fireLockoutEvent($request);
             return $this->sendLockoutResponse($request);
         }


         $user = User::where($this->username(), '=', $request->email)->first();

           if (password_verify($request->password, optional($user)->password)) {
               $this->clearLoginAttempts($request);

        //          $urlQR = "";
        //          $userEmail = user::where('email', $request->email )->first();


        //          if ($userEmail->token_auth == null) {


        //              if(is_null($user->token_login)){

        //                $user->update(['token_auth' => (new Google2FA)->generateSecretKey()]);

        //                  $urlQR = $this->createUserUrlQR($user);

        //                  // $urlQR = null;

        //   //               $twofa = ['name' => 'joelgoyo'];
        //   //               Mail::to($userEmail->email)->send(new Auth2faActive($twofa,$user));

        //              }


        //              return view("auth.2fa", compact('urlQR', 'user', 'is_active'));

        //              // Auth::login($user);
        //              // return redirect()->intended($this->redirectPath());

        //          }else{
        //              $urlQR = null;
        //              $is_active = false;
        //              return view("auth.2fa", compact('urlQR', 'user', 'is_active'));
        //          }
                 $urlQR = "";
                 $userEmail = user::where('email', $request->email )->first();
                 if ($userEmail->token_auth == null) {
                     Auth::login($user);
                     return redirect()->intended($this->redirectPath());

                 }else{
                     $urlQR = null;
                     $is_active = false;
                     return view("auth.2fa", compact('urlQR', 'user', 'is_active'));
                 }

        }


        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }*/




    public function login2FA(Request $request, User $user)
    {
        $request->validate(['code_verification' => 'required']);

        if ((new Google2FA())->verifyKey($user->token_auth, $request->code_verification)) {
            $user->auth_status = 1;
            $user->update();
            return redirect()->route('check.mail', $user->id)->with('user', $user->idr)->with('success','Codigo enviado al correo con exito');
        }else{
            return redirect()->back()->with('error', 'Incorrect verification code');
        }
    }


    public function check_mail()
    {

        $code_correo =  Crypt::encrypt(Str::random(10));

        $userto = User::where('id', 3)->first();

        $userto->update(['token_sistem' => $code_correo]);

        $email = ['email' => $userto->email];

        Mail::to($userto->email)->send(new CodeEmail($email));
        return view('mails.withdrawMail', compact('userto', 'email'));

    }


    public function cheking(Request $request)
    {

       $auth = user::where('id' , $request->id)->first();
       $desincryptarDB =  Crypt::decrypt($auth->token_sistem);

       if ($desincryptarDB == $request->code_verification) {

          $request->session()->regenerate();

          Auth::login($auth);
            return redirect()->route('dashboard.index');


        }else{
          return redirect()->back()->withErrors(['error'=> 'Código de verificación incorrecto']);
        }
    }

    public function createUserUrlQR($user)
    {
         $data =
            (new Google2FA)->getQRCodeUrl(
                config('app.name'),
                $user->email,
                $user->token_auth
            );

        return $data;
    }
    // Login
    public function showLoginForm(Request $request){
        $pageConfigs = [
            'bodyClass' => "bg-full-screen-image",
            'blankPage' => true
        ];
        return view('/auth/login', [
            'pageConfigs' => $pageConfigs
        ]);
    }
}
