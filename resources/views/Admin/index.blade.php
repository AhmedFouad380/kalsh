@extends('layout.layout')

@section('title')
    {{__('lang.Dashboard')}}
@endsection
@section('css')
    <link href="{{asset('dashboard//plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet"
          type="text/css"/>
    <style>
        .bootstrap-datetimepicker-widget {
            display: contents !important;
        }


    </style>
@endsection

@section('header')
    <div id="kt_header" class="header" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
        <!--begin::Container-->
        <div class="container-xxl d-flex align-items-center justify-content-between" id="kt_header_container">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-2 pb-2 pb-lg-0" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">
                <!--begin::Heading-->
                <h1 class="text-dark fw-bolder my-0 fs-2">{{__('lang.Dashboard')}} </h1>
                <!--end::Heading-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb fw-bold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{url('/')}}" class="text-muted">{{__('lang.Dashboard')}}</a>
                    </li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title=-->
            <!--begin::Wrapper-->
            <div class="d-flex d-lg-none align-items-center ms-n2 me-2">
                <!--begin::Aside mobile toggle-->
                <div class="btn btn-icon btn-active-icon-primary" id="kt_aside_toggle">
                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                    <span class="svg-icon svg-icon-2x">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
											<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
										</svg>
									</span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Aside mobile toggle-->
                <!--begin::Logo-->
                <a href="../../demo7/dist/index.html" class="d-flex align-items-center">
                    <img alt="Logo" src="{{asset('assets/media/logos/logo-demo7.svg')}}" class="h-30px" />
                </a>
                <!--end::Logo-->
            </div>
            <!--end::Wrapper-->
            <!--begin::Toolbar wrapper-->
        {{--            <div class="d-flex flex-shrink-0">--}}
        {{--                <!--begin::Invite user-->--}}
        {{--                <div class="d-flex ms-3">--}}
        {{--                    <a href="#" class="btn btn-flex flex-center bg-body btn-color-gray-700 btn-active-color-primary w-40px w-md-auto h-40px px-0 px-md-6" data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">--}}
        {{--                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->--}}
        {{--                        <span class="svg-icon svg-icon-2 svg-icon-primary me-0 me-md-2">--}}
        {{--											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">--}}
        {{--												<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />--}}
        {{--												<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />--}}
        {{--											</svg>--}}
        {{--										</span>--}}
        {{--                        <!--end::Svg Icon-->--}}
        {{--                        <span class="d-none d-md-inline">New Member</span>--}}
        {{--                    </a>--}}
        {{--                </div>--}}
        {{--                <!--end::Invite user-->--}}
        {{--                <!--begin::Create app-->--}}
        {{--                <div class="d-flex ms-3">--}}
        {{--                    <a href="#" class="btn btn-flex flex-center bg-body btn-color-gray-700 btn-active-color-primary w-40px w-md-auto h-40px px-0 px-md-6" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app" id="kt_toolbar_primary_button">--}}
        {{--                        <!--begin::Svg Icon | path: icons/duotune/general/gen005.svg-->--}}
        {{--                        <span class="svg-icon svg-icon-2 svg-icon-primary me-0 me-md-2">--}}
        {{--											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">--}}
        {{--												<path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM12.5 18C12.5 17.4 12.6 17.5 12 17.5H8.5C7.9 17.5 8 17.4 8 18C8 18.6 7.9 18.5 8.5 18.5L12 18C12.6 18 12.5 18.6 12.5 18ZM16.5 13C16.5 12.4 16.6 12.5 16 12.5H8.5C7.9 12.5 8 12.4 8 13C8 13.6 7.9 13.5 8.5 13.5H15.5C16.1 13.5 16.5 13.6 16.5 13ZM12.5 8C12.5 7.4 12.6 7.5 12 7.5H8C7.4 7.5 7.5 7.4 7.5 8C7.5 8.6 7.4 8.5 8 8.5H12C12.6 8.5 12.5 8.6 12.5 8Z" fill="black" />--}}
        {{--												<rect x="7" y="17" width="6" height="2" rx="1" fill="black" />--}}
        {{--												<rect x="7" y="12" width="10" height="2" rx="1" fill="black" />--}}
        {{--												<rect x="7" y="7" width="6" height="2" rx="1" fill="black" />--}}
        {{--												<path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black" />--}}
        {{--											</svg>--}}
        {{--										</span>--}}
        {{--                        <!--end::Svg Icon-->--}}
        {{--                        <span class="d-none d-md-inline">New App</span>--}}
        {{--                    </a>--}}
        {{--                </div>--}}
        {{--                <!--end::Create app-->--}}
        {{--                <!--begin::Chat-->--}}
        {{--                <div class="d-flex align-items-center ms-3">--}}
        {{--                    <!--begin::Menu wrapper-->--}}
        {{--                    <div class="btn btn-icon btn-primary w-40px h-40px pulse pulse-white" id="kt_drawer_chat_toggle">--}}
        {{--                        <!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->--}}
        {{--                        <span class="svg-icon svg-icon-2">--}}
        {{--											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">--}}
        {{--												<path opacity="0.3" d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z" fill="black" />--}}
        {{--												<rect x="6" y="12" width="7" height="2" rx="1" fill="black" />--}}
        {{--												<rect x="6" y="7" width="12" height="2" rx="1" fill="black" />--}}
        {{--											</svg>--}}
        {{--										</span>--}}
        {{--                        <!--end::Svg Icon-->--}}
        {{--                        <span class="pulse-ring"></span>--}}
        {{--                    </div>--}}
        {{--                    <!--end::Menu wrapper-->--}}
        {{--                </div>--}}
        {{--                <!--end::Chat-->--}}
        {{--            </div>--}}
        <!--end::Toolbar wrapper-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Breadcrumb-->
@endsection

@section('content')

    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <!--begin::Post-->


        <div class="content flex-row-fluid" id="kt_content">
            <!--begin::Card-->
                <!--begin::Card body-->
            <div class="row g-5 g-xl-8">
                <div class="col-xl-3">
                    <!--begin::Statistics Widget 5-->
                    <a href="#" class="card bg-body hoverable card-xl-stretch mb-xl-8">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                            <span class="svg-icon svg-icon-primary svg-icon-3x ms-n1">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect x="8" y="9" width="3" height="10" rx="1.5" fill="black" />
													<rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black" />
													<rect x="18" y="11" width="3" height="8" rx="1.5" fill="black" />
													<rect x="3" y="13" width="3" height="6" rx="1.5" fill="black" />
												</svg>
											</span>
                            <!--end::Svg Icon-->
                            <div class="text-gray-900 fw-bolder fs-2 mb-2 mt-5">411</div>
                            <div class="fw-bold text-gray-400">Users</div>
                        </div>
                        <!--end::Body-->
                    </a>
                    <!--end::Statistics Widget 5-->
                </div>
                <div class="col-xl-3">
                    <!--begin::Statistics Widget 5-->
                    <a href="#" class="card bg-dark hoverable card-xl-stretch mb-xl-8">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                            <span class="svg-icon svg-icon-gray-100 svg-icon-3x ms-n1">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path opacity="0.3" d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z" fill="black" />
													<path d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z" fill="black" />
													<path d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z" fill="black" />
												</svg>
											</span>
                            <!--end::Svg Icon-->
                            <div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5">240</div>
                            <div class="fw-bold text-gray-100">Providers</div>
                        </div>
                        <!--end::Body-->
                    </a>
                    <!--end::Statistics Widget 5-->
                </div>
                <div class="col-xl-3">
                    <!--begin::Statistics Widget 5-->
                    <a href="#" class="card bg-warning hoverable card-xl-stretch mb-xl-8">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                            <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path opacity="0.3" d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z" fill="black" />
													<path d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z" fill="black" />
												</svg>
											</span>
                            <!--end::Svg Icon-->
                            <div class="text-white fw-bolder fs-2 mb-2 mt-5">1502</div>
                            <div class="fw-bold text-white">Orders</div>
                        </div>
                        <!--end::Body-->
                    </a>
                    <!--end::Statistics Widget 5-->
                </div>
                <div class="col-xl-3">
                    <!--begin::Statistics Widget 5-->
                    <a href="#" class="card bg-info hoverable card-xl-stretch mb-5 mb-xl-8">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Svg Icon | path: icons/duotune/graphs/gra007.svg-->
                            <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path opacity="0.3" d="M10.9607 12.9128H18.8607C19.4607 12.9128 19.9607 13.4128 19.8607 14.0128C19.2607 19.0128 14.4607 22.7128 9.26068 21.7128C5.66068 21.0128 2.86071 18.2128 2.16071 14.6128C1.16071 9.31284 4.96069 4.61281 9.86069 4.01281C10.4607 3.91281 10.9607 4.41281 10.9607 5.01281V12.9128Z" fill="black" />
													<path d="M12.9607 10.9128V3.01281C12.9607 2.41281 13.4607 1.91281 14.0607 2.01281C16.0607 2.21281 17.8607 3.11284 19.2607 4.61284C20.6607 6.01284 21.5607 7.91285 21.8607 9.81285C21.9607 10.4129 21.4607 10.9128 20.8607 10.9128H12.9607Z" fill="black" />
												</svg>
											</span>
                            <!--end::Svg Icon-->
                            <div class="text-white fw-bolder fs-2 mb-2 mt-5">26</div>
                            <div class="fw-bold text-white">Slider</div>
                        </div>
                        <!--end::Body-->
                    </a>
                    <!--end::Statistics Widget 5-->
                </div>
            </div>
            <div class="row g-5 g-xl-8">
                <div class="col-xl-3">
                    <!--begin::Statistics Widget 5-->
                    <a href="#" class="card bg-body hoverable card-xl-stretch mb-xl-8">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                            <span class="svg-icon svg-icon-primary svg-icon-3x ms-n1">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect x="8" y="9" width="3" height="10" rx="1.5" fill="black" />
													<rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black" />
													<rect x="18" y="11" width="3" height="8" rx="1.5" fill="black" />
													<rect x="3" y="13" width="3" height="6" rx="1.5" fill="black" />
												</svg>
											</span>
                            <!--end::Svg Icon-->
                            <div class="text-gray-900 fw-bolder fs-2 mb-2 mt-5">7</div>
                            <div class="fw-bold text-gray-400">Services</div>
                        </div>
                        <!--end::Body-->
                    </a>
                    <!--end::Statistics Widget 5-->
                </div>
                <div class="col-xl-3">
                    <!--begin::Statistics Widget 5-->
                    <a href="#" class="card bg-dark hoverable card-xl-stretch mb-xl-8">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                            <span class="svg-icon svg-icon-gray-100 svg-icon-3x ms-n1">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path opacity="0.3" d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z" fill="black" />
													<path d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z" fill="black" />
													<path d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z" fill="black" />
												</svg>
											</span>
                            <!--end::Svg Icon-->
                            <div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5">201</div>
                            <div class="fw-bold text-gray-100">Stores</div>
                        </div>
                        <!--end::Body-->
                    </a>
                    <!--end::Statistics Widget 5-->
                </div>
                <div class="col-xl-3">
                    <!--begin::Statistics Widget 5-->
                    <a href="#" class="card bg-warning hoverable card-xl-stretch mb-xl-8">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                            <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path opacity="0.3" d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z" fill="black" />
													<path d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z" fill="black" />
												</svg>
											</span>
                            <!--end::Svg Icon-->
                            <div class="text-white fw-bolder fs-2 mb-2 mt-5">230</div>
                            <div class="fw-bold text-white">News</div>
                        </div>
                        <!--end::Body-->
                    </a>
                    <!--end::Statistics Widget 5-->
                </div>
                <div class="col-xl-3">
                    <!--begin::Statistics Widget 5-->
                    <a href="#" class="card bg-info hoverable card-xl-stretch mb-5 mb-xl-8">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Svg Icon | path: icons/duotune/graphs/gra007.svg-->
                            <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path opacity="0.3" d="M10.9607 12.9128H18.8607C19.4607 12.9128 19.9607 13.4128 19.8607 14.0128C19.2607 19.0128 14.4607 22.7128 9.26068 21.7128C5.66068 21.0128 2.86071 18.2128 2.16071 14.6128C1.16071 9.31284 4.96069 4.61281 9.86069 4.01281C10.4607 3.91281 10.9607 4.41281 10.9607 5.01281V12.9128Z" fill="black" />
													<path d="M12.9607 10.9128V3.01281C12.9607 2.41281 13.4607 1.91281 14.0607 2.01281C16.0607 2.21281 17.8607 3.11284 19.2607 4.61284C20.6607 6.01284 21.5607 7.91285 21.8607 9.81285C21.9607 10.4129 21.4607 10.9128 20.8607 10.9128H12.9607Z" fill="black" />
												</svg>
											</span>
                            <!--end::Svg Icon-->
                            <div class="text-white fw-bolder fs-2 mb-2 mt-5">48</div>
                            <div class="fw-bold text-white">Important numbers</div>
                        </div>
                        <!--end::Body-->
                    </a>
                    <!--end::Statistics Widget 5-->
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-xl-stretch-50 mb-5 mb-xl-8">
                        <!--begin::Body-->
                        <div class="card-body d-flex flex-column p-0">
                            <!--begin::Stats-->
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">Generate Reports</a>
                                        <div class="text-muted fs-7 fw-bold">Finance and accounting reports</div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary">$24,500</div>
                                </div>
                            </div>
                            <!--end::Stats-->
                            <!--begin::Chart-->
                            <div class="mixed-widget-7-chart card-rounded-bottom" data-kt-chart-color="primary" style="height: 150px"></div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Body-->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-xl-stretch-50 mb-5 mb-xl-8">
                        <!--begin::Body-->
                        <div class="card-body p-0 d-flex justify-content-between flex-column overflow-hidden">
                            <!--begin::Hidden-->
                            <div class="d-flex flex-stack flex-wrap flex-grow-1 px-9 pt-9 pb-3">
                                <div class="me-2">
                                    <span class="fw-bolder text-gray-800 d-block fs-3">Sales</span>
                                    <span class="text-gray-400 fw-bold">Oct 8 - Oct 26 21</span>
                                </div>
                                <div class="fw-bolder fs-3 text-primary">$15,300</div>
                            </div>
                            <!--end::Hidden-->
                            <!--begin::Chart-->
                            <div class="mixed-widget-10-chart" data-kt-color="primary" style="height: 175px"></div>
                            <!--end::Chart-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xl-4">
                    <!--begin::Mixed Widget 13-->
                    <div class="card card-xl-stretch mb-xl-10" style="background-color: #F7D9E3">
                        <!--begin::Body-->
                        <div class="card-body d-flex flex-column">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column flex-grow-1">
                                <!--begin::Title-->
                                <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">Earnings</a>
                                <!--end::Title-->
                                <!--begin::Chart-->
                                <div class="mixed-widget-13-chart" style="height: 100px"></div>
                                <!--end::Chart-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Stats-->
                            <div class="pt-5">
                                <!--begin::Symbol-->
                                <span class="text-dark fw-bolder fs-2x lh-0">$</span>
                                <!--end::Symbol-->
                                <!--begin::Number-->
                                <span class="text-dark fw-bolder fs-3x me-2 lh-0">560</span>
                                <!--end::Number-->
                                <!--begin::Text-->
                                <span class="text-dark fw-bolder fs-6 lh-0">+ 28% this week</span>
                                <!--end::Text-->
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Mixed Widget 13-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-4">
                    <!--begin::Mixed Widget 14-->
                    <div class="card card-xxl-stretch mb-xl-10" style="background-color: #CBF0F4">
                        <!--begin::Body-->
                        <div class="card-body d-flex flex-column">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column flex-grow-1">
                                <!--begin::Title-->
                                <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">Contributors</a>
                                <!--end::Title-->
                                <!--begin::Chart-->
                                <div class="mixed-widget-14-chart" style="height: 100px"></div>
                                <!--end::Chart-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Stats-->
                            <div class="pt-5">
                                <!--begin::Number-->
                                <span class="text-dark fw-bolder fs-3x me-2 lh-0">47</span>
                                <!--end::Number-->
                                <!--begin::Text-->
                                <span class="text-dark fw-bolder fs-6 lh-0">- 12% this week</span>
                                <!--end::Text-->
                            </div>
                            <!--end::Stats-->
                        </div>
                    </div>
                    <!--end::Mixed Widget 14-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-4">
                    <!--begin::Mixed Widget 14-->
                    <div class="card card-xxl-stretch mb-5 mb-xl-10" style="background-color: #CBD4F4">
                        <!--begin::Body-->
                        <div class="card-body d-flex flex-column">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column mb-7">
                                <!--begin::Title-->
                                <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">Orders</a>
                                <!--end::Title-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Row-->
                            <div class="row g-0">
                                <!--begin::Col-->
                                <div class="col-6">
                                    <div class="d-flex align-items-center mb-9 me-2">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-40px me-3">
                                            <div class="symbol-label bg-white bg-opacity-50">
                                                <!--begin::Svg Icon | path: icons/duotune/abstract/abs043.svg-->
                                                <span class="svg-icon svg-icon-1 svg-icon-dark">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path opacity="0.3" d="M22 8H8L12 4H19C19.6 4 20.2 4.39999 20.5 4.89999L22 8ZM3.5 19.1C3.8 19.7 4.4 20 5 20H12L16 16H2L3.5 19.1ZM19.1 20.5C19.7 20.2 20 19.6 20 19V12L16 8V22L19.1 20.5ZM4.9 3.5C4.3 3.8 4 4.4 4 5V12L8 16V2L4.9 3.5Z" fill="black" />
																		<path d="M22 8L20 12L16 8H22ZM8 16L4 12L2 16H8ZM16 16L12 20L16 22V16ZM8 8L12 4L8 2V8Z" fill="black" />
																	</svg>
																</span>
                                                <!--end::Svg Icon-->
                                            </div>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Title-->
                                        <div>
                                            <div class="fs-5 text-dark fw-bolder lh-1">150</div>
                                            <div class="fs-7 text-gray-600 fw-bold">Ready Service</div>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-6">
                                    <div class="d-flex align-items-center mb-9 ms-2">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-40px me-3">
                                            <div class="symbol-label bg-white bg-opacity-50">
                                                <!--begin::Svg Icon | path: icons/duotune/abstract/abs046.svg-->
                                                <span class="svg-icon svg-icon-1 svg-icon-dark">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path d="M8 22C7.4 22 7 21.6 7 21V9C7 8.4 7.4 8 8 8C8.6 8 9 8.4 9 9V21C9 21.6 8.6 22 8 22Z" fill="black" />
																		<path opacity="0.3" d="M4 15C3.4 15 3 14.6 3 14V6C3 5.4 3.4 5 4 5C4.6 5 5 5.4 5 6V14C5 14.6 4.6 15 4 15ZM13 19V3C13 2.4 12.6 2 12 2C11.4 2 11 2.4 11 3V19C11 19.6 11.4 20 12 20C12.6 20 13 19.6 13 19ZM17 16V5C17 4.4 16.6 4 16 4C15.4 4 15 4.4 15 5V16C15 16.6 15.4 17 16 17C16.6 17 17 16.6 17 16ZM21 18V10C21 9.4 20.6 9 20 9C19.4 9 19 9.4 19 10V18C19 18.6 19.4 19 20 19C20.6 19 21 18.6 21 18Z" fill="black" />
																	</svg>
																</span>
                                                <!--end::Svg Icon-->
                                            </div>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Title-->
                                        <div>
                                            <div class="fs-5 text-dark fw-bolder lh-1">130</div>
                                            <div class="fs-7 text-gray-600 fw-bold">limousine Serivce</div>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-6">
                                    <div class="d-flex align-items-center me-2">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-40px me-3">
                                            <div class="symbol-label bg-white bg-opacity-50">
                                                <!--begin::Svg Icon | path: icons/duotune/abstract/abs022.svg-->
                                                <span class="svg-icon svg-icon-1 svg-icon-dark">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path opacity="0.3" d="M11.425 7.325C12.925 5.825 15.225 5.825 16.725 7.325C18.225 8.825 18.225 11.125 16.725 12.625C15.225 14.125 12.925 14.125 11.425 12.625C9.92501 11.225 9.92501 8.825 11.425 7.325ZM8.42501 4.325C5.32501 7.425 5.32501 12.525 8.42501 15.625C11.525 18.725 16.625 18.725 19.725 15.625C22.825 12.525 22.825 7.425 19.725 4.325C16.525 1.225 11.525 1.225 8.42501 4.325Z" fill="black" />
																		<path d="M11.325 17.525C10.025 18.025 8.425 17.725 7.325 16.725C5.825 15.225 5.825 12.925 7.325 11.425C8.825 9.92498 11.125 9.92498 12.625 11.425C13.225 12.025 13.625 12.925 13.725 13.725C14.825 13.825 15.925 13.525 16.725 12.625C17.125 12.225 17.425 11.825 17.525 11.325C17.125 10.225 16.525 9.22498 15.625 8.42498C12.525 5.32498 7.425 5.32498 4.325 8.42498C1.225 11.525 1.225 16.625 4.325 19.725C7.425 22.825 12.525 22.825 15.625 19.725C16.325 19.025 16.925 18.225 17.225 17.325C15.425 18.125 13.225 18.225 11.325 17.525Z" fill="black" />
																	</svg>
																</span>
                                                <!--end::Svg Icon-->
                                            </div>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Title-->
                                        <div>
                                            <div class="fs-5 text-dark fw-bolder lh-1">40</div>
                                            <div class="fs-7 text-gray-600 fw-bold">Dream Serivce</div>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-6">
                                    <div class="d-flex align-items-center ms-2">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-40px me-3">
                                            <div class="symbol-label bg-white bg-opacity-50">
                                                <!--begin::Svg Icon | path: icons/duotune/abstract/abs045.svg-->
                                                <span class="svg-icon svg-icon-1 svg-icon-dark">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path d="M2 11.7127L10 14.1127L22 11.7127L14 9.31274L2 11.7127Z" fill="black" />
																		<path opacity="0.3" d="M20.9 7.91274L2 11.7127V6.81275C2 6.11275 2.50001 5.61274 3.10001 5.51274L20.6 2.01274C21.3 1.91274 22 2.41273 22 3.11273V6.61273C22 7.21273 21.5 7.81274 20.9 7.91274ZM22 16.6127V11.7127L3.10001 15.5127C2.50001 15.6127 2 16.2127 2 16.8127V20.3127C2 21.0127 2.69999 21.6128 3.39999 21.4128L20.9 17.9128C21.5 17.8128 22 17.2127 22 16.6127Z" fill="black" />
																	</svg>
																</span>
                                                <!--end::Svg Icon-->
                                            </div>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Title-->
                                        <div>
                                            <div class="fs-5 text-dark fw-bolder lh-1">90</div>
                                            <div class="fs-7 text-gray-600 fw-bold">Delivery Serivce</div>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        </div>
                    </div>
                    <!--end::Mixed Widget 14-->
                </div>
                <!--end::Col-->
            </div>

            <div class="card card-xl-stretch mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Provider Requests</span>
                    </h3>
                    <!--begin::Toolbar-->
                    <div class="card-toolbar" data-kt-buttons="true">
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Chart-->
                    <div id="kt_charts_widget_33_chart" style="height: 350px"></div>
                    <!--end::Chart-->
                </div>
                <!--end::Body-->
            </div>
        </div>
    </div>


                @endsection
@section('script')

    <script src="{{asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <!--<script src="{{asset('dashboard/assets/js/pages/features/charts/apexcharts.js')}}"></script>-->

    <script type="text/javascript">

        (function () {
            var e = document.getElementById("kt_charts_widget_33_chart"),
                t = (parseInt(KTUtil.css(e, "height")), KTUtil.getCssVariableValue("--bs-gray-500")),
                a = KTUtil.getCssVariableValue("--bs-gray-200"),
                o = KTUtil.getCssVariableValue("--bs-info"),
                s = KTUtil.getCssVariableValue("--bs-light-info");
            e &&
            new ApexCharts(e, {
                series: [
                    {
                        name:"New Provider Requests",
                        data: [
                                @for($x=1; $x<=12; $x++)
                                "{{$x *  6}}",
                            @endfor
                        ]

                    },
                    {
                        name: "Completed Provider Requests",
                        data: [
                                @for($x=1; $x<=12; $x++)
                                "{{$x *  14}}",
                            @endfor
                        ]
                    }
                ],
                chart: { fontFamily: "inherit", type: "area", height: 350, toolbar: { show: !1 } },
                plotOptions: {},
                legend: { show: !1 },
                dataLabels: { enabled: !1 },
                fill: { type: "solid", opacity: 1 },
                stroke: { curve: "smooth", show: !0, width: 3, colors: [o] },
                xaxis: {
                    categories: [
                        @for($x=1; $x<=12; $x++)
                            "{{date('Y')}}-{{$x}}-1",
                        @endfor
                    ],
                    axisBorder: { show: !1 },
                    axisTicks: { show: !1 },
                    labels: { style: { colors: t, fontSize: "12px" } },
                    crosshairs: { position: "front", stroke: { color: o, width: 1, dashArray: 3 } },
                    tooltip: { enabled: !0, formatter: void 0, offsetY: 0, style: { fontSize: "12px" } },
                },
                yaxis: { labels: { style: { colors: t, fontSize: "12px" } } },
                states: { normal: { filter: { type: "none", value: 0 } }, hover: { filter: { type: "none", value: 0 } }, active: { allowMultipleDataPointsSelection: !1, filter: { type: "none", value: 0 } } },
                tooltip: {
                    style: { fontSize: "12px" },
                    y: {
                        formatter: function (e) {
                            return "" + e + " ";
                        },
                    },
                },
                colors: [s],
                grid: { borderColor: a, strokeDashArray: 4, yaxis: { lines: { show: !0 } } },
                markers: { strokeColor: o, strokeWidth: 3 },
            }).render();
        })()


    </script>

    <!--begin::Page scripts(used by this page) -->
    <?php
    $message = session()->get("message");
    ?>

    @if( session()->has("message"))
        @if( $message == "Success")
            <script>
                Swal.fire({
                    icon: 'success',
                    title: "{{__('lang.Success')}}",
                    text: "{{__('lang.Success_text')}}",
                    type: "success",
                    timer: 1000,
                    showConfirmButton: false
                });

            </script>
        @endif
    @endif
@endsection
