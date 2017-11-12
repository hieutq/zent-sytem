@extends('layouts.master')
@section('head')
    <!-- include summernote css/js-->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">

@endsection

@section('contents')

<div class="portlet light bordered" id="form_wizard_1">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-plus-circle" aria-hidden="true"></i> TẠO MỚI  </div>
        {{-- <div class="actions">
            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                <i class="icon-cloud-upload"></i>
            </a>
            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                <i class="icon-wrench"></i>
            </a>
            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                <i class="icon-trash"></i>
            </a>
        </div> --}}
    </div>
    <div class="portlet-body form">
        <form  action="#" id="submit_form" method="POST" enctype="multipart/form-data">
             {{ csrf_field() }}
            <div class="form-wizard">
                <div class="form-body">
                    <div class="form-body col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-10 col-lg-offset-1">

                                    <div class="form-group form-md-line-input form-md-floating-label ">
                                        <input type="text" class="form-control" id="short_name" name="short_name">
                                        <label for="code">Tên viết tắt</label>
                                        {{-- <span class="help-block">Vui lòng nhập mã khóa học</span> --}}
                                    </div>

                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="name" name="name">
                                        <label for="name">Tên khóa học</label>
                                        {{-- <span class="help-block">Vui lòng nhập tên khóa học</span> --}}
                                    </div>
                                     <div class="form-group form-md-line-input form-md-floating-label ">
                                        <input type="text" class="form-control" id="slogan" name="slogan">
                                        <label for="code">Khẩu hiệu</label>
                                        {{-- <span class="help-block">Vui lòng nhập khẩu hiệu của khóa họ</span> --}}
                                    </div>

                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input class="form-control" id="tuition" name="tuition"  type="text" >
                                        <label for="tuition">Học phí</label>
                                        {{-- <span class="help-block">Vui lòng nhập học phí</span> --}}
                                    </div>

                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="number" min = "1" class="form-control" id="capacity" name="capacity">
                                        <label for="capacity">Sức chứa</label>
                                        {{-- <span class="help-block">Vui lòng nhập số học viên tối đa của lớp</span> --}}
                                    </div>

                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="orientation_time" name="orientation_time">
                                        <label for="orientation_time">Ngày khai giảng</label>
                                        {{-- <span class="help-block">Vui lòng nhập ngày khai giảng</span> --}}
                                    </div>

                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="time_table" name="time_table">
                                        <label for="time_table">Lịch học</label>
                                        {{-- <span class="help-block">Vui lòng nhập lịch học</span> --}}
                                    </div>

                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="class_fb_group" name="class_fb_group">
                                        <label for="class_fb_group">Nhóm facebook</label>
                                        {{-- <span class="help-block">Vui lòng nhập nhóm facebook</span> --}}
                                    </div>

                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <select  id = "status" class="form-control" name="status">
                                        <option value=""></option>
                                        <option value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                    <label for="status">Trạng thái của khóa học</label>
                                    {{-- <span class="help-block">Hiển thị hoặc không hiển thị ở website</span> --}}
                                </div>

                            
                              <div class="form-group">
                                {{-- <label class="col-sm-3 control-label" for="addClassInfo">Thông Tin Lớp</label> --}}
                                <div class="col-sm-12">
                                <textarea class="form-control summernote" rows="3" id="class_info" name="class_info"></textarea>
                                </div>
                             </div>

                             <div class="form-group">
                                {{-- <label class="col-sm-3 control-label" for="addClassInfo">Thông Tin Lớp</label> --}}
                                <div class="col-sm-12">
                                <textarea class="form-control summernote" rows="3" id="class_desire_detail" name="class_desire_detail"></textarea>
                                </div>
                             </div>

                                <div class="form-group ">
                                    <div class="col-xs-12">
                                        <textarea class="form-control summernote" rows="3" id="student_object" name="student_object"></textarea>
                                    </div>
                                 </div>
                             <div class="form-group">
                                <div class="col-sm-12">
                                    <textarea class="form-control summernote" rows="3" id="content" name="content" placeholder="Nội Dung"></textarea>
                                </div>
                             </div>
                             <div class="form-group">
                                <div class="col-sm-12">
                                <textarea class="form-control summernote" rows="3" id="register_info" name="register_info" placeholder="Thông Tin Đăng Ký"></textarea>
                                </div>
                             </div>
                            </div>    

                    
                </div>
                <div class="form-actions text-center">
                    {{-- <div class="row"> --}}
                        <div class="col-xs-12 col-sm-12">
                            {{-- <a href="javascript:;" class="btn default button-previous">
                                <i class="fa fa-angle-left"></i> Quay lại </a> --}}
                            <a href="javascript:;" onclick="funAddCourse();" class="btn btn-outline green button-next"> Tiếp tục
                                <i class="fa fa-angle-right"></i>
                            </a>
                            {{-- <a href="javascript:;" class="btn green button-submit"> Submit
                                <i class="fa fa-check"></i>
                            </a> --}}
                        </div>
                    {{-- </div> --}}
                </div>
            </div>
        </form>
    </div>
</div>

{{-- <form id="frmCreateCourse" name="frmCreateCourse" action="{{ url('courses/createCourse') }}" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
   {{ csrf_field() }}
   <input type="hidden" name="_token" value="{{ csrf_token() }}">
     <div class="row">
     <div class="col-sm-11">


         <div class="form-group form-md-line-input">
            <label  class="col-sm-3 control-label" for="name">Khẩu Hiệu</label>
            <div class="col-sm-8">
               <input class="style-formEdit form-control" id="slogan" name="slogan" placeholder="Khẩu Hiệu..." type="text"/>
            </div>
         </div>
         
         <div class="form-group form-md-line-input">
            <label  class="col-sm-3 control-label" for="name">Hình Ảnh</label>
            <div class="col-sm-8">
               <input class="style-formEdit form-control" id="class_img" name="class_img" placeholder="Hình Ảnh" type="file"/>
            </div>
         </div>
         
         
         
         
         <div class="form-group form-md-line-input">
            <label class="col-sm-3 control-label" for="addStudentObject">Đối Tượng Học Viên</label>
            <div class="col-sm-8">
            <textarea class="form-control summernote" rows="3" id="student_object" name="student_object" placeholder="Đối Tượng Học Viên..."></textarea>
            </div>
         </div>
         <div class="form-group form-md-line-input">
            <label class="col-sm-3 control-label" for="addContent">Nội Dung</label>
            <div class="col-sm-8">
            <textarea class="form-control summernote" rows="3" id="content" name="content" placeholder="Nội Dung..."></textarea>
            </div>
         </div>
         <div class="form-group form-md-line-input">
            <label class="col-sm-3 control-label" for="addRegisterInfo">Thông Tin Đăng Ký</label>
            <div class="col-sm-8">
            <textarea class="form-control summernote" rows="3" id="register_info" name="register_info" placeholder="Thông Tin Đăng Ký..."></textarea>
            </div>
         </div>
         </div>
   </div>
   <div class="modal-footer">
      <a href="{{url('courses/list')}}"><button  type="button" class="btn btn-default"
         data-dismiss="modal">
      Hủy
      </button></a>
      <button type="submit" class="btn btn-primary">
      Thêm Mới
      </button>
   </div>
</form> --}}

@endsection

@section('footer')
    <script src="{{url('js/autoNumeric-min.js')}}"></script>
    <script>
        $('#tuition').autoNumeric('init', {aSign:' VND', pSign:'s' });
    </script>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
    <script>

    $("#content").summernote({
        placeholder: "Nội dung",
        height: 250,
    });
</script>

<script>
   $("#frmCreateCourse").validate({
    errorElement: "span",
      rules:{
          name:{
              required:true,
              maxlength:255,
          },

          short_name:{
              required:true,
              maxlength:255,
          },

          code:{
              required:true,
              maxlength:100,
          },

          capacity:{
              required:true,
              maxlength:11,
              digits: true,
          },

          tuition:{
              required:true,
              maxlength:11,
              digits: true,
          },

          status:{
              required:true,
          },

          orientation_time:{
              required:true,
          },          
      },
      messages:{
          name:{
              required:'Vui lòng nhập trường này',
              maxlength:'Bạn chỉ được nhập tối đa 255 ký tự',
          },
          short_name:{
              required:'Vui lòng nhập trường này',
              maxlength:'Bạn chỉ được nhập tối đa 255 ký tự',
          },
          code:{
              required:'Vui lòng nhập trường này',
              maxlength:'Bạn chỉ được nhập tối đa 100 ký tự',
          },
          capacity:{
              required:'Vui lòng nhập trường này',
              maxlength:'Bạn chỉ được nhập tối đa 11 số',
              digits:'Chỉ được nhập số, không được phép nhập ký tự',
          },
          tuition:{
              required:'Vui lòng nhập trường này',
              maxlength:'Bạn chỉ được nhập tối đa 11 số',
              digits:'Chỉ được nhập số, không được phép nhập ký tự',
          },
          status:{
              required:'Bạn chưa chọn giá trị trong trường này',
          },
          orientation_time:{
              required:'Bạn chưa chọn giá trị trong trường này',
          },
      }
   });

   function funAddCourse() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var short_name = $('#short_name').val();
        var name = $('#name').val();
        var slogan = $('#slogan').val();
        var tuition = $('#tuition').val();
        var capacity = $('#capacity').val();
        var orientation_time = $('#orientation_time').val();
        var time_table = $('#time_table').val();
        var status = $('#status').val();
        var status = $('#status').val();
        var class_fb_group = $('#class_fb_group').val();
        var content = $('#content').val();
        var register_info = $('#register_info').val();
        var class_info = $('#class_info').val();
        var class_desire_detail = $('#class_desire_detail').val();

        $.ajax({
              type: "POST",
              url: "{{route('courses.store')}}",
              data: {
                short_name : short_name,
                name : name,
                slogan : slogan,
                tuition : tuition,
                capacity : capacity,
                orientation_time : orientation_time,
                time_table : time_table,
                status : status,
                class_fb_group : class_fb_group,
                student_object : student_object,
                content : content,
                register_info : register_info,
                class_info : class_info,
                class_desire_detail : class_desire_detail,
              },
              success: function(res)
              {

                if(!res.error) {
                    toastr.success('Thêm mới thành công!');

                        $('.steps ul li').removeClass('active');

                        $('#step2').addClass('active');

                        $('#bar .progress-bar-success').css('width', '50%');

                        $('#tab1'). removeClass('active');

                        $('#tab2'). addClass('active');

                    // setTimeout(function () {   
                    //     window.location.href = "{{route('courses.index')}}";
                    // }, 2500)                   
                }
              },
              error: function (xhr, ajaxOptions, thrownError) {
                toastr.error(thrownError);
              }
        });
   }
</script>

@endsection

