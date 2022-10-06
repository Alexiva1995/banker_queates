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

@push('custom_js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        $(document).ready(function() {
            @if ($user->photoDB != null)
                previewPersistedFile("{{ asset('storage/' . $user->photoDB) }}", 'photo_preview');
            @endif
        });



        function previewFile(input, preview_id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#" + preview_id).attr('src', e.target.result);
                    $("#" + preview_id).css('height', '90px');
                    $("#" + preview_id).parent().parent().removeClass('d-none');
                }
                $("label[for='" + $(input).attr('id') + "']").text(input.files[0].name);
                reader.readAsDataURL(input.files[0]);
            }
        }

        function previewPersistedFile(url, preview_id) {
            $("#" + preview_id).attr('src', url);
            $("#" + preview_id).css('height', '10px');
            $("#" + preview_id).parent().parent().removeClass('d-none');

        }

        function sendCodeEmailUpdate() {
            var laravelToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const config = { headers: { 'Content-Type': 'multipart/form-data' } };
              axios.post('{{route("perfilUpdateCode")}}',
              {
                  headers: {'Content-Type': 'multipart/form-data'},
                  name: document.getElementById('namePerfil').value,
                  email: document.getElementById('email').value,
                  pais: document.getElementById('countrie_id').value,
                  billeteraUSDT: document.getElementById('billeteraUSDT').value,
                  billeteraBTC: document.getElementById('billeteraBTC').value,
                  photoDB: document.getElementById('photoDB').value,
                  activa:document.getElementById('wallet_address_active').value

              }).then(function (response) {
                if(response.data.valores.campos_vacio == 'true'){
                        return toastr.error("No puede dejar campos vacios", '¡Aviso!', { "progressBar": true });

                    }

                if(response.data.valores.verificado == 'false'){

                    toastr.error("No tiene cambios en su perfil", '¡Aviso!', { "progressBar": true });
              }else{

                toastr.success("El Codigo fue enviado con exito", '¡Aviso!', { "progressBar": true });
              }
              }).catch(function (error) {
                  console.log(error);
              });
              //console.log(response.data.valores);

        }

        function sendFormUpdate() {
            // $('#code_g').val($('#code_google').val())
            $('#code_c').val($('#code_correo').val())
            $('#formupdate').submit();
        }
        function activateForm(val){
            let boton = document.getElementById('botonModalCorreo');
            $( "#namePerfil" ).change(function() {
            if(val != null || val != ''){

                   boton.disabled = false;
                }

            });
            $( "#email" ).change(function() {
            if(val != null){
                   boton.disabled = false;
                }

            });

            $( "#countrie_id" ).change(function() {
            if(val != null){
                   boton.disabled = false;
                }

            });
            $( "#wallet_address_active" ).change(function() {
            if(val != null){
                   boton.disabled = false;
                }

            });
            $( "#billeteraUSDT" ).change(function() {
            if(val != null){
                   boton.disabled = false;
                }

            });

            $( "#billeteraBTC" ).change(function() {
            if(val != null){
                   boton.disabled = false;
                }

            });

            $( "#photoDB" ).change(function() {
            if(val != null){
                   boton.disabled = false;
                }

            });
        }
        function proccess(){
            var laravelToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
              axios.post('{{route("activar2fact.post")}}', {
                activar2fa: document.getElementById('activar2fa').value,
              }).then(function(response){
                if(response.data.valores.verificado == 'true'){
                let timerInterval
                  Swal.fire({
                  title: '<h3 class="text-center text-white">activando Google 2FA</h3>',
                  background:'#0d411c',
                  timer: 2300,
                  timerProgressBar: true,
                      didOpen: () => {
                          Swal.showLoading()
                          const b = Swal.getHtmlContainer().querySelector('b')
                          timerInterval = setInterval(() => {
                          b.textContent = Swal.getTimerLeft()
                          }, 100)
                      },willClose: () => {
                          clearInterval(timerInterval)
                      }
                  })

                 let redirecionar =  window.location.href = '{{route("2fact")}}';
              }else{
                let timerInterval
                Swal.fire({
                title: '<h3 class="text-center text-white">Desactivando Google 2FA</h3>',
                background:'#0d411c',
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
                }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log('I was closed by the timer')
                }
                })
                location.reload();
              }

              })
        }
        function TowFaPerfil(){
            var laravelToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

              axios.post('{{route("2factPerfil.post")}}', {
                code2fa: document.getElementById('code2fa').value,
                password2fa: document.getElementById('password2fa').value,
              }).then(function(response){
                if(response.data.valores.verificado == true){
                    let timerInterval
                  Swal.fire({
                  title: '<h3 class="text-center text-white">Desactivando Google 2FA</h3>',
                  background:'#0d411c',
                  timer: 2300,
                  timerProgressBar: true,
                      didOpen: () => {
                          Swal.showLoading()
                          const b = Swal.getHtmlContainer().querySelector('b')
                          timerInterval = setInterval(() => {
                          b.textContent = Swal.getTimerLeft()
                          }, 100)
                      },willClose: () => {
                          clearInterval(timerInterval)
                      }
                  })
                  location.reload();
                }else{
                    let timerInterval
                  Swal.fire({
                  icon: 'warning',
                  title: '<h3 class="text-center text-white">Codigo o Contraseña incorrectos</h3>',
                  background:'#0d411c',
                  timer: 2300,
                  timerProgressBar: true,

                  })
                }
              })
        }
    </script>

@section('content')
<style>
    .Codigocorreo::placeholder { color: rgb(50, 194, 31); font-weight: bold; }
    .bac{
        background-color: rgba(0, 0, 0, 0)!important;
    }
    .ti{
        font-size: 1.8rem;
        background-color: rgba(1, 10, 0, 0.775);
        margin-left: 10.5rem;
         margin-right:auto;
         padding: 0.7rem;
         position: relative;
         top: 35px;
    }
    .bt{
        background-color: red !important;
        padding: 5px;
        border-radius: 5px;
        width: 100px !important;

    }
    .g2fa{
        background: none;
    border: none !important;
        outline:none!important;
    color: inherit;
    /* cursor: default; */
    font: inherit;
    line-height: normal;
    overflow: visible;
    padding: 0;
    -webkit-user-select: none; /* for button */
    -webkit-appearance: button; /* for input */
        -moz-user-select: none;
        -ms-user-select: none;
        outline:none;
    }
    .contraseña{
        background: none;
    border: none !important;
        outline:none!important;
    color: inherit;
    /* cursor: default; */
    font: inherit;
    line-height: normal;
    overflow: visible;
    padding: 0;
    -webkit-user-select: none; /* for button */
    -webkit-appearance: button; /* for input */
        -moz-user-select: none;
        -ms-user-select: none;
        outline:none;
    }
    .google {
        -webkit-transition:all .3s ease; /* Safari y Chrome */
        -moz-transition:all .3s ease; /* Firefox */
        -o-transition:all .3s ease; /* IE 9 */
        -ms-transition:all .3s ease; /* Opera */
        width:100%;
        }
    .google:hover{
        -webkit-transform:scale(1.25);
        -moz-transform:scale(1.25);
        -ms-transform:scale(1.25);
        -o-transform:scale(1.25);
        transform:scale(1.25);
        }
        .google:active{
        -webkit-transform:scale(1);
        -moz-transform:scale(1);
        -ms-transform:scale(1);
        -o-transform:scale(1);
        transform:scale(1);
        border-radius:100%;
        width: 50px;
        height: 50px;
        box-shadow: 5px 5px 5px 4px rgba(22, 209, 28, 0.481);
        }

</style>



<div class="card" >
    <div class="card-body">
        <div class="container">
            <h1 ><strong> Datos personales </strong></h1>
            <div class="row">

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="fullname">Nombre Completo</label>
                        <input type="text" class="form-control  border-primary rounded" name="fullname" disabled
                            value="{{ Auth::user()->fullname}}">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control  border-primary rounded" name="email" disabled
                            value="{{Auth::user()->email }}">
                    </div>

                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control  border-primary rounded" name="email" disabled
                            value="{{ Auth::user()->email }}">
                    </div>

                </div>

                <div class="col-sm-6">
                    <div class="form-group ">
                            <label for="countrie_id">Pais</label>
                                <select name="" id=""
                                    class="form-control  border-primary rounded @error('countrie_id') is-invalid @enderror" required data-toggle="select" disabled>
                                        <option value="">Elegir pais</option>
                                    @foreach (App\Models\Countrie::all() as $countrie)
                                            <option value="{{ $countrie->id }}" @if ((isset(Auth::user()->countrie_id) && Auth::user()->countrie_id == $countrie->id) || old('countrie_id') == $countrie->id) selected @endif>{{ $countrie->name }}
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
                            <select name="wallet_address_active" id="" class="form-control  border-primary rounded " disabled>
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
                            <input type="text" id="" class="form-control  border-primary rounded " placeholder="wallet_address_usdt" disabled
                                name=""
                                value="{{ old('wallet_address_usdt') != null ? old('wallet_address_usdt') : $user->wallet_address->USDTTR20 }}">
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="controls">
                            <label for="account-api">Billetera BTC</label>
                            <input type="text" id="" class="form-control  border-primary rounded " placeholder="wallet_address_btc" disabled
                                name=""
                                value="{{ old('wallet_address_btc') != null ? old('wallet_address_btc') : $user->wallet_address->BTC }}">
                        </div>
                    </div>
                </div>


                <div class="col-sm-3 d-flex">
                      <button class="text-success  justify-content-end  contraseña" data-toggle="modal" data-target="#exampleModalcontraseña">
                      <i class="text-success feather icon-lock font-medium-3"></i>
                      Cambiar contraseña
                      </button>
                </div>
                <div class="col-sm-1 d-flex">
                    <div class="form-group justify-content-center">
                        <button type="button" class="g2fa google" data-toggle="modal" data-target="#Modal2fa">
                            <img src="{{asset('assets/img/2fa.png')}}" class=" "  data-toggle="tooltip" data-placement="top" title="Google 2 pasos" alt="logo" width="50">
                        </button>
                    </div>
                </div>

                <div class="col-sm-2 d-flex">
                    <div class="form-group  justify-content-end">
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal" style="top: 8px;">
                           Editar Perfil
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
  </div>




@include('Kyc.modalcontrasena')
@include('Kyc.modalPerfil')
@if (Auth::user()->status_google == 0)
@include('Kyc.modal2fa')
@else
@include('Kyc.modalDescativar2fa')
@endif
@endsection
