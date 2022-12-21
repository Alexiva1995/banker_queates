@extends('layouts/contentLayoutMaster')

@section('title', 'Creación de ticket')

@section('content')
    <style>
        .categorie-content {
            gap: 1rem;
            row-gap: 1.8rem;
            justify-content: flex-start;
        }

        .categorie {
            margin-right: 10px;
            font-size: 15px;
            font-weight: bold;
            padding: 10px 15px;
        }

        .content-input input,
        .content-select select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        .content-input input {
            visibility: hidden;
            position: absolute;
            right: 0;
        }

        .content-input {
            position: relative;
            display: block;
            cursor: pointer;
        }

        /* Estas reglas se aplicarán a todos los span despues de un input de tipo radio*/
        .content-input input[type=radio]+span {
            width: 13rem;
            border: 1px solid #02D6AC;
            border-radius: 10px;
        }

        .content-input input[type=radio]+span:before {
            background-color: #07B0F2;
            color: #fff;
        }

        .content-input input[type=radio]:checked+span {
            background: #05A5E9;
            color: #fff;
            border-radius: 10px;
            opacity: 1;
            width: 13rem;
        }
    </style>
    <div class="d-flex my-2">
        <p style="color:#808E9E;" class="fw-700">Soporte</p><span class="fw-normal mx-1">|</span>
        <p>Ticket</p>
    </div>

    <section id="basic-vertical-layouts">
        <div class="match-height d-flex justify-content-center">
            <div class="col-md-12 col-12">
                <div class="card p-2">
                    <!--Card Header--->
                    <div class="card-header">
                        <h4 class="mt-2 fw-bold fw-600">
                            Categorias
                        </h4>
                    </div>
                    <!--Card Header End--->
                    <div class="card-body">
                        <form action="{{ route('ticket.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 mb-2" style="width:100%">
                                    <!--SELECT-->
                                    <div class="d-flex justify-content-between categorie-content flex-wrap mt-1">
                                        <label style="width:18%" class=" d-flex  content-input">
                                            <input type="radio" name="categories" id="nivel_1" value="0" checked>
                                            <span style="font-size: 0.9rem" class="text-center categorie" >Ayuda</span>
                                            </input>
                                        </label>
                                        <label style="width:18%" class="d-flex  content-input">
                                            <input type="radio" name="categories" id="nivel_1" value="1">
                                            <span style="font-size: 0.9rem" class="text-center categorie">
                                                Soporte Tecnico</span>
                                            </input>
                                        </label>
                                        <label style="width:18%" class="d-flex  content-input">
                                            <input type="radio" name="categories" id="nivel_1" value="2">
                                            <span style="font-size: 0.9rem" class="text-center categorie">
                                                Correcion de Datos</span>
                                            </input>
                                        </label>
                                        <label style="width:18%" class="d-flex content-input">
                                            <input type="radio" name="categories" id="nivel_1" value="3">
                                            <span style="font-size: 0.9rem" class="text-center categorie">
                                                Bonos</span>
                                            </input>
                                        </label>
                                        <label style="width:18%" class="d-flex  content-input">
                                            <input type="radio" name="categories" id="nivel_1" value="4">
                                            <span style="font-size: 0.9rem" class="text-center categorie">
                                                Inversion Total</span>
                                            </input>
                                        </label>
                                    </div>
                                    <!--SELECT END-->
                                </div>
                                <div class="w-100"></div>
                                {{-- <div class="col-sm-4">
                                <!--INPUT DE PRIORIDADES-->
                                <span class=" text-bold-600">Prioridades:</span>
                                <select class="form-select" name="priority">
                                    <option value="0">Alta</option>
                                    <option value="1">Media</option>
                                    <option value="2">Baja</option>
                                </select>
                                <!--INPUT DE PRIORIDADES END-->
                                </div> --}}
                                <div class="col-sm-6 mb-2 mt-2">
                                    <!--Asunto -->
                                    <h4 class="text-bold-600 fw-600">Asunto:</h4>
                                    <div class="input-group input-group-lg">
                                        <input type="text" name="issue" class="form-control" required>
                                    </div>
                                    <!--Asunto end-->
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 ">
                                        <div class=" card" style="background-color: #D8EDED; padding: 10em;">
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <input class="form-control " placeholder="Escriba un mensaje"
                                                        type="text" id="message" name="message"
                                                        style="background-color: #D8EDED;" required></input>
                                                    <!--MENSAJE END-->
                                                    </div>
                                                    <div class="col-sm-12 text-center mt-1">
                                                        @error('image')
                                                                <small class="text-danger ">
                                                                    {{ $message }}
                                                                </small>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <!--MENSAJE-->
                                                
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="">
                                                    <div class="row">
                                                        <div class="col-sm-7 d-flex justify-content-end">
                                                            <form class="p-0" id="frm-example" name="frm-example">
                                                                <label for="hiddenBtn" class="choose-btn capa-interior"
                                                                    id="chooseBtn"
                                                                    style="margin-top: 0.5em; margin-right: 3em;"><svg
                                                                        width="24" height="24" viewBox="0 0 24 24"
                                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M20.75 23.25H3.25C1.86929 23.25 0.75 22.1307 0.75 20.75V3.25C0.75 1.86929 1.86929 0.75 3.25 0.75H20.75C22.1307 0.75 23.25 1.86929 23.25 3.25V20.75C23.25 22.1307 22.1307 23.25 20.75 23.25ZM3.25 3.25V20.75H20.75V3.25H3.25ZM19.5 18.25H4.5L8.25 13.25L9.5 14.5L13.25 9.5L19.5 18.25ZM7.625 10.75C6.58947 10.75 5.75 9.91053 5.75 8.875C5.75 7.83947 6.58947 7 7.625 7C8.66053 7 9.5 7.83947 9.5 8.875C9.5 9.91053 8.66053 10.75 7.625 10.75Z"
                                                                            fill="#2E3A59" />
                                                                    </svg>
                                                                </label>
                                                                <input type="file" id="hiddenBtn" name="image">
                                                            </form>
                                                        </div>

                                                        <div class="col-sm-5 d-flex justify-content-end">
                                                            <button
                                                                class="mb-2 btn btn-primary waves-effect waves-float waves-light"
                                                                style="width: 8em">Enviar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--CONTENEDOR DE ARCHIVO ADJUNTO END-->
            </div>
        </div>
    </section>
@endsection
