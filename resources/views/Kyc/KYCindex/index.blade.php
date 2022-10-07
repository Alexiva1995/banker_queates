@extends('layouts/contentLayoutMaster')
@section('content')
@include('Kyc.KYCindex.KYCStyles.styles')
@include('Kyc.KYCindex.KYCStyles.KYCJs.Js')
<div class="container">
    <div class="row">
        <div class="col-sm-12 card ">
            @if (empty($solicitudKYC))
            <form method="POST" action="{{route('KYC-store')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class=" mt-2">Selecciona el tipo de documento con el que desea validar su KYC</h3>
                        <div class="row ">
                                @if (isset($solicitudKycRechazada ))
                            <div class="col-sm-12 d-flex align-items-center">
                                <h5 class="alert alert-danger mb-2"><i style="font-size: 1.5rem !important;" class="fa fa-exclamation-circle" aria-hidden="true"></i> <strong> Solicitud de verificacion KYC Rechazada , documentos ilegibles </strong> </h5>
                            </div>
                                @endif

                            <div class="col-sm-4">
                                <div class="card py-2">
                                    <div class="row">
                                        <div class="col-sm-4 d-flex justify-content-center">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                        </div>
                                        <div class="col-sm-8 d-flex align-items-center d-flex justify-content-start">
                                            <div class="form-check selector">
                                                <input class="form-check-input " type="radio" name="TipoDocumento" onclick="checkRadius('TarjetaIdentificacion')" value="TarjetaIdentificacion" id="TarjetaIdentificacion">
                                                <label class="form-check-label" for="inlineCheckbox3"><strong>Tarjeta de identificacion</strong></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class=" card py-2">
                                    <div class="row">
                                        <div class="col-sm-4 d-flex justify-content-center">
                                            <i class="fa fa-solid fa-id-card"></i>
                                        </div>
                                        <div class="col-sm-8 d-flex align-items-center d-flex justify-content-start">
                                            <div class="form-check selector">
                                                <input class="form-check-input " type="radio" name="TipoDocumento" onclick="checkRadius('Pasaporte')" value="Pasaporte" id="Pasaporte" >
                                                <label class="form-check-label" for="inlineCheckbox3"><strong>Pasaporte</strong></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class=" card py-2">
                                    <div class="row">
                                        <div class="col-sm-4 d-flex justify-content-center">
                                            <i class="fa fa-solid fa-address-card"></i>
                                        </div>
                                        <div class="col-sm-8 d-flex align-items-center d-flex justify-content-star">
                                            <div class="form-check selector">
                                                <input class="form-check-input " type="radio" name="TipoDocumento" onclick="checkRadius('LicenciaConducir')" value="LicenciaConducir" id="LicenciaConducir">
                                                <label class="form-check-label" for="inlineCheckbox3"><strong>Licencia de conducir</strong></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-3">

                        <div class="row">
                    
                            <div class="col-sm-6">
                                <h5 class="text-center">Carga la parte frontal de su documento</h5>
                                <div class="d-flex justify-content-center">
                                    <div class="row">
                                        <div class="col-sm-12 ">

                                            <div class="row">
                                                <div class="col-sm-12 d-flex justify-content-center">
                                                    <i data-feather='upload-cloud' class="font-large-4 text-light"></i>
                                                </div>
                                                <div class="col-sm-12">
                                                    <label for="frontal" class="choose-btn capa-interior fw-400 d-flex justify-content-center" id="chooseBtn_frontal">
                                                        Arrastre y suelte o <span class="text-primary text-decoration-underline">explore</span> sus archivos
                                                    </label>
                                                    <input type="file" id="frontal" type="file" class="form-control @error('frontal') is-invalid @enderror" name="frontal" value="{{ old('frontal') }}" style="display: none;">
                                                    <br>
                            
                                                    @error('image')
                                                        <small class="text-danger">
                                                            {{$message}}
                                                        </small>
                                                    @enderror
                                                    <div class="" id="photo_preview_wrapper">
                                                        <div class="d-flex justify-content-center">
                                                            <img id="photo_preview" class="img-fluid rounded"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>

                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h5 class="text-center">Carga la parte trasera de su documento</h5>
                                <div class="d-flex justify-content-center">
                                    <div class="row">
                                        
                                        <div class="col-sm-12">

                                            <div class="row">
                                                <div class="col-sn-12 d-flex justify-content-center">
                                                    <i data-feather='upload-cloud' class="font-large-4 text-light "></i>

                                                </div>
                                                <div class="col-sm-12 d-flex justify-content-center">
                                                    <label for="trasera" class="choose-btn capa-interior fw-400 " id="chooseBtn_frontal">
                                                        Arrastre y suelte o <span class="text-primary text-decoration-underline">explore</span> sus archivos
                                                    </label>
                                                    <input type="file" id="trasera" type="file" class="form-control @error('trasera') is-invalid @enderror" name="trasera" value="{{ old('trasera') }}" style="display: none;">
                                                    <br>
                            
                                                    @error('image')
                                                        <small class="text-danger">
                                                            {{$message}}
                                                        </small>
                                                    @enderror
                                              
                                                    <div class="" id="photo_preview_wrapper">
                                                        <div class="d-flex justify-content-center">
                                                            <img id="photo_preview2" class="img-fluid rounded"/>
                                                        </div>
                                                    </div>
                                                </div>
                                              
                                            </div>
                                          

                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 d-flex justify-content-center mb-3">
                        <button type="submit" class="btn btn-success">Verificar</button>
                    </div>
                </div>
            </form>
            @endif

            @if (!empty($solicitudKYC))
            @if ($solicitudKYC['status']== '1')
            <div class="row">
                <div class="col-sm-12 py-5 d-flex justify-content-center">
                    <h1><strong><i class="fa fa-check-circle-o" aria-hidden="true"></i> Verificado</strong></h1>
                </div>
            </div>


            @else
                <div class="row">
                    <div class="col-sm-12 py-5 d-flex justify-content-center">
                        <h1><strong><i class="fa fa-check-circle-o" aria-hidden="true"></i> Verificacion KYC solicitada </strong></h1>
                    </div>
                </div>
            @endif
            @endif

      </div>
    </div>
  </div>

@endsection
