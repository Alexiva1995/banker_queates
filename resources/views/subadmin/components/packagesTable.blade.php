@foreach ($formularys as $formulary)
    @if ($formulary != null)
        @if ($formulary->type == $type)
            <tbody>
                <tr class="text-center">
                    <td>{{ $formulary->user->name }}</td>
                    <td>{{ $formulary->user->email }}</td>
                    <td>{{ $formulary->package }}</td>
                    <td>{{ $formulary->package }}</td>
                    <td>{{ $formulary->created_at }}</td>
                    <td>
                        @if ($formulary->status == '0')
                            <button class="btn bg-light-warning" type="button">
                                {{ $formulary->status() }}
                            </button>
                        @elseif ($formulary->status == '1')
                            <button class='btn bg-light-success' type="button">
                                {{ $formulary->status() }}
                            </button>
                        @elseif ($formulary->status == '2' || $formulary->status == '3')
                            <button class='btn bg-light-warning' type="button">
                                {{ $formulary->status() }}
                            </button>
                        @elseif ($formulary->status == '4')
                            <button class='btn bg-light-danger' type="button">
                                {{ $formulary->status() }}
                            </button>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('subadmin.details', $formulary->id) }}">
                            <i data-feather='eye' style="width: 1.5rem !important; height: 1.5rem !important"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        @endif
    @endif
@endforeach
