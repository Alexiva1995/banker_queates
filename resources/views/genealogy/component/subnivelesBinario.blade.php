<a class="a" onclick="tarjeta({{$data}},'{{ route('genealogy_type_id', [base64_encode($data->id)]) }}', '{{ asset('img/logo/blackbox.png')}}')">
    <div class="media d-flex justify-content-center ">
        {{--@if (empty($data->photoDB))
            <img src="{{ asset('assets/img/pandora-logo.png') }}" height="48" width="48"
                class="rounded-circle align-self-center mr-1 di" alt="{{ $data->firstname }}" title="{{ $data->firstname }}">
        @else--}}
        
        @if ($data->gender == null || $data->gender == 0)
            <img src="{{ asset('images/avatars-profile/1.png') }}" height="70" width="64"
            class="rounded-circle" style="margin-top: -4px" alt="{{ $data->name }}"
            title="{{ $data->name }}">
        @else
            <img src="{{ asset('images/avatars-profile/2.png') }}" height="64" width="64"
            class="rounded-circle " style="margin-top: -4px" alt="{{ $data->name }}"
            title="{{ $data->name }}">
        @endif

        {{-- PARA CUANDO SE TENGAN LAS IMAGENES CORRESPONDIENTES--}}
        {{--@if( ($data["range_id"] != null) )
            <img src="{{ asset('images/ensignRanges/'.$data['range_id'].'.png') }}" height="80" width="80"
            class="rounded-circle align-self-center mr-1 di" alt="{{$data['range_id']}}">
        
        @elseif( ($data["range_id"] == null) && (!empty($data->investment->package_id)) )
            <img src="{{ asset('images/ensignLicences/'.$data['range_id'].'.png') }}" height="80" width="80"
            class="rounded-circle align-self-center mr-1 di" alt="{{$data['range_id']}}">
        
        @elseif( ($data["range_id"] == null) && (empty($data->investment->package_id)) )

            @if ($data->gender == null || $data->gender == 0)
                <img src="{{ asset('images/avatars-profile/1.png') }}" height="70" width="64"
                class="rounded-circle" style="margin-top: -4px" alt="{{ $data->name }}"
                title="{{ $data->name }}">
            @else
                <img src="{{ asset('images/avatars-profile/2.png') }}" height="64" width="64"
                class="rounded-circle " style="margin-top: -4px" alt="{{ $data->name }}"
                title="{{ $data->name }}">
            @endif

        @endif--}}
        
    </div>

    <div class="media-body">
            <h5 class=""> <b>{{ $data->name }}</b></h5>
            {{-- esto se debe quitar cuando ya esten las imagenes, solo es de prueba para saber que llegan los datos--}}
            @if( $data->investment != null )
                <h5 class="mt-0"> <b>Licencia: {{ $data->investment->package_id }}</b></h5>
            @endif
            @if( $data->range_id != null )
                <h5 class="mt-0"> <b>Rango: {{ $data->range_id }}</b></h5>
            @endif
    </div>
</a>
