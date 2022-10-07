@extends('layouts/contentLayoutMaster')
@section('content')
<div class="container">
    <div class="row">
      <div class="col-sm-12 card ">

        <div class="row">
            <div class="col-sm-12 d-flex justify-content-center">
                <div>
                    <h2 class="mt-2"> <strong>Solicitudes de verificacion KYC </strong></h2>
                </div>
            </div>
                <div class="col-sm-12">
                    <div class="table-responsive" id="table">
                        <table class="table " id="myTable">
                            <thead class="">
                                <tr class="text-center text-white bg-purple-alt2">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Tipo de documento</th>
                                    <th>Documento</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($KYC as $key => $K)
                                    <tr>
                                        <td>{{ $K->user_id }}</td>
                                       <td>{{'usuario'}}</td>
                                        <td>{{ $K->type_kyc }}</td>
                                        <td class="">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <button style="font-size: 10px" class="btn btn-success me-1"  type="button" data-bs-toggle="modal" data-bs-target="#frontModal{{ $K->user_id }}"><i class="fa fa-address-card" aria-hidden="true"></i> Frontal del documento</button>
                                                </div>
                                                <div class="col-sm-6">
                                                    <button style="font-size: 10px" class="btn btn-info"  type="button"  data-bs-toggle="modal" data-bs-target="#frontModal{{ $K->user_id }}"><i class="fa fa-credit-card" aria-hidden="true"></i> Espalda del documento</button>
                                                </div>
                                                
                                              </div>
                                        </td>

                                        <td>
                                            <form method="POST" action="{{route('KYC-accion')}}">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <button style="font-size: 10px" type="submit" name="aprovar" value="{{ $K->user_id  }}" class="btn btn-success me-1"><i class="fa fa-check" aria-hidden="true" ></i> Aprobar</button>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <button style="font-size: 10px" type="submit" name="cancelar" value="{{ $K->user_id  }}" class="btn btn-danger"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</button>
                                                    </div>
                                                  </div>
                                            </form>
                                        </td>

                                    </tr>
                                    @include('Kyc.KYCindex.KYCcomponentes.frontalModal')
                                    @include('Kyc.KYCindex.KYCcomponentes.traseroModal')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('Kyc.KYCindex.KYCcomponentes.dataTable')

@endsection

