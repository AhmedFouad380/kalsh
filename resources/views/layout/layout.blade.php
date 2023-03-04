<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic - Bootstrap 5 HTML, VueJS, React, Angular & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en" @if(Session('lang') =='ar')dir="rtl" @endif>
<!--begin::Head-->
<head>
    <base href="../">
    <title> Kalsh || @yield('title')
    </title>
    <meta charset="utf-8"/>
    <meta name="description"
          content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free."/>
    <meta name="keywords"
          content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title"
          content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme"/>
    <meta property="og:url" content="https://keenthemes.com/metronic"/>
    <meta property="og:site_name" content="Keenthemes | Metronic"/>
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8"/>
    <link rel="shortcut icon" href="{{asset('logo.png')}}"/>
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700"/>
    <!--end::Fonts-->
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    <link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <!--end::Page Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>
    @if(Session('lang')  ==  'ar')
        <link href="{{asset('assets/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css"/>
    @else
        <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>

    @endif
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"
          integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
@yield('css')
@stack('styles')
<!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" style="background-image: url()"
      class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-enabled">
<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid">
        <!--begin::Aside-->
        <div id="kt_aside" class="aside aside-extended" data-kt-drawer="true" data-kt-drawer-name="aside"
             data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
             data-kt-drawer-width="auto" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_toggle">
            <!--begin::Primary-->
            <div class="aside-primary d-flex flex-column align-items-lg-center flex-row-auto">
                <!--begin::Logo-->
                <div class="aside-logo d-none d-lg-flex flex-column align-items-center flex-column-auto py-10"
                     id="kt_aside_logo">
                    <a href="{{url('/')}}">
                        <img alt="Logo" src="{{asset('logo.png')}}" class="h-35px"/>
                    </a>
                </div>
                <!--end::Logo-->
                <!--begin::Nav-->
                <div class="aside-nav d-flex flex-column align-items-center flex-column-fluid w-100 pt-5 pt-lg-0"
                     id="kt_aside_nav">
                    <!--begin::Wrapper-->
                    <div class="hover-scroll-y mb-10" data-kt-scroll="true"
                         data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
                         data-kt-scroll-wrappers="#kt_aside_nav"
                         data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-offset="0px">
                        <!--begin::Nav-->
                        <ul class="nav flex-column">
                            <!--begin::Nav item-->
                        {{--                            <li class="nav-item mb-2" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="right" data-bs-dismiss="click" title="Projects">--}}
                        {{--                                <!--begin::Nav link-->--}}
                        {{--                                <a class="nav-link btn btn-icon btn-active-color-primary btn-color-gray-400 btn-active-light" data-bs-toggle="tab" href="#kt_aside_nav_tab_projects">--}}
                        {{--                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->--}}
                        {{--                                    <span class="svg-icon svg-icon-2x">--}}
                        {{--												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">--}}
                        {{--													<rect x="2" y="2" width="9" height="9" rx="2" fill="black" />--}}
                        {{--													<rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />--}}
                        {{--													<rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />--}}
                        {{--													<rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />--}}
                        {{--												</svg>--}}
                        {{--											</span>--}}
                        {{--                                    <!--end::Svg Icon-->--}}
                        {{--                                </a>--}}
                        {{--                                <!--end::Nav link-->--}}
                        {{--                            </li>--}}
                        <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item mb-2" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                data-bs-placement="right" data-bs-dismiss="click" title="{{trans('lang.basic_menus')}}">
                                <!--begin::Nav link-->
{{--                                @if(request()->segment(1) != 'ready' && request()->segment(1) != 'cars') active @endif--}}
                                <a class="nav-link btn btn-icon btn-active-color-primary btn-color-gray-400 btn-active-light active "
                                   data-bs-toggle="tab" href="#kt_aside_nav_tab_menu">
                                    <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Home\Home.svg--><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path
                                                        d="M3.95709826,8.41510662 L11.47855,3.81866389 C11.7986624,3.62303967 12.2013376,3.62303967 12.52145,3.81866389 L20.0429,8.41510557 C20.6374094,8.77841684 21,9.42493654 21,10.1216692 L21,19.0000642 C21,20.1046337 20.1045695,21.0000642 19,21.0000642 L4.99998155,21.0000673 C3.89541205,21.0000673 2.99998155,20.1046368 2.99998155,19.0000673 L2.99999828,10.1216672 C2.99999935,9.42493561 3.36258984,8.77841732 3.95709826,8.41510662 Z M10,13 C9.44771525,13 9,13.4477153 9,14 L9,17 C9,17.5522847 9.44771525,18 10,18 L14,18 C14.5522847,18 15,17.5522847 15,17 L15,14 C15,13.4477153 14.5522847,13 14,13 L10,13 Z"
                                                        fill="#000000"/>
                                                </g>
                                            </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <!--end::Svg Icon-->
                                </a>
                                <!--end::Nav link-->
                            </li>

{{--                            <li class="nav-item mb-2" data-bs-toggle="tooltip" data-bs-trigger="hover"--}}
{{--                                data-bs-placement="right" data-bs-dismiss="click"--}}
{{--                                title="{{trans('lang.ready_service')}}">--}}
{{--                                <!--begin::Nav link-->--}}
{{--                                <a class="nav-link btn btn-icon btn-active-color-primary btn-color-gray-400 btn-active-light @if(request()->segment(1) == 'ready') active @endif "--}}
{{--                                   data-bs-toggle="tab" href="#kt_aside_nav_tab_ready">--}}
{{--                                    <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->--}}
{{--                                    <span class="svg-icon svg-icon-2x">--}}
{{--												 <img style="width: 22px;"--}}
{{--                                                      src="{{url('/')}}\assets\media\svg\ready_logo.svg">--}}
{{--											</span>--}}
{{--                                    <!--end::Svg Icon-->--}}
{{--                                </a>--}}
{{--                                <!--end::Nav link-->--}}
{{--                            </li>--}}
{{--                            <li class="nav-item mb-2" data-bs-toggle="tooltip" data-bs-trigger="hover"--}}
{{--                                data-bs-placement="right" data-bs-dismiss="click"--}}
{{--                                title="{{trans('lang.dream_service')}}">--}}
{{--                                <!--begin::Nav link-->--}}
{{--                                <a class="nav-link btn btn-icon btn-active-color-primary btn-color-gray-400 btn-active-light @if(request()->segment(1) == 'dream') active @endif "--}}
{{--                                   data-bs-toggle="tab" href="#kt_aside_nav_tab_dream">--}}
{{--                                    <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->--}}
{{--                                    <span class="svg-icon svg-icon-2x">--}}
{{--												 <img style="width: 25px;"--}}
{{--                                                      src="{{url('/')}}\assets\media\svg\dream_service_logo.svg">--}}
{{--											</span>--}}
{{--                                    <!--end::Svg Icon-->--}}
{{--                                </a>--}}
{{--                                <!--end::Nav link-->--}}
{{--                            </li>--}}
{{--                            <li class="nav-item mb-2" data-bs-toggle="tooltip" data-bs-trigger="hover"--}}
{{--                                data-bs-placement="right" data-bs-dismiss="click"--}}
{{--                                title="{{trans('lang.limousine_service')}}">--}}
{{--                                <!--begin::Nav link-->--}}
{{--                                <a class="nav-link btn btn-icon btn-active-color-primary btn-color-gray-400 btn-active-light @if(request()->segment(1) == 'limousine') active @endif "--}}
{{--                                   data-bs-toggle="tab" href="#kt_aside_nav_tab_limousine">--}}
{{--                                    <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->--}}
{{--                                    <span class="svg-icon svg-icon-2x">--}}
{{--												 <img style="width: 33px;"--}}
{{--                                                      src="{{url('/')}}\assets\media\svg\limousine_service_logo.svg">--}}
{{--											</span>--}}
{{--                                    <!--end::Svg Icon-->--}}
{{--                                </a>--}}
{{--                                <!--end::Nav link-->--}}
{{--                            </li>--}}

{{--                            <li class="nav-item mb-2" data-bs-toggle="tooltip" data-bs-trigger="hover"--}}
{{--                                data-bs-placement="right" data-bs-dismiss="click"--}}
{{--                                title="{{trans('lang.cars_service')}}">--}}
{{--                                <!--begin::Nav link-->--}}
{{--                                <a class="nav-link btn btn-icon btn-active-color-primary btn-color-gray-400 btn-active-light @if(request()->segment(1) == 'cars') active @endif "--}}
{{--                                   data-bs-toggle="tab" href="#kt_aside_nav_tab_cars">--}}
{{--                                    <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->--}}
{{--                                    <span class="svg-icon svg-icon-2x">--}}
{{--												 <img style="width: 33px;"--}}
{{--                                                      src="{{url('/')}}\assets\media\svg\car_service_logo.svg">--}}
{{--											</span>--}}
{{--                                    <!--end::Svg Icon-->--}}
{{--                                </a>--}}
{{--                                <!--end::Nav link-->--}}
{{--                            </li>--}}
{{--                            <li class="nav-item mb-2" data-bs-toggle="tooltip" data-bs-trigger="hover"--}}
{{--                                data-bs-placement="right" data-bs-dismiss="click"--}}
{{--                                title="{{trans('lang.delivery_service')}}">--}}
{{--                                <!--begin::Nav link-->--}}
{{--                                <a class="nav-link btn btn-icon btn-active-color-primary btn-color-gray-400 btn-active-light @if(request()->segment(1) == 'delivery') active @endif "--}}
{{--                                   data-bs-toggle="tab" href="#kt_aside_nav_tab_delivery">--}}
{{--                                    <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->--}}
{{--                                    <span class="svg-icon svg-icon-2x">--}}
{{--												 <img style="width: 33px;"--}}
{{--                                                      src="{{url('/')}}\assets\media\svg\delivery_service_logo.svg">--}}
{{--											</span>--}}
{{--                                    <!--end::Svg Icon-->--}}
{{--                                </a>--}}
{{--                                <!--end::Nav link-->--}}
{{--                            </li>--}}
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <!--end::Nav item-->
                        </ul>
                        <!--end::Tabs-->
                    </div>
                    <!--end::Nav-->
                </div>
                <!--end::Nav-->
                <!--begin::Footer-->
            @include('layout.footer')
            <!--end::Footer-->
            </div>
            <!--end::Primary-->
            <!--begin::Secondary-->
            <div class="aside-secondary d-flex flex-row-fluid">
                <!--begin::Workspace-->
                <div class="aside-workspace my-5 p-5" id="kt_aside_wordspace">
                    <div class="d-flex h-100 flex-column">
                        <!--begin::Wrapper-->
                        <div class="flex-column-fluid hover-scroll-y" data-kt-scroll="true"
                             data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                             data-kt-scroll-wrappers="#kt_aside_wordspace"
                             data-kt-scroll-dependencies="#kt_aside_secondary_footer" data-kt-scroll-offset="0px">
                            <!--begin::Tab content-->
                            <div class="tab-content">

                                <!--begin::Menu-->
                            @include('layout.sidebars.basic_menus')
{{--                            @include('layout.sidebars.ready_menus')--}}
{{--                            @include('layout.sidebars.dream_menus')--}}
{{--                            @include('layout.sidebars.limousine_menus')--}}
{{--                            @include('layout.sidebars.cars_menus')--}}
{{--                            @include('layout.sidebars.delivery_menus')--}}
                            <!--end::Menu-->

                                <!--end::Tab pane-->

                            </div>
                            <!--end::Tab content-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                </div>
                <!--end::Workspace-->
            </div>
            <!--end::Secondary-->
            <!--begin::Aside Toggle-->
            <button
                class="btn btn-sm btn-icon bg-body btn-color-gray-700 btn-active-primary position-absolute translate-middle start-100 end-0 bottom-0 shadow-sm d-none d-lg-flex"
                data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
                data-kt-toggle-name="aside-minimize" style="margin-bottom: 1.35rem">
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr063.svg-->
                <span class="svg-icon svg-icon-2 rotate-180">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none">
								<rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="black"/>
								<path
                                    d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z"
                                    fill="black"/>
							</svg>
						</span>
                <!--end::Svg Icon-->
            </button>
            <!--end::Aside Toggle-->
        </div>
        <!--end::Aside-->
        <!--begin::Wrapper-->
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            <!--begin::Header-->
            <div id="kt_header" class="header" data-kt-sticky="true" data-kt-sticky-name="header"
                 data-kt-sticky-offset="{default: '200px', lg: '300px'}">
                <!--begin::Container-->
                <div class="container-xxl d-flex align-items-center justify-content-between" id="kt_header_container">
                    <!--begin::Page title-->
                    <div
                        class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-2 pb-2 pb-lg-0"
                        data-kt-swapper="true" data-kt-swapper-mode="prepend"
                        data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">
                        @yield('header')
                    </div>
                    <!--end::Page title=-->
                    <!--begin::Wrapper-->
                    <div class="d-flex d-lg-none align-items-center ms-n2 me-2">
                        <!--begin::Aside mobile toggle-->
                        <div class="btn btn-icon btn-active-icon-primary" id="kt_aside_toggle">
                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                            <span class="svg-icon svg-icon-2x">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                                fill="black"/>
                            <path opacity="0.3"
                                  d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                                  fill="black"/>
                        </svg>
                    </span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Aside mobile toggle-->
                        <!--begin::Logo-->
                        <a href="{{url('/')}}" class="d-flex align-items-center">
                            <img alt="Logo" src="{{asset('logo.png')}}" class="h-30px"/>
                        </a>
                        <!--end::Logo-->
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::Toolbar wrapper-->
                    <!--end::Toolbar wrapper-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Breadcrumb-->
            <!--end::Header-->
            <!--begin::Content-->
        @yield('content')
        <!--end::Content-->
            <!--begin::Footer-->
            <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                <!--begin::Container-->
                <div class="container-xxl d-flex flex-column flex-md-row flex-stack">
                    <!--begin::Copyright-->
                    <div class="text-dark order-2 order-md-1">
                        <span class="text-gray-400 fw-bold me-1">{{trans('lang.created_by')}}</span>
                        <a href="javascript:void($this);"
                           class="text-muted text-hover-primary fw-bold me-2 fs-6">Backend Team</a>
                    </div>
                    <!--end::Copyright-->
                    <!--begin::Menu-->
                    <!--end::Menu-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Root-->
<!--begin::Drawers-->
<!--begin::Activities drawer-->
<!--end::Activities drawer-->
<!--begin::Chat drawer-->
<div id="kt_drawer_chat" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="chat" data-kt-drawer-activate="true"
     data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'300px', 'md': '500px'}"
     data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_drawer_chat_toggle"
     data-kt-drawer-close="#kt_drawer_chat_close">
    <!--begin::Messenger-->
    <div class="card w-100 rounded-0 border-0" id="kt_drawer_chat_messenger">
        <!--begin::Card header-->
        <div class="card-header pe-5" id="kt_drawer_chat_messenger_header">
            <!--begin::Title-->
            <div class="card-title">
                <!--begin::User-->
                <div class="d-flex justify-content-center flex-column me-3">
                    <a href="#" class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1">Brian Cox</a>
                    <!--begin::Info-->
                    <div class="mb-0 lh-1">
                        <span class="badge badge-success badge-circle w-10px h-10px me-1"></span>
                        <span class="fs-7 fw-bold text-muted">Active</span>
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::User-->
            </div>
            <!--end::Title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Menu-->
                <div class="me-2">
                    <button class="btn btn-sm btn-icon btn-active-light-primary" data-kt-menu-trigger="click"
                            data-kt-menu-placement="bottom-end">
                        <i class="bi bi-three-dots fs-3"></i>
                    </button>
                    <!--begin::Menu 3-->
                    <div
                        class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3"
                        data-kt-menu="true">
                        <!--begin::Heading-->
                        <div class="menu-item px-3">
                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Contacts</div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                               data-bs-target="#kt_modal_users_search">Add Contact</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link flex-stack px-3" data-bs-toggle="modal"
                               data-bs-target="#kt_modal_invite_friends">Invite Contacts
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                   title="Specify a contact email to send an invitation"></i></a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                            <a href="#" class="menu-link px-3">
                                <span class="menu-title">Groups</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <!--begin::Menu sub-->
                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-bs-toggle="tooltip" title="Coming soon">Create
                                        Group</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-bs-toggle="tooltip" title="Coming soon">Invite
                                        Members</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-bs-toggle="tooltip" title="Coming soon">Settings</a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu sub-->
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3 my-1">
                            <a href="#" class="menu-link px-3" data-bs-toggle="tooltip" title="Coming soon">Settings</a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu 3-->
                </div>
                <!--end::Menu-->
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-light-primary" id="kt_drawer_chat_close">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-2">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                          transform="rotate(-45 6 17.3137)" fill="black"/>
									<rect x="7.41422" y="6" width="16" height="2" rx="1"
                                          transform="rotate(45 7.41422 6)" fill="black"/>
								</svg>
							</span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

    </div>
    <!--end::Messenger-->
</div>
<!--end::Chat drawer-->
<!--end::Drawers-->
<!--end::Main-->
<!--begin::Engage drawers-->
<!--end::Engage drawers-->
<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
    <span class="svg-icon">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)"
                          fill="black"/>
					<path
                        d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                        fill="black"/>
				</svg>
			</span>
    <!--end::Svg Icon-->
</div>
<!--end::Scrolltop-->
<!--begin::Modals-->
<!--end::Modals-->
<!--begin::Javascript-->
<script>var hostUrl = "{{asset('assets/')}}";</script>
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->
<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
@yield('topscript')
<script src="{{asset('assets/js/custom/widgets.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/chat/chat.js')}}"></script>
<script src="{{asset('assets/js/custom/modals/upgrade-plan.js')}}"></script>
<script src="{{asset('assets/js/custom/modals/create-app.js')}}"></script>
<script src="{{asset('assets/js/custom/modals/users-search.js')}}"></script>
{{--<script src="{{asset('assets/js/pages/crud/file-upload/image-input.js?v=7.0.6')}}"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!--end::Page Custom Javascript-->
<script type="text/javascript">
    $('.dropify').dropify();

    function update_active(el, route) {
        if (el.checked) {
            var status = 'active';
        } else {
            var status = 'inactive';
        }
        $.post(route, {
            _token: '{{ csrf_token() }}',
            id: el.value,
            status: status
        }, function (data) {
            if (data == 1) {
                toastr.success("{{trans('lang.status_changed')}}");
            } else {
                toastr.error("{{trans('lang.status_changed')}}");
            }
        });
    }

    function update_is_checked(el, route) {
        if (el.checked) {
            var is_checked = 1;
        } else {
            var is_checked = 0;
        }
        $.post(route, {
            _token: '{{ csrf_token() }}',
            id: el.value,
            is_checked: is_checked
        }, function (data) {
            if (data == 1) {
                toastr.success("{{trans('lang.status_changed')}}");
            } else {
                toastr.error("{{trans('lang.status_changed')}}");
            }
        });
    }
</script>
@yield('script')
@stack('scripts')

<?php
$errors = session()->get("errors");
?>

@if( session()->has("errors"))
    <?php
    $e = implode(' - ', $errors->all());
    ?>

    <script>
        Swal.fire({
            icon: 'warning',
            title: "برجاء التأكد من البيانات.",
            text: "{{$e}} ",
            type: "error",
            timer: 5000,
            showConfirmButton: false
        });
    </script>

@endif


@if( session()->has("error"))
    <?php
    $e = session()->get("error");
    ?>

    <script>
        Swal.fire({
            icon: 'warning',
            title: "برجاء التأكد من البيانات.",
            text: "كلمة المرور غير صحيحه  ",
            type: "error",
            timer: 5000,
            showConfirmButton: false
        });
    </script>

@endif
<?php
$error_message = session()->get("error_message");
?>

@if( session()->has("error_message"))
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

        toastr.error("{{$error_message}}", "عفوا !");
    </script>

@endif

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
        toastr.success(null, "{{$message}}");
    </script>



@endif
<!--end::Javascript-->
</body>
<!--end::Body-->
</html>
