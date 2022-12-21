
    <div class="media d-flex justify-content-center ">
        {{--@if (empty($data->photoDB))
            <img src="{{ asset('assets/img/pandora-logo.png') }}" height="48" width="48"
                class="rounded-circle align-self-center mr-1 di" alt="{{ $data->firstname }}" title="{{ $data->firstname }}">
        @else--}}
        @if( ($data["range_id"] != null) )
            <img src="{{ asset('images/ensignRanges/'.$data['range_id'].'.png') }}" height="70" width="90"
            class=""  style="margin-top: -2px" alt="{{$data['range_id']}}">
        @elseif($data['range_id'] == null && $data->hasActiveLicense())
        <img src="{{ asset('images/ensignRanges/0.png') }}" height="70" width="70"
        class=""  style="margin-top: -2px" alt="{{ $data->name }}"
        title="{{ $data->name }}">
        @elseif ( ($data["range_id"] == null) && !$data->hasActiveLicense() )
            <img src="{{ asset('images/ensignRanges/0.png') }}" height="70" width="70"
            class=""  style="margin-top: -2px" alt="{{ $data->name }}"
            title="{{ $data->name }}">
        @endif
    </div>
    <div class="media-body">
            <h5 style="font-size: 0.8rem"> <b>{{ $data->name }}</b></h5>
    </div>

