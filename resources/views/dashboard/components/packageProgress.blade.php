<div class="col-md-5">
    <div class="card p-2 mb-2">
        <h5 class="fw-700">Avances del paquete</h5>
            <select class="select2 form-control" name="package_select" id="package_select"
                data-toggle="select" class="form-control">
                @if(count($user_packages) > 0)
                <option disabled selected>Seleccione un paquete</option>
                    @foreach ($user_packages as $package)
                        <option id="active" inversion-id="{{$package->investment_id}}" value="{{$package->investment_id}}">{{"{$package->name} {$package->amount}"}}</option>
                    @endforeach
                @else
                    <option disabled selected>No posee paquetes</option>
                @endif;
            </select>
        <div class="row mt-auto fd-sm">
            <div class="col-lg-8 col-sm-12 md-50 ">
                <div id="gainDonutChart"></div>
            </div>
            <div class="col-lg-4 col-sm-12 d-flex align-items-center border-start justify-content-center md-50">
                <div class="card-body p-0">
                    <h1 class="text-center mb-0"><b id="packagePercent">0%</b></h1>
                    <p class="text-center font-medium-2 mb-0" id="totalAdvance">Avance total</p>
                </div>
            </div>
        </div>
    </div>
</div>