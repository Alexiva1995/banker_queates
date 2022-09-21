@extends('layouts/contentLayoutMaster')

@section('title', 'Tienda')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection
@section('page-style')
<!-- Page css files -->
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
<style>
    .list-group-item-action {
        cursor: pointer;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
           <h1 class="text-center mb-2 textoCustom">  {{$title->name }}</h1>
        </div>
        @foreach ($data as $package )
            <div class="col-sm-3" >

                    <div class="card">
                        <div class="card-body">
                            <h5 name="member" value="{{ $package->amount == 50 ? 'Activación' : 'Membresía' }} {{ $package->amount }} USD" class="textoCustom card-title text-center">{{ $package->amount == 50 ? 'Activación' : 'Membresía' }} {{ $package->amount }} USD</h5>
                            <p class="card-text text-center textoCustom"><strong>{{ $package->amount == 50 ? 'Depósito sólo para la activación' : 'Depósito de membresia estimado mensual' }} </strong></p>

                            <div class="d-flex justify-content-center">
                                <form action="{{route('shop.proccess')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="package" value="{{$package->id}}">
                                    <input type="hidden" name="title" value="{{$title->name}}">
                                    <button class="btn btn-outline-primary d-flex textoCustom">Pagar {{ $package->amount_per_month }} USD</a>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
        @endforeach
    </div>
  </div>
@endsection
