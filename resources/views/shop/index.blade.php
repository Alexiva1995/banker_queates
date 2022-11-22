@extends('layouts/contentLayoutMaster')

@section('title', 'Tienda Bronce')

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
    .ico-sm{
        width: 2rem!important;
        height: 2rem!important;
    }
    @media screen and (max-width: 575px) and (min-width:400px) {
        .mobile{
            justify-content: center !important;
        }
        .width-5 {
            width: 50% !important;
        }
    }
    @media screen and (max-width: 768px) and (min-width:575px) {
        .mobile{
            justify-content: space-around  !important;
        }
    }
</style>
@section('content')
<div class="container-fluid container-custom">
    <div class="d-flex my-1">
        <p class="fw-700 mb-0">Mercado</p><span class="fw-300 mx-1 text-light">|</span><p class="fw-300 mb-0">Licencias</p>
    </div>

    <div id="adminServices" class="mt-1">

        {{-- @if ($order != null ? $order->status == 0 : false)
            @include('shop.components.paymentPending')
        @endif --}}

        <div class="row justify-content-center">
            <div class="alert alert-info d-flex p-1 my-75">
                <i data-feather='info' class="text-info me-75 ico-sm"></i>
                Tu paquete será llevado al 200%, en donde ese 200% incluye el 100% del capital aportado. Es decir, traes 1.000 y sales con 2.000. Dicho de otra manera: Recibes tus 1.000 y 1.000 de Ganancia, en total recibes 2.000
            </div>
            <div class="mobile row mt-2 px-0 match-height">
                @foreach ($licenses as $package)

                   <div class="col-md-4 col-lg-3 col-sm-4 wm-27">
                        <div class="card">
                            <div class="d-flex justify-content-center">
                                @if ($package->image === null)
                                    <div class="card rounded-0 mb-0 border-0" style="width: 80%;">
                                        <div style="height: 161px; width:161px" class="text-center d-flex align-items-center justify-content-center">
                                            <h4>{{ $package->name }}</h4>
                                        </div>
                                        {{-- <img src="{{ asset('images/MembershipsPackage/Bronce/' . $package->image) }}"
                                            alt="{{ $package->image }}" height="161" width="161"
                                            class="d-block rounded mx-auto" /> --}}
                                        {{-- <h2 class="fw-600 font-large-1 text-switch position-absolute mb-0 top-50 start-50 translate-middle">${{ number_format($package->amount, 0,',' , '.') }}</h2> --}}

                                    </div>
                                @else
                                    <div class="card rounded-0 mb-0 border-0" style="width: 80%;">
    
                                        <img src="{{ asset('images/MembershipsPackage/Bronce/' . $package->image) }}"
                                            alt="{{ $package->image }}" height="161" width="161"
                                            class="d-block rounded mx-auto" />
                                        {{-- <h2 class="fw-600 font-large-1 text-switch position-absolute mb-0 top-50 start-50 translate-middle">${{ number_format($package->amount, 0,',' , '.') }}</h2> --}}

                                    </div>
                                @endif
                            </div>
                            <div class="card-body px-sm-2">
                                <small class="text-light">Ganancias</small>
                                <h2 class="fw-600 mb-75 text-center">{{ "USDT ".$package->amount }}</h2>
                                
                                    {{-- <form class="d-grid gap-2" action="{{ route('shop.transactionCompra') }}" --}}
                                    <form class="d-grid gap-2" action="{{ route('makePurchase') }}"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="package" value="{{ $package->id }}">
                                        <input type="hidden" name="amount" value="{{ $package->amount }}">
                                        <button class="btn btn-primary w-100" 
                                            {{ $package->disabled == true ? 'disabled' : '' }}>{{ $package->text }}
                                        </button>
                                   </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
<script>
// if($('#staticBackdrop').length != 0) {
//      $.blockUI();
// }
</script>
@endsection
