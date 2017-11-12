@extends('layouts.master')
@section('head')
<!-- include summernote css/js-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
@endsection
@section('contents')
<div class="portlet light bordered" id="form_wizard_1">
   <div class="portlet-title">
      <div class="caption">
         <span class="caption-subject font-red bold uppercase"><i class="fa fa-plus-circle" aria-hidden="true"></i> TẠO MỚI KHÓA HỌC  </span>
      </div>
   </div>
   <h3 class="block text-center">Thông tin cơ bản</h3>
   <div class="portlet-body form">
   @if(count($errors))
      <div class="alert alert-danger text-center">
        <strong>Lỗi!</strong> Hãy kiểm tra lại dữ liệu bạn vừa nhập vào.
      </div>
    @endif
      <form  action="{{route('courses.store')}}" id="frmCreateCourse" name="frmCreateCourse" method="POST" enctype="multipart/form-data" autocomplete="off">
         {{ csrf_field() }}
         <div class="form-wizard">
            <div class="form-body">
               <div class="tab-content">
                  <div class="tab-pane active">
                     <div class="form-body col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-10 col-lg-offset-1">

                        <div class="form-group form-md-line-input form-md-floating-label {{ $errors->has('name') ? 'has-error' : '' }}">
                           <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                           <label for="name">Tên khóa học <span class="requireds"> (*)</span></label>
                        </div>
                        <p class="font-red-mint">{{ $errors->first('name') }}</p>

                        <div class="form-group form-md-line-input form-md-floating-label {{ $errors->has('short_name') ? 'has-error' : '' }}">
                           <input type="text" class="form-control" id="short_name" name="short_name" value="{{ old('short_name') }}">
                           <label for="code">Tên viết tắt <span class="requireds"> (*)</span></label>
                        </div>
                       <p class="font-red-mint">{{ $errors->first('short_name') }}</p>

                        <div class="form-group form-md-line-input form-md-floating-label ">
                           <input type="text" class="form-control" id="slogan" name="slogan" value="{{ old('slogan') }}">
                           <label for="code">Khẩu hiệu</label>
                        </div>

                        <div class="form-group form-md-line-input form-md-floating-label ">
                           <input class="form-control" id="tuition" name="tuition"  type="text" value="{{ old('tuition') }}">
                           <label for="tuition">Học phí</label>
                        </div>

                        <div class="form-group form-md-line-input form-md-floating-label {{ $errors->has('capacity') ? 'has-error' : '' }}">
                           <input type="number" min = "1" class="form-control" id="capacity" name="capacity" value="{{ old('capacity') }}">
                           <label for="capacity">Số Lượng <span class="requireds"> (*)</span></label>
                        </div>
                        <p class="font-red-mint">{{ $errors->first('capacity') }}</p>

                        <div class="form-group form-md-line-input form-md-floating-label {{ $errors->has('orientation_time') ? 'has-error' : '' }}">
                           <input type="text" class="form-control" id="orientation_time" name="orientation_time" value="{{ old('orientation_time') }}">
                           <label for="orientation_time">Ngày khai giảng <span class="requireds"> (*)</label>
                        </div>
                        <p class="font-red-mint">{{ $errors->first('orientation_time') }}</p>

                        <div class="form-group form-md-line-input form-md-floating-label">
                           <input type="text" class="form-control" id="time_table" name="time_table" value="{{ old('time_table') }}">
                           <label for="time_table">Lịch học</label>
                        </div>

                        <div class="form-group form-md-line-input form-md-floating-label">
                           <input type="text" class="form-control" id="class_fb_group" name="class_fb_group" value="{{ old('class_fb_group') }}">
                           <label for="class_fb_group">Nhóm facebook</label>
                        </div>

                        <div class="form-group form-md-line-input form-md-floating-label {{ $errors->has('status') ? 'has-error' : '' }}">
                           <select  id = "status" class="form-control" name="status">
                              <option value="" ></option>
                              <option value="0" @if (old('status')==0) Selected  @endif>Ẩn</option>
                              <option value="1" @if (old('status')==1) Selected  @endif>Hiển thị</option>
                              
                           </select>
                           <label for="status">Trạng thái của khóa học <span class="requireds"> (*)</span></label>
                        </div>
                        <p class="font-red-mint">{{ $errors->first('status') }}</p>

                        <div class="form-group">
                              <div style="margin-bottom: 15px;color: #888;">Thông tin lớp học</div>
                              <textarea class="form-control" rows="3" id="class_info" name="class_info" placeholder="Thông tin lớp">{{ old('class_info') }}</textarea>
                          
                        </div>

                        <div class="form-group">
                              <div style="margin-bottom: 15px;color: #888;">Thông tin lớp chi tiết</div>
                              <textarea class="form-control" rows="3" id="class_desire_detail" name="class_desire_detail" placeholder="Thông tin lớp chi tiết">{{ old('class_desire_detail') }}</textarea>
                           
                        </div>

                        <div class="form-group ">
                              <div style="margin-bottom: 15px;color: #888;">Đối tượng học viên</div>
                              <textarea class="form-control" rows="3" id="student_object" name="student_object" placeholder="Đối tượng học viên">{{ old('student_object') }}</textarea>
                          
                        </div>

                        <div class="form-group">
                            <div style="margin-bottom: 15px;color: #888;">Nội dung</div>
                              <textarea class="form-control" rows="3" id="content" name="content" placeholder="Nội Dung">{{ old('content') }}</textarea>
                           
                        </div>

                        <div class="form-group">
                              <div style="margin-bottom: 15px;color: #888;">Thông tin đăng ký</div>
                              <textarea class="form-control" rows="3" id="register_info" name="register_info" placeholder="Thông tin đăng ký">{{ old('register_info') }}</textarea>
                           
                        </div>
                     </div>
                  </div>
                  </div>
               </div>
            </div>
            <div class="form-actions text-center">
               <div class="col-xs-12 col-sm-12" style="margin-top: 20px;">
                    <a href="{{route('courses.index')}}" class="btn btn-outline green button-pre btn-circle"> Quay Lại
                    </a>               
                   <button type="submit" class="btn green btn-circle">
                   Thêm mới
                      {{-- <i class="fa fa-check"></i> --}}
                    </button>
               </div>
            </div>
         </div>
      </form>
   </div>
</div> 
@endsection

@section('footer')
<script src="{{url('js/autoNumeric-min.js')}}"></script>
<script src="{{url('js/jqueryValidate/jquery.validate.js')}}" type="text/javascript"></script>
<script>
   $('#tuition').autoNumeric('init', {aSign:' VND', pSign:'s' });
</script>

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

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

      tinymce.init({
          selector: '#student_object',
          height: 300,
          menubar: false,
          plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
          ],
          toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
          content_css: [
              '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
              '//www.tinymce.com/css/codepen.min.css'
            ],
          // setup: function(ed) {
          //       ed.on('keyup', function(e) {
          //           check_submit();
          //       });
          //   }
        });

      tinymce.init({
          selector: '#content',
          height: 300,
          menubar: false,
          plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
          ],
          toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
          content_css: [
              '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
              '//www.tinymce.com/css/codepen.min.css'
            ],
          // setup: function(ed) {
          //       ed.on('keyup', function(e) {
          //           // check_submit();
          //       });
          //   }
        });

      tinymce.init({
          selector: '#register_info',
          height: 300,
          menubar: false,
          plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
          ],
          toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
          content_css: [
              '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
              '//www.tinymce.com/css/codepen.min.css'
            ],
          // setup: function(ed) {
          //       ed.on('keyup', function(e) {
          //           // check_submit();
          //       });
          //   }
        });

      tinymce.init({
          selector: '#class_info',
          height: 300,
          menubar: false,
          plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
          ],
          toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
          content_css: [
              '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
              '//www.tinymce.com/css/codepen.min.css'
            ],
          // setup: function(ed) {
          //       ed.on('keyup', function(e) {
          //           // check_submit();
          //       });
          //   }
        });

      tinymce.init({
          selector: '#class_desire_detail',
          height: 300,
          menubar: false,
          plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
          ],
          toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
          content_css: [
              '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
              '//www.tinymce.com/css/codepen.min.css'
            ],
          // setup: function(ed) {
          //       ed.on('keyup', function(e) {
          //           // check_submit();
          //       });
          //   }
        });
  </script>

{{-- <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script> --}}
{{-- <script>
   $("#student_object").summernote({
       placeholder: "Đối tượng học viên",
       height: 250,
   });
   $("#content").summernote({
       placeholder: "Nội dung",
       height: 250,
   });
   $("#register_info").summernote({
       placeholder: "Thông tin lớp",
       height: 250,
   });
   
   $("#class_info").summernote({
       placeholder: "Yêu cầu đầu vào",
       height: 250,
   });
   $("#class_desire_detail").summernote({
       placeholder: "Cam kết đầu ra",
       height: 250,
   });
</script> --}}
@endsection
