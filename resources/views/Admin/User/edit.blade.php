@extends('layout.layout')
@php
    $route = 'users';
@endphp
@section('css')
@endsection

@section('style')
    <style>
        @media (min-width: 992px) {
            .aside-me .content {
                padding-right: 30px;
            }
        }
    </style>
@endsection
@section('header')
    <!--begin::Heading-->
    <h1 class="text-dark fw-bolder my-0 fs-2"> {{trans('lang.edit')}}</h1>
    <!--end::Heading-->
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb fw-bold fs-base my-1">
        <li class="breadcrumb-item">
            <a href="{{url('/')}}" class="text-muted">
                {{trans('lang.Dashboard')}} </a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route($route.'.index')}}" class="text-muted">
                {{trans('lang.'.$route)}} </a>
        </li>
        <li class="breadcrumb-item">
            {{trans('lang.edit')}}
        </li>
    </ul>
@endsection
@section('content')
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <!--begin::Post-->

        <div class="content flex-row-fluid" id="kt_content">

            <!--begin::Basic info-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                     data-bs-target="#kt_account_profile_details" aria-expanded="true"
                     aria-controls="kt_account_profile_details">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__('lang.Users_Edit')}}</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin::Content-->
                <div id="kt_account_settings_profile_details" class="collapse show">
                    <!--begin::Form-->
                    <form id="kt_account_profile_details_form" action="{{url('update-User')}}" class="form"
                          method="post">
                    @csrf
                    <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">{{__('lang.name')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="name"
                                       class="form-control form-control-solid mb-3 mb-lg-0"
                                       placeholder="" value="{{$employee->name}}" required/>

                                <input type="hidden" name="id" value="{{$employee->id}}" required/>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">{{__('lang.email')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="email" name="email"
                                       class="form-control form-control-solid mb-3 mb-lg-0"
                                       placeholder="البريد الالكتروني" value="{{$employee->email}}"
                                />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">{{__('lang.phone')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="tel" name="phone" id="phone" maxlength="8" minlength="8"
                                       class="form-control form-control-solid mb-3 mb-lg-0"
                                       placeholder="رقم الهاتف" value="{{$employee->phone}}" required/>
                                <!--end::Input-->
                                <span id="error-validation" style="color:red"></span>

                                <!--end::Input-->
                            </div>

                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">{{__('lang.password')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="password" name="password"
                                       class="form-control form-control-solid mb-3 mb-lg-0"
                                       placeholder="" value=""/>
                                <!--end::Input-->
                            </div>
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">{{__('lang.Confirm password')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="password" name="password_confirmation"
                                       class="form-control form-control-solid mb-3 mb-lg-0"
                                       placeholder="" value=""/>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--end::Input group-->
                            <div class="fv-row mb-7">
                                <div
                                    class="form-check form-switch form-check-custom form-check-solid">
                                    <label class="form-check-label" for="flexSwitchDefault">{{__('lang.active')}}
                                        ؟</label>
                                    <input class="form-check-input" name="is_active" type="hidden"
                                           value="inactive" id="flexSwitchDefault"/>
                                    <input class="form-check-input form-control form-control-solid mb-3 mb-lg-0"
                                           name="is_active" type="checkbox"
                                           value="active" id="flexSwitchDefault"
                                           @if($employee->is_active == 'active') checked @endif />
                                </div>
                            </div>
                            <!--end::Input group-->


                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->

                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="submit" class="btn btn-primary"
                                    id="kt_account_profile_details_submit">{{__('lang.save')}}
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Basic info-->

        </div>
        <!--end::Post-->
    </div>
@endsection

@section('script')

    <script>
        $('#phone').change(function () {
            var val = $(this).val();
            var id = {{$employee->id}};

            $.ajax({
                type: "GET",
                url: "{{url('checkPhoneValidationUser')}}",
                data: {'phone': val, 'id': id},
                success: function (data) {
                    if (data == true) {

                        var text = 'عفوا رقم الهاتف موجود بالفعل';
                        $('#error-validation').html(text)
                    } else {
                        var text = '';
                        $('#error-validation').html(text)

                    }
                }
            })
        })


        $("#state").change(function () {
            var wahda = $(this).val();

            if (wahda != '') {
                $.get("{{ URL::to('/get-branch')}}" + '/' + wahda, function ($data) {
                    var outs = "";
                    $.each($data, function (title, id) {
                        console.log(title)
                        outs += '<option value="' + id + '">' + title + '</option>'
                    });
                    $('#branche').html(outs);
                });
            }
        });
    </script>



@endsection

