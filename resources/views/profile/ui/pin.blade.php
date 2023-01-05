{{-- password --}}
<div class="tab-pane fade" id="nav-pin" role="tabpanel" aria-labelledby="nav-pin-tab">
    <div class="card-body ">
        <div class="row">
            <div class="col-lg-12 col-12 order-2 order-lg-1">
                <form method="POST" action="{{ route('pin.update') }}" novalidate>
                    @csrf
                    <div class="row">
                        <!--ROW 1 START-->
                        <h3 class="fw-600 mb-4">Pin Security</h3>
                        <div class="col-sm-6">
                            <label for="" class="fw-500">Password<label
                                    style="color: red;">*</label></label>
                            <div class="input-group mb-2 shadow-none">
                                <div class="input-group input-group-merge form-password-toggle shadow-none">
                                    <input id="password" type="password" name="current_password"
                                        class="form-control form-control-merge @error('current_password') is-invalid @enderror"
                                        autocomplete="current-password" placeholder="Enter your password">
                                    @error('current_password')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="" class="fw-500">Mail verification <label
                                    style="color: red;">*</label></label>
                            <div class="input-group mb-2 shadow-none">
                                <div class="input-group input-group-merge form-password-toggle shadow-none">
                                    <input type="text" class="form-control form-control-merge" id="code_pin" name="code_pin" placeholder="Enter the code"/>
                        <a class="btn input-group-btn btn-primary cursor-pointer border-end input-group-text border-top border-bottom" id="codeButton" onclick="getCode();">Get Code</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12"></div>

                        <div class="col-sm-6" >
                            <label for="" style="margin-bottom: 1%;" class="fw-500">New PIN (Numbers only)<label
                                    style="color: red;">*</label></label>
                            <div class="input-group mb-3">
                                {{-- <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password"> --}}
                                <input id="new_pin" type="password" name="new_pin"
                                    class="form-control @error('new_pin') is-invalid @enderror"
                                    autocomplete="current-pin" placeholder="Enter your new PIN" onkeypress="return isNumberKey(event)">
                                @error('new_pin')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="" style="margin-bottom: 1%;" class="fw-500">Repeat PIN <label
                                    style="color: red;">*</label></label>
                            <div class="input-group mb-3">
                                <input id="confirm_pin" type="password" name="confirm_pin"
                                    class="form-control @error('new_confirm_pin') is-invalid @enderror"
                                    autocomplete="current-pin" placeholder="Repeat your new PIN" onkeypress="return isNumberKey(event)" >
                                @error('confirm_pin')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-start modal-footer" style="border: none">
                            <button type="submit" class=" btn btn-primary" id="guardar">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Cambiar Contraseña end-->
