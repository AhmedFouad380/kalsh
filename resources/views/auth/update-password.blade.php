@extends('layout.auth')
@section('css')
@endsection

@section('breadcrumb')
@endsection

@section('content')
<!--begin::Authentication - Sign-in -->
<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-cover" style="background-image: url({{asset('admin/assets/media/illustrations/sketchy-1/14-3.jpeg')}}">

    <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">

        <!--begin::Wrapper-->
        <div class="w-lg-550px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
            <!--begin::Form-->
            <form class="form w-100" novalidate="novalidate" id="" method="post" action="{{url('updatePassword')}}">
                <!--begin::Heading-->
                @csrf
                <div class="text-center mb-10">
                    <!--begin::Logo-->
                    <a href="/" class="mb-12">
                        <img alt="Logo" src="{{asset('admin/assets/media/logos/logo-dark.png')}}" class="h-150px" />
                    </a>
                    <!--end::Logo-->
                    <!--begin::Title-->
                    <h1 class="text-danger mt-3">تحديث كلمة المرور</h1>
                    <!--end::Title-->
                </div>
                <!--begin::Heading-->
                <!--begin::Input group-->
                <div class="mb-10 fv-row" data-kt-password-meter="true">
                    <!--begin::Wrapper-->
                    <div class="mb-1">
                        <!--begin::Label-->
                        <label class="form-label fw-bolder text-dark fs-6">كلمة المرور الجديده</label>
                        <!--end::Label-->
                        <!--begin::Input wrapper-->
                        <div class="position-relative mb-3">
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="password" autocomplete="off" />
                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                <i class="bi bi-eye-slash fs-2"></i>
                                <i class="bi bi-eye fs-2 d-none"></i>
                            </span>
                        </div>
                        <!--end::Input wrapper-->
                        <!--begin::Meter-->
                        <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                        </div>
                        <!--end::Meter-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Input group=-->
                <!--begin::Input group=-->
                <div class="fv-row mb-10">
                    <label class="form-label fw-bolder text-dark fs-6">تأكيد كلمة المرور</label>
                    <input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="password_confirmation" autocomplete="off" />
                </div>
                <!--end::Input group=-->
                <!--begin::Actions-->
                <div class="text-center">
                    <!--begin::Submit button-->
                    <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-danger w-100 mb-5">
                        <span class="indicator-label">حفـظ</span>
                        <span class="indicator-progress">انتظر لحظات...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Submit button-->
                    <div class="text-center text-muted text-uppercase fw-bolder mb-5">او</div>
                    <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
                        <img alt="Logo" src="{{asset('admin/assets/media/svg/misc/infography.svg')}}" class="h-20px me-3" />تسجيل الدخول</a>
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

