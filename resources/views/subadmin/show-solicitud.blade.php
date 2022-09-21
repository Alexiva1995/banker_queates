@extends('layouts/contentLayoutMaster')

@section('title', 'Paquetes')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap');
    
    body{
        font-family: 'Poppins', sans-serif!important;
    }
    .fw-7{
        font-weight: 700!important;
    }
    .fw-9{
        font-weight: 900!important;
    }
    .fw-6{
        font-weight: 600!important;
    }
    .fw-5{
        font-weight: 500!important;
    }
    .fw-4{
        font-weight: 400!important;
    }
    .nav-tabs .nav-link{
        position: relative;
        transition: transform 0.3s;
    }
    .nav-tabs .nav-link:hover {
       color: #0255b8!important;
    }
    .page-item.active {
        background-color: #f3f2f7;
    }
    .p-8{
        padding: 8px!important;
    }
    .mt-8{
        margin-top: 8px!important;
    }
    .px-sm-15{
        padding-left: 20px!important;
        padding-right: 20px!important;
    }
    .form-label {
        font-size: 0.9rem!important;
    }
    .p-sm-05{
        padding: 0.5rem!important;
    }
</style>
<div class="row col-12 mt-2 mb-2 align-items-center">
    <nav aria-label="breadcrumb" class="w-auto">
        <ol class="breadcrumb align-middle">
        <span class="fw-bold" style="margin-right:.5rem">Paquetes | </span>
        <li class="breadcrumb-item"><a href="{{ route('subadmin.index') }}">Paquetes</a></li>
        <li class="breadcrumb-item active" aria-current="solicitudes"><a href="{{ route('subadmin.solicitudes') }}">Solicitudes - Forex / Membresia 40 USD</a></li>
        <li class="breadcrumb-item text-capitalize">Solicitud {{ $orden->user->name }} {{ $orden->user->lastname }}</li>
    </ol>
    </nav>       
    <a href="" class="btn btn-outline-primary ms-auto w-auto">
        <i class="ficon textoCustom" style="width:1.3rem;height:1.3rem;" data-feather="chevron-left"></i>
         Volver</a>
</div>
<div class="row mt-2">
    <div class="col-lg-8">
        <div class="card p-1">
            <div class="card-header p-2">
                <div class="row align-content-center border-bottom w-100 ps-0" >
                <h4 class="fw-5 mb-2 ps-0">Solicitud <span class="fw-7 text-capitalize">#{{ $orden->id }} - {{ $orden->user->name }} {{ $orden->user->lastname }}</span></h4>
                    <div class="d-flex my-1 px-0">
                        <p class="fw-4 me-sm-2"><span class="fw-6">Telefono:</span> {{ $orden->phone ? $orden->phone : '-'}}</p>
                        <p class="fw-4"><span class="fw-6">Fecha:</span> {{ $orden->created_at }}</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row mt-1 mb-2">
                    <div class="col-md-4">
                        <p class="fw-6 text-dark">Nombre del broker</p>
                        <p>XXXXXXXXXXXXXXXXX</p>
                    </div>
                    <div class="col-md-4">
                        <p class="fw-6 text-dark">Servidor del broker</p>
                        <p>XXXXXXXXXXXXXXXXX</p>
                    </div>
                    <div class="col-md-4">
                        <p class="fw-6 text-dark">Login o number account</p>
                        <p>XXXXXXXXXXXXXXXXX</p>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <p class="fw-6 text-dark">Password real</p>
                        <p>XXXXXXXXXXXXXXXXX</p>
                    </div>
                    <div class="col-md-4">
                        <p class="fw-6 text-dark">Password inversor</p>
                        <p>XXXXXXXXXXXXXXXXX</p>
                    </div>
                    <div class="col-md-4">
                        <p class="fw-6 text-dark">Currency</p>
                        <p>XXXXXXXXXXXXXXXXX</p>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <p class="fw-6 text-dark">Plataforma de operaciones</p>
                        <p>XXXXXXXXXXXXXXXXX</p>
                    </div>
                    <div class="col-md-4">
                        <p class="fw-6 text-dark">Monto del deposito</p>
                        <p>{{ $orden->amount ? $orden->amount.' USD' : 'XXXXXXXXXXXXXXXXX'}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <p class="fw-6 text-dark">Imagen adjunta</p>
                        <div class="card d-flex p-sm-05 flex-row align-items-center">
                            <svg width="33" height="33" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M24.75 30.25H8.25C6.73122 30.25 5.5 29.0188 5.5 27.5V5.50001C5.5 3.98122 6.73122 2.75001 8.25 2.75001H17.875C17.8873 2.74841 17.8998 2.74841 17.9121 2.75001H17.9204C17.9334 2.75408 17.9467 2.75684 17.9603 2.75826C18.0815 2.76603 18.2012 2.78961 18.3164 2.82838H18.3741C18.3995 2.84616 18.4234 2.86593 18.4456 2.88751C18.5954 2.95409 18.7319 3.04726 18.8485 3.16251L27.0985 11.4125C27.2137 11.5291 27.3069 11.6656 27.3735 11.8154C27.3859 11.8456 27.3955 11.8745 27.4051 11.9061L27.4189 11.9446C27.4573 12.0593 27.4799 12.1786 27.4862 12.2994C27.4874 12.3131 27.4907 12.3265 27.4959 12.3393V12.3475C27.4981 12.3565 27.4995 12.3657 27.5 12.375V27.5C27.5 28.2294 27.2103 28.9288 26.6945 29.4446C26.1788 29.9603 25.4793 30.25 24.75 30.25ZM21.2589 19.25C20.624 19.2147 20.0127 19.4951 19.6254 19.9994C19.2162 20.6303 19.0205 21.376 19.0671 22.1265V23.331C19.0278 24.074 19.2427 24.8082 19.6763 25.4128C20.0891 25.8947 20.7021 26.1578 21.3359 26.125C21.7291 26.1291 22.1194 26.0572 22.4854 25.9133H22.4964H22.4881C22.5009 25.9057 22.5142 25.8993 22.528 25.894H22.5349L22.5569 25.883L22.5857 25.8693C22.8859 25.7312 23.1524 25.5294 23.3668 25.278V22.5129H21.2437V23.5331H22.1196V24.761L22.0096 24.8435C21.8309 24.9572 21.6217 25.0133 21.4101 25.0044C21.0773 25.0306 20.7568 24.8723 20.5755 24.5919C20.3796 24.1764 20.293 23.7178 20.3239 23.2595V22.0454C20.3 21.6085 20.3816 21.1723 20.5618 20.7735C20.7098 20.5098 20.9955 20.3538 21.2974 20.372C21.5269 20.3529 21.7527 20.4395 21.9106 20.6071C22.0746 20.8671 22.1605 21.1688 22.1581 21.4761H23.375C23.3775 20.8619 23.1671 20.2657 22.7796 19.789C22.3707 19.4049 21.8184 19.2095 21.2589 19.25ZM9.625 24.0625C9.59549 24.6072 9.76343 25.1442 10.098 25.575C10.4337 25.9489 10.9203 26.151 11.4221 26.125C11.9204 26.1369 12.3969 25.9207 12.716 25.5379C13.0668 25.0946 13.2451 24.5392 13.2179 23.9745V19.3421H11.9625V23.9099C11.9625 24.6359 11.7796 25.0099 11.4125 25.0099C11.0454 25.0099 10.8721 24.6909 10.8721 24.0625H9.625ZM14.1996 19.3476V26.0384H15.4509V23.6803H16.2855C16.8431 23.711 17.3876 23.5042 17.7843 23.111C18.1603 22.6836 18.3538 22.1258 18.3232 21.5573C18.3476 20.9736 18.1512 20.4022 17.7732 19.9568C17.401 19.544 16.8642 19.3187 16.3089 19.3421L14.1996 19.3476ZM17.875 5.50001V12.375H24.75L17.875 5.50001ZM16.3103 22.55H15.4509V20.4669H16.324C16.5435 20.4678 16.7467 20.5829 16.8603 20.7708C17.0053 21.0096 17.0752 21.2865 17.061 21.5655C17.0781 21.8255 17.0096 22.0839 16.8657 22.3011C16.7317 22.4691 16.5248 22.5618 16.3103 22.55Z" fill="#808E9E"/>
                                </svg>
                                <div class="img-info ms-1">
                                    <p class="fw-6 mb-0">Img_1251.jpg</p>
                                    <p class="mb-0">1 mb</p>
                                </div>                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card p-1">
            <div class="card-header d-block border-bottom mb-1">
                <h4 class="fw-7 mb-2">Estado</h4> 
                @if ($orden->status==='0')
                    <div class="alert alert-warning text-white p-8 text-center">Por Instalar</div>
                @elseif($orden->status==='1')
                    <div class="alert alert-success text-white p-8 text-center">Instalada</div>
                @else
                    <div class="alert alert-danger text-white p-8 text-center">Rechazada</div>  
                @endif
            </div>
            <div class="card-body">
                <h4 class="fw-7 mb-2 my-2">Cambiar Estado</h4> 
                <form class="row col-lg-12 mt-1 mx-0">
                    <div class="col-md-12 px-0">
                        <select id="inputState" class="form-select">
                            <option selected>Seleccionar Estado</option>
                            <option>Instalado</option>
                            <option>Upgrade</option>
                            <option>Desinstalado</option>
                            <option>Rechazado</option>
                        </select>
                        <button type="button" class="btn btn-md btn-primary float-end mt-2">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <script>
    </script>
@endsection