@extends('layout.layout')

@section('title')
    {{__('lang.General Setting')}}
@endsection
@section('css')
    <link href="{{asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('dashboard/dropify/dist/css/dropify.min.css')}}">

@endsection

@section('content')

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <!--begin::Container-->        <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <!--begin::Mobile Toggle-->
                    <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
                        <span></span>
                    </button>
                    <!--end::Mobile Toggle-->
                    <!--begin::Page Heading-->
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <!--begin::Page Title-->

                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">

                            {{--                            <li class="breadcrumb-item">--}}
                            {{--                                <a href="" class="text-muted">Profile</a>--}}
                            {{--                            </li>--}}

                            <li class="breadcrumb-item">
                                <h5 class="text-dark font-weight-bold my-1 mr-5 ">{{trans('lang.General Setting')}}</h5>
                            </li>
                        </ul>

                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page Heading-->
                </div>
            </div>
        </div>

        <div class="container">
<br><br><br>            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap py-3">
                    <div class="card-title">
                        <h3 class="card-label">{{__('lang.General Setting')}}
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="/Update_Setting" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="kt-section__body">

                                    <div class="form-group">
                                        <label>{{__('lang.name_ar')}} :</label>
                                        <input class="form-control form-control-solid" type="text" value="{{$Setting->name_ar}}" name="name_ar">
                                    </div>

                                    <div class="form-group">
                                        <label>{{__('lang.name_en')}} :</label>
                                        <input class="form-control form-control-solid" type="text" value="{{$Setting->name_en}}" name="name_en">
                                    </div>

                                    <div class="form-group">
                                        <label>{{__('lang.description_ar')}} :</label>
                                        <textarea class="form-control form-control-solid" type="text" name="description_ar" rows="5" value=""> {{$Setting->description_ar}} </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>{{__('lang.description_en')}} :</label>
                                        <textarea class="form-control form-control-solid" type="text" name="description_en" rows="5" value=""> {{$Setting->description_en}} </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>{{__('lang.phone')}}   :</label>
                                        <input class="form-control form-control-solid" type="text" name="phone" value="{{$Setting->phone}}">
                                    </div>
                                    <div class="form-group">
                                        <label>{{__('lang.email')}}   :</label>
                                        <input class="form-control form-control-solid" type="text" name="email" value="{{$Setting->email}}">
                                    </div>


                                    <div class="form-group">
                                        <label>{{__('lang.address')}}  :</label>
                                        <input class="form-control form-control-solid" type="text" name="address" value="{{$Setting->address}}">
                                    </div>

                                    <div class="form-group">
                                        <label>Facebook :</label>
                                        <input class="form-control form-control-solid" type="text" name="facebook" value="{{$Setting->facebook}}">
                                    </div>
                                    <div class="form-group">
                                        <label>twitter :</label>
                                        <input class="form-control form-control-solid" type="text" name="twitter" value="{{$Setting->twitter}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Website :</label>
                                        <input class="form-control form-control-solid" type="text" name="web" value="{{$Setting->web}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Terms & Policy :</label>
                                        <textarea class="form-control form-control-solid" type="text" name="terms_policy" rows="5" value=""> {{$Setting->terms_policy}} </textarea>
                                    </div>


                                    <input type="hidden" name="id" value="{{$Setting->id}}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{__('lang.max_flexible_time')}}  :</label>
                                <input class="form-control form-control-solid" type="number" name="max_flexible_time" value="{{$Setting->max_flexible_time}}">
                            </div>
                            <div class="form-group">
                                <label>{{__('lang.max_pay_time')}}  :</label>
                                <input class="form-control form-control-solid" type="text" name="max_pay_time" value="{{$Setting->max_pay_time}}">
                            </div>
                            <div class="col-xl-12">
                                <div class="kt-section__body">

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">@if(session('lang') == 'ar')
                                            اللوجو@else  Logo @endif</label>
                                        <div class="col-lg-12 col-xl-12">
                                            <div class="card">
                                                <div class="card-block">
                                                    <h4 class="card-title"></h4>
                                                    <div class="controls">
                                                        <input type="file" id="input-file-now" class="dropify"  data-default-file="{{asset($Setting->logo)}}" name="logo"   data-validation-required-message="{{trans('word.This field is required')}}"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">{{__('lang.save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>







    <div class="modal fade" id="kt_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        @if(Request::segment(1) == 'ar')
                            اضافة جديده
                        @else
                            Create
                        @endif</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/Store_Setting" enctype="multipart/form-data">
                        @csrf
                        <div class="col-xl-12">
                            <div class="kt-section__body">

                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">@if(Request::segment(1) == 'ar') الاسم عربي   @else  Name Arabic @endif</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input class="form-control" type="text" name="ar_company_name" value="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">@if(Request::segment(1) == 'ar') الاسم انجليزي   @else  Name English @endif</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input class="form-control" type="text" name="en_company_name" value="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">@if(Request::segment(1) == 'ar') اسم الوزارة التابع لها   @else  Name Arabic @endif</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input class="form-control" type="text" name="ministry_name" value="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">@if(Request::segment(1) == 'ar') المديرية / الادارة التابع لها   @else  Name English @endif</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input class="form-control" type="text" name="directorate_name" value="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">@if(Request::segment(1) == 'ar') مسمى ادارة الحاسب الالي   @else  Name English @endif</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input class="form-control" type="text" name="it_name" value="">
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

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>



    <!-- /.modal -->
    <div class="modal fade bs-edit-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content card card-outline-info">
                <div class="modal-header card-header">
                    <h3 class="modal-title text-white" id="myLargeModalLabel">{{trans('word.Edit Advertisement')}}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

@section('js')
    <script src="{{asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script src="{{asset('dashboard/assets/js/pages/crud/datatables/basic/basic.js')}}"></script>
    <script src="{{asset('dashboard/assets/js/pages/features/miscellaneous/sweetalert2.js')}}"></script>
    <script src="{{asset('dashboard/assets/js/pages/features/miscellaneous/dropify.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/js/pages/crud/file-upload/image-input.js')}}"></script>

    <script>

        $("#checker").click(function(){
            var items = document.getElementsByTagName("input");

            for(var i=0; i<items.length; i++){
                if(items[i].type=='checkbox') {
                    if (items[i].checked==true) {
                        items[i].checked=false;
                    } else {
                        items[i].checked=true;
                    }
                }
            }

        });

        //Delete Row
        $("body").on("click", "#delete", function () {
            var dataList = [];
            dataList = $("#kt_datatable input:checkbox:checked").map(function(){
                return $(this).val();
            }).get();

            if(dataList.length >0){
                Swal.fire({
                    title: "{{trans('word.Are you sure?')}}",
                    text: "",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "{{trans('word.Yes, Sure it!')}}",
                    cancelButtonText: "{{trans('word.No')}}",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }).then(function (result) {
                    if (result.value) {
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url:'{{url("Delete_Language")}}',
                            type:"get",
                            data:{'id':dataList,_token: CSRF_TOKEN},
                            dataType:"JSON",
                            success: function (data) {
                                if(data.message == "Success")
                                {
                                    $("#kt_datatable .selected").hide();
                                    @if( Request::segment(1) == "ar")
                                    $('#delete').text('حذف 0 سجل');
                                    @else
                                    $('#delete').text('Delete 0 row');
                                    @endif
                                    Swal.fire("{{trans('word.Deleted')}}", "{{trans('word.Message_Delete')}}", "success");
                                    location.reload();
                                }else{
                                    Swal.fire("{{trans('word.Sorry')}}", "{{trans('word.Message_Fail_Delete')}}", "error");
                                }
                            },
                            fail: function(xhrerrorThrown){
                                Swal.fire("{{trans('word.Sorry')}}", "{{trans('word.Message_Fail_Delete')}}", "error");
                            }
                        });
                        // result.dismiss can be 'cancel', 'overlay',
                        // 'close', and 'timer'
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire("{{trans('word.Cancelled')}}", "{{trans('word.Message_Cancelled_Delete')}}", "error");
                    }
                });
            }
        });

        $(document).ready(function() {
            // Basic
            $('.dropify').dropify();

            // Used events
            var drEvent = $('#input-file-events').dropify();

            drEvent.on('dropify.beforeClear', function(event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });

            drEvent.on('dropify.afterClear', function(event, element) {
                alert('File deleted');
            });

            drEvent.on('dropify.errors', function(event, element) {
                console.log('Has Errors');
            });

            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function(e) {
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                } else {
                    drDestroy.init();
                }
            })
        });

        //End Delete Row
        $(".edit-Advert").click(function(){
            var id=$(this).data('id')
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: "GET",
                url: "{{url('Edit_Language')}}",
                data: {"id":id},
                success: function (data) {
                    $(".bs-edit-modal-lg .modal-body").html(data)
                    $(".bs-edit-modal-lg").modal('show')
                    $(".bs-edit-modal-lg").on('hidden.bs.modal',function (e){
                        //   $('.bs-edit-modal-lg').empty();
                        $('.bs-edit-modal-lg').hide();
                    })
                }
            })
        })

        $(".switchery-demo").click(function(){
            var id =$(this).data('id');
            console.log(id);
            $.ajax({
                type: "get",
                url: "{{url('UpdateStatusUser')}}",
                data: {"id":id },
                success: function (data) {
                    Swal.fire({
                        icon: 'success',
                        title: "@if(Request::segment(1)=='ar')  نجاح @else success @endif",
                        text: "@if(Request::segment(1) == 'ar' ) تم التعديل بنجاح   @else Successfully changed @endif",
                        type:"success" ,
                        timer: 1000,
                        showConfirmButton: false
                    });


                }
            })
        })
    </script>

    <?php
    $message=session()->get("message");
    ?>



    @if( session()->has("message"))
        @if( $message == "Success")
            <script>
                Swal.fire({
                    icon: 'success',
                    title: "{{__('lang.Success')}}",
                    text: "{{__('lang.Success_text')}}",
                    type:"success" ,
                    timer: 1000,
                    showConfirmButton: false
                });

            </script>
        @elseif ( $message == "Failed")
            <script>
                Swal.fire({
                    icon: 'warning',
                    title: "{{__('lang.Sorry')}}",
                    text: "{{__('lang.operation_failed')}}",
                    type:"error" ,
                    timer: 2000,
                    showConfirmButton: false
                });
            </script>
        @endif
    @endif
@endsection
@endsection
