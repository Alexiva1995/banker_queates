@extends('layouts/fullLayoutMaster')

@section('title', 'Register Page')
@section('vendor-style')
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection
@section('page-style')

{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-auth.css')) }}">
@endsection
<script>
   import "@fontsource/dm-sans";
</script>
<style>
    #bg {
        background-image: url('{{('images/auth/fondo-auth.png')}}');
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
    body{
        overflow-x: hidden;
    }
    .auth-wrapper.auth-v1{
        padding-left:1.5rem;
        padding-right:1.5rem;
    }
    @media(max-width:357px){
        .auth-wrapper.auth-v1{
            padding-left:0.5rem;
            padding-right:0.5rem;
        }
        .card.p-2 {
            padding-right: 3%!important;
            padding-left: 3%!important;
        }
    }
</style>
@section('content')
@php
$referred = null;
@endphp
@if ( request()->buyer_id != null )
@php
$ref_id=request()->buyer_id;
$referred = DB::table('users')
->where('id', '=', $ref_id)
->first();
@endphp
@endif
<div id="bg">
    <!--  <img src="{{asset('images/login/bg-login.png')}}" /> -->
 </div>
<div class="auth-wrapper auth-v1">
    <div class="auth-inner py-2" style="max-width:510px">
        <!-- Register v1 -->
        <div class="card mb-0 p-2 bg-white shadow box-shadow-1">
            <div class="card-body pb-0">
                <a href="#" class="brand-logo mb-3">
                    <img width="200" src="{{asset('images/logo/logo-deg.png')}}" alt="">
                </a>
                <h4 class="fw-700">Sign in Banker Quotes</h4>
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
                    input,.form-label, .form-check-label, .dark-layout .select2-container .select2-selection__rendered, .dark-layout .select2-container .select2-results__option[aria-disabled=true],.dark-layout .select2-container .select2-search__field, .select2-results__option{
                        color: #544E67 !important;
                        font-size: 14px!important;
                    }
                    .dark-layout .select2-container .select2-selection, .dark-layout .select2-container .select2-search__field, .dark-layout .select2-container .select2-selection__placeholder, span.select2-search.select2-search--dropdown,.dark-layout .select2-container .select2-dropdown {
                        background-color: #fff!important;
                        border-color: #DFDFDF !important;
                    }
                    input:-webkit-autofill,input:-webkit-autofill:focus,input:-internal-autofill-selected {
                            -webkit-text-fill-color: #544E67 !important;
                            color:#544E67 !important;
                    }
                </style>
                <form class="auth-register-form mt-2" method="POST" action="{{ route('auth-register') }}" enctype="multipart/form-data" >
                    @csrf
                    @if ( $referred !== null )
                        <div class="alert alert-info p-1 rounded-3 d-flex my-2">
                            <i data-feather='info' class="font-large-1 ms-50 me-75"></i>
                            <label class="fw-400 text-info pe-25">
                                Your sponsor's name is: <span class="fw-600 text-capitalize">{{ $referred->name.' '.$referred->last_name}} ({{ $referred->username }})</span>
                            </label>
                            {{-- <label class="" style="padding-left: 3%">El nombre de su patrocinador es: {{$referred->name}} </label>  --}}
                        </div>
                        <input type="hidden" name="buyer_id" value="{{$referred->id}}">
                        <input type="hidden" id="binary" name="binary" value="">
                    @endif
                    <p class="fw-300 my-1">Please complete the requested information to complete your registration.</p>

                    <div class="alert alert-secondary border border-2 p-25 px-1 font-small-1">The fields with <span class="text-danger font-medium-2">*</span> are required</div>
                    <label for="register-name" class="form-label mt-75 fw-500">Name And Last Name <span class="text-danger font-medium-2">*</span></label>
                    <div class="input-group mb-2 shadow-none">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="register-name" name="name" placeholder="Enter your first and last name" aria-describedby="register-name" style="background-color: white;border-color: #dfdfdf; color: rgb(0, 0, 0);" autofocus value="{{ old('name') }}" required/>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <label for="register-email" class="form-label fw-500">Email <span class="text-danger font-medium-2">*</span></label>
                    <div class="input-group mb-2 shadow-none">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="register-email" name="email" placeholder="Enter your email" aria-describedby="register-email"  style="background-color: white;border-color: #dfdfdf; color: rgb(0, 0, 0);" value="{{ old('email') }}" required/>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <label for="register-email-confirmation" class="form-label fw-500">Confirm Email<span class="text-danger font-medium-2">*</span></label>
                    <div class="input-group mb-2">
                        <input type="email" class="form-control @error('email_confirmation') is-invalid @enderror" id="register-email-confirmation" name="email_confirmation" placeholder="Confirm your email" aria-describedby="register-email-confirmation"  style="background-color: white;border-color: #dfdfdf; color: rgb(0, 0, 0);" value="{{ old('email_confirmation') }}" required/>
                    </div>

                    <label for="register-username" class="form-label fw-500">Username <span class="text-danger font-medium-2">*</span></label>
                    <div class="input-group mb-2 shadow-none">
                        <input type="text" class="form-control @error('username') is-invalid @enderror" required id="register-username" name="username" placeholder="Enter your username" aria-describedby="register-username" style="background-color: white;border-color: #dfdfdf;" autofocus value="{{ old('username') }}" required/>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    @if ( $referred === null )
                        <label for="register-referred_id" class="form-label fw-500">Enter the referral ID</label>
                        <div class="input-group mb-2 shadow-none">
                            <input type="text" class="form-control @error('buyer_id') is-invalid @enderror" id="registe-referred_id" name="buyer_id" placeholder="Enter your sponsor's Member ID" aria-describedby="register-referred_id" style="background-color: white;border-color: #dfdfdf; color: rgb(0, 0, 0);" autofocus value="{{ old('buyer_id') }}"/>
                            @error('buyer_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    @endif

                    {{-- <label for="register-phone" class="form-label"><strong>Teléfono</strong>  <span style="color:red; font-size:15px">*</span></label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="register-phone" name="phone" placeholder="Ingresa tu número de teléfono" aria-describedby="register-phone" style="background-color: white;border-color: #dfdfdf; color: rgb(0, 0, 0);" autofocus value="{{ old('phone') }}" required/>
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> --}}

                    <label for="register-country" class="form-label fw-500">Country <span class="text-danger font-medium-2">*</span></label>
                    <div class="input-group mb-2 shadow-none">
                        <select id="countrie_id" class="rounded form-control text-dark shadow-none" name="countrie_id" required>
                            <option disabled selected >Enter or select a country</option>
                                @foreach($countries as $country)

                                <option value="{{$country->id}}" {{old('countrie_id') == $country->id ? 'selected' : ''}}>{{$country->pais}}</option>
                                @endforeach
                            </option>
                        </select>
                    </div>
                    {{-- <div class="input-group mb-3">
                        <select id="countrie_id" class="rounded form-control text-dark" name="countrie" required>
                            <option disabled selected >seleccione un Pais</option>
                                @foreach($countrie as $item)
                                <option value="{{$item->id}}" {{old('countrie') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                @endforeach
                            </option>
                        </select>
                    </div> --}}

                    {{--  <label class="form-label"><strong>Método de pago</strong>  <span style="color:red; font-size:15px">*</span></label>
                    <div class="d-flex mb-3">
                        <div class="form-check me-2">
                            <input class="form-check-input" type="radio" name="type_payment" id="flexRadioDefault1" onclick="showModal()" value="direct"  required >
                            <label class="form-check-label" for="flexRadioDefault1" onclick="showModal()">
                                Pago directo
                            </label>
                            <br>
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    @if ($error == 'El campo comprobante es obligatorio.')
                                        <span class="text-danger">
                                            <strong>{{ $error }}</strong>
                                        </span>
                                    @endif
                                    <br>
                                    @if ($error == 'El campo hash es obligatorio.')
                                    <span class="text-danger">
                                        <strong>{{ $error }}</strong>
                                    </span>
                                @endif
                                @endforeach
                            @endif
                            </div>
                            <div class="form-check">
                            <input class="form-check-input" type="radio" name="type_payment" id="flexRadioDefault2" value="futswap" required>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Futswap Pay
                            </label>
                            </div>
                    </div> --}}
                    <input type="hidden" name="type_payment" value="futswap">

                    <label for="register-password" class="form-label fw-500">Password <span class="text-danger font-medium-2">*</span></label>
                    <div class="input-group mb-2 shadow-none">
                        <div class="input-group input-group-merge shadow-none form-password-toggle @error('password') is-invalid @enderror">
                            <input type="password" class="form-control form-control-merge @error('password') is-invalid @enderror" id="register-password" style="background-color: white;border-color: #dfdfdf; color: rgb(0, 0, 0);" name="password" placeholder="Enter your password" aria-describedby="register-password" required/>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <label for="register-password-confirm" class="form-label fw-500">Repeat password <span class="text-danger font-medium-2">*</span></label>
                    <div class="input-group mb-2 shadow-none">
                        <div class="input-group input-group-merge form-password-toggle shadow-none">
                            <input type="password" class="form-control form-control-merge" id="register-password-confirm" style="background-color: white;border-color: #dfdfdf; color: rgb(0, 0, 0);" name="password_confirmation" placeholder="Repeat password" aria-describedby="register-password" required/>
                        </div>
                    </div>
                    @if (!empty($data))
                        @include('auth.components.activationManual')
                    @endif

                    <div class="mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="register-privacy-policy" required/>
                            <label class="form-check-label"  for="register-privacy-policy">
                                I accept the <a href="./assets/terminos_y_condiciones.pdf" aria-label="download" download="teminos y condiciones.pdf" style="font-weight: 800; font-size: 14px;" class="fw-bold">Terms and Conditions</a>
                            </label>
                        </div>
                    </div>
                    <input type='hidden' name='recaptcha_token' id='recaptcha_token'>
                    @if($errors->has('recaptcha_token'))
                        <p class="alert alert-danger p-1">
                            {{$errors->first('recaptcha_token')}}
                        </p>
                    @endif
                    <button type="submit" class="btn btn-primary w-100 fw-400 accordion-itemtext-white g-recaptcha" style="letter-spacing: 0.9px">Sign In</button>
                </form>

                <p class="text-center mt-2">
                    Do you already have an account?
                    @if (Route::has('login'))
                       <a class="fw-bold" href="{{ route('login') }}" style="font-weight: 800; text-decoration-line: underline;">
                           <strong>Log In</strong>
                        </a>
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection
@section('page-script')
    <script src="https://www.google.com/recaptcha/api.js?render={{ env('GOOGLE_CAPTCHA_PUBLIC_KEY') }}"></script>
    <script>
        grecaptcha.ready(function() {
        grecaptcha.execute('{{ env('GOOGLE_CAPTCHA_PUBLIC_KEY') }}').then(function(token) {
        document.getElementById('recaptcha_token').value = token;
        }) });

        $('#countrie_id').select2();


        // Obtener el lado binario del enlace
        const url = new URL(window.location.href);
        const paramsBinary = url.searchParams.get("binary");
        const inputBinary = document.getElementById('binary');
        inputBinary.value = paramsBinary
    </script>
@endsection

