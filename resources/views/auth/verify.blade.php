@extends('layouts/fullLayoutMaster')

@section('title', 'Verify Page')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-auth.css')) }}">
<style>
  #bg{
      background-image: url('{{('../images/login/bg-login7k.png')}}');
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
</style>
@endsection
@section('content')

<div class="auth-wrapper auth-v1 px-2">
  <div class="auth-inner py-2">
      <div class="card p-2 mb-0 bg-white">
          <div class="card-body mx-1 text-center">
              <img width="120" class="mb-2" src="{{asset('images/logo/logo-deg.png')}}" alt="">
              <h4 class="text-center mb-1 fw-700">¡Para completar tu registro por favor presiona el boton!</h4>
              @if (session('resent'))
                <div class="alert alert-success" role="alert">
                  <div class="alert-body">
                    {{ __('Se ha enviado un link de verificación a tu correo electrónico.') }}
                  </div>
                </div>
              @endif
                <p class="card-text mb-3 text-centert">{{ __('Aca se creara tu cuenta en el broker y te llegara el correo de confirmación, si no has recibido el correo, has click abajo para solicitar otro') }}</p>
                @if (isset($user))
                 <form class="d-inline" id="send_email_form" method="GET" action="{{ route('auth.verify',$user) }}">
                @else
                <form class="d-inline" id="send_email_form" method="GET" action="{{ route('auth.verify') }}">
                @endif
                @if (session('resent'))
                  <input type="hidden" name="resend_email" value="1">
                    @csrf
                    <button type="submit" id="verfBTN" class="btn btn-primary fw-400 align-baseline mb-0" style="letter-spacing: 0.8px">
                      <span id="spin-span" class="spin spinner-border-sm">
                      </span>
                      <span id="text">
                        {{ __('Reintentar creación de cuenta Broker') }}
                      </span>
                  </button>.
                @else
                  <input type="hidden" name="resend_email" value="1">
                    @csrf
                    <button type="submit" id="verfBTN" class="btn btn-primary fw-400 align-baseline mb-0" style="letter-spacing: 0.8px">
                      <span id="spin-span" class="spin spinner-border-sm">
                      </span>
                      <span id="text">
                        {{ __('Crear cuenta en el Broker') }}
                      </span>
                  </button>.
                @endif
                </form>
                {{-- {{ dd(request('resent')) }} --}}
                
              </a>
          </div>
      </div>
  </div>
</div>
<script>
  const btnSubmit = document.querySelector('#verfBTN');
  const form = document.querySelector('#send_email_form');
  const spin = document.querySelector('#spin-span');
  const text = document.querySelector('#text');
  btnSubmit.addEventListener('click', ()=>{
    form.submit();
    btnSubmit.setAttribute('disabled', true);
    spin.classList.add('spinner-border');
    text.textContent = 'Creando cuenta en el Broker';
  })
  
</script>
@endsection
