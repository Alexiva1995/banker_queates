
{{-- para los css --}}
@push('page_css')
{{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/vendors/css/tables/datatable/datatables.min.css')}}"> --}}
<link rel="stylesheet" type="text/css" href="{{asset('assets/js/librerias/datatables/datatables.min.css')}}">
@endpush

{{-- para los js --}}
@push('page_vendor_js')
{{-- <script src="{{asset('assets/app-assets/vendors/js/tables/datatable/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/tables/datatable/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script> --}}

<script type="text/javascript" src="{{asset('assets/js/librerias/datatables/datatables.min.js')}}"></script>
@endpush


@push('custom_js')
    <script>
        $('.myTable').DataTable({
            // responsive: true,
         //scrollX: true,
            "destroy":true,
            order: [0, 'desc']

        })
        $('.myTable2').DataTable({
             responsive: true,


            order: [0, 'desc']

        })
    </script>
@endpush
