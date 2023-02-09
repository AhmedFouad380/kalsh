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
    <label class="required fw-bold fs-6 mb-2">{{__('lang.price')}}</label>
    <!--end::Label-->
    <!--begin::Input-->
    <input type="number" name="price"
           class="form-control form-control-solid mb-3 mb-lg-0"
           placeholder="" value="{{old('price',$data->price ?? '')}}"/>
    <!--end::Input-->
</div>



<!--end::Input group-->

<div class="form-group row">
    <label class="col-xl-3 col-lg-3 col-form-label text-right">Example Label</label>
    <div class="col-lg-9 col-xl-6">
        <input type="file" name="image" class="dropify" data-default-file="{{old('price',$data->image ?? '')}}" >
        <span class="form-text text-muted">Allowed file types:  png, jpg, jpeg.</span>
    </div>
</div>
<div class="fv-row mb-7">
    <div
        class="form-check form-switch form-check-custom form-check-solid">
        <label class="form-check-label" for="flexSwitchDefault">{{__('lang.active')}}
            ؟</label>
        <input class="form-check-input" name="is_active" type="hidden"
               value="inactive" id="flexSwitchDefault"/>
        <input
            class="form-check-input form-control form-control-solid mb-3 mb-lg-0"
            name="is_active" type="checkbox"
            value="active" id="flexSwitchDefault" checked/>
    </div>
</div>
<!--end::Input group-->



