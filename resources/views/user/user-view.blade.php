@extends('layouts/contentLayoutMaster')

@section('vendor-script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<!-- vendor files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@endsection

@section('content')
<style>

</style>

@if (auth()->user()->admin==='1')
<div class="d-flex my-1">
    <p class="fw-700 mb-0">Perfil de</p><span class="fw-300 mx-1 text-light">|</span>
    <p class="fw-300 mb-0">{{ $user->email }}</p>
</div>
<div class="row row col-lg-11 col-md-12 col-sm-12">
    <nav class="links col-sm-4">
        <div class="nav nav-tabs flex-column" id="nav-tab" role="tablist">
            <button class="btn btn-primary rounded active justify-content-start text-start" id="nav-home-tab"
                data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                aria-selected="true"><i data-feather='user' class="mx-lg-2 mx-md-2 me-sm-2"></i>Datos Generales</button>

        </div>
    </nav>
    <div class="col-sm-8 ">
        {{-- apartado perfil --}}
        <div class="row">
            <div class="col-lg-12 col-12 order-2 order-lg-1">
                <div class="card base p-2">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                            <div class="card-body p-0">
                                <div class="row col-lg-12 col-md-12 col-sm-12">
                                    <div class="col-lg-3 col-md-4 col-sm-4">
                                        <div class="p-1 pe-0 pb-0">
                                            @if ($user->photo == null)
                                            <div class="card image rounded-circle bg-light-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-center"
                                                        style="margin-top: 15px;">
                                                        <a><svg width="31" height="37" viewBox="0 0 31 37" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
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
                                            @else
                                                <img class="d-block rounded-circle"
                                                    src="{{ asset('storage/photo-profile/' . $user->photo) }}"
                                                    alt="user-image" width="110px" height="110px">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-8 p-1 pt-md-1 pt-sm-0 text-md-start text-sm-end">
                                        
                                    </div>
                                </div>
                                <div class="card-body" style="margin-top: -4%;">
                                    <form >
                                        @csrf
                                        <div class="row" style="margin-top: 4%;">
                                            <!--ROW 1 START-->
                                            <div class="col-sm-6">
                                                <label for="name" class=" fw-500">
                                                    Nombre
                                                <label style="color: red;">
                                                    *
                                                </label>
                                            </label>
                                                <div class="input-group mb-1">
                                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                                        value="{{ $user->name }}" disabled>
                                                    @error('name')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="last_name" class=" fw-500">
                                                    Apellido
                                                    <label style="color: red;">
                                                        *
                                                    </label>
                                                </label>
                                                <div class="input-group mb-1">
                                                    <input type="text" name="last_name" class="form-control @error('name') is-invalid @enderror"
                                                        value="{{ $user->last_name }}" disabled>
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
                                                <label for="" class=" fw-500">
                                                    País
                                                    <label style="color: red;">
                                                        *
                                                    </label>
                                                </label>
                                                <div class="input-group mb-1">
                                                    @if ($user->prefix_id != null)
                                                    <input type="text" name="prefix_id" class="form-control" placeholder="Bogotá" value="{{ $user->prefix->pais }}" disabled>
                                                    @else
                                                    <input type="text" name="prefix_id" class="form-control"
                                                        placeholder="Bogotá" disabled>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="" class="correo  fw-500">
                                                    Correo 
                                                    <label style="color: red;">
                                                        *
                                                    </label>
                                                </label>
                                                <div class="input-group mb-1">
                                                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                                                        value="{{ $user->email }}" disabled>
                                                    @error('email')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row" style="margin-top: 3%;">

                                            <div class="col-sm-6">
                                                <label for="gender" class=" fw-500">
                                                    Genero
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="input-group mb-1">
                                                    <select class=" form-select" name="gender" disabled>
                                                        <option disabled {{$user->gender == null ? 'selected' : '' }}>
                                                            Seleccion su genero"
                                                        </option>
                                                        <option value="0" {{$user->gender == '0' ? 'selected' : '' }}>
                                                            Masculino
                                                        </option>
                                                        <option value="1" {{$user->gender == '1' ? 'selected' : '' }}>
                                                            Femenino
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="" class=" fw-500">
                                                    Teléfono
                                                    <span style="color: red;">
                                                        *
                                                    </span>
                                                </label>
                                                <div class="input-group mb-1">
                                                    <input type="enum" name="phone" class="form-control   @error('phone') is-invalid @enderror "
                                                        placeholder="3107658734" value="{{ $user->phone }}" disabled>
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
                                                    <input type="text" class="form-control" placeholder="No Aplica"
                                                        disabled>
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
                                                    <input type="text" class="form-control" placeholder="No Aplica"
                                                        disabled>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- @include('profile.ui.password') --}}
                        {{-- @include('profile.ui.authenticator') --}}
                        {{-- @include('profile.ui.kyc') --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@include('profile.components.style')
@include('profile.components.modal-photo')
<script type='text/javascript' src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    let btnModalphoto = document.querySelector('#btnModalphoto');
        btnModalphoto.addEventListener("click", function(event) {
            let myModal = new bootstrap.Modal(document.getElementById('Modalphoto'), {
                keyboard: false
            })
            myModal.show();
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
</script>
@endsection