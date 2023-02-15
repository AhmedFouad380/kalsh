@extends('layout.auth')

@section('css')
@endsection

@section('breadcrumb')
@endsection

@section('content')
    <!--begin::Authentication - Sign-in -->
    <div
        class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-cover"
        style="background-image: url(assets/media/illustrations/sigma-1/14.png">
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <!--begin::Wrapper-->
            <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <!--begin::Form-->
                <form class="form w-100" id=""
                      method="post" action="{{route('forget.password.post')}}">
                    <!--begin::Heading-->@csrf
                    <div class="text-center mb-10">
                        <!--begin::Logo-->
                        <a href="/" class="mb-12">
                            <img alt="Logo" src="{{asset('logo.png')}}" class="h-150px"/>
                        </a>
                        <!--end::Logo-->
                        <!--begin::Title-->
                        <h1 class="text-dark mt-3">{{trans('lang.forget_password')}}</h1>
                        <div class="text-dark fw-bold fs-5 mb-5"></div>
                        <!--end::Title-->
                    </div>
                    <!--begin::Heading-->
                    <!--begin::Section-->
                    <div class="mb-10 px-md-10">
                        <!--begin::Label-->
                        <div
                            class="fw-bolder text-start text-dark fs-6 mb-1 ms-1">{{trans('lang.pleas_enter_email')}}</div>
                        <!--end::Label-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-w   rap flex-stack">
                            <input class="form-control form-control-lg form-control-solid" type="email" placeholder=""
                                   name="email" required/>
                        </div>
                        <!--begin::Input group-->
                    </div>
                    <!--end::Section-->
                    <!--begin::Actions-->
                    <div class="text-center">
                        <!--begin::Submit button-->
                        <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                            <span class="indicator-label">{{trans('lang.send')}}</span>
                            <span class="indicator-progress">{{trans('lang.wait_minutes')}}...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <a href="{{route('login')}}" class="link-primary fs-6 fw-bolder">{{trans('lang.back')}}</a>
                        <!--end::Submit button-->
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->
        </div>

    </div>
@endsection

@section('script')
    <script src="{{asset('admin/assets/js/custom/authentication/sign-in/general.js')}}"></script>
@endsection

