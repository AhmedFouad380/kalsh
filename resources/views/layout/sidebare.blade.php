<div
    class="menu menu-column menu-fit menu-rounded menu-title-gray-600 menu-icon-gray-400 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold fs-5 px-6 my-5 my-lg-0"
    id="kt_aside_menu" data-kt-menu="true">
    <div id="kt_aside_menu_wrapper" class="menu-fit">
        <div class="menu-item">
            <div class="menu-content pb-2">
                <span class="menu-section text-muted text-uppercase fs-8 ls-1">{{__('lang.Dashboard')}}</span>
            </div>
        </div>
        @if(Auth::guard('admin')->check())
            <div class="menu-item">
                <a class="menu-link" href="{{url('/')}}">
															<span class="menu-icon">
																<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
																<span class="svg-icon svg-icon-2">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                         height="24" viewBox="0 0 24 24" fill="none">
																		<rect x="2" y="2" width="9" height="9" rx="2"
                                                                              fill="black"/>
																		<rect opacity="0.3" x="13" y="2" width="9"
                                                                              height="9" rx="2" fill="black"/>
																		<rect opacity="0.3" x="13" y="13" width="9"
                                                                              height="9" rx="2" fill="black"/>
																		<rect opacity="0.3" x="2" y="13" width="9"
                                                                              height="9" rx="2" fill="black"/>
																	</svg>
																</span>
                                                                <!--end::Svg Icon-->
															</span>
                    <span class="menu-title">{{__('lang.Dashboard')}}</span>
                </a>
            </div>

        @else
            <div class="menu-item">
                <a class="menu-link" href="{{url('/UserDashboard')}}">
															<span class="menu-icon">
																<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
																<span class="svg-icon svg-icon-2">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                         height="24" viewBox="0 0 24 24" fill="none">
																		<rect x="2" y="2" width="9" height="9" rx="2"
                                                                              fill="black"/>
																		<rect opacity="0.3" x="13" y="2" width="9"
                                                                              height="9" rx="2" fill="black"/>
																		<rect opacity="0.3" x="13" y="13" width="9"
                                                                              height="9" rx="2" fill="black"/>
																		<rect opacity="0.3" x="2" y="13" width="9"
                                                                              height="9" rx="2" fill="black"/>
																	</svg>
																</span>
                                                                <!--end::Svg Icon-->
															</span>
                    <span class="menu-title">{{__('lang.Dashboard')}}</span>
                </a>
            </div>
        @endif
        <div class="menu-item">
            <div class="menu-content pt-8 pb-2">
                <span class="menu-section text-muted text-uppercase fs-8 ls-1">{{trans('lang.pages')}}</span>
            </div>
        </div>
        @if(Auth::guard('admin')->check())
            <div class="menu-item">
                <a class="menu-link" href="{{url('/Admin_setting')}}">
															<span class="menu-icon">
																<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
																<span class="svg-icon svg-icon-2">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                         height="24" viewBox="0 0 24 24" fill="none">
																		<rect x="2" y="2" width="9" height="9" rx="2"
                                                                              fill="black"/>
																		<rect opacity="0.3" x="13" y="2" width="9"
                                                                              height="9" rx="2" fill="black"/>
																		<rect opacity="0.3" x="13" y="13" width="9"
                                                                              height="9" rx="2" fill="black"/>
																		<rect opacity="0.3" x="2" y="13" width="9"
                                                                              height="9" rx="2" fill="black"/>
																	</svg>
																</span>
                                                                <!--end::Svg Icon-->
															</span>
                    <span class="menu-title">{{__('lang.Admins')}}</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link" href="{{url('User_setting')}}">
															<span class="menu-icon">
																<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
																<span class="svg-icon svg-icon-2">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                         height="24" viewBox="0 0 24 24" fill="none">
																		<rect x="2" y="2" width="9" height="9" rx="2"
                                                                              fill="black"/>
																		<rect opacity="0.3" x="13" y="2" width="9"
                                                                              height="9" rx="2" fill="black"/>
																		<rect opacity="0.3" x="13" y="13" width="9"
                                                                              height="9" rx="2" fill="black"/>
																		<rect opacity="0.3" x="2" y="13" width="9"
                                                                              height="9" rx="2" fill="black"/>
																	</svg>
																</span>
                                                                <!--end::Svg Icon-->
															</span>
                    <span class="menu-title">{{__('lang.Users')}}</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link" href="{{route('services.index')}}">
															<span class="menu-icon">
																<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
																<span class="svg-icon svg-icon-2">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                         height="24" viewBox="0 0 24 24" fill="none">
																		<rect x="2" y="2" width="9" height="9" rx="2"
                                                                              fill="black"/>
																		<rect opacity="0.3" x="13" y="2" width="9"
                                                                              height="9" rx="2" fill="black"/>
																		<rect opacity="0.3" x="13" y="13" width="9"
                                                                              height="9" rx="2" fill="black"/>
																		<rect opacity="0.3" x="2" y="13" width="9"
                                                                              height="9" rx="2" fill="black"/>
																	</svg>
																</span>
                                                                <!--end::Svg Icon-->
															</span>
                    <span class="menu-title">{{__('lang.services')}}</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link" href="{{route('stores.index')}}">
															<span class="menu-icon">
																<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
																<span class="svg-icon svg-icon-2">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                         height="24" viewBox="0 0 24 24" fill="none">
																		<rect x="2" y="2" width="9" height="9" rx="2"
                                                                              fill="black"/>
																		<rect opacity="0.3" x="13" y="2" width="9"
                                                                              height="9" rx="2" fill="black"/>
																		<rect opacity="0.3" x="13" y="13" width="9"
                                                                              height="9" rx="2" fill="black"/>
																		<rect opacity="0.3" x="2" y="13" width="9"
                                                                              height="9" rx="2" fill="black"/>
																	</svg>
																</span>
                                                                <!--end::Svg Icon-->
															</span>
                    <span class="menu-title">{{__('lang.stores')}}</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link" href="{{route('important_numbers.index')}}">
															<span class="menu-icon">
																<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
																<span class="svg-icon svg-icon-2">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                         height="24" viewBox="0 0 24 24" fill="none">
																		<rect x="2" y="2" width="9" height="9" rx="2"
                                                                              fill="black"/>
																		<rect opacity="0.3" x="13" y="2" width="9"
                                                                              height="9" rx="2" fill="black"/>
																		<rect opacity="0.3" x="13" y="13" width="9"
                                                                              height="9" rx="2" fill="black"/>
																		<rect opacity="0.3" x="2" y="13" width="9"
                                                                              height="9" rx="2" fill="black"/>
																	</svg>
																</span>
                                                                <!--end::Svg Icon-->
															</span>
                    <span class="menu-title">{{__('lang.important_numbers')}}</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link" href="{{route('news.index')}}">
															<span class="menu-icon">
																<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
																<span class="svg-icon svg-icon-2">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                         height="24" viewBox="0 0 24 24" fill="none">
																		<rect x="2" y="2" width="9" height="9" rx="2"
                                                                              fill="black"/>
																		<rect opacity="0.3" x="13" y="2" width="9"
                                                                              height="9" rx="2" fill="black"/>
																		<rect opacity="0.3" x="13" y="13" width="9"
                                                                              height="9" rx="2" fill="black"/>
																		<rect opacity="0.3" x="2" y="13" width="9"
                                                                              height="9" rx="2" fill="black"/>
																	</svg>
																</span>
                                                                <!--end::Svg Icon-->
															</span>
                    <span class="menu-title">{{__('lang.news')}}</span>
                </a>
            </div>
{{--            <div class="menu-item">--}}
{{--                <a class="menu-link" href="{{route('sliders.index')}}">--}}
{{--															<span class="menu-icon">--}}
{{--																<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->--}}
{{--																<span class="svg-icon svg-icon-2">--}}
{{--																	<svg xmlns="http://www.w3.org/2000/svg" width="24"--}}
{{--                                                                         height="24" viewBox="0 0 24 24" fill="none">--}}
{{--																		<rect x="2" y="2" width="9" height="9" rx="2"--}}
{{--                                                                              fill="black"/>--}}
{{--																		<rect opacity="0.3" x="13" y="2" width="9"--}}
{{--                                                                              height="9" rx="2" fill="black"/>--}}
{{--																		<rect opacity="0.3" x="13" y="13" width="9"--}}
{{--                                                                              height="9" rx="2" fill="black"/>--}}
{{--																		<rect opacity="0.3" x="2" y="13" width="9"--}}
{{--                                                                              height="9" rx="2" fill="black"/>--}}
{{--																	</svg>--}}
{{--																</span>--}}
{{--                                                                <!--end::Svg Icon-->--}}
{{--															</span>--}}
{{--                    <span class="menu-title">{{__('lang.sliders')}}</span>--}}
{{--                </a>--}}
{{--            </div>--}}

        @endif
    </div>
</div>
