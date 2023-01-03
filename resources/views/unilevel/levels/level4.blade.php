<div id="tab-body-4" class="tab-body d-none">
    <div class="table-responsive">
        <table class="table  nowrap scroll-horizontal-vertical myTable table-striped w-100">
            <thead>
                <tr>
                    <th class="text-center fw-600">#</th>
                    <th class="text-center fw-600">User</th>
                    <th class="text-center fw-600">Email</th>
                    <th class="text-center fw-600">License</th>
                    <th class="text-center fw-600">Status</th>
                    <th class="text-center fw-600">Affiliated by</th>
                    <th class="text-center fw-600">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($referals_childrens as $user)
                    @foreach ($user->children as $user)
                        @foreach ($user->children as $user)
                            @foreach ($user->children as $key => $user)
                         <tr {{$key%2 ==0 ? "class=cebra" : null}}>
                        <td class="text-center ">{{ $user->id }}</td>
                        <td class="text-center ">{{ $user->username }}</td>
                        <td class="text-center ">{{$user->email}}</td>
                        @if($user->investment != null)
                            <td class="text-center ">{{$user->investment->LicensePackage->name}}</td>
                            @else
                            <td class="text-center ">Don't have an active license</td>
                        @endif

                        @if ($user->investments->count() > 0)
                            @if ($user->investments->last()->status == 0)
                                <td class="text-center">
                                    <span class="badge bg-warning">Pending</span>
                                </td>
                            @elseif ($user->investments->last()->status == 1)
                                <td class="text-center">
                                    <span class="badge bg-success">Active</span>
                                </td>
                            @else
                                <td class="text-center">
                                    <span class="badge bg-danger">Inactive</span>
                                </td>
                            @endif
                        @else
                            <td class="text-center ">-</td>
                        @endif
                        <td class="text-center ">{{ $user->padre->fullName() }}</td>
                        <td class="text-center ">{{ date('Y-m-d', strtotime($user->created_at)) }}</td>
                    </tr>
                            @endforeach
                        @endforeach
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>
