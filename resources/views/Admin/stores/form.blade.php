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
    <label class="required fw-bold fs-6 mb-2">{{__('lang.url')}}</label>
    <!--end::Label-->
    <!--begin::Input-->
    <input type="url" name="url"
           class="form-control form-control-solid mb-3 mb-lg-0"
           placeholder="" value="{{old('url',$data->url ?? '')}}"/>
    <!--end::Input-->
</div>

<div class="form-group row">
    <label class="col-xl-3 col-lg-3 col-form-label text-right">{{trans('lang.image')}}</label>
    <div class="col-lg-9 col-xl-12">
        <input type="file" @if(request()->segment(2) != 'edit') required @endif name="image" class="dropify" data-default-file="{{old('image',$data->image ?? '')}}" >
        <span class="form-text text-muted">{{trans('lang.allows_files_type')}}:  png, jpg, jpeg , svg.</span>
    </div>
</div>
@push('scripts')
    <script !src="">
        var avatar1 = new KTImageInput('kt_image_1');
    </script>
@endpush


