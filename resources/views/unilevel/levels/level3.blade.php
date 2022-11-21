<div id="tab-body-3" class="tab-body d-none">
    <div class="table-responsive">
        <table class="table  nowrap scroll-horizontal-vertical myTable table-striped w-100">
            <thead>
                <tr>
                    <th class="fw-600">#</th>
                    <th class="fw-600">Usuario</th>
                    <th class="fw-600">Email</th>
                    <th class="fw-600">Licencia</th>
                    <th class="fw-600">Estado</th>
                    <th class="fw-600">Afiliado por</th>
                    <th class="fw-600">Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($referals_childrens as $user)
                    @foreach ($user->children as $user)
                        @foreach ($user->children as $user)
                            <tr>
                                <td>{{ $user->id }}</td>

                                <td>{{ $user->username }}</td>
                                <td>{{$user->email}}</td>
                                @if($user->investment != null)
                                    <td>{{$user->investment->LicensePackage->name}}</td>
                                @else
                                    <td>No tiene licencias activas</td>
                                @endif

                                @if ($user->investments->count() > 0)
                                    @if ($user->investments->last()->status == 0)
                                        <td class="text-center">
                                            <span class="badge bg-warning">En espera</span>
                                        </td>
                                    @elseif ($user->investments->last()->status == 1)
                                        <td class="text-center">
                                            <span class="badge bg-success">Activo</span>
                                        </td>
                                    @else
                                        <td class="text-center">
                                            <span class="badge bg-danger">Inactivo</span>
                                        </td>
                                    @endif
                                @else
                                    <td>-</td>
                                @endif
                                <td>{{ $user->padre->fullName() }}</td>
                                <td>{{ date('Y-m-d', strtotime($user->created_at)) }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>
