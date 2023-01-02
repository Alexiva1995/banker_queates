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

            padding-right: 109px !important;
            padding-left: 0px !important;
        }
        .width-5 {
            width: 50% !important;
        }
        .media{
            width: 100%;
        }
        .wm-27 {
            max-width: 381px!important;
            min-width: 238px!important;
        }
        div.title-mobile{
            width: 161px !important;
            padding-left: 37%;
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
        <p class="fw-700 mb-0" style="font-weight: 700; color:#000">Market</p><span class="fw-300 mx-1 text-light">|</span>
        <p class="fw-700 mb-0" style="font-weight: 700; color:rgba(0, 0, 0, 0.514)">Licences</p>
    </div>

    <div id="adminServices" class="mt-1">

        {{-- @if ($order != null ? $order->status == 0 : false)
            @include('shop.components.paymentPending')
        @endif --}}

        <div class="row justify-content-center">
           {{-- <div class="alert alert-info d-flex p-1 my-75">
               <i data-feather='info' class="text-info me-75 ico-sm"></i>
                Tu paquete será llevado al 200%, en donde ese 200% incluye el 100% del capital aportado. Es decir, traes 1.000 y sales con 2.000. Dicho de otra manera: Recibes tus 1.000 y 1.000 de Ganancia, en total recibes 2.000
            </div>--}}
            <div class="mobile row mt-2 px-0 match-height">
                @foreach ($licenses as $package)
                    <div class="col-sm-4">
                        <div class="">
                            <div class="card media">
                                <div class="d-flex justify-content-center">
                                    @if ($package->image === null)
                                        <div class="card rounded-0 mb-0 border-0" style="width: 100%;">
                                            <div style="height: 161px; width:161px" class="text-center d-flex align-items-center justify-content-center title-mobile">
                                                 <img src="{{ asset('images/licencias/' . $package->image) }}"
                                                alt="{{ $package->image }}"
                                                class="d-block rounded mx-auto" />
                                            </div>
                                            {{-- <img src="{{ asset('images/MembershipsPackage/Bronce/' . $package->image) }}"
                                                alt="{{ $package->image }}" height="161" width="161"
                                                class="d-block rounded mx-auto" /> --}}
                                            {{-- <h2 class="fw-600 font-large-1 text-switch position-absolute mb-0 top-50 start-50 translate-middle">${{ number_format($package->amount, 0,',' , '.') }}</h2> --}}

                                        </div>
                                    @else
                                        <div class="card mb-0 border-0" style="width: 100%;">

                                            <img src="{{ asset('images/licencias/' . $package->image) }}"
                                                alt="{{ $package->image }}"
                                                class="d-block rounded mx-auto" style="width: 200px;margin-top: 6%;"/>
                                            {{-- <h2 class="fw-600 font-large-1 text-switch position-absolute mb-0 top-50 start-50 translate-middle">${{ number_format($package->amount, 0,',' , '.') }}</h2> --}}

                                        </div>
                                    @endif
                                </div>
                                <div class="card-body text-center">
                                    <small class="text-light" style="font-size: 12px; color:#9892AA">Deposit Until {{$package->description}} USDT</small>
                                    <br>
                                    <h2 class="fw-600 mb-75 text-center" style="color: #04D99D;margin-bottom: 0!important;font-size:40px">{{ "USDT ".$package->amount }}</h2>
                                </div>
                            </div>
                           
                                <input type="hidden" name="package" value="{{ $package->id }}">
                                <input type="hidden" name="amount" value="{{ $package->amount }}">
                                <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#ModalPayment{{ $package->id }}"
                                    {{ $package->disabled == true ? 'disabled' : '' }}>{{ $package->text }}
                                </button>
                        </div>
                    </div>
                    @include('shop.components.modalPayment')
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
