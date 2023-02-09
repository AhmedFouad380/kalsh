<div class="aside-footer d-flex flex-column align-items-center flex-column-auto" id="kt_aside_footer">
    <!--begin::Quick links-->
    <!--end::Quick links-->
    <!--begin::Activities-->
    <div class="d-flex align-items-center mb-3">
        <!--begin::Drawer toggle-->
        <a @if(Session('lang') == 'en') href="{{url('lang/ar')}}" @else href="{{url('lang/en')}}"
           @endif class="btn btn-icon btn-active-color-primary btn-color-gray-400 btn-active-light"
           data-kt-menu-trigger="click" data-kt-menu-overflow="true" data-kt-menu-placement="top-start"
           data-bs-toggle="tooltip" data-bs-placement="right" data-bs-dismiss="click" title="{{__('lang.language')}}"
           id="kt_activities_toggle">
            <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
            <span class="svg-icon svg-icon-2 svg-icon-lg-1">
                                <i class="bi bi-translate"></i>
									</span>
            <!--end::Svg Icon-->
        </a>
        <!--end::drawer toggle-->
    </div>
    <!--end::Activities-->
    <!--begin::Notifications-->
    <!--end::Notifications-->
    <!--begin::User-->
    <div class="d-flex align-items-center mb-10" id="kt_header_user_menu_toggle">
        <!--begin::Menu wrapper-->
        <div class="cursor-pointer symbol symbol-40px" data-kt-menu-trigger="click" data-kt-menu-overflow="true"
             data-kt-menu-placement="top-start" data-bs-toggle="tooltip" data-bs-placement="right"
             data-bs-dismiss="click">
            <img src="{{url('/')}}/assets/media/avatars/150-26.jpg" alt="image"/>
        </div>
        <!--begin::Menu-->
        <div
            class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
            data-kt-menu="true">
            <!--begin::Menu item-->
            <div class="menu-item px-3">
                <div class="menu-content d-flex align-items-center px-3">
                    <!--begin::Avatar-->
                    <div class="symbol symbol-50px me-5">
                        <img alt="Logo" src="{{url('/')}}/assets/media/avatars/150-26.jpg"/>
                    </div>
                    <!--end::Avatar-->
                    <!--begin::Username-->
                    <div class="d-flex flex-column">
                        <div class="fw-bolder d-flex align-items-center fs-5">
                            @if(Auth::guard('admin')->check())
                                {{Auth::guard('admin')->user()->name}}
                            @else
                                {{Auth::guard('web')->user()->name}}
                            @endif
                        </div>
                        <!--end::Username-->
                    </div>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu separator-->
                <div class="separator my-2"></div>
                <!--end::Menu separator-->

                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-5">
                    <a href="{{route('profile')}}" class="menu-link px-5">
                        <span class="menu-text">{{__('lang.profile')}}</span>
                    </a>
                </div>
                <!--end::Menu item-->

                <!--end::Menu item-->
                <!--begin::Menu separator-->
                <div class="separator my-2"></div>
                <!--end::Menu separator-->
                <!--begin::Menu item-->

                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-5">
                    <a href="{{url('logout')}}" class="menu-link px-5">{{trans('lang.logout')}}</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu separator-->
                <div class="separator my-2"></div>
                <!--end::Menu separator-->
                <!--begin::Menu item-->
            {{--                <div class="menu-item px-5">--}}
            {{--                    <div class="menu-content px-5">--}}
            {{--                        <label class="form-check form-switch form-check-custom form-check-solid pulse pulse-success"--}}
            {{--                               for="kt_user_menu_dark_mode_toggle">--}}
            {{--                            <input class="form-check-input w-30px h-20px" type="checkbox" value="1" name="mode"--}}
            {{--                                   id="kt_user_menu_dark_mode_toggle" data-kt-url="../../demo7/dist/index.html"/>--}}
            {{--                            <span class="pulse-ring ms-n1"></span>--}}
            {{--                            <span class="form-check-label text-gray-600 fs-7">Dark Mode</span>--}}
            {{--                        </label>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            <!--end::Menu item-->
            </div>
            <!--end::Menu-->
            <!--end::Menu wrapper-->
        </div>
        <!--end::Menu-->
        <!--end::Menu wrapper-->
    </div>
    <!--end::User-->
</div>
