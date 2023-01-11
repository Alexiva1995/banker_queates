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
            
        }
    </style>
    <div class="d-flex my-1">
        <p class="fw-700 mb-0">Profile</p><span class="fw-300 mx-1 text-light">|</span>
        <p class="fw-400 mb-0">Edit Profile</p>
    </div>
    <div class="row" >
        
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
                                    class=""></i>Security Pin
                            </button> 
                            @if (Auth::user()->admin != 1)
                            @endif
                        </div>
                    </nav>
                    <div class="card p-2">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                <div class="card-body p-0">
                                    <h3 class="mt-1 fw-600">Profile details</h3>
                                    <div class="d-flex justify-content-start">
                                    @if (Auth::user()->range_id != null)
                                        <img class=" rounded rounded-circle"
                                            src="{{ asset('images/ensignRanges/' . Auth::user()->range_id . '.png') }}"
                                            alt="Avatar" width="140px" height="110px" data-toggle="modal"
                                            data-target="#fotos">
                                        <div>
                                        <h3 class="ms-2 fw-600">{{Auth::user()->name}} {{Auth::user()->last_name}}</h3>
                                    
                                        <h4 class="ms-2" style="color: #9892AA;">Range {{Auth::user()->range->name}}</h4>
                                        </div>
                                    @else
                                        <img class=" rounded rounded-circle"
                                        src="{{ asset('images/ensignRanges/0.png') }}"
                                        alt="Avatar" width="110px" height="110px" data-toggle="modal"
                                        data-target="#fotos">
                                        <div>
                                        <h3 class="mb-1 fw-600">{{Auth::user()->name}} {{Auth::user()->last_name}}</h3> 
                                        <h4 style="color: #9892AA;">Not range</h4>
                                    </div>
                                        @endif
                                    </div>
                                   
                                    <div class="mt-2 card-body" style="margin-top: -4%;">
                                        <form method="POST" action="{{ route('profile.update') }}"
                                            enctype="multipart/form-data" novalidate>
                                            @csrf
                                            <div class="row" style="margin-top: 4%;">
                                                <!--ROW 1 START-->
                                                <div class="col-sm-6">
                                                    <label for="name" class=" fw-500">Name<label
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
                                                    <label for="last_name" class=" fw-500">Last Name<label
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
                                                    <label for="" class=" fw-500">Country <label
                                                            style="color: red;">*</label></label>

                                                    <div class="input-group mb-2 shadow-none">
                                                        <select id="countrie_id" class="rounded form-control text-dark shadow-none" name="countrie_id" required>

                                                            
                                                            @if($user->prefix_id  != null)
                                                                @foreach($country as $countries)
                                                                    <option value="{{$countries->id}}" {{$user->prefix_id == $countries->id ? 'selected' : ''}}>{{$countries->pais}}</option>
                                                                @endforeach
                                                            @else
                                                                <option>Enter or select a country</option>
                                                            @endif

                                                            @foreach($country as $countries)
                                                                <option value="{{$countries->id}}" {{old('countries') == $countries->id ? 'selected' : ''}}>{{$countries->pais}}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    
                                                </div>

                                                <div class="col-sm-6">
                                                    <label for="" class="correo  fw-500">
                                                        Email <label style="color: red;">*</label>
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
                                                    <label for="name" class=" fw-500">Sponsor Names<label
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
                                                        Sponsor Email<label style="color: red;">*</label>
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
                                                <button type="submit" class="btn btn-primary" id="guardar">Save Changes</button>
                                                <button type="button" id="boton01" class="btn btn-outline-danger ">
                                                    Cancel
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
         async function checkCode() {
            const pin = document.getElementById('code')
            const code = {
                pin: pin.value
            }
            console.log(pin.value);
            const url = '{{route("check-code")}}'
            console.log(url);
            const response = await axios.post(url, code);
            console.log(response);
            const { status } = response.data;
            if (status === 'success') {
                $("#exampleModalVerification").modal('hide')
                toastr['success']('Verified Code', '¡Successful!', {
                    closeButton: true,
                    tapToDismiss: false
                });
                const email = document.getElementById('email')
                email.disabled = false
            } else
            toastr['error']('The codes do not match', '¡error!', {
                closeButton: true,
                tapToDismiss: false
            });
        }
        async function getCode(){
        const codeBtn = document.getElementById('codeButton');
        const url = '{{route("getCode.user.retiro")}}'
        codeBtn.disabled = true;
        let seconds = 50;

        try {

            if( !codeBtn.disabled ) return ;
            function segundos(){
                codeBtn.textContent =`Forward in ${seconds}s`;
                seconds--;
                if( seconds > 0 ){
                    // console.log(seconds)
                    setTimeout(segundos,1000);
                }else{
                    codeBtn.disabled = false;
                    codeBtn.textContent = 'Get code';
                }
            }
            
            segundos();

            const response = await axios.post(url);
            const { status } = response.data;

            if( status === 'success')
            {
                toastr['success']('Please check your mail', '¡Successful!', {
                    closeButton: true,
                    tapToDismiss: false
                });
            }


        } catch (error) {
            console.log(error);
            toastr['error']('There was an error please contact the administrator', '¡error!', {
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
