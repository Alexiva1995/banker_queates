@extends('layouts.dashboard')

@push('vendor_css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/librerias/emojionearea.min.css')}}">
@endpush

@push('page_vendor_js')
<script src="{{asset('assets/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/extensions/polyfill.min.js')}}"></script>
@endpush

{{-- permite llamar las librerias montadas --}}
@push('page_js')
<script src="{{asset('assets/js/librerias/vue.js')}}"></script>
<script src="{{asset('assets/js/librerias/axios.min.js')}}"></script>
<script src="{{asset('assets/js/librerias/emojionearea.min.js')}}"></script>
@endpush

@section('content')
<div class="container">
    <div class="row">
      <div class="col-sm-12 card ">

        <div class="row">
            <div class="col-sm-12 d-flex justify-content-center">
                <div>
                    <h2 class="mt-2"> <strong>Solicitudes de verificacion KYC </strong></h2>
                </div>
            </div>
                <div class="col-sm-12">
                    <div class="table-responsive" id="table">
                        <table class="table nowrap scroll-horizontal-vertical myTable w-100" id="myTable">
                            <thead class="">
                                <tr class="text-center text-white bg-purple-alt2">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Tipo de documento</th>
                                    <th>Documento</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($KYC as $key => $K)
                                    <tr>
                                        <td>{{ $K->user_id }}</td>
                                        <td>{{ $K->getUser->fullname}}</td>
                                        <td>{{ $K->type_kyc }}</td>
                                        <td class="d-flex justify-content-center">
                                            <button class="btn btn-success mr-1"  type="button" data-toggle="modal" data-target="#frontModal{{ $K->user_id }}"><i class="fa fa-address-card" aria-hidden="true"></i> Frontal del documento</button>
                                            <button class="btn btn-info"  type="button"  data-toggle="modal" data-target="#traseroModal{{ $K->user_id }}"><i class="fa fa-credit-card" aria-hidden="true"></i> Espalda del documento</button>
                                        </td>

                                        <td>
                                            <form method="POST" action="{{route('KYC-accion')}}">
                                                @csrf
                                                <button type="submit" name="aprovar" value="{{ $K->user_id  }}" class="btn btn-success mr-1"><i class="fa fa-check" aria-hidden="true" ></i> Aprovar</button>
                                                <button type="submit" name="cancelar" value="{{ $K->user_id  }}" class="btn btn-danger"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</button>
                                            </form>
                                        </td>

                                    </tr>
                                    @include('Kyc.KYCindex.KYCcomponentes.frontalModal')
                                    @include('Kyc.KYCindex.KYCcomponentes.traseroModal')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@include('layouts.componenteDashboard.optionDatatable')

