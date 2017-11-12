@extends('layouts.master')
@section('contents')

<div class="portlet light bordered">
<div class="portlet-title">
    <div class="caption font-green uppercase">
        <i class="fa fa-file-text" aria-hidden="true"></i> {{$theory_group_name}} / DANH SÁCH LÝ THUYẾT </div>
   
</div>
<div class="row">
    <div class="col-xs-12 col-sm-4 col-md-6 col-lg-5">
        <button onclick="addTheory();" class="btn green btn-circle"><i class="fa fa-plus"></i> Thêm mới</button>
    </div>
    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-7">
        <form method="get" action="">
            <input type="text" class="search-class form-control" id="search"  name="search"  placeholder="Nhập Thông Tin Tìm Kiếm">
        </form>
    </div>
</div>
<div class="portlet-body">
    <div class="table-scrollable">
        <table class="table table-striped table-bordered table-hover" id="sample_1">
            <thead>
                <tr>
                   <th class="stl-column color-column">#</th>
                   <th class="stl-column color-column">Tên</th>
                   <th class="stl-column color-column">Nội dung</th>
                   <th class="stl-column color-column">Bài tập</th>
                   <th class="stl-column color-column">Ngày tạo</th>
                   <th class="stl-column color-column">Hành động</th>
                </tr>
                
            </thead>
            <tbody>
                @if($theories) @foreach($theories as $key => $theory)
                <tr>
                    <td class="text-center"> {{ $key + 1 }} </td>
                    <td class="text-center"> {{ $theory->name }} </td>
                    <td class="text-center"> 
                        @if(strlen($theory->content) > 50)  {!! substr($theory->content,0,50) !!} ... @else  {!! $theory->content !!} @endif </td>
                    <td class="text-center"> {{ $theory->listExercises($theory->id)->count() }} </td>
                 
                    <td class="text-center"> {{ date('d-m-Y H:i:s', strtotime($theory->created_at)) }} </td>
                    
                    <td class="text-center"> 
                        <a href="#" class="show-detail btn btn-outline btn-circle btn-sm blue" data-name = "{{$theory->name}}" data-content="{{$theory->content}}">
                            <i class="fa fa-eye" aria-hidden="true"></i> Chi tiết
                        </a>
                        <a href="#" onclick = "editTheory({{$theory->id}})" class="btn btn-outline btn-circle btn-sm green-dark">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sửa
                        </a>

                        <a href="{{route('exercises.create')}}?theory_group_id={{$theory->theory_group_id}}&theory_id={{$theory->id}}&step=1" class="btn btn-outline btn-circle green btn-sm purple">
                            <i class="fa fa-list" aria-hidden="true"></i> Bài tập 
                        </a>
                        {{-- <form action="#" method="DELETE" style="display: initial;"> --}}
                          <a href="#" type="submit" onclick="alertDel({{$theory->id}})" class="btn btn-outline btn-circle dark btn-sm red">
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

<div class="modal fade bs-modal-lg" id="createTheoryModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header " id="themmoi">
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> --}}
                    <h4 class="modal-title green">THÊM MỚI</h4>
                </div>
                <div class="modal-body">

                            <div id ="add-theory-name" class="form-group form-md-line-input form-md-floating-label">
                                <input type="text" class="form-control" id="name" name="name">
                                <label for="class_fb_group">Tên lý thuyết</label>
                                
                            </div>
                            
                            <div id ="add-theory-content" class="form-group form-md-line-input">
                                {{-- <label class="col-sm-3 control-label" for="addClassInfo">Thông Tin Lớp</label> --}}
                                <textarea placeholder="Nội dung" class="form-control" rows="8" id="content-theory" name="content"></textarea>
                             </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-circle"
                                    data-dismiss="modal">
                                Hủy
                            </button>
                            <button type="button" id="add"  class="btn green btn-circle">
                                Thêm Mới
                            </button>
                        </div>

                </div>
            </div>
        </div>
</div>

<div class="modal fade bs-modal-lg" id="showTheoryModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header " id="themmoi">
                {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> --}}
                <h4 class="detail-theory" class="modal-title blue uppercase">CHI TIẾT</h4>
            </div>
            <div class="modal-body">
                        
                        {{-- <h3 class="theory-name"></h3> --}}
                        <div class="theory-content">
                            
                        </div>
                    
                    <div class="modal-footer">
                        
                        <button  data-dismiss="modal" type="button"  class="btn blue btn-circle">
                            Đóng
                        </button>
                    </div>

            </div>
        </div>
    </div>
</div>


<div class="modal fade bs-modal-lg" id="editTheoryModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header " id="themmoi">
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> --}}
                    <h4 class="modal-title green">CẬP NHẬT</h4>
                </div>
                <div class="modal-body">

                            <div id ="edit-theory-name" class="form-group form-md-line-input form-md-floating-label">
                                <input type="text" class="form-control" id="edit-name" name="name">
                                <label for="class_fb_group">Tên lý thuyết</label>
                                
                            </div>
                            
                            <div id ="edit-theory-content" class="form-group form-md-line-input">
                                
                                <textarea placeholder="Nội dung" class="form-control" rows="8" id="edit-content" name="content"></textarea>
                             </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-circle"
                                    data-dismiss="modal">
                                Hủy
                            </button>
                            <button type="button" id="update"  class="btn green btn-circle">
                                <input type="hidden" class="form-control" id="edit-id" name="id">
                                Cập nhật
                            </button>
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
        selector: '#content-theory',
        height: 300,
        // forced_root_block : '',
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
                check_submit();
            });
        }

       });

      tinymce.init({
        selector: '#edit-content',
        height: 300,
        // forced_root_block : '',
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
                check_submit_edit();
            });
        }
       });
  </script>

<script>


    // show detail theory
    $('.show-detail').click (function() {
        $('#showTheoryModal').modal('show');
        var name  = $(this).data('name');
        var content  = $(this).data('content');
        $('h4.detail-theory').html(name);
        $('.theory-content').html(content);

    });

    // delete theory
    function alertDel ( id ) {

      //-----------Notification when delete---------------
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
      
      var path = "{{URL::asset('')}}coursewares/theories/" + id;

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
                        }, 2000)                   
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


    //check submit
    function check_submit() {

        if ($('#name').val() != '' && tinymce.get('content-theory').getContent() != '') {
                $('#add').removeAttr('disabled');
        } else {
            $('#add').prop('disabled', true);
        }
    }

    // add theory
    function addTheory() {

        $('#createTheoryModal').modal('show');
         $('#name').val('');
         tinymce.get('content-theory').setContent('');
        $('#add').prop('disabled', true);


        $('#name').keyup(function () {

            if ($('#name').val() != '' && tinymce.get('content-theory').getContent() != '') {
                    $('#add').removeAttr('disabled');
            } else {
                $('#add').prop('disabled', true);
            }
        });

    }

    //check submit
    function check_submit_edit() {

        if ($('#edit-name').val() != '' && tinymce.get('edit-content').getContent() != '') {
                $('#update').removeAttr('disabled');
        } else {
            $('#update').prop('disabled', true);
        }
    }

    // edit theory
    function editTheory(id) {
        
        $('#editTheoryModal').modal('show');

        $('#edit-name').keyup(function () {

            if ($('#edit-name').val() != '' && tinymce.get('edit-content').getContent() != '') {
                    $('#update').removeAttr('disabled');
            } else {
                $('#update').prop('disabled', true);
            }
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
              type: "GET",
              url: "{{URL::asset('coursewares/theories')}}/" + id,
              success: function(res)
              {
                $('#edit-name').focus();
                $('#edit-name').val(res.data.name);
                
                tinymce.get('edit-content').setContent(res.data.content);

                $('#edit-id').val(res.data.id);
              }
        });

    }

    // add theory
    $('#add'). click(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
              type: "POST",
              url: "{{route('theories.store')}}",
              data: {
                theory_group_id: {{$id}},
                name : $('#name').val(),
                content: tinymce.get('content-theory').getContent()
              },
              success: function(res)
              {

                if(!res.error) {
                    toastr.success('Thêm mới thành công!');

                    $('#createTheoryModal').modal('hide');

                    setTimeout(function () {   
                        window.location.href = "{{URL::asset('coursewares/theory')}}/{{$id}}";
                    }, 2500)

                } else {
                    if ($('#name').val() == '') {
                        // $('#add-theory-name').addClass('has-error');
                        toastr.error(res.message.name[0]);
                    }
                    if ( tinymce.get('content-theory').getContent() == '') {
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


    // edit theory
    $('#update'). click(function () {


        $('#edit-name').keyup(function () {

            $('#edit-theory-name').removeClass('has-error');

            if ($('#edit-content').val() != '') {
                $('#update').removeAttr('disabled');
            }
        });

        $(document).on('input propertychange', "textarea[name='content']", function () {
            $('#edit-theory-content').removeClass('has-error');

            if ($('#edit-name').val() != '') {
                $('#update').removeAttr('disabled');
            }

        });


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
              type: "PUT",
              url: "{{URL::asset('coursewares/theories')}}/" + $('#edit-id').val(),
              data: {
                id: $('#edit-id').val(),
                name : $('#edit-name').val(),
                content: tinymce.get('edit-content').getContent()
              },
              success: function(res)
              {
                console.log(res.data);

            
                if(!res.error) {
                    toastr.success('Cập nhật thành công!');

                    $('#editTheoryModal').modal('hide');


                    setTimeout(function () {   
                        window.location.href = "{{URL::asset('coursewares/theory')}}/{{$id}}";
                    }, 2500)

                } else {
                    if ($('#edit-name').val() == '') {
                        toastr.error(res.message.name[0]);
                        // $('#edit-theory-name').addClass('has-error');
                    }
                    if ( tinymce.get('edit-content').getContent() == '') {
                        // $('#edit-theory-content').addClass('has-error');
                        toastr.error(res.message.content[0]);
                    }
                    
                    
                }
              },
              error: function (xhr, ajaxOptions, thrownError) {
                toastr.error(thrownError);

              }
        });

        $(this).prop('disabled', true)
    });

 </script>

@endsection
