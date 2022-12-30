@extends('layouts/fullLayoutMaster')

@section('title', 'Reset Password')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-auth.css')) }}">
@endsection

@section('content')
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
    <!-- la clase bg1 se encuentra en el archivo _variables.scss-->

    <div class="auth-wrapper auth-v1 px-2 bg1">
        <div class="auth-inner py-2">
            <div class="card p-2 mb-0 bg-white">
                <a href="#" class="brand-logo">
                    <img width="200" src="{{asset('images/logo/logo-deg.png')}}"  alt="">
                </a>
                <div class="card-body mx-1 text-center">
                    <h4 class="text-center mb-1 fw-700">Check your email and follow the instructions</h4>
                    <p class="card-text mb-3 text-center">We have sent you an email with instructions to change your password. If you can't find it, check your spam folder.</p>
                    <a href="{{ route('password.request') }}" class="btn btn-primary w-75 fw-500 align-baseline mb-0">{{ __('Do you want to request another?') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection