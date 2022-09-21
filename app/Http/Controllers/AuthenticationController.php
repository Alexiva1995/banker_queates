<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthenticationController extends Controller
{
  // Login v1
  public function login_v1()
  {
    $pageConfigs = ['blankPage' => true];

    return view('/content/authentication/auth-login-v1', ['pageConfigs' => $pageConfigs]);
  }

  // Login v2
  public function login_v2()
  {
    $pageConfigs = ['blankPage' => true];

    return view('/content/authentication/auth-login-v2', ['pageConfigs' => $pageConfigs]);
  }

  // Register v1
  public function register_v1()
  {
    $pageConfigs = ['blankPage' => true];

    return view('/content/authentication/auth-register-v1', ['pageConfigs' => $pageConfigs]);
  }

  // Register v2
  public function register_v2()
  {
    $pageConfigs = ['blankPage' => true];

    return view('/content/authentication/auth-register-v2', ['pageConfigs' => $pageConfigs]);
  }

  // Forgot Password v1
  public function forgot_password_v1()
  {
    $pageConfigs = ['blankPage' => true];
    dd($pageConfigs);
    return view('/content/authentication/auth-forgot-password-v1', ['pageConfigs' => $pageConfigs]);
  }

  // Forgot Password v2
  public function forgot_password_v2()
  {
    $pageConfigs = ['blankPage' => true];
        
    return view('/content/authentication/auth-forgot-password-v2', ['pageConfigs' => $pageConfigs]);
  }

  // Reset Password
  public function reset_password_v1()
  {
    $pageConfigs = ['blankPage' => true];
 
    return view('/content/authentication/auth-reset-password-v1', ['pageConfigs' => $pageConfigs]);
  }

  // Reset Password
  public function reset_password_v2()
  {
    $pageConfigs = ['blankPage' => true];
 
    return view('/content/authentication/auth-reset-password-v2', ['pageConfigs' => $pageConfigs]);
  }

  public function sendVerificationEmail(){
    $user = Auth::user();

    $dataEmail = [
      'user' => $user,
    ];

    Mail::send('mail.VerificationEmail',  ['data' => $dataEmail,  'logo' => public_path('/images') . '/login/connect.png',], function ($msj) use ($user)
        {
            $msj->subject('Verificación de correo electrónico.');
            $msj->to($user->email);
        });  
    return redirect()->back()->with('success', 'Correo de verificación enviado exitosamente');
  }
  public function verify(Request $request, User $user){
    $pageConfigs = ['blankPage' => true];

    if($request!=null){
      $user=Auth::user();
      if( $request->has('resend_email') && $request->resend_email == '1' )
      {
        $dataEmail = [ 'user' => $user ];
        Mail::send('mail.VerificationEmail',  ['data' => $dataEmail], function ($msj) use ($user){
            $msj->subject('Verificación de correo electrónico.');
            $msj->to($user->email);
        });  
        return redirect()->route('auth.verify')->with('resent', true);
      }
      return view('auth.verify', ['pageConfigs' => $pageConfigs], compact('user'));
    }
    
  }

  public function verify_v2(){
   

    return view('auth.verified-reset');
  }
}
