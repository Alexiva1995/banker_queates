@extends('layouts/fullLayoutMaster')

@section('title', 'Reset Password')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-auth.css')) }}">
@endsection

@section('content')
<div id="bg"></div> 
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
    <!-- Reset Password v1 -->
    <div class="card mb-0 p-2 bg-white shadow box-shadow-0">
      <div class="card-body mx-1 text-center">
        <a href="#" class="brand-logo">
          <img width="200" src="{{asset('images/logo/logo-deg.png')}}"  alt="">
        </a>
        <h4 class="card-body mb-1 fw-700">Estás a punto de cambiar tu contraseña</h4>
        
        <p class="card-text mb-2">Al terminar, te enviaremos a iniciar sesión de nuevo con tu nueva contraseña</p>
        <form class="auth-reset-password-form mb-2 " method="POST" action="{{ route('password.update') }}">
          @csrf
          <input type="hidden" name="token" value="{{ $token }}">
          <div class="mb-1">
            <input type="hidden" class="form-control" id="email" name="email" placeholder="john@example.com" aria-describedby="email" tabindex="1" autofocus value="{{ $email ?? old('email') }}" />
          </div>

          <div class="mb-1">
            <div class="d-flex justify-content-between">
              <label class="form-label fw-500" for="reset-password-new">Contraseña</label>
            </div>
            <div class="input-group input-group-merge form-password-toggle @error('password') is-invalid @enderror">
              <input type="password" class="form-control form-control-merge @error('password') is-invalid @enderror" id="reset-password-new" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="reset-password-new" tabindex="2" autofocus />
              <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
            @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="mb-1">
            <div class="d-flex justify-content-between">
              <label for="reset-password-confirm" class="form-label fw-500">Confirmar contraseña</label>
            </div>
            <div class="input-group input-group-merge form-password-toggle">
              <input type="password" class="form-control form-control-merge" id="reset-password-confirm" name="password_confirmation" autocomplete="new-password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="reset-password-confirm" tabindex="3" />
              <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
          </div>
          <button type="submit" class="btn btn-primary w-100  mt-1" tabindex="4" >Aceptar</button>
        </form>

         
          @if (Route::has('login'))
          <a href="{{ route('login') }}" class="fw-500 text-center my-2">
            <i data-feather="chevron-left"></i>
            Volver al Inicio de Sesión
          </a>
          @endif
      </div>
    </div>
    <!-- /Reset Password v1 -->
  </div>
</div>

@endsection