@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"
          integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
@endpush
<!--begin::Input group-->
<div class="fv-row mb-7">
    <!--begin::Label-->
    <label class="required fw-bold fs-6 mb-2">{{__('lang.name_ar')}}</label>
    <!--end::Label-->
    <!--begin::Input-->
    <input type="text" name="name_ar"
           class="form-control form-control-solid mb-3 mb-lg-0"
           placeholder="" value="{{old('name_ar',$data->name_ar ?? '')}}" required/>
    <!--end::Input-->
</div>
<!--end::Input group-->  <!--begin::Input group-->
<div class="fv-row mb-7">
    <!--begin::Label-->
    <label class="required fw-bold fs-6 mb-2">{{__('lang.name_en')}}</label>
    <!--end::Label-->
    <!--begin::Input-->
    <input type="text" name="name_en"
           class="form-control form-control-solid mb-3 mb-lg-0"
           placeholder="" value="{{old('name_en',$data->name_en ?? '')}}" required/>
    <!--end::Input-->
</div>
<div class="fv-row mb-7">
    <!--begin::Label-->
    <label class="required fw-bold fs-6 mb-2">{{__('lang.begin_price')}}</label>
    <!--end::Label-->
    <!--begin::Input-->
    <input type="number" name="cost" step="any" @if(app()->getLocale() == 'ar') style="direction: rtl;" @endif
    class="form-control form-control-solid mb-3 mb-lg-0" value="{{old('cost',$data->cost ?? '')}}" required/>
    <div class="text-muted fs-7">{{__('lang.increase_price_ber_kelo')}}</div>
    <!--end::Input-->
</div>

<div class="fv-row mb-7">
    <!--begin::Label-->
    <label class="required fw-bold fs-6 mb-2">{{__('lang.price_ber_kelo')}}</label>
    <!--end::Label-->
    <!--begin::Input-->
    <input type="number" name="distance_cost" step="any" @if(app()->getLocale() == 'ar') style="direction: rtl;" @endif
    class="form-control form-control-solid mb-3 mb-lg-0" value="{{old('distance_cost',$data->distance_cost ?? '')}}"
           required/>
    <div class="text-muted fs-7">{{__('lang.increase_price_ber_kelo')}}</div>
    <!--end::Input-->
</div>
<div class="fv-row mb-7">
    <label class="required fw-bold fs-6 mb-2">{{__('lang.road_type_in_service')}}</label>

    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-1 row-cols-xl-3 g-9" data-kt-buttons="true"
         data-kt-buttons-target="[data-kt-button='true']">

        <!--begin::Col-->
        <div class="col-md-6" style="width: 229px;">
            <!--begin::Option-->
            <label class="btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6
                @if(request()->segment(3) == 'edit')
                @if($data->type == \App\Models\CarService::TYPEONE ) active @endif
                @else
                    active
                @endif
                "
                   data-kt-button="true">
                <!--begin::Radio-->
                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                <input class="form-check-input" type="radio" name="type"
                       @if(request()->segment(3) == 'edit')
                       @if($data->type == \App\Models\CarService::TYPEONE ) checked="checked" @endif
                       @else
                       checked="checked"
                       @endif
                       value="{{\App\Models\CarService::TYPEONE}}">
            </span>
                <!--end::Radio-->
                <!--begin::Info-->
                <span class="ms-5">
                <span class="fs-4 fw-bolder text-gray-800 d-block">{{__('lang.service_with_one')}}</span>
            </span>
                <!--end::Info-->
            </label>
            <!--end::Option-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-6" style="width: 229px;">
            <!--begin::Option-->
            <label class="btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6
                @if(request()->segment(3) == 'edit')
                     @if($data->type == \App\Models\CarService::TYPETWO ) active @endif
                @endif
                "
                   style="width: 229px;"
                   data-kt-button="true">
                <!--begin::Radio-->
                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                <input class="form-check-input" type="radio" name="type"
                       @if(request()->segment(3) == 'edit')
                       @if($data->type == \App\Models\CarService::TYPETWO ) checked="checked" @endif
                       @endif
                       value="{{\App\Models\CarService::TYPETWO}}">
            </span>
                <!--end::Radio-->
                <!--begin::Info-->
                <span class="ms-5">
                <span class="fs-4 fw-bolder text-gray-800 d-block">{{__('lang.service_with_two')}}</span>
            </span>
                <!--end::Info-->
            </label>
            <!--end::Option-->
        </div>
        <!--end::Col-->
    </div>
</div>
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
            integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script !src="">
        $('.dropify').dropify();
        var avatar1 = new KTImageInput('kt_image_1');
    </script>
@endpush


