<form method="post" action="/Update_Setting" enctype="multipart/form-data">
    @csrf
    <div class="col-xl-12">
        <div class="kt-section__body">

            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">@if(Request::segment(1) == 'ar') الاسم عربي   @else  Name Arabic @endif</label>
                <div class="col-lg-9 col-xl-9">
                    <input class="form-control" type="text" value="{{$Setting->ar_company_name}}" name="ar_company_name">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">@if(Request::segment(1) == 'ar') الاسم انجليزي   @else  Name English @endif</label>
                <div class="col-lg-9 col-xl-9">
                    <input class="form-control" type="text" value="{{$Setting->en_company_name}}" name="en_company_name">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">@if(Request::segment(1) == 'ar') اسم الوزارة التابع لها   @else  Name Arabic @endif</label>
                <div class="col-lg-9 col-xl-9">
                    <input class="form-control" type="text" name="ministry_name" value="{{$Setting->ministry_name}}">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">@if(Request::segment(1) == 'ar') المديرية / الادارة التابع لها   @else  Name English @endif</label>
                <div class="col-lg-9 col-xl-9">
                    <input class="form-control" type="text" name="directorate_name" value="{{$Setting->directorate_name}}">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">@if(Request::segment(1) == 'ar') مسمى ادارة الحاسب الالي   @else  Name English @endif</label>
                <div class="col-lg-9 col-xl-9">
                    <input class="form-control" type="text" name="it_name" value="{{$Setting->it_name}}">
                </div>
              </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">@if(Request::segment(1) == 'ar') نوع التاريخ المستخدم   @else  type  @endif</label>
                    <div class="col-lg-9 col-xl-9">
                        <select class="form-control kt-select2"  name="date_type" required>
                            @if($Setting->date_type == 0)
                                <option selected value="0"> ميلادي</option>
                            @else
                                <option value="1"> هجري</option>
                            @endif
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">@if(Request::segment(1) == 'ar') صورة الشعار  @else  type  @endif</label>
                    <div class="col-lg-6 col-xl-6">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="logo" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                      </div>
                    </div>
                  </div>
  
                  <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">@if(Request::segment(1) == 'ar') صورة التوقيع  @else  type  @endif</label>
                    <div class="col-lg-6 col-xl-6">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="seal" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                      </div>
                    </div>
                  </div>
  
                  <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">@if(Request::segment(1) == 'ar') صورة التأشير  @else  type  @endif</label>
                    <div class="col-lg-6 col-xl-6">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="signature" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                      </div>
                    </div>
                  </div>

                  <input type="hidden" name="id" value="{{$Setting->id}}" />
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>



