@extends('admin.layouts.master-without-nav')

@section('css')
@endsection

@section('breadcrumb')
@endsection

@section('content')
<!--begin::Authentication - Sign-in -->
<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-cover" style="background-image: url({{asset('admin/assets/media/illustrations/sketchy-1/14-3.jpeg')}}">

    <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">

        <!--begin::Wrapper-->
        <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
            <!--begin::Form-->
            <form class="form w-100" novalidate="novalidate" id="" method="post" action="{{url('registerEmployee')}}">
                <!--begin::Heading-->@csrf
                <div class="text-center mb-10">
                    <!--begin::Logo-->
                    <a href="../../demo16/dist/index.html" class="mb-12">
                        <img alt="Logo" src="{{asset('admin/assets/media/logos/logo-dark.png')}}" class="h-150px" />
                    </a>
                    <!--end::Logo-->
                    <!--begin::Title-->
                    <h1 class="text-danger mt-3">تسجيل موظف جديد</h1>
                    <!--end::Title-->
                </div>
                <!--begin::Heading-->
                <!--begin::Input group-->
                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="required fw-bold fs-6 mb-2">اسم الموظف</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" name="name"
                           class="form-control form-control-solid mb-3 mb-lg-0"
                           placeholder="الاسم" value="{{old('name')}}" required/>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->  <!--begin::Input group-->
                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="required fw-bold fs-6 mb-2">البريد الالكترونى</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="email" name="email"
                           class="form-control form-control-solid mb-3 mb-lg-0"
                           placeholder="البريد الالكتروني" value="{{old('email')}}"
                           required/>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->
                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="required fw-bold fs-6 mb-2">رقم الجوال</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="tel" name="phone"
                           class="form-control form-control-solid mb-3 mb-lg-0"
                           placeholder="رقم الجوال" value="{{old('phone')}}" required/>
                    <!--end::Input-->
                </div>
                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="required fw-bold fs-6 mb-2">كلمة المرور</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="password" name="password"
                           class="form-control form-control-solid mb-3 mb-lg-0"
                           placeholder="كلمة المرور" value="" required/>
                    <!--end::Input-->
                </div>
                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="required fw-bold fs-6 mb-2">تأكيد كلمة المرور</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="password" name="password_confirmation"
                           class="form-control form-control-solid mb-3 mb-lg-0"
                           placeholder="تأكيد كلمة المرور" value="" required/>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->
                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="required fw-bold fs-6 mb-2">العنوان</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" name="address"
                           class="form-control form-control-solid mb-3 mb-lg-0"
                           placeholder="العنوان" value="{{old('address')}}"/>
                    <!--end::Input-->
                </div>
                <div class="fv-row mb-10">
                    <label for="exampleFormControlInput1"
                           class="form-label">المنطقة</label>
                    <select class="form-control form-control-solid mb-3 mb-lg-0"
                            name="state" aria-label="" required id="state">
                        <option value="">اختر المنطقة</option>
                        @foreach(\App\Models\State::all() as $state)
                            <option value="{{$state->id}}">{{$state->title}}</option>
                        @endforeach
                    </select>
                </div>

                <!--end::Input group-->
                <!--begin::Actions-->
                <div class="text-center">
                    <!--begin::Submit button-->
                    <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-danger w-100 mb-5">
                        <span class="indicator-label">دخول</span>
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


    @if( session()->has("error"))
        <?php
        $e = session()->get("error");
        ?>

        <script>
            Swal.fire({
                icon: 'success',
                title: "نجاح.",
                text: "{{$e}} ",
                type: "success",
                timer: 5000,
                showConfirmButton: false
            });
        </script>

    @endif
    @if( session()->has("message"))
        <?php
        $e = session()->get("message");
        ?>

        <script>
            Swal.fire({
                icon: 'success',
                title: "نجاح.",
                text: " تم تسجيل البيانات بنجاح و في انتظار تفعيل الحساب من خلال الإدارة ",
                type: "success",
                timer: 5000,
                showConfirmButton: false
            });
        </script>

    @endif
@endsection

