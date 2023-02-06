@extends('admin.layouts.master-without-nav')

@section('css')
@endsection

@section('breadcrumb')
@endsection

@section('content')
    <!--begin::Authentication - Sign-in -->
    <div
        class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-cover"
        style="background-image: url({{asset('admin/assets/media/illustrations/sketchy-1/14-3.jpeg')}}">

        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">

            <!--begin::Wrapper-->
            <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <!--begin::Form-->
                <form class="form w-100" novalidate="novalidate" id="" method="post" action="{{url('checkCode')}}">
                    <!--begin::Heading-->@csrf
                    <div class="text-center mb-10">
                        <!--begin::Logo-->
                        <a href="/" class="mb-12">
                            <img alt="Logo" src="{{asset('admin/assets/media/logos/logo-dark.png')}}" class="h-150px"/>
                        </a>
                        <!--end::Logo-->
                        <!--begin::Title-->
                        <h1 class="text-danger mt-3">التحقق من الحساب</h1>
                        <div class="text-dark fw-bold fs-5 mb-5">ادخل كود التحقق المرسل على جوالك</div>
                        <!--end::Title-->
                    </div>
                    <!--begin::Heading-->
                    <!--begin::Section-->
                    <div class="mb-10 px-md-10">
                        <!--begin::Label-->
                        <div class="fw-bolder text-start text-dark fs-6 mb-1 ms-1">ادخل الكود المكون من 4 ارقام</div>
                        <!--end::Label-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-wrap flex-stack inputs">
                            <input type="hidden" name="id" value="{{$user->id}}" required>
                            <input type="text" name="forth" data-inputmask="'mask': '9', 'placeholder': ''"
                                   maxlength="1"
                                   class="form-control inputs form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2"
                                   value="" autofocus />
                            <input type="text" name="third" data-inputmask="'mask': '9', 'placeholder': ''"
                                   maxlength="1"
                                   class="form-control inputs form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2"
                                   value=""/>
                            <input type="text" name="second" data-inputmask="'mask': '9', 'placeholder': ''"
                                   maxlength="1"
                                   class="form-control inputs form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2"
                                   value=""/>
                            <input type="text" name="first" data-inputmask="'mask': '9', 'placeholder': ''"
                                   maxlength="1"
                                   class="form-control inputs form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2"
                                   value=""/>
                        </div>
                        <!--begin::Input group-->
                    </div>
                    <!--end::Section-->
                    <!--begin::Actions-->
                    <div class="text-center">
                        <!--begin::Submit button-->
                        <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-danger w-100 mb-5">
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
    <script>
        $(".inputs").keyup(function () {
            $(this).next(".inputs").focus();
        });
    </script>
@endsection

