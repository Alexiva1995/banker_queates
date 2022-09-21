{{-- password --}}
<div class="tab-pane fade" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">
    <div class="card-body ">
        <div class="row">
            <div class="col-lg-12 col-12 order-2 order-lg-1">
                <form method="POST" action="{{ route('contraseña.update') }}" novalidate>
                    @csrf
                    <div class="row" style="padding: 1%;">
                        <!--ROW 1 START-->
                        
                        <div class="col-sm-6">
                            <label for="" class="fw-500">Contraseña anterior <label
                                    style="color: red;">*</label></label>
                            <div class="input-group mb-2 shadow-none">
                                <div class="input-group input-group-merge form-password-toggle shadow-none">
                                    <input id="password" type="password" name="current_password"
                                        class="form-control form-control-merge @error('current_password') is-invalid @enderror"
                                        autocomplete="current-password" placeholder="Ingresa tu contraseña anterior">
                                    @error('current_password')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-12"></div>

                        <div class="col-sm-6" >
                            <label for="" style="margin-bottom: 1%;" class="fw-500">Nueva contraseña <label
                                    style="color: red;">*</label></label>
                            <div class="input-group mb-3">
                                {{-- <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password"> --}}
                                <input id="new_password" type="password" name="new_password"
                                    class="form-control @error('new_password') is-invalid @enderror"
                                    autocomplete="current-password" placeholder="Ingresa tu nueva contraseña">
                                @error('new_password')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="" style="margin-bottom: 1%;" class="fw-500">Repetir nueva contraseña <label
                                    style="color: red;">*</label></label>
                            <div class="input-group mb-3">
                                <input id="confirm_password" type="password" name="confirm_password"
                                    class="form-control @error('new_confirm_password') is-invalid @enderror"
                                    autocomplete="current-password" placeholder="Repite tu nueva contraseña">
                                @error('confirm_password')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer" style="border: none">
                            <button type="button" id="boton03" class="btn btn-outline-danger">
                                Reiniciar
                            </button>
                            <button type="submit" class="btn btn-primary" id="guardar">
                                Cambiar Contraseña
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Cambiar Contraseña end-->
