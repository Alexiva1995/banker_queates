@extends('layouts/contentLayoutMaster')

@section('vendor-script')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <!-- vendor files -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@endsection

@section('vendor-style')
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('content')
    <style>
        .fw-700 {
            font-weight: 700 !important;
        }

        @media (max-width: 767px)and(min-width:575px) {
            nav.links {
                /* width: auto!important; */
            }

        }

        @media (max-width: 332px) {

            .subir-foto,
                {
                margin-bottom: 0.8rem;
            }
        }

        .nav-tabs .nav-link.active,
        .nav-tabs .nav-item.show .nav-link {
            color: #fff;
            background-color: #07B0F2;
        }
        .card{
            border: 1px solid #05B1D966 !important;
            border-radius: 10px !important;
        }
        .nav {
            flex-wrap: nowrap;
        }   
        .nav-tabs .nav-link.active {
            position: relative;
            color: #ffffff;
        }

        .box {
            background-color: rgb(0 191 191 / 5%);
            padding: 1rem 0rem;
            margin-right: 0.25rem;
            margin-left: 0.25rem;
        }
    </style>
    <div class="d-flex my-1">
        <p class="fw-700 mb-0">Perfil</p><span class="fw-300 mx-1 text-light">|</span>
        <p class="fw-400 mb-0">Editar Perfil</p>
    </div>
    <div class="row row col-lg-11 col-md-12 col-sm-12 mt-1">
        
        <div class="col-sm-12 ">
            {{-- apartado perfil --}}
            <div class="row">
                <div class="col-lg-12 col-12 order-2 order-lg-1">
                    <nav class="" > 
                        <div class="nav d-flex nav-tabs" id="nav-tab" role="tablist" style="width: 100%">
                            <button class="nav-link active justify-content-center text-start fw-400 rounded" id="nav-home-tab"
                                data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                aria-selected="true" style="width: 15%;"><i data-feather='user' class=""></i>Account</button>
                            <button class="nav-link justify-content-center text-start fw-400 rounded" style="width: 15%;" id="nav-password-tab"
                                data-bs-toggle="tab" data-bs-target="#nav-password" type="button" role="tab"
                                aria-controls="nav-password" aria-selected="false"><i data-feather='lock'
                                    class=""></i>Password
                            </button>
                            <button class="nav-link justify-content-center text-start fw-400 rounded" style="width: 15%;" id="nav-pin-tab"
                                data-bs-toggle="tab" data-bs-target="#nav-pin" type="button" role="tab"
                                aria-controls="nav-pin" aria-selected="false"><i data-feather='lock'
                                    class=""></i>Security Ping 
                            </button> 
                            @if (Auth::user()->admin != 1)
                                {{-- <button class="nav-link" id="nav-auth-tab" data-bs-toggle="tab" data-bs-target="#nav-auth" type="button" role="tab" aria-controls="nav-auth" aria-selected="false" style="padding-inline-end:10%;"><i data-feather='git-commit'></i>Configurar Authenticator</button> --}}
                            @endif
                        </div>
                    </nav>
                    <div class="card base p-2">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                <div class="card-body p-0">
                                    <h3 class="mt-1 fw-600">Profile details</h3>
                                    <div class="d-flex align-items-center">
                                    @if (Auth::user()->range_id != null)
                                        <img class="ms-1 rounded rounded-circle"
                                            src="{{ asset('images/ensignRanges/' . Auth::user()->range_id . '.png') }}"
                                            alt="Avatar" width="140px" height="110px" data-toggle="modal"
                                            data-target="#fotos">
                                        <div>
                                        <h3 class="mb-2 fw-600">{{Auth::user()->name}} {{Auth::user()->last_name}}</h3>
                                    
                                        <h4 style="color: #9892AA;">Rango {{Auth::user()->range->name}}</h4>
                                        </div>
                                    @else
                                        <img class="ms-2 rounded rounded-circle"
                                        src="{{ asset('images/ensignRanges/0.png') }}"
                                        alt="Avatar" width="110px" height="110px" data-toggle="modal"
                                        data-target="#fotos">
                                        <div>
                                        <h3 class="mb-1 fw-600">{{Auth::user()->name}} {{Auth::user()->last_name}}</h3> 
                                        <h4 style="color: #9892AA;">Sin rango</h4>
                                    </div>
                                        @endif
                                    </div>
                                    <!--<div class="row col-lg-12 col-md-12 col-sm-12">
                                        <div class="col-lg-3 col-md-4 col-sm-4">
                                            <div class="p-1 pe-0 pb-0">
                                                    <div class="card image rounded-circle alert alert-primary">
                                                        <div class="card-body">
                                                            <div class="d-flex justify-content-center"
                                                                style="margin-top: 15px;">
                                                                <a><svg width="31" height="37" viewBox="0 0 31 37"
                                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M6.125 10C6.125 4.82233 10.3223 0.625 15.5 0.625C20.6777 0.625 24.875 4.82233 24.875 10C24.875 15.1777 20.6777 19.375 15.5 19.375C10.3223 19.375 6.125 15.1777 6.125 10ZM15.5 15.625C18.6066 15.625 21.125 13.1066 21.125 10C21.125 6.8934 18.6066 4.375 15.5 4.375C12.3934 4.375 9.875 6.8934 9.875 10C9.875 13.1066 12.3934 15.625 15.5 15.625Z"
                                                                            fill="#673DED" />
                                                                        <path
                                                                            d="M4.8934 25.6434C2.08035 28.4564 0.5 32.2718 0.5 36.25H4.25C4.25 33.2663 5.43526 30.4048 7.54505 28.295C9.65483 26.1853 12.5163 25 15.5 25C18.4837 25 21.3452 26.1853 23.455 28.295C25.5647 30.4048 26.75 33.2663 26.75 36.25H30.5C30.5 32.2718 28.9196 28.4564 26.1066 25.6434C23.2936 22.8304 19.4782 21.25 15.5 21.25C11.5218 21.25 7.70644 22.8304 4.8934 25.6434Z"
                                                                            fill="#673DED" />
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                            </div>
                                        </div>
                                        <div
                                            class="col-lg-9 col-md-8 col-sm-8 p-1 pt-md-1 pt-sm-0 text-md-start text-sm-end">
                                            <div class="h4 mt-1 text-white fw-bold">
                                                @if ($user->photo == null)
                                                    <button class="btn btn-primary subir-foto me-1 mb-sm-1 pb-sm-1 mb-50"
                                                        id="btnModalphoto">
                                                        Subir foto
                                                    </button>
                                                @else
                                                    <button class="btn btn-primary subir-foto me-1 mb-sm-1 pb-sm-1 mb-50"
                                                        id="btnModalphoto">
                                                        Subir foto
                                                    </button>
                                                    <form class="d-inline" method="POST"
                                                        action="{{ route('photo.delete') }}">
                                                        @csrf
                                                        <button class="btn btn-outline-danger mb-sm-1 me-1 mb-50">
                                                            Remover
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                            <p class="d-flex justify-content-start">JPG o PNG permitidos. Tamaño
                                                máximo 800kB.</p>
                                        </div>
                                    </div>-->
                                    <div class="mt-2 card-body" style="margin-top: -4%;">
                                        <form method="POST" action="{{ route('profile.update') }}"
                                            enctype="multipart/form-data" novalidate>
                                            @csrf
                                            <div class="row" style="margin-top: 4%;">
                                                <!--ROW 1 START-->
                                                <div class="col-sm-6">
                                                    <label for="name" class=" fw-500">Nombre<label
                                                            style="color: red;">*</label></label>
                                                    <div class="input-group mb-1">
                                                        <input type="text" name="name"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            value="{{ $user->name }}">
                                                        @error('name')
                                                            <span class="invalid-feedback d-block" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <label for="last_name" class=" fw-500">Apellido<label
                                                            style="color: red;">*</label></label>
                                                    <div class="input-group mb-1">
                                                        <input type="text" name="last_name"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            value="{{ $user->last_name }}">
                                                        @error('last_name')
                                                            <span class="invalid-feedback d-block" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row" style="margin-top: 3%;">

                                                <div class="col-sm-6">
                                                    <label for="" class=" fw-500">País <label
                                                            style="color: red;">*</label></label>

                                                    <div class="input-group mb-2 shadow-none">
                                                        <select id="countrie_id" class="rounded form-control text-dark shadow-none" name="countrie_id" required>

                                                            
                                                            @if($user->countrie_id  != null)
                                                                @foreach($country as $countries)
                                                                    <option value="{{$countries->id}}" {{$user->countrie_id == $countries->id ? 'selected' : ''}}>{{$countries->name}}</option>
                                                                @endforeach
                                                            @else
                                                                <option>Ingresa o selecciona un país</option>
                                                            @endif

                                                            @foreach($country as $countries)
                                                                <option value="{{$countries->id}}" {{old('countries') == $countries->id ? 'selected' : ''}}>{{$countries->name}}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    
                                                </div>

                                                <div class="col-sm-6">
                                                    <label for="" class="correo  fw-500">
                                                        Correo <label style="color: red;">*</label>
                                                    </label>

                                                    <div class="input-group mb-1">
                                                        <input type="text" id="email" name="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            value="{{ $user->email }}" disabled>

                                                        <input type="text" name="emailOrigin" value="{{ $user->email }}" hidden>

                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModalVerification" id="continue-button"
                                                        class="btn btn-primary" 
                                                        >
                                                       <!-- <i class="fal fa-edit" class="mx-lg-2 mx-md-2 me-sm-2"></i>-->
                                                       <img width="15px" height="15px" src="{{ asset('images/svg/edit.svg') }}">
                                                        </button>

                                                        @error('email')
                                                            <span class="invalid-feedback d-block" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="col-sm-6 offset-md-6">
                                                    <input type="hidden" aria-label="contraseña" id="password" name="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        placeholder="contraseña Take">

                                                    @error('password')
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="row" style="margin-top: 3%;">

                                                <div class="col-sm-6">
                                                    <label for="gender" class=" fw-500">
                                                        Genero 
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="input-group mb-1">
                                                        <select class=" form-select" name="gender">
                                                            <option disabled {{$user->gender == null ? 'selected' : ' ' }}>Seleccion su genero"</option>
                                                            <option value="0" {{$user->gender == '0' ? 'selected' : ' ' }}>Masculino</option>
                                                            <option value="1" {{$user->gender == '1' ? 'selected' : ' ' }}>Femenino</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <label for="" class=" fw-500">Teléfono <label
                                                            style="color: red;">*</label></label>
                                                    <div class="input-group mb-1">
                                                        <input type="enum" name="phone"
                                                            class="form-control   @error('phone') is-invalid @enderror "
                                                            placeholder="3107658734" value="{{ $user->phone }}">
                                                        @error('phone')
                                                            <span class="invalid-feedback d-block" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row" style="margin-top: 3%;">
                                                    
                                                <div class="col-sm-6">
                                                    <label for="name" class=" fw-500">Nombres del Patrocinador <label
                                                            style="color: red;">*</label></label>
                                                    @if ($user->admin != 1)
                                                        <div class="input-group mb-1">
                                                            <input type="text" class="form-control"
                                                                value="{{ $user->padre->name }}" disabled>
                                                        </div>
                                                    @else
                                                        <div class="input-group mb-1">
                                                            <input type="text" class="form-control"
                                                                placeholder="No Aplica" disabled>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="col-sm-6">
                                                    <label for="" class="correo fw-500">
                                                        Correo del Patrocinador<label style="color: red;">*</label>
                                                    </label>
                                                    @if ($user->admin != 1)
                                                        <div class="input-group mb-1">
                                                            <input type="text" class="form-control"
                                                                value="{{ $user->padre->email }}" disabled>
                                                        </div>
                                                    @else
                                                        <div class="input-group mb-1">
                                                            <input type="text" class="form-control"
                                                                placeholder="No Aplica" disabled>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="float-start modal-footer mt-2" style="border: none">
                                                <button type="submit" class="btn btn-primary" id="guardar">Guardar Cambios</button>
                                                <button type="button" id="boton01" class="btn btn-outline-danger ">
                                                    Cancelar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @include('profile.ui.password')
                            @include('profile.ui.pin')
                        </div>
                    </div>
                            {{-- @include('profile.ui.authenticator') --}}
                            {{-- @include('profile.ui.kyc') --}}
                </div>
            </div>
        </div>
    </div>
    @include('profile.components.style')
    @include('profile.components.modal-photo')
    @include('profile.components.modal-verification')
    <script type='text/javascript' src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>

    <script>
        async function getCode(){

        const codeBtn = document.getElementById('codeButton');
        const url = '{{route("getCode.user.retiro")}}'
        codeBtn.disabled = true;
        let seconds = 50;

        try {

            if( !codeBtn.disabled ) return ;

            function segundos(){
                codeBtn.textContent =`Reenviar en ${seconds}s`;
                seconds--;
                if( seconds > 0 ){
                    // console.log(seconds)
                    setTimeout(segundos,1000);
                }else{
                    codeBtn.disabled = false;
                    codeBtn.textContent = 'Obtener codigo';
                }
            }
            
            segundos();

            const response = await axios.post(url);
            const { status } = response.data;

            if( status === 'success')
            {
                toastr['success']('Por favor revise su correo', '¡Exitoso!', {
                    closeButton: true,
                    tapToDismiss: false
                });
            }


        } catch (error) {
            console.log(error);
            toastr['error']('Hubo un error por favor contacte con el administrador', '¡error!', {
                closeButton: true,
                tapToDismiss: false
            });
        }
        
    }
        let btnModalphoto = document.querySelector('#btnModalphoto');
        btnModalphoto.addEventListener("click", function(event) {
            let myModal = new bootstrap.Modal(document.getElementById('Modalphoto'), {
                keyboard: false
            })
            myModal.show();
        }, false);

        //let inputPassword = document.querySelector('#inputPassword');
        inputPassword.addEventListener("click", function(event) {
            event.preventDefault();
            document.getElementById('password').setAttribute('type', 'password');
            document.getElementById('email').removeAttribute("disabled");

            alert(element);
        }, false);



        $("#boton01").click(function() {
            setTimeout(function() {
                window.location = '{{ route('profile.profile') }}';
            });
        });

        $("#boton02").click(function() {
            setTimeout(function() {
                window.location = '{{ route('profile.profile') }}';
            });
        });
        $("#boton03").click(function() {
            setTimeout(function() {
                window.location = '{{ route('profile.profile') }}';
            });
        });

        $('#countrie_id').select2();

        function isNumberKey(evt){
            var charCode = (evt.which) ? evt.which : evt.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

    </script>
@endsection
