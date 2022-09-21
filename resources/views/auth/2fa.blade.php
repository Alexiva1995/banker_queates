@extends('layouts/fullLayoutMaster')

@section('title', 'Login Page')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-auth.css')) }}">
@endsection
<style>
    #bg {
        background-image: url('{{('images/login/bg-login.png')}}');
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
    body {
        font-family: "DM Sans";
    }
    label.form-label {
        font-size: 14px;
    }
    .form-check-input:checked {
        background-color: #0255B8 !important;
        border-color: #0255B8 !important;
    }

</style>
@section('content')
<video id="bg" loop autoplay  muted>
   <!--  <source src="{{asset('Dashboard/LOGIN_v1.mp4')}}" /> -->
</video>
  <div class="auth-wrapper auth-v1 px-2">
    <div class="auth-inner py-2">
      <div class="auth-inner py-2" style="max-width: 500px;">
        <div class="card mb-0 p-2" style="border: 2px solid white;background-color:white;">
          <div class="card-body">
            <a href="#" class="brand-logo">
              <img src="{{asset('images/login/connect.png')}}" alt="">
            </a>
            <h2 class="text-center" style="font-weight:bold;letter-spacing:4px;color:#0255B8;">Google Authenticator</h2>
          </div>
          <form method="POST" action="{{ route('login.2fa', $user->id) }}">
            @csrf
            <div class="form-group row justify-content-center text-center">   
              @if ($urlQR != '')
                <div class="col-12"> 
                  {!! QrCode::size(250)->generate($urlQR) !!}
                  <div style="margin-top: 20px">
                    <p style="margin-bottom: 10px">¿No puedes escanear tu código?</p>
                    <a id="token-auth-copy" ><i class="iconCard" data-feather='copy' ></i><strong  class="ms-1 aDecoration fw-700" onclick="getTokenAuth()" id="copy-to-auth-token">COPIAR TOKEN</strong></a>
                  </div>
                </div>
              @endif        
              <div class="col-12 col-lg-8">
                <div class="form-group">
                  <label for="code_verification" class="col-form-label">
                    {{ __('CÓDIGO DE VERIFICACIÓN') }}
                  </label>
                  <input 
                    id="code_verification" 
                    type="text" 
                    class="form-control{{ $errors->has('code_verification') ? ' is-invalid' : '' }}" 
                    name="code_verification"
                   
                    value="{{ old('code_verification') }}" 
                    required
                    autofocus>
                    
                  <input type="hidden" name="is_active" value="{{ $is_active }}">
                  @if ($errors->has('code_verification'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('code_verification') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
              <button type="submit" class="btn mt-2 text-center text-white" style="background:#0255B8;">ENVIAR</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
<script>
function getTokenAuth() {
  var aux = document.createElement("input");
  aux.setAttribute("value", "{{$user->token_auth}}");
  document.body.appendChild(aux);
  aux.select();
  document.execCommand("copy");
  document.body.removeChild(aux);

  Swal.fire({
    title: "Token Copiado",
    icon: 'success',
    confirmButtonClass: 'btn btn-outline-primary',
  })
}
</script>