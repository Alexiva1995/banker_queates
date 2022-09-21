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
    .fw-700 {
        font-weight: 700 !important;
    }

    @media screen and (max-width: 575px) and (min-width:425px) {
        .width-5 {
            width: 50% !important;
        }
    }
</style>
@section('content')
    <div id="adminServices">

        @if ($order != null ? $order->status == 0 : false)
            @include('shop.components.paymentPending')
        @endif
        <div class="d-flex my-2">
            <p style="color:#808E9E;" class="fw-700">Paquetes</p><span class="fw-normal mx-1">|</span>
            <p class="">Adquirir Paquetes</p>
        </div>

        <p class="mt-2 mb-1">Por favor selecciona un mercado</p>

        <div>
            <ul class="nav nav-tabs" role="tablist">
                @foreach ($data as $type)
                  
                        <li class="nav-item">
                            <a class="nav-link {{ $type->id == 1 ? 'active' : '' }}"
                                data-bs-toggle="tab" href="#home-{{ $type->id }}" role="tab">{{ $type->name }}</a>
                        </li>
                 
                @endforeach
            </ul>

            <div class="tab-content">

                @foreach ($data as $type)
                    <div class="tab-pane {{ $type->id == 1 ? 'active' : '' }} " id="home-{{ $type->id }}"
                        aria-labelledby="home{{ $type->id }}-tab" role="tabpanel">
                        <div class="row">
                            @foreach ($type->MembershipPackage as $package)
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 width-5">
                                    <div class="card">
                                        <div class="d-flex justify-content-center">
                                            @if ($package->image != null)
                                                <div class="card mt-2 rounded-0 mb-1" style="width: 80%; height: 9rem;">
                                                    <img src="{{ asset('images/membershipsPackage/' . $package->image) }}"
                                                        alt="{{ $package->image }}" height="125"
                                                        class="d-block rounded" />
                                                </div>
                                            @else
                                                <div class="card mt-2 rounded-0 mb-1"
                                                    style="width: 80%; height: 9rem; background-color: #F2F4F8;">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-center">
                                                            <a><img src="{{ asset('images/Dashboard/image.svg') }}"
                                                                    alt="Avatar" height="60" width="50"
                                                                    class="d-block rounded mt-1"
                                                                    style="opacity: 0.3;" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="card-body px-sm-2">
                                        <!--  <p name="member" class="card-text fw-bolder mb-0">Membresía</p>-->
                                        <h2>{{ $package->amount }} USD</h2>
                                           <!--    <h2>{{ $package->amount_per_month }} USD</h2>
                                         <p class="card-text mb-0"><strong>Depósito</strong> {{ $package->amount }}
                                                USD</p>
                                            <p class="card-text"><strong>Estimado</strong> {{ $package->percentage }}</p>-->
                                            <form class="d-grid gap-2" action="{{ route('shop.proccess') }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="package" value="{{ $package->id }}">
                                                <input type="hidden" name="title" value="{{ $type->name }}">
                                                <button class="btn btn-primary"
                                                    {{ $package->disabled == true ? 'disabled' : '' }}>{{ $package->text }}</button>
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

    </div>
@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
@endsection
