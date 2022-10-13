<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="background-color: rgba(0, 14, 0, 0.864)">
        <div class="modal-header bac">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{Route('perfilUpdate')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
            <div class="container">
                <h1 >Editar Datos Personales </h1>
                <div class="row">


                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="fullname">Nombre Completo</label>
                            <input type="text" class="form-control border  border-success   rounded" name="namePerfil" id="namePerfil" required onclick="activateForm(this.value)"
                                value="{{ Auth::user()->fullname}}">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control border  border-success rounded" name="email" id="email" required onclick="activateForm(this.value)"
                                value="{{Auth::user()->email }}">
                        </div>

                    </div>

                    <div class="col-sm-6">
                        <div class="form-group ">
                                <label for="countrie_id">Pais</label>
                                    <select name="countrie_id" id="countrie_id"  onclick="activateForm(this.value)"
                                        class="form-control border  border-success rounded @error('countrie_id') is-invalid @enderror" required data-toggle="select" >

                                            @foreach ($pais as $id => $countrie)
                                                <option value="{{$id}}" @if ((isset(Auth::user()->countrie_id) && Auth::user()->countrie_id == $id) || old('countrie_id') == $id) selected @endif>{{ $countrie}}
                                                </option>
                                        @endforeach
                                    </select>
                                @error('countrie_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="controls">
                                <label for="account-api">Billetera Activa</label>
                                <select name="wallet_address_active" id="wallet_address_active" class="form-control border   border-success rounded" required  onclick="activateForm(this.value)">
                                    <option value="USDTTR20" @if ($user->wallet_address->activa == 'USDTTR20') selected
                                        @endif>USDTTR20</option>
                                    <option value="BTC" @if ($user->wallet_address->activa == 'BTC') selected @endif>BTC</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="controls">
                                <label for="account-api">Billetera USDT-TR20</label>
                                <input type="text" id="billeteraUSDT" class="form-control border  border-success rounded " required placeholder="wallet_address_usdt"  onclick="activateForm(this.value)"
                                    name="billeteraUSDT"
                                    value="{{ old('wallet_address_usdt') != null ? old('wallet_address_usdt') : $user->wallet_address->USDTTR20 }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="controls">
                                <label for="account-api">Billetera BTC</label>
                                <input type="text" id="billeteraBTC" class="form-control border  border-success rounded " required placeholder="wallet_address_btc"  onclick="activateForm(this.value)"
                                    name="billeteraBTC"
                                    value="{{ old('wallet_address_btc') != null ? old('wallet_address_btc') : $user->wallet_address->BTC }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                        <div class="custom-file">
                             <input type="file" name="photoDB" value="" id="photoDB" class="custom-file-input  @error('photoDB') is-invalid @enderror" id="photoDB" onclick="activateForm(this.value)"
                                    onchange="previewFile(this, 'photo_preview')" accept="image/*">
                                    @error('photoDB')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                            <label class="custom-file-label" for="validatedCustomFile">Seleccione su
                                Foto</label>

                          </div>
                        </div>
                </div>
                <div class="col-sm-6">
                    <div class="" id="photo_preview_wrapper" style="position: absolute;">
                        <div class="">
                            <img id="photo_preview" class="img-fluid rounded"/>
                        </div>
                    </div>
                </div>

                </div>
            </div>

            @include('Kyc.modalEnviarCorreo')
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" id="botonModalCorreo" class="btn btn-outline-primary"data-toggle="modal" data-target="#Modal" disabled>Guardar</button>
        </div>
      </div>
    </div>
  </div>
