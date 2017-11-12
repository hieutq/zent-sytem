@extends('layouts.master')
@section('contents')

<div class="portlet light bordered">
<div class="portlet-title">
    <div class="caption uppercase">
        <i class="fa fa-file-text" aria-hidden="true"></i> {{$name}} / BÀI TẬP </div>
   
</div>

<div class="portlet-body">
    <div class="tabbable-line">
        <ul class="nav nav-tabs ">
            <li class="active">
                <a href="#tab_1" data-toggle="tab"> Bài tập </a>
            </li>
            <li>
                <a href="#tab_2" data-toggle="tab"> Nộp Bài </a>
            </li>
            <li @if (!$open_answer) style="display: none" @endif>
                <a href="#tab_3" data-toggle="tab"> Lời giải </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                @if (count($exercises)) 

                @foreach ($exercises as $key => $exercise)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#" href="#collapse-{{$exercise->id}}">  {{$exercise->name}} </a>
                        </h4>
                    </div>
                    <div id="collapse-{{$exercise->id}}" class="panel-collapse in">
                        <div class="panel-body">
                            {!! $exercise->content !!}
                        </div>
                    </div>
                </div>
                @endforeach 
                @else 
                    <h4 class="text-center" style="font-style: italic; font-size:16px;"> Không có bản ghi nào.</h4>
                @endif
            </div>
            <div class="tab-pane" id="tab_2">
                
                <div class="form-group form-md-line-input" style="margin-bottom: 20px;">
                    <label class="col-sm-3 control-label" for="addClassInfo" style="padding: 0px;">Nội dung</label>
                </div>
                <div class="form-group form-md-line-input">
                    
                    <textarea placeholder="Nội dung" class="form-control" rows="8" id="content" name="content"></textarea>
                </div>
                
                <div class="form-group form-md-line-input" style="margin-bottom: 20px;">
                    <label class="col-sm-3 control-label" for="addClassInfo" style="padding: 0px;">Nhận xét</label>
                </div>
                <div class="form-group form-md-line-input">
                     {{-- <label class="col-sm-3 control-label" for="addClassInfo">Nhận xét</label> --}}
                    <textarea placeholder="Nhận xét" class="form-control" rows="8" id="comment" name="comment"></textarea>
                </div>
                
                <div class="modal-footer" style="text-align: center;">
                    <input type="hidden" id="student_id" name="student_id" value="{{Auth::guard('student')->user()->id}}">
                    <input type="hidden" id="class_room_unit_id" name="class_room_unit_id" value="{{$class_room_unit_id}}">
                    <button type="button" id="submit"  class="btn green btn-circle" @if ($is_submited) style="display: none" @endif disabled>
                        Nộp bài
                    </button>
                </div>
                
            </div>

            <div @if(!$open_answer) style="display: none" @endif class="tab-pane" id="tab_3">
                @if (count($unit_exercises))
                @foreach ($unit_exercises as $key => $exercise)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#" href="#collapse-{{$exercise->id}}">  @if (count($exercise->exercise)){{$exercise->exercise->name}} @else No Name @endif </a>
                        </h4>
                    </div>
                    <div id="collapse-{{$exercise->id}}" class="panel-collapse in">
                        <div class="panel-body">
                          @if (count($exercise->answer))
                            {!! $exercise->answer->content !!}
                          @else
                            Không có dữ liệu
                          @endif
                        </div>
                    </div>
                </div>
                @endforeach 
                @else 
                    <h4 class="text-center" style="font-style: italic; font-size:16px;"> Không có bản ghi nào.</h4>
                @endif

            </div>

        </div>
    </div>

</div>
</div>

@endsection

@section('footer')

{{-- <script src="{{url('js/curd-Theory.js')}}" type="text/javascript"></script> --}}
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
          setup: function(ed) {
                ed.on('keyup', function(e) {
                    check_submit();
                });
            }
        });

      tinymce.init({
          selector: '#comment',
          height: 150,
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
          setup: function(ed) {
                ed.on('keyup', function(e) {
                    // check_submit();
                });
            }
        });

  </script>

  <script>
    
    //check submit
    function check_submit() {
        if (tinymce.get('content').getContent() != '') {
                $('#submit').removeAttr('disabled');
        } else {
            $('#submit').prop('disabled', true);
        }
    }

    // add theory
    $('#submit'). click(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
              type: "POST",
              url: "{{route('students.submit-store')}}",
              data: {
                student_id: $('#student_id').val(),
                class_room_unit_id : $('#class_room_unit_id').val(),
                content: tinymce.get('content').getContent(),
                comment: tinymce.get('comment').getContent()
              },
              success: function(res)
              {

                if(!res.error) {
                    toastr.success('Nộp bài thành công!');

                    setTimeout(function () {   
                        window.location.reload();
                    }, 2500)

                } else {
                    if ( tinymce.get('content').getContent() == '') {
                        // $('#add-theory-content').addClass('has-error');
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
