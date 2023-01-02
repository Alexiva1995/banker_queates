@extends('layouts/fullLayoutMaster')

@section('title', 'Verify Page')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-auth.css')) }}">
<style>
  .bg{
    background-image: url(/images/auth/fondo-auth.png);
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    position: fixed;
  }
  h4{
      color:#544E67!important;
  }
</style>
@endsection
@section('content')
<!-- la clase bg1 se encuentra en el archivo _variables.scss-->
<div class="auth-wrapper auth-v1 px-2 bg1">
  <div class="auth-inner py-2">
      <div class="card p-2 mb-0 bg-white">
          <div class="card-body mx-1 text-center">
              <img width="120" class="mb-2" src="{{asset('images/logo/logo-deg.png')}}" alt="">
              <h4 class="text-center mb-1 fw-700">¡To complete your registration please press the button!</h4>
              @if (session('resent'))
                <div class="alert alert-success" role="alert">
                  <div class="alert-body">
                    {{ __('A verification link has been sent to your email.') }}
                  </div>
                </div>
              @endif
                <p class="card-text mb-3 text-centert">{{ __('Here your account will be created in the broker and you will receive the confirmation email, if you have not received the email, click below to request another') }}</p>
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
                        {{ __('Retry broker account creation') }}
                      </span>
                  </button>.
                @else
                  <input type="hidden" name="resend_email" value="1">
                    @csrf
                    <button type="submit" id="verfBTN" class="btn btn-primary fw-400 align-baseline mb-0" style="letter-spacing: 0.8px">
                      <span id="spin-span" class="spin spinner-border-sm">
                      </span>
                      <span id="text">
                        {{ __('Create account in the Broker') }}
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
    text.textContent = 'Creating account in the Broker';
  })
  
</script>
@endsection
