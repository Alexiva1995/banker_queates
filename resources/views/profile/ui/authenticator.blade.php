<div class="tab-pane fade" id="nav-auth" role="tabpanel" aria-labelledby="nav-auth-tab">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <div class="card-body "> 
            <div class="row">
                <div class="col-lg-12 col-12 order-2 order-lg-1">
                    @if (Auth::user()->token_auth == null)
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card-header">Verificación de Google Authenticator</div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <p>Nota: Luego de ser activado el Google Authenticator no puede ser desactivado</p>
                                                <form method="POST" {{--action="{{ route('activate.2fa') }}"--}}>
                                                    @csrf
                                                    <div class="botones mt-2 text-center">
                                                        <button class="btn btn-success btn-lg">Activar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card-header">
                                        
                                    </div>
                                    <p class="text-center">Verificación de Goggle Authenticator</p>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <p class="text-center">El Google Authenticator ya ha sido activado. Puedes escanear el siguiente código Qr para agregarlo a su aplicación.</p>
                                                <div class="col-12 text-center">
                                                  <img id="imgQR" src="{{$urlQR}}"/>
                                                </div>
                                                <p class="mt-2 text-center">Nota: Luego de ser activado el Google Authenticator no puede ser desactivado</p>
                                                <div class="botones text-center mt-2">
                                                    <button class="btn btn-success btn-lg" disabled>Activado</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div> 
                    @endif
                </div>
            </div>
        </div>
    </div>
