@extends('layouts/contentLayoutMaster')

@section('title', 'Tienda')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection
@section('page-style')
<!-- Page css files -->
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection
<style>
    .wm-27{
        max-width: 271px!important;
        min-width: 238px!important;
    }

    @media screen and (max-width: 575px) and (min-width:425px){ 
        .width-5{
            width: 50%!important;
        }
    }
</style>
@section('content')
<div id="adminServices">

    <div class="d-flex my-2">
        <p class="fw-700">Activación Manual de Membresia</p><span class="fw-normal mx-1">|</span><p class="">{{ $user->email }}</p>    
    </div>
    @if (!empty($data))
        <p class="mt-2 mb-1">Por favor selecciona un mercado</p>
        
        <div>
        <ul class="nav nav-tabs" role="tablist">
            @foreach ($data as $type )
                <li class="nav-item">
                    <a class="nav-link {{ $type->id == 1 ? 'active' : '' }}" data-bs-toggle="tab" href="#home-{{ $type->id }}" role="tab">{{ $type->name }}</a>
                </li>
            @endforeach
        </ul>
        
        <div class="tab-content">
            @foreach ($data as $type)
                <div class="tab-pane {{ $type->id == 1 ? 'active' : '' }} " id="home-{{$type->id}}" aria-labelledby="home{{$type->id}}-tab" role="tabpanel">
                    <div class="row mt-3">
                        @foreach ($type->MembershipPackage as $package)
                            <div class="col-md-4 col-lg-3 col-sm-4 wm-27">
                                <div class="card">
                                    <div class="d-flex justify-content-center">
                                        @if ($package->image != null)
                                           <div class="card rounded-0 mb-0 border-0" style="width: 80%;">
                                            <img src="{{ asset('images/MembershipsPackage/'.$type->name.'/' . $package->image) }}"
                                                alt="{{ $package->image }}" height="161" width="161"
                                                class="d-block rounded mx-auto" />
                                                {{-- <h2 class="fw-600 font-large-1 text-switch position-absolute mb-0 top-50 start-50 translate-middle">${{ number_format($package->amount, 0,',' , '.') }}</h2> --}}
                                        </div>
                                        @else
                                            <div class="card mt-2 rounded-0 mb-1 border-0" style="width: 80%; height: 9rem; background-color: #F2F4F8;">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-center">
                                                        <a>
                                                            <img src="{{ asset('images/Dashboard/image.svg') }}"
                                                                alt="Avatar" height="60" width="50"
                                                                class="d-block rounded mt-1"
                                                                style="opacity: 0.3;" />
                                                        </a>
                                                            <h2 class="fw-600 font-large-1 text-switch position-absolute mb-0 top-50 start-50 translate-middle">${{ $package->amount }}</h2>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-body px-sm-2">
                                        <small class="text-light">Ganancias</small>
                                        <h2 class="fw-600 mb-75">{{ $package->rentability }}% ~ 200%</h2>
                                            <form class="" action="{{route('activation.store')}}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="package" value="{{ $package->id }}">
                                                <input type="hidden" name="title" value="{{$type->id}}">
                                                <input type="hidden" name="user" value="{{$user->id}}">
                                                @if ($package->disabled == true)
                                                    <div class="d-flex justify-content-between flex-column">
                                                        @if($package->text==='Adquirido')
                                                        {{-- {{ dd($package->comision) }} --}}
                                                        <div class="form-check mb-75">
                                                            <label class="form-check-label" for="rentability{{ $package->id }}">¿Genera Rentabilidad?</label>
                                                            <input class="form-check-input" disabled type="checkbox" name="rentability" id="rentability{{ $package->id }}" {{ $package->pay_utility === 0 ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check mb-75">
                                                            <label class="form-check-label" for="comision{{ $package->id }}">¿Genera Comisión?</label>
                                                            <input class="form-check-input" disabled type="checkbox" name="comision" id="comision{{ $package->id }}" {{ $package->comision === true ? 'checked' : '' }}>
                                                        </div>
                                                        <button class="btn btn-primary" disabled>Adquirido</button> 
                                                        @else 
                                                        <div class="form-check mb-75">
                                                            <label class="form-check-label" for="rentability{{ $package->id }}">¿Genera Rentabilidad?</label>
                                                            <input class="form-check-input" disabled type="checkbox" name="rentability" id="rentability{{ $package->id }}" >
                                                        </div>
                                                        <div class="form-check mb-75">
                                                            <label class="form-check-label" for="comision{{ $package->id }}">¿Genera Comisión?</label>
                                                            <input class="form-check-input" disabled type="checkbox" name="comision" id="comision{{ $package->id }}">
                                                        </div>
                                                        <button class="btn btn-primary" disabled>Adquirido</button>  
                                                        @endif
                                                    </div>
                                                @else
                                                    <div class="d-flex justify-content-between flex-column">
                                                        <div class="form-check mb-75">
                                                            <label class="form-check-label" for="rentability{{ $package->id }}">¿Genera Rentabilidad?</label>
                                                            <input class="form-check-input" type="checkbox" name="rentability" id="rentability{{ $package->id }}" >
                                                        </div>
                                                        <div class="form-check mb-75">
                                                            <label class="form-check-label" for="comision{{ $package->id }}">¿Genera Comisión?</label>
                                                            <input class="form-check-input" type="checkbox" name="comision" id="comision{{ $package->id }}" >
                                                        </div>

                                                        {{-- <button class="btn btn-primary me-1" type="submit" name="bond" value="1">{{ $package->textBono }}</button>   
                                                        <button class="btn btn-primary" type="submit" name="bond" value="0">{{ $package->textNone }}</button> --}}
                                                   
                                                        <button class="btn btn-primary" type="submit" name="bond" value="0">{{ $package->upgrade ? 'Upgrade' : 'Comprar Paquete'}}</button>
                                                    </div>
                                                @endif
                                            </form>
                                    </div>
                                </div>
                            </div>
                            
                        @endforeach
                    </div>   
                </div>
            @endforeach
        </div>
        
        </div>
    @else
    <!--  <p class="mt-2 mb-1">El usuario <strong>{{$user->name}}</strong> no tiene la membresia anual activada</p>
        <div class="row">
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 width-5">
                    <div class="card">
                        <div class="d-flex justify-content-center">
                            <div class="card mt-2 rounded-0 mb-1" style="width: 80%; height: 9rem; background-color: #F2F4F8;">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center">
                                        <a><img src="{{asset('images/Dashboard/image.svg')}}" alt="Avatar" height="60" width="50" class="d-block rounded mt-1" style="opacity: 0.3;"/></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-sm-2">
                            <p name="member" class="card-text fw-bolder mb-0">Membresía</p>
                            <h2>50 USD</h2>
                            <p class="card-text mb-1"><strong>Depósito</strong> 50 USD</p>
                            <form class="d-grid gap-2" action="{{route('activation.store')}}" method="POST">
                                @csrf
                                <input type="hidden" name="package" value="50">
                                <input type="hidden" name="title" value="Membresía Anual">
                                <input type="hidden" name="user" value="{{$user->id}}">
                                <button type="submit" class="btn btn-primary" name="bond" value="none">Activar</button>
                            </form>
                            </div>
                        </div>
                </div>
        </div>--> 
    @endif
    
</div>
@endsection

@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
@section('page-script')
<!-- Page js files -->
@endsection