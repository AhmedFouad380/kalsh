@extends('layout.layout')

@php
    $route = 'ready_orders';
@endphp

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
    <h1 class="text-dark fw-bolder my-0 fs-2">{{__('lang.order_details')}} </h1>
    <!--end::Heading-->
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb fw-bold fs-base my-1">
        <li class="breadcrumb-item text-muted">
            {{trans('lang.order_details')}}
        </li>
        <li class="breadcrumb-item">
            <a href="{{route($route.'.index')}}" class="text-muted">
                {{trans('lang.'.$route)}} </a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{url('/')}}" class="text-muted">
                {{trans('lang.Dashboard')}} </a>
        </li>
    </ul>
    <!--end::Breadcrumb-->
@endsection


@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-lg-row">
                <!--begin::Content-->
                <div class="flex-lg-row-fluid me-lg-15 order-2 order-lg-1 mb-10 mb-lg-0">
                        <!--begin::Customer-->
                        <div class="card card-flush pt-3 mb-5 mb-lg-10">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2 class="fw-bolder">{{trans('lang.order')}}</h2>
                                </div>
                                <!--begin::Card title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Description-->
                                <!--end::Description-->
                                <!--begin::Selected customer-->
                                <div class="mb-7">
                                    <!--begin::Title-->
                                    <h5 class="mb-3">{{trans('lang.message_voice')}}</h5>
                                    <!--end::Title-->
                                    <!--begin::Details-->
                                    <div class="mb-0">
                                        <audio controls>
                                            <source src="{{$data->voice}}" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                        </audio>
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <div class="mb-7">
                                    <!--begin::Title-->
                                    <h5 class="mb-3">{{trans('lang.order_content')}}</h5>
                                    <!--end::Title-->
                                    <!--begin::Details-->
                                    <div class="mb-0">
                                        <p>
                                            {{$data->description}}
                                        </p>
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Selected customer-->
                                <!--begin::Notice-->
                                <!--end::Notice-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Customer-->
                        <!--begin::Pricing-->
                        <div class="card card-flush pt-3 mb-5 mb-lg-10">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2 class="fw-bolder">{{trans('lang.order_info')}}</h2>
                                </div>
                                <!--begin::Card title-->
                                <!--begin::Card toolbar-->
                                <!--end::Card toolbar-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Table wrapper-->
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-dashed fs-6 fw-bold gy-4"
                                           id="kt_subscription_products_table">
                                        <!--begin::Table head-->
                                        <!--end::Table head-->
                                        <!--begin::Table body-->
                                        <tbody class="text-gray-600">
                                        <tr>
                                            <td>{{trans('lang.order_status')}}</td>
                                            <td>{{trans('lang.'.$data->status->name)}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{trans('lang.order_category')}}</td>
                                            <td>{{$data->readyService ? $data->readyService->name : '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{trans('lang.radius')}}</td>
                                            <td>{{$data->radius}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{trans('lang.payment_type')}}</td>
                                            <td>{{trans('lang.'.$data->payment_type)}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{trans('lang.payment_status')}}</td>
                                            <td>{{trans('lang.'.$data->payment_status)}}</td>
                                        </tr>
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Table wrapper-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Pricing-->
                        <!--begin::user rate-->
                        @if($data->userRating)
                            <div class="card card-flush pt-3 mb-5 mb-lg-10">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2 class="fw-bolder">{{trans('lang.user_rate')}}</h2>
                                    </div>
                                    <!--begin::Card title-->
                                    <!--begin::Card toolbar-->
                                    <!--end::Card toolbar-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Table wrapper-->
                                    <div class="table-responsive">
                                        <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                                               id="kt_ecommerce_products_table">
                                            <tbody class="fw-semibold text-gray-600">
                                            <tr class="odd">
                                                <td class="text-center">
                                                    <span class="fw-bold">{{$data->userRating->comment}}</span>
                                                </td>
                                                <td class="text-end pe-0" data-order="rating-4">
                                                    <div class="rating justify-content-end">
                                                        <div class="rating-label @if($data->userRating->rate >= 1 ) checked @endif ">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen029.svg-->
                                                            <span class="svg-icon svg-icon-2"><svg width="24"
                                                                                                   height="24"
                                                                                                   viewBox="0 0 24 24"
                                                                                                   fill="none"
                                                                                                   xmlns="http://www.w3.org/2000/svg">
    <path
        d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z"
        fill="currentColor"></path>
</svg>
</span>
                                                            <!--end::Svg Icon-->                            </div>
                                                        <div class="rating-label @if( $data->userRating->rate >= 2 ) checked @endif">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen029.svg-->
                                                            <span class="svg-icon svg-icon-2"><svg width="24"
                                                                                                   height="24"
                                                                                                   viewBox="0 0 24 24"
                                                                                                   fill="none"
                                                                                                   xmlns="http://www.w3.org/2000/svg">
    <path
        d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z"
        fill="currentColor"></path>
</svg>
</span>
                                                            <!--end::Svg Icon-->                            </div>
                                                        <div class="rating-label @if($data->userRating->rate  >= 3  ) checked @endif ">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen029.svg-->
                                                            <span class="svg-icon svg-icon-2"><svg width="24"
                                                                                                   height="24"
                                                                                                   viewBox="0 0 24 24"
                                                                                                   fill="none"
                                                                                                   xmlns="http://www.w3.org/2000/svg">
    <path
        d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z"
        fill="currentColor"></path>
</svg>
</span>
                                                            <!--end::Svg Icon-->                            </div>
                                                        <div class="rating-label @if($data->userRating->rate >= 4  ) checked @endif ">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen029.svg-->
                                                            <span class="svg-icon svg-icon-2"><svg width="24"
                                                                                                   height="24"
                                                                                                   viewBox="0 0 24 24"
                                                                                                   fill="none"
                                                                                                   xmlns="http://www.w3.org/2000/svg">
    <path
        d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z"
        fill="currentColor"></path>
</svg>
</span>
                                                            <!--end::Svg Icon-->                            </div>
                                                        <div class="rating-label @if($data->userRating->rate >= 5 ) checked @endif ">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen029.svg-->
                                                            <span class="svg-icon svg-icon-2"><svg width="24"
                                                                                                   height="24"
                                                                                                   viewBox="0 0 24 24"
                                                                                                   fill="none"
                                                                                                   xmlns="http://www.w3.org/2000/svg">
    <path
        d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z"
        fill="currentColor"></path>
</svg>
</span>
                                                            <!--end::Svg Icon-->                            </div>
                                                    </div>
                                                </td>
                                                <td class="text-end pe-0" data-order="Published">
                                                    <div
                                                        class="badge badge-light-success">{{$data->userRating->created_at->format('Y-m-d g:i a')}}</div>
                                                </td>
                                            </tr>
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                    </div>
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::user rate-->
                        @endif

                    @if($data->providerRating)
                        <div class="card card-flush pt-3 mb-5 mb-lg-10">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2 class="fw-bolder">{{trans('lang.provider_rate')}}</h2>
                                </div>
                                <!--begin::Card title-->
                                <!--begin::Card toolbar-->
                                <!--end::Card toolbar-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Table wrapper-->
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                                           id="kt_ecommerce_products_table">
                                        <tbody class="fw-semibold text-gray-600">
                                        <tr class="odd">
                                            <td class="text-center">
                                                <span class="fw-bold">{{$data->providerRating->comment}}</span>
                                            </td>
                                            <td class="text-end pe-0" data-order="rating-4">
                                                <div class="rating justify-content-end">
                                                    <div class="rating-label @if($data->providerRating->rate >= 1 ) checked @endif ">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen029.svg-->
                                                        <span class="svg-icon svg-icon-2"><svg width="24"
                                                                                               height="24"
                                                                                               viewBox="0 0 24 24"
                                                                                               fill="none"
                                                                                               xmlns="http://www.w3.org/2000/svg">
    <path
        d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z"
        fill="currentColor"></path>
</svg>
</span>
                                                        <!--end::Svg Icon-->                            </div>
                                                    <div class="rating-label @if( $data->providerRating->rate >= 2 ) checked @endif">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen029.svg-->
                                                        <span class="svg-icon svg-icon-2"><svg width="24"
                                                                                               height="24"
                                                                                               viewBox="0 0 24 24"
                                                                                               fill="none"
                                                                                               xmlns="http://www.w3.org/2000/svg">
    <path
        d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z"
        fill="currentColor"></path>
</svg>
</span>
                                                        <!--end::Svg Icon-->                            </div>
                                                    <div class="rating-label @if($data->providerRating->rate  >= 3  ) checked @endif ">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen029.svg-->
                                                        <span class="svg-icon svg-icon-2"><svg width="24"
                                                                                               height="24"
                                                                                               viewBox="0 0 24 24"
                                                                                               fill="none"
                                                                                               xmlns="http://www.w3.org/2000/svg">
    <path
        d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z"
        fill="currentColor"></path>
</svg>
</span>
                                                        <!--end::Svg Icon-->                            </div>
                                                    <div class="rating-label @if($data->providerRating->rate >= 4  ) checked @endif ">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen029.svg-->
                                                        <span class="svg-icon svg-icon-2"><svg width="24"
                                                                                               height="24"
                                                                                               viewBox="0 0 24 24"
                                                                                               fill="none"
                                                                                               xmlns="http://www.w3.org/2000/svg">
    <path
        d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z"
        fill="currentColor"></path>
</svg>
</span>
                                                        <!--end::Svg Icon-->                            </div>
                                                    <div class="rating-label @if($data->providerRating->rate >= 5 ) checked @endif ">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen029.svg-->
                                                        <span class="svg-icon svg-icon-2"><svg width="24"
                                                                                               height="24"
                                                                                               viewBox="0 0 24 24"
                                                                                               fill="none"
                                                                                               xmlns="http://www.w3.org/2000/svg">
    <path
        d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z"
        fill="currentColor"></path>
</svg>
</span>
                                                        <!--end::Svg Icon-->                            </div>
                                                </div>
                                            </td>
                                            <td class="text-end pe-0" data-order="Published">
                                                <div
                                                    class="badge badge-light-success">{{$data->providerRating->created_at->format('Y-m-d g:i a')}}</div>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                </div>
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::user rate-->
                @endif
                    <!--end::Form-->
                </div>
                <!--end::Content-->
                <!--begin::Sidebar-->
                <div class="flex-column flex-lg-row-auto w-100 w-lg-250px w-xl-300px mb-10 order-1 order-lg-2">
                    <!--begin::Card-->
                    <div class="card card-flush pt-3 mb-0" data-kt-sticky="true"
                         data-kt-sticky-name="subscription-summary"
                         data-kt-sticky-offset="{default: false, lg: '200px'}"
                         data-kt-sticky-width="{lg: '250px', xl: '300px'}" data-kt-sticky-left="auto"
                         data-kt-sticky-top="150px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>{{trans('lang.customer')}}</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0 fs-6">
                            <!--begin::Section-->
                            <div class="d-flex align-items-center p-3 mb-2">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-60px symbol-circle me-3">
                                    <img alt="Pic" src="{{$data->user->image}}"/>
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Info-->
                                <div class="d-flex flex-column">
                                    <!--begin::Name-->
                                    <a href="#"
                                       class="fs-4 fw-bolder text-gray-900 text-hover-primary me-2">{{$data->user->name}}</a>
                                    <!--end::Name-->
                                    <!--begin::Email-->
                                    <a href="#"
                                       class="fw-bold text-gray-600 text-hover-primary">{{$data->user->email}}</a>
                                    <a href="#"
                                       class="fw-bold text-gray-600 text-hover-primary">{{$data->user->phone}}</a>
                                    <!--end::Email-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Section-->
                            <!--begin::Seperator-->
                            <div class="separator separator-dashed mb-7"></div>
                            <!--end::Seperator-->
                            <h2>{{trans('lang.provider')}}</h2>
                            <!--begin::Section-->
                            @if($data->provider)
                                <div class="d-flex align-items-center p-3 mb-2">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-60px symbol-circle me-3">
                                        <img alt="Pic" src="{{$data->provider->image}}"/>
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-column">
                                        <!--begin::Name-->
                                        <a href="#"
                                           class="fs-4 fw-bolder text-gray-900 text-hover-primary me-2">{{$data->provider->name}}</a>
                                        <!--end::Name-->
                                        <!--begin::Email-->
                                        <a href="#"
                                           class="fw-bold text-gray-600 text-hover-primary">{{$data->provider->email}}</a>
                                        <a href="#"
                                           class="fw-bold text-gray-600 text-hover-primary">{{$data->provider->phone}}</a>
                                        <!--end::Email-->
                                    </div>
                                    <!--end::Info-->
                                </div>
                            @else
                                <a href="#"
                                   class="fw-bold text-gray-600 text-hover-primary">{{trans('lang.not_selected_yet')}}</a>
                        @endif
                        <!--end::Section-->
                            <!--begin::Seperator-->
                            <div class="separator separator-dashed mb-7"></div>
                            <!--end::Seperator-->
                            <!--begin::Section-->
                            <!--end::Section-->
                            <!--begin::Actions-->

                            <!--end::Actions-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Sidebar-->
            </div>
            <!--end::Layout-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Content-->
@endsection
