@extends('layouts.master')
@section('head')
    <!-- include summernote css/js-->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">

@endsection

@section('contents')

<div class="portlet light bordered" id="form_wizard_1">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-plus-circle" aria-hidden="true"></i> THÊM MỚI BÀI TẬP  </div>
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
                    <ul class="nav nav-pills nav-justified steps">
                        <li id="step1"@if ($step == 1) class="active" @endif >
                            <a href="#tab1" data-toggle="tab" class="step" aria-expanded= false>
                                <span class="number"> 1 </span>
                                <span class="desc">
                                    <i class="fa fa-check"></i> Thông tin cơ bản </span>
                            </a>
                        </li>
                        <li id="step2" @if ($step == 2) class="active" @endif>
                            <a href="#tab2" data-toggle="tab" class="step"  aria-expanded= true>
                                <span class="number"> 2 </span>
                                <span class="desc">
                                    <i class="fa fa-check"></i> Lời giải </span>
                            </a>
                        </li>
                        {{-- <li>
                            <a href="#tab3" data-toggle="tab" class="step active">
                                <span class="number"> 3 </span>
                                <span class="desc">
                                    <i class="fa fa-check"></i> Xác nhận </span>
                            </a>
                        </li> --}}
                        
                    </ul>
                    <div id="bar" class="progress progress-striped" role="progressbar">
                        <div class="progress-bar progress-bar-success" @if ($step == 1) style="width: 50%" @elseif($step == 2) style="width: 100%" @endif> </div>
                    </div>
                    <div class="tab-content">
                        
                        <div class="tab-pane @if ($step == 1) active @endif" id="tab1">
                            <h3 class="block">Nội dung</h3>
                            
                                <div class="form-body col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-10 col-lg-offset-1">
                                    
                                    <div id = "form-group-id" class="form-group form-md-line-input form-md-floating-label">
                                        <select disabled="true" id = "theory_group_id"  class="form-control" name="theory_group_id">
                                          @if ($groups) @foreach($groups as $group)
                                              <option value="{{$group->id}}" @if($group->id == $theory_group_id) selected @endif>{{$group->name}}</option>
                                          @endforeach @endif
                                        </select>
                                        <label for="theory_group_id">Nhóm lý thuyết</label>
                                        <span id="error-theory_group_id" class="help-block"></span>
                                    </div>

                                    <div id = "form-theory-id" class="form-group form-md-line-input form-md-floating-label">
                                      <select @if($theory_id) disabled="true" @endif id = "theory_id" class="form-control" name="theory_id">
                                           @if ($theories) @foreach($theories as $theory)
                                              <option value="{{$theory->id}}" @if($theory->id == $theory_id) selected @endif>{{$theory->name}}</option>
                                          @endforeach @endif
                                      </select>
                                      <label for="theory_id">Lý thuyết</label>
                                      {{-- <span class="help-block">Hiển thị hoặc không hiển thị ở website</span> --}}
                                    </div>


                                    <div id = "form-name" class="form-group form-md-line-input form-md-floating-label ">
                                        <input type="text" class="form-control" id="name" name="name">
                                        <label for="name">Tên bài tập</label>
                                        {{-- <span class="help-block">Vui lòng nhập tên bài tập</span> --}}
                                    </div>

                                    <div id = "form-level-id" class="form-group form-md-line-input form-md-floating-label">
                                      <select  id = "level_id" class="form-control" name="level_id">
                                          @if ($levels) @foreach($levels as $level)
                                            <option value="{{$level->id}}">{{$level->name}}</option>
                                          @endforeach @endif
                                      </select>
                                      <label for="level_id">Mức độ</label>
                                      {{-- <span class="help-block">Hiển thị hoặc không hiển thị ở website</span> --}}
                                  </div>

                                 <div id = "form-content" class="form-group">
                                    
                                        <textarea class="form-control" rows="3" id="content" name="content" placeholder="Nội Dung"></textarea>
                                    
                                 </div>
                            </div>    
                            
                            <div class="form-actions text-center">
                              {{-- <div class="row"> --}}
                                  <div class="col-xs-12 col-sm-12">
                                      {{-- <a href="javascript:;" class="btn default button-previous">
                                          <i class="fa fa-angle-left"></i> Quay lại </a> --}}
                                      <a href="javascript:;" onclick="funAddExercise();" class="btn btn-outline green button-next  btn-circle"> Thêm mới
                                          
                                      </a>
                                      {{-- <a href="javascript:;" class="btn green button-submit"> Submit
                                          <i class="fa fa-check"></i>
                                      </a> --}}
                                  </div>
                              {{-- </div> --}}
                          </div>
                        </div>
                        <div class="tab-pane @if ($step == 2) active @endif" id="tab2">
                             <h3 class="block">Nội dung</h3>
                            
                                <div class="form-body col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-10 col-lg-offset-1">
                                    
                                    <div id = "form-language-id" class="form-group form-md-line-input form-md-floating-label">
                                      <select  id = "language_id" class="form-control" name="language_id">
                                          @if ($languages) @foreach($languages as $language)
                                            <option value="{{$language->id}}">{{$language->name}}</option>
                                          @endforeach @endif
                                      </select>
                                      <label for="language_id">Ngôn ngữ</label>
                                      {{-- <span class="help-block">Hiển thị hoặc không hiển thị ở website</span> --}}
                                  </div>

                                 <div id = "form-answer" class="form-group">
                                        <input type="hidden" id="exercise_id" value="{{$exercise_id}}">
                                        <textarea class="form-control" rows="3" id="answer" name="content" placeholder="Nội Dung"></textarea>
                                    
                                 </div>
                            </div>    
                            
                            <div class="form-actions text-center">
                              {{-- <div class="row"> --}}
                                  <div class="col-xs-12 col-sm-12">
                                      {{-- <a href="javascript:;" class="btn default button-previous">
                                          <i class="fa fa-angle-left"></i> Quay lại </a> --}}
                                      <a href="javascript:;" onclick="funAddAnswer();" class="btn btn-outline green button-next  btn-circle"> Thêm mới
                                          
                                      </a>
                                      {{-- <a href="javascript:;" class="btn green button-submit"> Submit
                                          <i class="fa fa-check"></i>
                                      </a> --}}
                                  </div>
                              {{-- </div> --}}
                          </div>

                          <h3 class="block">Danh sách lời giải</h3>

                          <div class="portlet-body">
                            <div class="table-scrollable">
                                <table class="table table-striped table-bordered table-hover" id="sample_1">
                                    <thead>
                                        <tr>
                                           <th class="stl-column color-column">#</th>
                                           <th class="stl-column color-column">Ngôn ngữ</th>
                                           <th class="stl-column color-column">Ngày tạo</th>
                                           <th class="stl-column color-column">Hành động</th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody id ="list-answer">
                                          
                                          @if($answers) @foreach($answers as $key => $answer)
                                            <tr>
                                                <td class="text-center"> {{ $key + 1 }} </td>

                                                <td class="text-center"> {{ $answer->getLanguage() }} </td>

                                                <td class="text-center"> {{ date('d-m-Y H:i:s ', strtotime($answer->created_at)) }} </td>
                                                
                                                <td class="text-center"> 
                                                   
                                                   
                                                    <a href="#" onclick="editAnswer({{$answer->id}})" class="btn btn-outline btn-circle green btn-sm purple">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sửa
                                                    </a>
                                                    {{-- <form action="#" method="DELETE" style="display: initial;"> --}}
                                                      <a href="#" type="submit" onclick="delAnswer({{$answer->id}})" class="btn btn-outline btn-circle dark btn-sm red">
                                                        <i class="fa fa-trash-o"></i> Xóa 
                                                      </a>
                                                    {{-- </form> --}}
                                                    
                                                </td>
                                               
                                            </tr>
                                            @endforeach @else
                                              <tr>
                                                <td colspan="4" class="text-center"> Không có bản ghi nào </td>
                                              </tr>
                                            @endif
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </form>
    </div>
    

    <div class="modal fade bs-modal-lg" id="editAnswerModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header " id="themmoi">
                {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> --}}
                <h4 class="edit-answer" class="modal-title blue uppercase">CẬP NHẬT</h4>
            </div>
            <div class="modal-body">
                        
                         <div id = "form-edit-language-id" class="form-group form-md-line-input form-md-floating-label">
                              <select  id = "edit_language_id" class="form-control" name="language_id">
                                  
                              </select>
                              <label for="language_id">Ngôn ngữ</label>
                              {{-- <span class="help-block">Hiển thị hoặc không hiển thị ở website</span> --}}
                          </div>

                         <div id = "form-edit-answer" class="form-group">
                                <input type="hidden" id="edit_answer_id" name="answer_id">
                                <textarea class="form-control" rows="3" id="edit_answer" name="content" placeholder="Nội Dung"></textarea>
                            
                         </div>
                    
                    <div class="modal-footer">
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-circle"
                                    data-dismiss="modal">
                                Hủy
                            </button>
                            <button type="button" id="update"  class="btn green btn-circle">
                                Cập Nhập
                            </button>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</div>


</div>

@endsection

@section('footer')

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
        selector: '#content',
        height: 350,
        theme: 'modern',
        plugins: [
          'advlist autolink lists link image charmap print preview hr anchor pagebreak',
          'searchreplace wordcount visualblocks visualchars code fullscreen',
          'insertdatetime media nonbreaking save table contextmenu directionality',
          'emoticons template paste textcolor colorpicker textpattern imagetools codesample', 'placeholder'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
        image_advtab: true,
        templates: [
          { title: 'Test template 1', content: 'Test 1' },
         
        ],
        content_css: [
          '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
          '//www.tinymce.com/css/codepen.min.css'
        ]
       });

      tinymce.init({
        selector: '#answer',
        height: 350,
        theme: 'modern',
        plugins: [
          'advlist autolink lists link image charmap print preview hr anchor pagebreak',
          'searchreplace wordcount visualblocks visualchars code fullscreen',
          'insertdatetime media nonbreaking save table contextmenu directionality',
          'emoticons template paste textcolor colorpicker textpattern imagetools codesample', 'placeholder'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
        image_advtab: true,
        templates: [
          { title: 'Test template 1', content: 'Test 1' },
         
        ],
        content_css: [
          '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
          '//www.tinymce.com/css/codepen.min.css'
        ]
       });

      tinymce.init({
        selector: '#edit_answer',
        height: 350,
        theme: 'modern',
        plugins: [
          'advlist autolink lists link image charmap print preview hr anchor pagebreak',
          'searchreplace wordcount visualblocks visualchars code fullscreen',
          'insertdatetime media nonbreaking save table contextmenu directionality',
          'emoticons template paste textcolor colorpicker textpattern imagetools codesample', 'placeholder'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
        image_advtab: true,
        templates: [
          { title: 'Test template 1', content: 'Test 1' },
         
        ],
        content_css: [
          '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
          '//www.tinymce.com/css/codepen.min.css'
        ],
        setup: function(ed) {
            ed.on('keyup', function(e) {
                check_submit_edit_answer();
            });
        }
       });
  </script>

  <script>

    function IsNull(obj)
    {
        var is;
        if (obj instanceof jQuery)
            is = obj.length <= 0;
        else
            is = obj === null || typeof obj === 'undefined' || obj == "";

        return is;
    }

    $('#step1').click(function(e) {
      if (!$(this).hasClass('active')) {
          e.preventDefault();
          return false;
      } else return true;
      
    });

    $('#step2').click(function(e) {
      if (!$(this).hasClass('active')) {
          e.preventDefault();
          return false;
      } else return true;
      
    });

    //add exercie
    function funAddExercise() {

      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
              type: "POST",
              url: "{{route('exercises.store')}}",
              data: {
                theory_group_id: $('#theory_group_id').val(),
                theory_id: $('#theory_id').val(),
                name: $('#name').val(),
                level_id: $('#level_id').val(),
                content: tinymce.get('content').getContent(),
              },
              success: function(res)
              {
                
                

                if(!res.error) {

                    toastr.success('Thêm bài tập thành công!');
                    setTimeout(function () {
                        window.location.href = "{{route('exercises.create')}}" + "?theory_group_id=" + res.data.theory_group_id + "&theory_id=" + res.data.theory_id + '&exercise_id=' + res.data.id + '&step=2'
                    }, 2000);                   
                } else {

                  if (!IsNull(res.message.theory_group_id)) {
                    // $('#form-group-id').addClass('has-error');
                    toastr.error(res.message.theory_group_id[0]);
                  }
                  if (!IsNull(res.message.theory_id)) {
                    // $('#form-theory-id').addClass('has-error');
                    toastr.error(res.message.theory_id[0]);
                  }
                  if (!IsNull(res.message.name)) {
                    // $('#form-name').addClass('has-error');
                    toastr.error(res.message.name[0]);
                  }
                  if (!IsNull(res.message.level_id)) {
                    // $('#form-level-id').addClass('has-error');
                    toastr.error(res.message.level_id[0]);
                  }
                  if (!IsNull(res.message.content)) {
                    // $('#form-content').addClass('has-error');
                    toastr.error(res.message.content[0]);
                  }


                }
              },
              error: function (xhr, ajaxOptions, thrownError) {

                console.log('error');

                toastr.error(thrownError);
              }
        });
        $(this).prop('disabled', true)
    }

    // add answer
    function funAddAnswer() {

      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
              type: "POST",
              url: "{{route('answers.store')}}",
              data: {
                exercises_id: $('#exercise_id').val(),
                language_id: $('#language_id').val(),
                content: tinymce.get('answer').getContent(),
              },
              success: function(res)
              {
                console.log(res);

                if(!res.error) {

                    toastr.success('Thêm lời giải thành công!');
                    setTimeout(function () {
                        location.reload();
                    }, 2000);                   
                } else {

                  if (!IsNull(res.message.language_id)) {
                    // $('#form-level-id').addClass('has-error');
                    toastr.error(res.message.language_id[0]);
                  }
                  if (!IsNull(res.message.content)) {
                    // $('#form-content').addClass('has-error');
                    toastr.error(res.message.content[0]);
                  }


                }
              },
              error: function (xhr, ajaxOptions, thrownError) {

                console.log('error');

                toastr.error(thrownError);
              }
        });
        $(this).prop('disabled', true)
    }


    //delete answer
    function delAnswer(id) {

      toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "500",
        "hideDuration": "500",
        "timeOut": "2000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      };

      var path = "{{URL::asset('')}}coursewares/answers/" + id;
   
      swal({
          title: "Bạn có chắc muốn xóa?",
          // text: "Bạn sẽ không thể khôi phục lại bản ghi này!!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          cancelButtonText: "Không",
          confirmButtonText: "Có",
          
          // closeOnConfirm: false,
      },
      function(isConfirm) {
          if (isConfirm) {  

          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          $.ajax({
                type: "DELETE",
                url: path,
                success: function(res)
                {
                  if(!res.error) {
                      toastr.success('Xóa thành công!');
                      setTimeout(function () {
                          location.reload();
                      }, 2000)  ;                 
                  }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                  toastr.error(thrownError);
                }
          });

              
          } else {
              toastr.info("Thao tác xóa đã bị huỷ bỏ!");
          }
      });
    }

    function check_submit_edit_answer() {
       if (!IsNull(tinymce.get('edit_answer').getContent())) {
                $('#update').removeAttr('disabled');
        } else {
            $('#update').prop('disabled', true);
        }
    }
    function editAnswer(id) {
      $('#editAnswerModal').modal('show');

      $.ajax({
              type: "GET",
              url: "{{URL::asset('coursewares/answers')}}/" + id,
              success: function(res)
              {

                $('#edit_language_id').focus();

                jQuery.each(res.languages, function(index, language){
                        jQuery('#edit_language_id').append('<option value="'+language.id+'"'+ (language.id == res.data.language_id? "selected":"")  +'>'+language.name+'</option>');
                        
                    });

                tinymce.get('edit_answer').setContent(res.data.content);

                $('#edit_answer_id').val(res.data.id);
              }
        });

    }


    //update
    
    $('#update'). click(function () {
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
              type: "PUT",
              url: "{{URL::asset('coursewares/answers')}}/" + $('#edit_answer_id').val(),
              data: {
                id: $('#edit_answer_id').val(),
                language_id : $('#edit_language_id').val(),
                content: tinymce.get('edit_answer').getContent()
              },
              success: function(res)
              {
                console.log(res.data);

            
                if(!res.error) {
                    toastr.success('Cập nhật thành công!');

                    $('#editAnswerModal').modal('hide');


                    setTimeout(function () {   
                        location.reload();
                    }, 2000)

                } else {
                    if (!IsNull(res.message.language_id)) {

                        toastr.error(res.message.language_id[0]);
                        // $('#edit-theory-name').addClass('has-error');
                    }
                    if (!IsNull(res.message.content)) {
                        // $('#edit-theory-content').addClass('has-error');
                        toastr.error(res.message.content[0]);
                    }
                    
                    
                }
              },
              error: function (xhr, ajaxOptions, thrownError) {
                toastr.error(thrownError);

              }
        });

        $(this).prop('disabled', true);
    });

  </script>





@endsection

