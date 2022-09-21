@extends('layouts/contentLayoutMaster')

@section('title', 'Bonos')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">

@endsection
@section('page-style')
<!-- Page css files -->
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection
<style>

</style>
@section('content')
<div id="adminServices">
    <div class="d-flex my-2">
        <p class="fw-700">Configuracion de Bonos</p>
    </div>
    @if ($user->admin=='1')
        <div class="row">
            <div class="col-md-8 col-lg-6 col-sm-8">
                <div class="card p-1">
                    <div class="card-body p-2">
                        <h4 class="fw-600 mb-75">Cambiar configuración de Bonos</h4>
                        <form class="mt-2" action="{{ route('bonosSettings') }}"
                            method="POST">
                            @csrf
                            <div class="row align-items-end">
                                <div class="col-sm-6">
                                    <label for="">Seleccionar Bono: </label>
                                    <div class="input-group mb-1">
                                        <select id="bono" class="rounded form-control text-dark shadow-none" name="bono" required>
                                            <option selected value="" disabled>Selecciona un Bono</option>
                                                <option value="1">Bono Inicio Rapido</option>
                                                <option value="2">Bono Recompra</option>
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="">Cambiar Porcentaje:</label>
                                    <div class="input-group input-group-merge mb-1">
                                        <input type="number" class="form-control" id="porcentage_bono" name="porcentage_bono" disabled placeholder="10" aria-describedby="porcentaje_bono" autofocus value="{{ old('porcentage_bono') }}" required/>
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="">Seleccionar Nivel: </label>
                                    <select id="level" class="rounded form-control text-dark shadow-none" name="level" disabled required>
                                        <option selected value="">Selecciona un Nivel</option>
                                            @foreach($level as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <button type="submit" id="changeB" class="btn btn-primary w-100">Cambiar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
@section('page-script')
<!-- Page js files -->
<script>
    $('#bono').select2({
        minimumResultsForSearch: Infinity
    });
    $('#level').select2({
        minimumResultsForSearch: Infinity
    });

    //if not selected
    $('#bono').change(function(){
        console.log($(this).val());
        if($(this).val() !=='0' && $(this).val() !== '3'){
            // console.log('giii');
            $('#porcentage_bono').prop("disabled",false);
            $('#level').prop("disabled", false);
         }
         else{
            $('#level').prop("disabled", true);
            $('#porcentage_bono').prop("disabled",false);
        }
    });
</script>
@endsection
