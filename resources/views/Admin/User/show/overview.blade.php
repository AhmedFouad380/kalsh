<!--begin::details View-->
<div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
    <!--begin::Card header-->
    <div class="card-header cursor-pointer">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">{{trans('lang.profile_details')}}</h3>
        </div>
        <!--end::Card title-->
        <!--begin::Action-->
    {{--                    <a href="../../demo7/dist/account/settings.html" class="btn btn-primary align-self-center">Edit--}}
    {{--                        Profile</a>--}}
    <!--end::Action-->
    </div>
    <!--begin::Card header-->
    <!--begin::Card body-->
    <div class="card-body p-9">
        <!--begin::Row-->
        <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">{{trans('lang.full_name')}}</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <span class="fw-bolder fs-6 text-gray-800">{{$data->name}}</span>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
        <!--begin::Input group-->
        <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">{{trans('lang.email')}}</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
                <span class="fw-bold text-gray-800 fs-6">{{$data->email}}</span>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">{{trans('lang.contact_phone')}}
            </label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8 d-flex align-items-center">
                <span class="fw-bolder fs-6 text-gray-800 me-2">{{$data->phone}}</span>
                @if($data->email_verified_at)
                    <span  class="badge badge-success">{{trans('lang.verified')}}</span>
                @else
                    <span  class="badge badge-danger">{{trans('lang.un_verified')}}</span>
                @endif
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">{{trans('lang.rate')}}</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <div class="rating-label checked ">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen029.svg-->
                    <span class="svg-icon svg-icon-2">{{$data->rate}}
                                    <svg width="24"
                                         height="24"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z"
                                        fill="currentColor"></path>
                                </svg>
                                </span>
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <!--end::Notice-->
    </div>
    <!--end::Card body-->
</div>
<!--end::details View-->
<!--begin::Row-->
<div class="row gy-5 g-xl-10">
    <!--begin::Col-->
    <div class="col-xl-6">
        <!--begin::Charts Widget 1-->
        <div class="card card-xl-stretch mb-xl-10">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <!--begin::Title-->
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">{{trans('lang.location_on_map')}}</span>
                </h3>
                <!--end::Title-->
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Chart-->
                <div id="us1" style="width:100%;height:400px;"></div>
                <!--end::Chart-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Charts Widget 1-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-xl-6">
        <!--begin::Tables Widget 1-->
        <div class="card card-xl-stretch mb-5 mb-xl-10">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                                <span
                                    class="card-label fw-bolder fs-3 mb-1">{{trans('lang.services_that_i_done')}}</span>
                    {{--                                <span class="text-muted fw-bold fs-7">Pending 10 tasks</span>--}}
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-3">
                <!--begin::Table container-->

                <!--end::Table container-->
            </div>
        </div>
        <!--endW::Tables Widget 1-->
    </div>
    <!--end::Col-->
</div>

@push('scripts')
    <script>
        function myMap() {
            var mapProp = {
                center: new google.maps.LatLng({{$data->lat}},{{$data->lng}}),
                zoom: 5,
            };
            var map = new google.maps.Map(document.getElementById("us1"), mapProp);
        }
    </script>
    <script
        src="http://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=myMap"></script>
    <script src="{{ asset('assets/js/locationpicker.jquery.js')}}"></script>
    <script>
        $('#us1').locationpicker({
            location: {
                latitude: {{$data->lat}},
                longitude: {{$data->lng}}
            },
            radius: 300,
            markerIcon: "{{url('/defaults/map-marker.png')}}",
            inputBinding: {
                latitudeInput: $('#lat'),
                longitudeInput: $('#lng')
            }
        });
        $('#us1').setOptions(
            {draggable: false, zoomControl: false, scrollwheel: false, disableDoubleClickZoom: true}
        )
    </script>
@endpush


