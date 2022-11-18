@extends('layouts/fullLayoutMaster')

@section('title', 'Login Page')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-auth.css')) }}">
@endsection

@section('content')
<div id="bg"></div>
<div class="auth-wrapper auth-v1 px-2">
    <div class="auth-inner py-2">
        <!-- Login v1 -->
        <div class="card p-2 mb-0 bg-white">
            <div class="card-body mx-1 text-center">
                <img width="120" class="mb-2" src="{{asset('images/logo/logo-deg.png')}}" alt="">
                <h4 class="text-center mb-1 fw-700">¡Correo Electrónico Verificado!</h4>
                <p class="card-text mb-0 text-centert">Su verificación de email ha sido realizada correctamente</p>
               <div>
                    <form class="mt-2 mb-1" method="POST" action="{{ route('desloguear') }}">
                        @csrf
                        <button type="submit" class="btn nav-link fw-500 p-0 m-0 align-baseline text-decoration-underline mx-auto">{{ __('Has click aquí para iniciar sesión') }}</button>
                    </form>
                </div> 
            </div>
        </div>
    </div>
</div>
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
