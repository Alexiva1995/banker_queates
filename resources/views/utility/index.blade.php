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
        <p class="mt-2 mb-1">Por favor selecciona un Tipo de Paquete para actualizar</p>

        <div>


            <div class="tab-content">


                    <div>
                        <div class="row">
                        @foreach ($percentage as $type)
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 width-5">
                                    <div class="card">
                                        <div class="d-flex justify-content-center">

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

                                        </div>
                                        <div class="card-body px-sm-2">

                                        <h2>{{ $type->name }}</h2>

                                        <h3>{{ $type->percentage }}%</h3>


                                                <input type="hidden" name="package"  id="{{'package-'.$type->id}}" value="{{ $type->id }}">
                                                <input type="hidden" name="title" value="{{ $type->name }}">
                                                <button class="btn btn-primary" onclick="openmodal({{ $type->id }})">Actualizar</button>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

            </div>

        </div>

    </div>



    <div class="modal fade" id="ModalPercet" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Porcetaje</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{route('porcentaje.rentabilidad.update')}}" method="POST">
        @csrf
        <input type="hidden" name="type_id"  id="type_id">
        <div class="modal-body">
          <label for="referido">Porcentaje</label>
          <input type="text"  class="form-control mb-2" name="type_percent" id="type_percent">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
    <script src="{{ asset('vendors/js/jquery/jquery.min.js') }}"></script>
@endsection
@section('page-script')
   <script>

function openmodal(type){

    $('#type_id').val(type);

    $('#ModalPercet').modal('show');
}
$(document).ready(function() {

$('#type_percent').on("keyup", function( event ) {
    let val = $(this).val();
    if(isNaN(val)){
         val = val.replace(/[^0-9\.]/g,'');
         if(val.split('.').length>2) {
             val =val.replace(/\.+$/,"");
            }
    }
    $(this).val(val);
})

});

   </script>
@endsection
