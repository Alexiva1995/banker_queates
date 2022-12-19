    <div class="media d-flex justify-content-center ">
        {{--@if (empty($data->photoDB))
            <img src="{{ asset('assets/img/pandora-logo.png') }}" height="48" width="48"
                class="rounded-circle align-self-center mr-1 di" alt="{{ $data->firstname }}" title="{{ $data->firstname }}">
        @else--}}
        @if( ($data["range_id"] != null) )
            <img src="{{ asset('images/ensignRanges/'.$data['range_id'].'.png') }}" height="70" width="90"
            class=""  style="margin-top: -2px" alt="{{$data['range_id']}}">
        @elseif($data['range_id'] == null && $data->hasActiveLicense())
            <img src="{{ asset('images/ensignRanges/' . $data->investment->package_id . '.png') }}"
            height="70" width="90"
            class=""  style="margin-top: -2px" alt="{{$data['range_id']}}">
        @elseif ( ($data["range_id"] == null) && !$data->hasActiveLicense() )
            <img src="{{ asset('images/ensignRanges/0.png') }}" height="70" width="70"
            class="" style="margin-top: -2px" alt="{{$data['range_id']}}">
        @endif
    </div>
    <div class="media-body">
            <h6 style="color: #544E67; font-size: 10px"> <b>{{ $data->name }}</b></h6>
    </div>


