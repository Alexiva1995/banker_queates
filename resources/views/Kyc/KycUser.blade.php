@extends('layouts.dashboard')

@push('vendor_css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/css/core/colors/palette-gradient.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{asset('assets/app-assets/css/plugins/forms/validation/form-validation.css')}}">
@endpush

@push('page_vendor_js')
<script src="{{asset('assets/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/pickers/pickadate/picker.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/pickers/pickadate/picker.date.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/extensions/dropzone.min.js')}}"></script>
@endpush

@section('content')
<div class="card" >
    <div class="card-body">
      <h5 class="card-title">Card title</h5>

        <div class="container">
            <div class="row">

                <div class="col-sm-6">
                    <select class="form-control form-control-lg">
                        <option>Tipo de Documento</option>
                      </select>
                </div>

                <div class="col-sm-6">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        </div>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="inputGroupFile01">
                          <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                      </div>

                </div>

                <div class="col-sm-6">
                foro trasera del documento
                </div>

                <div class="col-sm-6">
                    selfie con el documento
                </div>

            </div>
        </div>

    </div>
  </div>
@endsection
