@extends('layouts/contentLayoutMaster')

@section('title', 'Unilevel')
@section('vendor-style')
<link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
@endsection
<style>
    .fw-700{
        font-weight: 700!important;
    }
</style>
@section('content')
<div id="logs-list d-flex justify-content-center">
    <div class="d-flex my-2">
        <p style="color:#808E9E;" class="fw-700">Configuraciones</p><span class="fw-normal mx-1">|</span><p>Métodos de Pago</p>
    </div>
    <div class="col-12 col-md-6">
        <div class="card p-2">
            <div class="card-content">
                <div class="card-header p-0">
                    <h4 class="fw-700">Wallet Coinpaymets</h4>
                </div>
                <div class="card-body card-dashboard">
                    <div class="row">
                    <form method="POST" action="{{ route('configurations.store') }}" enctype="multipart/form-data" novalidate>
                                @csrf
                        <div class="col-md-12 col-12">
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <div class="p-1 d-flex justify-content-center justify-content">
                                        @if (!empty($data) > 0)
                                            <a ><img class="d-block rounded"  src="{{ asset('storage//wallet-admin/'.$data->image) }}" alt="Avatar" width="110px" id="imageW2" height="110px" data-toggle="modal" data-target="#fotos"></a>
                                        @else
                                            <a><img src="{{asset('/images/Dashboard/image.svg')}}" alt="Avatar" height="110" width="120" class="d-block rounded" id="imageW"/></a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-sm-8 p-1">
                                    <div class="h4 mt-1 fw-bold d-flex" style="width: 88.333333% !important;">
                                        <button class="btn btn-primary mr-2" id="uploadImg" style="margin-right: 1rem !important;">
                                            Subir imagen
                                        </button>
                                        <button class="btn btn-outline-danger d-none text-danger" id="removeImage">
                                            Remover
                                        </button>
                                    </div>
                                    <p class="d-flex justify-content-start" style="width: 101%">JPG o PNG permitidos. Tamaño máximo 2MB.</p>
                                </div>
                                <input type="file" name="image" id="image" accept="image/*" style="display: none;" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ (!empty($data) ) ? asset('storage//wallet-admin/'.$data->image) : '' }}">
                                @error('image')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror
                            </div>

                                    <div class="row" style="margin-top: 4%;">
                                        <!--ROW 1 START-->
                                        <div class="col-sm-12">
                                            <label for="name">Wallet</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="wallet" class="form-control @error('wallet') is-invalid @enderror"
                                                        value="{{ isset($data->wallet) ? $data->decryptWallet() : '' }}">
                                                @error('wallet')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{$message}}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!--ROW 3 END-->
                                        <div class="botones d-flex justify-content-end mt-2">
                                            <button type="submit" class="btn btn-primary" id="guardar">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const uploadImg = document.querySelector('#uploadImg');
    const inputImg = document.getElementById('image')
    const imgWallet = document.getElementById('imageW')
    const imgWallet2 = document.getElementById('imageW2')
    const removeImage = document.getElementById('removeImage')
    if (inputImg.value) {
        removeImage.classList.remove("d-none")
        removeImage.classList.add('d-block')
    }
    uploadImg.addEventListener("click", (event) => {
        event.preventDefault()
        inputImg.setAttribute("value", "")
        inputImg.click()
    }, false);

    inputImg.addEventListener("change", function(event) {
        const [file] = inputImg.files
        if (file) {
            console.log(imgWallet)
            if (imgWallet) {
                imgWallet.src = URL.createObjectURL(file)
            } else {
                imgWallet2.src = URL.createObjectURL(file)
            }
            removeImage.classList.remove('d-none')
            removeImage.classList.add('d-block')
        }
    }, false);

    removeImage.addEventListener('click', (event) => {
        event.preventDefault()
        if (imgWallet) {
            imgWallet.src = '{{asset('/images/dashboard/image.svg')}}'
        } else {
            imgWallet2.src = '{{asset('/images/dashboard/image.svg')}}'
        }
        removeImage.classList.remove("d-block")
        removeImage.classList.add('d-none')
    }, false)


</script>
@endsection