@extends('layout.layout')
@php
    $route = 'ready_orders';
@endphp
@section('title',__('lang.Users'))

@section('header')
    <!--begin::Heading-->
    <h1 class="text-dark fw-bolder my-0 fs-2">{{trans('lang.'.$route)}} </h1>
    <!--end::Heading-->
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb fw-bold fs-base my-1">
        <li class="breadcrumb-item">
            <a href="{{url('/')}}" class="text-muted">
                {{trans('lang.Dashboard')}} </a>
        </li>
        <li class="breadcrumb-item">
            {{trans('lang.'.$route)}}
        </li>
    </ul>
    <!--end::Breadcrumb-->
@endsection

@section('content')
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <!--begin::Post-->
        <div class="content flex-row-fluid" id="kt_content">
            <!--begin::Card-->
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
                            <th class="min-w-125px">{{__('lang.category')}}</th>
                            <th class="min-w-125px">{{__('lang.customer')}}</th>
                            <th class="min-w-125px">{{__('lang.order_date')}}</th>
                            <th class="min-w-125px">{{__('lang.status')}}</th>
                            <th class="min-w-125px">{{__('lang.Actions')}}</th>
                            <th class="min-w-125px">{{__('lang.payment_status')}}</th>
                            <th class="min-w-125px">{{__('lang.provider')}}</th>
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
            <!--end::Card-->
        </div>
        <!--end::Post-->
    </div>
@endsection

@section('script')
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
                    url: '{{ route($route.'.datatable') }}',
                    data: {}
                },
                columns: [

                    {data: 'id', name: 'id', "searchable": true, "orderable": true},
                    {data: 'readyService', name: 'readyService', "searchable": true, "orderable": true},
                    {data: 'customer_name', name: 'customer_name', "searchable": true, "orderable": true},
                    {data: 'created_at', name: 'created_at', "searchable": true, "orderable": true},
                    {data: 'status', name: 'status', "searchable": true, "orderable": true},
                    {data: 'actions', name: 'actions', "searchable": false, "orderable": false},
                    {data: 'payment_status', name: 'payment_status', "searchable": true, "orderable": true},
                    {data: 'provider_name', name: 'provider_name', "searchable": true, "orderable": true},
                ]
            });
            $.ajax({
                url: "{{ route($route.'.table_buttons') }}",
                success: function (data) {
                    $('.add_button').append(data);
                },
                dataType: 'html'
            });
        });

    </script>

@endsection

