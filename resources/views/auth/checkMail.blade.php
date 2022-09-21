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

   .form-check-input:checked {
        background-color: #0255B8 !important;
        border-color: #0255B8 !important;
    }
    a.reenviar {
      text-align: center !important;
      margin-top: -1rem;
      color:#0255B8 !important;
    }
    
</style>
@section('content')
  <div id="bg">
   <!--  <img src="{{asset('images/login/bg-login.png')}}" /> -->
  </div>
  <div class="auth-wrapper auth-v1 px-2">
    <div class="auth-inner py-2">
      <div class="auth-inner py-2" style="max-width: 500px;">
        <div class="card mb-0 p-2" style="border: 2px solid white;background-color:white;">
          <div class="card-body">
            <a href="#" class="brand-logo">
              <img src="{{asset('images/login/connect.png')}}" alt="">
            </a>
            <h2 class="text-center" style="font-weight:bold;letter-spacing:4px;color:#0255B8;">Codigo Email</h2>
          </div> 
          <form method="POST" action="{{ route('check.mail', $userto->id) }}">
            @csrf 

            <div class="form-group row justify-content-center text-center">   
              <div class="col-12 col-lg-8">
                <div class="form-group">
                  <label for="code_verification" class="col-form-label">
                    
                  </label>
                  <input 
                    id="code_verification" 
                    type="text"
                    class="form-control"
                    name="code_verification"
                    value=""
                    required
                    autofocus>
                  <input type="hidden" name="id" value="{{$userto->id}}">
                </div>
              </div>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
              <button type="submit" class="btn mt-2 text-center text-white" style="background:#0255B8;">ENVIAR</button>
              <a href="{{route('check.mail',$userto->id)}}" class="reenviar">Obtener un nuevo email</a>
            </div>
          </form> 
        </div>
      </div>
    </div>
  </div>
@endsection
