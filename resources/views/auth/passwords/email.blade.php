@extends('layouts/fullLayoutMaster')

@section('title', 'Forgot Password')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-auth.css')) }}">
@endsection

@section('content')

<!-- la clase bg1 se encuentra en el archivo _variables.scss-->
<div class="auth-wrapper auth-v1 px-2 bg1">
  <div class="auth-inner py-2">
    <style>
       .dark-layout .input-group:focus-within .form-control, .dark-layout .input-group:focus-within .input-group-text, .dark-layout input:-webkit-autofill{
            -webkit-box-shadow: 0 0 0 1000px #ffffff inset !important;
            background-color: #fff!important;
        }
        .dark-layout input.form-control{
            border-color: #DFDFDF!important;
        }
        .dark-layout .input-group, .dark-layout input.form-control{
            background-color: #fff!important;
        }
        .dark-layout .form-check-input:not(:checked){
            border-color: #DFDFDF!important;
            background-color: #fff!important;
        }
        .dark-layout .input-group:focus-within .input-group-text{
            border-color: #DFDFDF !important;
        }
        .form-label, .form-check-label, .dark-layout .select2-container .select2-selection__rendered, .dark-layout .select2-container .select2-results__option[aria-disabled=true],.dark-layout .select2-container .select2-search__field, .select2-results__option{
            color: #544E67 !important;
            font-size: 14px!important;
        }
        .dark-layout .select2-container .select2-selection, .dark-layout .select2-container .select2-search__field, .dark-layout .select2-container .select2-selection__placeholder, span.select2-search.select2-search--dropdown,.dark-layout .select2-container .select2-dropdown {
            background-color: #fff!important;
            border-color: #DFDFDF !important;
        }
        h4{
        color:#544E67!important;
    }
    </style>
        {{--CARD 1 --}}
        <div class="card mb-0 p-2 bg-white shadow box-shadow-0">
            <a href="#" class="brand-logo">
              <img width="200" src="{{asset('images/logo/logo-deg.png')}}"  alt="">
            </a>
            <h4 class="card-body text-center mb-1 fw-700">Revisa tu correo y sigue las instrucciones</h4>
            <p class="mb-2 text-center">Te enviaremos un enlace a tu correo<br> para que puedas cambiar la contraseña</p>

            <form class="auth-forgot-password-form px-1 mt-1" require method="POST" action="{{ route('password.email') }}">
              @csrf
              <label for="forgot-password-email" class="form-label mt-75 fw-500">Correo</label>
              <div class=" input-group mb-1">
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="forgot-password-email" name="email" value="{{ old('email') }}" placeholder="john@example.com" aria-describedby="forgot-password-email" tabindex="1" autofocus />
                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="text-center">
                <button id="boton01" class="btn btn-primary mt-1 fw-400" tabindex="2" style="letter-spacing: 0.9px">
                  Cambiar Contraseña
                </button>
              </div>
            </form>
            <p class="text-center mt-1">
              Regresar al
              @if (Route::has('login'))
                <a href="{{ route('login') }}" class="fw-700">Inicio de sesión</a>
              @endif
            </p>
          </div>
      </div>  
</div>
<script type='text/javascript' src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
  $("#boton01").click(function() {
    setTimeout(function() {
      window.location = '{{route("auth.verified-reset")}}';
    }, 1000);
  });
</script>


@endsection