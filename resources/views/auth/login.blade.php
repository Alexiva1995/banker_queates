@extends('layouts/fullLayoutMaster')

@section('title', 'Login Page')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-auth.css')) }}">
@endsection

<style>
    #bg {
        background-image: url('{{('images/login/bg-login7k.png')}}');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: fixed;
        right: 0;
        width: auto;
        height: auto;
        z-index: -10;
        min-width: 100%;
        min-height: 100%;
        visibility: visible;
    }
    h4{
        color:#544E67!important;
    }
  
    @media(max-width:357px){
        .auth-wrapper.auth-v1{
            padding-left:0.5rem!important;
            padding-right:0.5rem!important; 
        }
        .card.mb-0.p-2 {
            padding-right: 3%!important;
            padding-left: 3%!important;
        }
    }
</style>

@section('content')
<div id="bg">
   <!--  <img src="{{asset('images/login/bg-login.png')}}" /> -->
</div>

<div class="auth-wrapper auth-v1 px-2">
    <div class="auth-inner py-2">
              <div class="card mb-0 p-2 bg-white shadow box-shadow-1" >
            <div class="card-body pb-0">
                <a href="#" class="brand-logo">
                    <img width="200" src="{{asset('images/logo/logo-deg.png')}}" alt="">
                </a>
                <h4 class="fw-700" style="">Bienvenido a Banker Quotes</h4>
                <p class="mb-0 fw-300">Por favor ingresa los datos a continuación e ingresa</p>

                <form class="auth-login-form mt-2" id="login-form" method="POST" action="{{ route('login') }}">
                    <style>
                        .dark-layout .input-group:focus-within .form-control, .dark-layout .input-group:focus-within .input-group-text, .dark-layout input:-webkit-autofill{
                            -webkit-box-shadow: 0 0 0 1000px #ffffff inset !important;
                            background-color: #fff!important;
                        }
                        .dark-layout input.form-control{
                            border-color: #DFDFDF!important;
                        }
                        .dark-layout .input-group{
                            background-color: #fff!important;
                        }
                        .dark-layout .form-check-input:not(:checked){
                            border-color: #DFDFDF!important;
                            background-color: #fff!important;

                        }
                        .dark-layout .input-group:focus-within .input-group-text{
                            border-color: #DFDFDF !important;
                        }
                        .form-label, .form-check-label{
                            color: #544E67 !important;
                            font-size: 14px!important;
                        }
                        input:-webkit-autofill,input:-webkit-autofill:focus,input:-internal-autofill-selected {
                            -webkit-text-fill-color: #544E67 !important;
                            color:#544E67 !important;
                         }
                    </style>
                    @csrf
                    <label for="login-email" class="form-label fw-500">Usuario o Email</label>
                    <div class="input-group mb-2 bg-white">
                        <input id="login" type="text"
                            class="form-control bg-white {{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}"
                            name="login" value="{{ old('username') ?: old('email') }}" required autofocus placeholder="Ingresa tu usuario o email">
                        @if ($errors->has('username') || $errors->has('email'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="my-2">
                        <div class="d-flex justify-content-between">
                            <label class="form-label fw-500" for="login-password">Contraseña</label>
                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                <small class="fw-500 font-small-3 text-decoration-underline">Olvidé mi contraseña</small>
                            </a>
                            @endif
                        </div>
                        <div class="input-group input-group-merge form-password-toggle bg-white">
                            <input type="password" required class="form-control bg-white form-control-merge" id="login-password" name="password" tabindex="2" placeholder="Ingresa tu contraseña" aria-describedby="login-password" />
                            <span class="input-group-text cursor-pointer"><i data-feather='eye'></i></span>
                            {{-- <button type="button" o><i data-feather='eye'></i></button> --}}
                        </div>
                    </div>
                    <div class="mb-1">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember" tabindex="3" {{ old('remember') ? 'checked' : '' }} />
                            <label class="form-check-label fw-400" for="remember"> Recuérdame </label>
                        </div>
                    </div>
                    <input type='hidden' name='recaptcha_token' id='recaptcha_token'>
                    
                    @if($errors->has('recaptcha_token'))
                        <p class="alert alert-danger p-1">
                            {{$errors->first('recaptcha_token')}}
                        </p>
                    @endif
                        <button type="submit" id="submit" class="btn btn-primary w-100 text-white g-recaptcha fw-400 my-75" style="letter-spacing: 0.9;">Ingresar
                        </button>
                </form>
            </div>
            <div class="row">
                <div class="">
                    <p class="text-center mb-0">¿Aún no tienes una cuenta? @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="fw-700 text-decoration-underline">
                            Regístrate
                        </a>
                    </p>
                @endif
                </span>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://www.google.com/recaptcha/api.js?render={{ env('GOOGLE_CAPTCHA_PUBLIC_KEY') }}"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('{{ env('GOOGLE_CAPTCHA_PUBLIC_KEY') }}').then(function(token) {
        document.getElementById('recaptcha_token').value = token;
    }) });
</script>
<script> 
   
</script>
@endsection
