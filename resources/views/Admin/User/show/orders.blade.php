
<div class="card">
    <!--begin::Card body-->
    <div class="card-body pt-0">

        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-4 gy-5" id="users_table">
            <!--begin::Table head-->
            <thead>
            <!--begin::Table row-->

            <tr class="text-start text-muted fw-bolder fs-5 text-uppercase gs-0">
                <th class="min-w-125px">{{__('lang.order_number')}}</th>
                <th class="min-w-125px">{{__('lang.the_service')}}</th>
                <th class="min-w-125px">{{__('lang.category')}}</th>
                <th class="min-w-125px">{{__('lang.order_date')}}</th>
                <th class="min-w-125px">{{__('lang.status')}}</th>
                <th class="min-w-125px">{{__('lang.Actions')}}</th>
                <th class="min-w-125px">{{__('lang.provider')}}</th>
                <th class="min-w-125px">{{__('lang.payment_status')}}</th>
            </tr>
            <!--end::Table row-->
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->


            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
    <!--end::Card body-->
</div>
@push('scripts')
    <script src="{{ URL::asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>

    <script type="text/javascript">
        $(function () {
            var table = $('#users_table').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                aaSorting: [],
                "dom": "<'card-header border-0 p-0 pt-6'<'card-title' <'d-flex align-items-center position-relative my-1'f> r> <'card-toolbar' <'d-flex justify-content-end add_button'B> r>>  <'row'l r> <''t><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable
                lengthMenu: [[10, 25, 50, 100, 250, -1], [10, 25, 50, 100, 250, "All"]],
                "language": {
                    search: '<i class="fa fa-eye" aria-hidden="true"></i>',
                    searchPlaceholder: 'Search',
                    "url": "{{ url('admin/assets/ar.json') }}"
                },
                buttons: [
                    {
                        extend: 'print',
                        className: 'btn btn-light-primary me-3',
                        text: '<i class="bi bi-printer-fill fs-2x"></i>'
                    },
                    // {extend: 'pdf', className: 'btn btn-raised btn-danger', text: 'PDF'},
                    {
                        extend: 'excel',
                        className: 'btn btn-light-primary me-3',
                        text: '<i class="bi bi-file-earmark-spreadsheet-fill fs-2x"></i>'
                    },
                    // {extend: 'colvis', className: 'btn secondary', text: 'إظهار / إخفاء الأعمدة '}
                ],
                ajax: {
                    url: '{{ route('users.orders.datatable',$data->id) }}',
                    data: {}
                },
                columns: [

                    {data: 'id', name: 'id', "searchable": true, "orderable": true},
                    {data: 'service', name: 'service', "searchable": true, "orderable": true},
                    {data: 'readyService', name: 'readyService', "searchable": true, "orderable": true},
                    {data: 'created_at', name: 'created_at', "searchable": true, "orderable": true},
                    {data: 'status', name: 'status', "searchable": true, "orderable": true},
                    {data: 'actions', name: 'actions', "searchable": false, "orderable": false},
                    {data: 'provider_name', name: 'provider_name', "searchable": true, "orderable": true},
                    {data: 'payment_status', name: 'payment_status', "searchable": true, "orderable": true},
                ]
            });
        });
    </script>
    <?php
    $message = session()->get("message");
    ?>
    @if( session()->has("message"))
        <script>
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
                "preventDuplicates": false,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            toastr.success("نجاح", "{{$message}}");
        </script>



    @endif
@endpush
