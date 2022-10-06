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
<style type="text/css">
    input.clipboard:focus {
        outline: none;
        background-color: transparent;
    }

    input.clipboard::moz-selection {
        background-color: transparent;
    }

    input.clipboard::selection {
        background-color: transparent;
    }
</style>
@section('content')
    <div class="card text-center">
        <div class="card-header">
            <h5 class="modal-title" id="ModalPagarLabel">Realizar Pago</h5>
        </div>
        <form action="{{ route('shop.proccess') }}" method="POST" enctype="multipart/form-data" class="d-inline">
            @csrf
            <div class="card-body">
                <div class="container">
                    <nav class="links col-sm-5">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active justify-content-start text-start fw-400 rounded"
                                id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button"
                                role="tab" aria-controls="nav-home" aria-selected="true">
                                <div class="card-body card-dashboard">
                                    <img src="https://icons.iconarchive.com/icons/cjdowner/cryptocurrency-flat/1024/Tether-USDT-icon.png"
                                        alt="" height="24">
                                    USDT TRC20
                                </div>
                            </button>
                            <button class="nav-link justify-content-start text-start fw-400 rounded" id="nav-btc-tab"
                                data-bs-toggle="tab" data-bs-target="#nav-btc" type="button" role="tab"
                                aria-controls="nav-btc" aria-selected="false">
                                <div class="card-body card-dashboard">
                                    <img src="https://icons.iconarchive.com/icons/cjdowner/cryptocurrency-flat/512/Bitcoin-BTC-icon.png"
                                        alt="" height="24">
                                    BTC
                                </div>
                            </button>
                            <button class="nav-link justify-content-start text-start fw-400 rounded" id="nav-bnb-tab"
                                data-bs-toggle="tab" data-bs-target="#nav-bnb" type="button" role="tab"
                                aria-controls="nav-bnb" aria-selected="false">
                                <div class="card-body card-dashboard">
                                    <img src="https://icons.iconarchive.com/icons/cjdowner/cryptocurrency-flat/128/Binance-Coin-BNB-icon.png"
                                        alt="" height="24">
                                    BNB
                                </div>
                            </button>
                        </div>
                    </nav>
                    <div class="row">

                        <div class="col-sm">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                    aria-labelledby="nav-home-tab">
                                    <img src="{{ asset('images/Qr/' . $wallettrc20[0]['image']) }}" alt="qr"
                                        style="width: 72%;">
                                    <input type="hidden" name="moneda" value="{{ $wallettrc20[0]['type'] }}">
                                    <input type="text" id="wallet" class="clipboard mt-1"
                                        value="{{ $wallettrc20[0]['wallet'] }}" style="width:275px;border:none;">
                                    <span>
                                        <i class="fa fa-copy"></i>
                                    </span>
                                </div>
                                @include('shop.ui.billeteraBtc')
                                @include('shop.ui.billeteraBnB')
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="col-12 mt-1">
                                <label for="hash" class="form-label w-100">Paquete:</>
                            </div>
                            <div class="col-12 mt-1">
                                <label for="amount" class="form-label w-100">{{ __('Monto:') }}</>
                                    <input name="amount" type="number" class="w-100 form-control"
                                        style="display: block !important;" value="{{ $amount }}" disabled>
                            </div>
                            <div class="col-12 mt-1">
                                <label for="voucher" class="form-label w-100">{{ __('Comprobante de pago:') }}</>
                                    <input name="voucher" type="file" class="w-100 form-control"
                                        style="display: block !important;" required>
                            </div>
                            <div class="col-12 mt-1">
                                <label for="hash" class="form-label w-100">{{ __('Hash:') }}</>
                                    <input name="hash" id="hash" type="text" class="w-100 form-control"
                                        required>
                            </div>
                            <input type="hidden" name="package" value="{{ $packageId }}">
                            <div class="modal-footer mt-2" style="padding-left:1px;">
                                {{-- <button type="button" class="btn btn-secondary"
                                href="{{route('')}}">volver</button> --}}
                                <button type="submit" class="btn btn-primary">Confirmar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        const button = document.querySelector('i.fa-copy');

        const input = document.querySelector('.clipboard1');

        const message = document.querySelector('#message');

        button.addEventListener('click', function() {
            input.focus();
            document.execCommand('selectAll');
            document.execCommand('copy');

            message.innerHTML = Swal.fire(
                'Copiado!',
                '',
                'success'
            );

            setTimeout(() => message.innerHTML = "", 2000);
        })
    </script>
@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
@endsection
