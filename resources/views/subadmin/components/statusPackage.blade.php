
        <table class="table myTable nowrap scroll-horizontal-vertical table-striped w-100">
            <thead class="">
                <tr class="text-center">
                    <th>Nombre y Apellido</th>
                    <th>Usuario</th>
                    <th>Paquete</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            @include('subadmin.components.packagesTable', ['type' => $type, 'status' => $status])
        </table>
    


