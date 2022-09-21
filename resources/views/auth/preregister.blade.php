@extends('layouts/fullLayoutMaster')

@section('title', 'Register Page')

@section('page-style')

{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-auth.css')) }}">
@endsection
<script>
   import "@fontsource/dm-sans";
   
</script>
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

</style>
@section('content')
@php
$referred = null;
@endphp
@if ( request()->referred_id != null )
@php
$referred = DB::table('users')
->select('name')
->where('ID', '=', request()->referred_id)
->first();
@endphp
@endif


<video id="bg" loop autoplay  muted>
   <!--  <source src="{{asset('Dashboard/LOGIN_v1.mp4')}}" /> -->
</video>

<div class="auth-wrapper auth-v1 px-2">
    <div class="auth-inner py-2" style="max-width: 500px;">
        <!-- Register v1 -->
        <div class="card mb-0" style="border: 2px solid white;background-color:white;">
            <div class="card-body">
                <a href="#" class="brand-logo">
                    <img src="{{asset('images/login/connect.png')}}" alt="">
                </a>
                <p class="text-align" style="color:#5E7382; font-size: 18px; font-weight: 800;">Bienvenido a Connect <img src="{{asset('images/login/mano.png')}}" alt="" style="position: absolute;margin-top: -1px;margin-left: 2px;"></p>


                    <label class="text-align mb-1" style="font-size: 15px">Pre registro.</label>
                    <form class="auth-register-form mt-2" id="the_form" method="POST" action="{{ route('preregister.store') }}" enctype="multipart/form-data">
                        @csrf  
                        <label for="register-username" class="form-label"><strong>Nombres Y Apellidos <span style="color:red; font-size:15px">*</span></strong></label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="register-username" name="name" placeholder="Ingresa tus nombres y apellidos" aria-describedby="register-username" style="background-color: white;border-color: #dfdfdf; color: rgb(0, 0, 0);" autofocus value="{{ old('name') }}"  required/>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <label for="register-email" class="form-label"><strong>Email</strong> <span style="color:red; font-size:15px">*</span></label> 
                        <div class="input-group mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="register-email" name="email" placeholder="Ingresa tu email" aria-describedby="register-email"  style="background-color: white;border-color: #dfdfdf; color: rgb(0, 0, 0);" value="{{ old('email') }}" required />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <label for="register-phone" class="form-label"><strong>Teléfono</strong>  <span style="color:red; font-size:15px">*</span></label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="register-phone" name="phone" placeholder="Ingresa tu número de teléfono" aria-describedby="register-phone" style="background-color: white;border-color: #dfdfdf; color: rgb(0, 0, 0);" autofocus value="{{ old('phone') }}" required />
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <label for="register-country" class="form-label"><strong>País</strong>  <span style="color:red; font-size:15px">*</span></label>
                        <div class="input-group mb-3">
                          {{--  <input type="text" class="form-control @error('country') is-invalid @enderror" id="register-country" name="country" placeholder="Ingresa o selecciona un país" aria-describedby="register-country"  style="background-color: white;border-color: #dfdfdf; color: rgb(0, 0, 0);" autofocus value="{{ old('name') }}" />
                            @error('country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror--}}
                            <select id="countrie_id" class="rounded form-control text-dark" name="countrie"  required>
                                <option disabled >Seleccione un Pais</option>
                                @foreach($countrie as $item)
                                        <option value="{{$item->id}}" {{old('countrie') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                @endforeach
                                </option>
                            </select>
                        </div>

                        <label class="form-label"><strong>Método de pago</strong>  <span style="color:red; font-size:15px">*</span></label>
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
                                    @endforeach
                                @endif
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="type_payment" id="flexRadioDefault2" value="futswap" required>
                                <label class="form-check-label" for="flexRadioDefault2">
                                  Futswap Pay
                                </label>
                              </div>
                        </div>
                        
                        <label for="register-password" class="form-label"><strong>Contraseña</strong>  <span style="color:red; font-size:15px">*</span></label>
                        <div class="input-ggroup mb-3">
                            <div class="input-group input-group-merge form-password-toggle @error('password') is-invalid @enderror">
                                <input type="password" class="form-control form-control-merge @error('password') is-invalid @enderror" id="register-password" style="background-color: white;border-color: #dfdfdf; color: rgb(0, 0, 0);" name="password" placeholder="Ingresa tu contraseña" aria-describedby="register-password"  required />                            
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> 
                            @enderror
                        </div>

                        <label for="register-password-confirm" class="form-label"><strong>Repetir Contraseña</strong>  <span style="color:red; font-size:15px">*</span></label>
                        <div class="input-group mb-3">
                            <div class="input-group input-group-merge form-password-toggle">
                                <input type="password" class="form-control form-control-merge" id="register-password-confirm" style="background-color: white;border-color: #dfdfdf; color: rgb(0, 0, 0);" name="password_confirmation" placeholder="Repite tu Contraseña" aria-describedby="register-password"  required/>
                            </div>
                        </div>
                        @if (!empty($data))
                        @include('auth.components.activationManual')
                        @endif
                        <button id="boton" class="btn w-100 text-white" style="font-weight:bold;">Pre Registrarse</button>
                    </form>

               {{--  <p class="text-center mt-2">
                    <a class="text-center" style="color:#5E7382">¿Ya tienes una cuenta?</a>
                    @if (Route::has('login'))
                       <a class="fw-bold" href="{{ route('login') }}" style="color: #0255B8; font-weight: 800; text-decoration-line: underline;">
                           <strong>Ingresar</strong>
                        </a>
                    @endif
                </p> --}}
            </div>
        </div>
         
    </div>
</div>

<script>

    $('#boton').click(function(){
        e.prevenDefault()
        validateInputs();
    });

    function validateInputs()
    {
        let name =  $('#register-username').val();
        let email = $('#register-email').val();
        let phone = $('#register-phone').val();
        let country = $('#countrie_id').val();
        let type_payment = $('input:radio[name=type_payment]:checked').val()
        let password = $('#register-password').val();
        let confirm_password = $('#register-password-confirm').val();

        if(name != '' && email != '' && phone != '' && country != '' && type_payment != '' && password != '' && confirm_password  != '')
        {
            console.log("hola")
            //$('#the_form').submit();
        }
        else{
            Swal.fire({
            title: 'Warning!',
            text: 'Debe llenar todos los campos!'
            })
        }
    }

    function showModal(){
        $("#ModalActivacionM").modal("show");
    }
</script>
@endsection