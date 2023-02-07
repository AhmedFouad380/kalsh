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
                <form class="form w-100"  id=""
                      method="post" action="{{url('forget-password')}}">
                    <!--begin::Heading-->@csrf
                    <div class="text-center mb-10">
                        <!--begin::Logo-->
                        <a href="/" class="mb-12">
                            <img alt="Logo" src="{{asset('logo.png')}}" class="h-150px"/>
                        </a>
                        <!--end::Logo-->
                        <!--begin::Title-->
                        <h1 class="text-danger mt-3">Forget password</h1>
                        <div class="text-dark fw-bold fs-5 mb-5"> </div>
                        <!--end::Title-->
                    </div>
                    <!--begin::Heading-->
                    <!--begin::Section-->
                    <div class="mb-10 px-md-10">
                        <!--begin::Label-->
                        <div class="fw-bolder text-start text-dark fs-6 mb-1 ms-1">Please enter your email</div>
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
                            <span class="indicator-label">ارسال</span>
                            <span class="indicator-progress">انتظر لحظات...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
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

