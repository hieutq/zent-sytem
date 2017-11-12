@extends('layouts.master')
@section('head')
<!-- <link rel="stylesheet" type="text/css" href="{{url('css//bootstrap-select.min.css')}}"> -->

<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
<script>
   tinymce.PluginManager.add('placeholder', function (editor) {
        editor.on('init', function () {
            var label = new Label;
            onBlur();
            tinymce.DOM.bind(label.el, 'click', onFocus);
          
            editor.on('focus', onFocus);
            editor.on('blur', onBlur);
            editor.on('change', onBlur);
            editor.on('setContent', onBlur);
            function onFocus() { if (!editor.settings.readonly === true) { label.hide(); } editor.execCommand('mceFocus', false); }
            function onBlur() { if (editor.getContent() == '') { label.show(); } else { label.hide(); } }
        });
        var Label = function () {
            var placeholder_text = editor.getElement().getAttribute("placeholder") || editor.settings.placeholder;
            var placeholder_attrs = editor.settings.placeholder_attrs || { style: { position: 'absolute', top: '2px', left: 0, color: '#aaaaaa', padding: '.25%', margin: '5px', width: '80%', 'font-size': '17px !important;', overflow: 'hidden', 'white-space': 'pre-wrap' } };
            var contentAreaContainer = editor.getContentAreaContainer();
            tinymce.DOM.setStyle(contentAreaContainer, 'position', 'relative');
            this.el = tinymce.DOM.add(contentAreaContainer, "label", placeholder_attrs, placeholder_text);
        }
        Label.prototype.hide = function () { tinymce.DOM.setStyle(this.el, 'display', 'none'); }
        Label.prototype.show = function () { tinymce.DOM.setStyle(this.el, 'display', ''); }
    });
   
    tinymce.init({selector: ".EditorControl",plugins: ["placeholder"]});
</script>

@endsection
<style type="text/css">
    .error{
      color: red;
      margin-top: 4px;
    }
    .last-blur{
     font-size: 16px;
    top: 25px;
    transition: 0.2s ease all;
    color: #999;
    }
</style>
@section('contents')
<div class="portlet light bordered" id="form_wizard_1">
   <div class="portlet-title">
      <div class="caption">
         <i class="fa fa-plus-circle" aria-hidden="true"></i> TẠO MỚI LỚP HỌC  
      </div>
   </div>
   <div class="portlet-body form">
      <form  id="frmCreateClassRoom" action="#" method="POST" name="frmCreateClassRoom" role="form"  enctype="multipart/form-data">
         {{ csrf_field() }}
         <div class="form-wizard">
            <div class="form-body">
               <div class="tab-content">
                 
                  <div class="tab-pane active" id="tab1">
                     {{-- <h3 class="block">Thông tin cơ bản</h3> --}}
                     <div class="form-body col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-10 col-lg-offset-1">
                        <div class="form-group form-md-line-input form-md-floating-label">

                           <input type="text" class="form-control" id="code" name="code">
                           <label for="code">Mã Lớp (<span style="color:red;">*</span>)</label>
                          <span class="help-block"></span>
                        </div>
                        <div class="form-group form-md-line-input form-md-floating-label">
                           <input type="text" class="form-control" id="class_name" name="class_name">
                           <label for="class_name">Tên Lớp (<span style="color:red;">*</span>)</label>
                           <span class="help-block"></span>
                        </div>
                        <div class="form-group form-md-line-input form-md-floating-label">
                        <label class="lable-select" for="id_teacher">Giảng Viên</label>
                           <select class="selectpicker " id="id_teacher" name="id_teacher[]" multiple="" data-live-search="true" tabindex="-98">
                              @if(!empty($list_teacher))
                             
                                  @foreach($list_teacher as $db_user)
                                  <option value="{{$db_user->id}}" data-tokens="{{$db_user->name}},{{$db_user->mobile}},{{$db_user->email}}">{{$db_user->name }} </option>
                                  @endforeach
                               @endif
                              @if(count($list_teacher)==0)
                              <option value=""><em>(Chưa có giảng viên nào)</em></option>
                             @endif
                           </select>
                    
                           <span class="help-block"></span>
                        </div>
                        <div class="form-group form-md-line-input form-md-floating-label">
                          <label class="lable-select" for="id_teacher">Trợ Giảng</label>
                           <select id="tutors_name_class" class="selectpicker" name="tutors_name_class[]" multiple="" data-live-search="true" tabindex="-98">
                              @if(!empty($list_tutor))
                           
                              @foreach($list_tutor as $db_tutor)
                              <option value="{{$db_tutor->id}}" data-tokens="{{$db_tutor->name}},{{$db_tutor->mobile}},{{$db_tutor->email}}">{{$db_tutor->name }}</option>
                              @endforeach
                              @endif
                                @if(count($list_tutor)==0)
                              <option value=""><em>(Chưa có trợ giảng nào)</em></option>
                              @endif
                           </select>
                          <span class="help-block"></span>
                        </div>
                        <div class="form-group form-md-line-input form-md-floating-label">
                           <input class="form-control" id="orientation_time"
                              name="orientation_time" type="text" />
                           <label for="orientation_time" class="lb-orientation_time">Ngày Khai Giảng</label>
                    
                        </div>
                        <div class="form-group form-md-line-input form-md-floating-label">
                           <input type="text"  class="form-control" id="time_table" name="time_table">
                           <label for="time_table">Ngày Học</label>
                          
                        </div>
                        <div class="form-group form-md-line-input form-md-floating-label">
                           <input type="text" class="form-control" id="number_of_unit" name="number_of_unit">
                           <label for="number_of_unit">Số Buổi Học (<span style="color:red;">*</span>)</label>
                       
                        </div>
                        <div class="form-group form-md-line-input form-md-floating-label">
                           <input type="text" class="form-control" id="tuition" name="tuition">
                           <label for="tuition">Học Phí (<span style="color:red;">*</span>)</label>
                      
                        </div>
                        <div class="form-group form-md-line-input form-md-floating-label">
                           <input type="text" class="form-control" id="max_tuition_policy" name="max_tuition_policy">
                           <label for="max_tuition_policy">Học Phí Giảm Tối Đa</label>
                  
                        </div>
                        <div class="form-group form-md-line-input form-md-floating-label">
                           <select  id = "course_id" class="form-control" name="course_id">
                              @if(!empty($list_course))
                              <option value=""></option>
                              @foreach($list_course as $db)
                              <option value="{{$db->id}}">{{$db->name}}</option>
                              @endforeach
                              @else
                              <option value=""></option>
                              @endif
                           </select>
                           <label for="course_id">Thuộc Khóa Học (<span style="color:red;">*</span>)</label>
                   
                        </div>
                        <div class="form-group form-md-line-input form-md-floating-label">
                           <input type="text" class="form-control" id="facebook_group" name="facebook_group">
                           <label for="facebook_group">Facebook Lớp</label>
          
                        </div>
                        <div class="form-group form-md-line-input form-md-floating-label">
                           <select  id = "status" class="form-control" name="status">
                              <option value=""></option>
                              @if (!empty($statuses)) @foreach($statuses as $status)
                                <option value="{{$status->id}}">{{$status->name}}</option>
                              @endforeach @endif

                           </select>
                           <label for="status">Trạng thái Lớp (<span style="color:red;">*</span>)</label>
                     
                        </div>
                        <div class="form-group">
                           <div class="col-sm-12">
                              <textarea id="tuition_policy" class="EditorControl" style="height: 250px; width: 100%"" placeholder="Chính Sách Giảm Học Phí" name="tuition_policy">
                              </textarea>                           
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-actions text-center">
               
                  <div class="col-xs-12 col-sm-12">
                     <button type="submit" class="btn btn-outline green button-next btn-circle">Thêm Mới</button>
                  </div>
            </div>
         </div>
      </form>
   </div>
</div>

@endsection
@section('footer')

{{-- <script>

       var date_input=$('input[name="orientation_time"]'); //our date input has the name "date"
       var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
       date_input.datepicker({
           format: 'yyyy/mm/dd',
           container: container,
           todayHighlight: true,
           autoclose: true,
           startDate: '+1d',
       });
     var val_date_input=date_input.val();
     $(". table-condensed").click(function(){
      if ($("#orientation_time").attr('value') != "") {
        alert($("#orientation_time").attr('value'));
        $(".error").hide();
         $("#lb-orientation_time").css({"font-size": "13px", "top": "0"});
      }else if ($("#orientation_time").attr('value') == undefined){
        alert($("#orientation_time").attr('value'));
        $(".lb-orientation_time").addclass("last-blur");
        
      }
      
     })

</script> --}}

<script src="{{url('js/autoNumeric-min.js')}}"></script>

<script src="{{url('js/jqueryValidate/jquery.validate.js')}}" type="text/javascript"></script>


<script>
   $('#tuition').autoNumeric('init', {aSign:' VND', pSign:'s' });
   $('#max_tuition_policy').autoNumeric('init', {aSign:' VND', pSign:'s' });
</script>
{{-- <script src="{{url('js/curd-ClassRoom.js')}}" type="text/javascript"></script> --}}


<script>
    $('#frmCreateClassRoom').validate({ // initialize the plugin
              errorElement: "span",
              rules: {
                code : {
                  required : true,
                  minlength: 2,
                  maxlength:250
                  
                },
                class_name : {
                  required :true,
                  minlength :2,
                  maxlength : 250
                },
                orientation_time : {
                  required :true,
                  date :true
                },
          
                number_of_unit : {
                  required :true,
                  number :true
                },
                tuition : {
                  required :true,
                  maxlength :250
                },
                max_tuition_policy : {
                  maxlength:1000
                },
                course_id : {
                  required:true,
                  number:true
                },
                status : {
                  required:true,
                  number:true
                }
              },
              messages: {
                code : {
                  required : "Bạn phải nhập mã lớp ",
                  minlength: "Mã lớp có độ dài ít nhất 2 ký tự",
                  maxlength : "Mã lớp có độ dài tối đa 250 ký tự"
                },
                class_name : {
                  required :"Bạn phải nhập tên lớp",
                  minlength: "Tên lớp có độ dài ít nhất 2 ký tự",
                  maxlength : "Tên lớp có độ dài tối đa 250 ký tự"
                },
                orientation_time : {
                  required :"Bạn phải nhập ngày khai giảng",
                  date : "Ngày khai giảng không đúng định dạng"
                },
          
                number_of_unit : {
                  required :"Bạn phải nhập số buổi học",
                  number: "Số buổi học phải là kiểu số"
                },
                tuition : {
                  required :"Bạn phải nhập học phí",
                  maxlength : "Học phí có độ dài tối đa 250 ký tự"
                },
                max_tuition_policy : {
                  maxlength : "Chính sách giảm phí có độ dài tối đa 1000 ký tự"
                },
                course_id : {
                  required :"Bạn phải chọn khóa học cho lớp",
                  number : "Khóa học không đúng định dạng"
                },
                status : {
                  required :"Bạn phải chọn trạng thái cho lớp",
                  number : "Trạng thái không đúng định dạng"
                }
              }
  });

    $('#frmCreateClassRoom').on('submit',function(e){

            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var tuition_policy =tinymce.get('tuition_policy').getContent();

            $.ajax({
                type:'POST',
                url: "{{route('classroom.store')}}",
                data: {
                  code : $("#code").val(),
                  class_name : $("#class_name").val(),
                  id_teacher : $("#id_teacher").val(),
                  tutors_name_class : $("#tutors_name_class").val(),
                  orientation_time : $("#orientation_time").val(),
                  time_table : $("#time_table").val(),
                  number_of_unit : $("#number_of_unit").val(),
                  tuition : $("#tuition").val(),
                  max_tuition_policy : $("#max_tuition_policy").val(),
                  course_id : $("#course_id").val(),
                  facebook_group : $("#facebook_group").val(),
                  status : $("#status").val(),
                  tuition_policy : tuition_policy,

                },

                success:function(data){
                    if(!data.error) {
                        toastr.success('Thêm mới lớp học thành công!');

                        setTimeout(function () {   
                            window.location.href = "{{route('classroom.index')}}";
                        }, 1500);

                        $('#frmCreateClassRoom button[type="submit"]').prop('disabled',true);


                    } else {
                        toastr.error('Thêm mới không thành công !');
                        $('#frmCreateClassRoom button[type="submit"]').prop('disabled',false);
                    }
                  },
                  error: function (xhr, ajaxOptions, thrownError) {
                    toastr.error(thrownError);

                  }
            });
        });  
</script>
@endsection