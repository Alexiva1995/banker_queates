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
</style>
@section('content')
<div id="bg"></div>
  <div class="auth-wrapper auth-v1 px-2">
    <div class="auth-inner py-2">
      <div class="auth-inner py-2" style="max-width: 500px;">
        <div class="card mb-0 p-2">
          <div class="card-body">
            <a href="#" class="brand-logo">
              <img src="{{asset('images/login/connect.png')}}" alt="">
            </a>
            <h2 class="text-center" style="font-weight:bold;letter-spacing:4px;">Acceso al Backoffice</h2>
             <P class="mt-1">Para acceder al backoffice debes activar el pase por un costo de 50 USDT
                  </P>
          </div>

          <form method="POST" action="{{ route('active') }}">
            @csrf
            <input type="hidden" name="user" value="{{$user->id}}">
            <div class="form-group row justify-content-center text-center">   
      
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
               <button type="submit" class="btn w-100 text-white" tabindex="4" style="font-weight:bold;background: linear-gradient(90deg, #0255B8 0%, #4C9AF6 100%);">Comprar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
