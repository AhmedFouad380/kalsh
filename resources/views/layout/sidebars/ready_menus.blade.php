<div class="tab-pane fade @if(request()->segment(1) == 'ready') active show @endif " id="kt_aside_nav_tab_ready" role="tabpanel">
    <div
        class="menu menu-column menu-fit menu-rounded menu-title-gray-600 menu-icon-gray-400 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold fs-5 px-6 my-5 my-lg-0"
        id="kt_aside_menu" data-kt-menu="true">
        <div id="kt_aside_menu_wrapper" class="menu-fit">
            <div class="menu-item">
                <div class="menu-content pb-2">
                    <h2 class="subheader-title text-dark font-weight-bold my-1 mr-3">
                        {{trans('lang.ready_service')}}
                    </h2>
                </div>
            </div>
            <div class="menu-item">
                <a class="menu-link" href="{{route('ready_services.index')}}">
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
                    <span class="menu-title">{{__('lang.ready_services')}}</span>
                </a>
            </div>
        </div>
    </div>
</div>
