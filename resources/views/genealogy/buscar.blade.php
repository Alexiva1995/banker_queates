@extends('layouts/contentLayoutMaster')

@section('title', 'Buscararbol')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection
@section('page-style')
<!-- Page css files -->
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection
<style>
    .fw-700{
        font-weight: 700!important;
    }
</style>
@section('content')
<div id="logs-list">
    <div class="d-flex my-2">
        <p style="color:#808E9E;" class="fw-700">Auditoria</p><span class="fw-normal mx-1">|</span><p>Buscar</p>
    </div>
    <div class="col-12">
        <div class="card bg-lp p-2">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <h4 class="mb-5 fw-700">Ingrese el id del usuario</h4>
                    <form action="{{route('red.search')}}" method="POST">
                        @csrf
                        <div class="row justify-content-center mb-3 mb-sm-1">
                            <div class="col-md-4 col-sm-8">
                                <div class=" white mt-2">
                                    <input type="number" placeholder="Ingres el id del usuario" name="id" class="form-control" id="id">
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-4">
                                <div class=" white mt-2">
                                    <button type="submit" class="btn btn-primary ">Buscar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>

@endsection