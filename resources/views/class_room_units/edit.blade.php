@extends('layouts.master')
@section('head')
    <!-- include summernote css/js-->
    <link rel="stylesheet" href="{{URL::asset('')}}css/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="{{URL::asset('')}}css/bootstrap-switch.min.css">
@endsection

@section('contents')

<div class="portlet light bordered" id="form_wizard_1">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-plus-circle" aria-hidden="true"></i> THÊM MỚI UNIT </div>
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
                                    <i class="fa fa-check"></i> Thông tin</span>
                            </a>
                        </li>
                        <li id="step2" @if ($step == 2) class="active" @endif>
                            <a href="#tab2" data-toggle="tab" class="step"  aria-expanded= true>
                                <span class="number"> 2 </span>
                                <span class="desc">
                                    <i class="fa fa-check"></i> Lý thuyết </span>
                            </a>
                        </li>
                        <li id="step3" @if ($step == 3) class="active" @endif>
                            <a href="#tab3" data-toggle="tab" class="step active">
                                <span class="number"> 3 </span>
                                <span class="desc">
                                    <i class="fa fa-check"></i> Bài tập </span>
                            </a>
                        </li>
                        
                    </ul>
                    <div id="bar" class="progress progress-striped" role="progressbar">
                        <div class="progress-bar progress-bar-success" @if ($step == 1) style="width: 33%" @elseif($step == 2) style="width: 66%" @elseif($step == 3) style="width: 100%" @endif> </div>
                    </div>
                    <div class="tab-content">
                        
                        <div class="tab-pane @if ($step == 1) active @endif" id="tab1">

                                <div class="form-body col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-10 col-lg-offset-1">
                                    
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                       <input type="text" class="form-control" id="unit_name" name="unit_name" value="{{$class_room_unit->unit_name}}">
                                       <label for="unit_name">Tên Bài Học (<span style="color:red;">*</span>)</label>
                                       
                                   </div>
                                   <div  class="form-group form-md-line-input form-md-floating-label">
                                       <input type="number" class="form-control" id="unit" name="unit" value="{{$class_room_unit->unit}}">
                                       <label for="unit">Số Bài Học (<span style="color:red;">*</span>)</label>
                                       
                                   </div>
                                   <div class="form-group form-md-line-input form-md-floating-label">
                                            <select class="form-control" id="status" name="status">
                                                <option value="1" @if($class_room_unit->status == 1) selected @endif>Hiển Thị</option>
                                                <option value="0" @if($class_room_unit->status == 0) selected @endif >Ẩn</option>
                                            </select>
                                            <label for="status">Trạng Thái (<span style="color:red;">*</span>)</label>
                                   </div>  
                                    <div  class="form-group form-md-line-input form-md-floating-label">
                                       <input type="text" class="form-control" id="deadline" name="deadline" value="{{$class_room_unit->deadline}}">
                                       <label for="deadline">Ngày deadline (<span style="color:red;">*</span>)</label>
                                       
                                   </div>
                                   <div class="form-group form-md-line-input form-md-floating-label">
                                      <textarea type="textarea" rows="4" class="form-control" id="note" name="note">{{$class_room_unit->note}}</textarea>
                                       <label for="note">Ghi Chú</label>
                                       <input type="hidden" class="form-control" id="class_room_id" name="class_room_id" value="{{$class_room_unit->class_room_id}}">
                                   </div>       
                                </div>    
                            
                                <div class="form-actions text-center">
                                      <div class="col-xs-12 col-sm-12">

                                          <a href="javascript:;" onclick="funEditUnit({{$class_room_unit->id}});" class="btn btn-outline green button-next  btn-circle"> Tiếp theo</a>
                                      </div>
                                </div>
                        </div>
                        <div class="tab-pane @if ($step == 2) active @endif" id="tab2">
                             
                            <div class="portlet-body">
                                <div class="row">
                                        <div class="col-xs-12 col-md-5">
                                            <div class="form-group form-md-line-input">
                                                {{-- <label for="theory_group">Nhóm lý thuyết</label> --}}
                                                <select id="theory_group" class="selectpicker show-menu-arrow" name="theory_group[]" 
                                                multiple data-live-search="true" tabindex="-98" title="Vui lòng chọn lý thuyết" data-selected-text-format="count > 3" data-actions-box="true">
                                                {{-- <option value="0" selected data-tokens="all">Tất cả</option> --}}
                                                  @if(!empty($theory_groups))
                                                    
                                                      @foreach($theory_groups as $theory_group)
                                                        <optgroup label="{{$theory_group->name}}">
                                                            @if(!empty($theory_group->theories)) @foreach($theory_group->theories as $theory)
                                                                <option @if (in_array($theory->id, $theores_id)) selected @endif value="{{$theory->id}}" data-tokens="{{$theory->name}}">{{$theory->name }}</option>
                                                            @endforeach @endif
                                                        </optgroup>
                                                      @endforeach

                                                    @else
                                                        <option value=""><em>(Nhóm lý thuyết rỗng)</em></option>
                                                    @endif
                                               </select>

                                              
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-7">
                                          <div class="form-group form-md-line-input">
                                              <button onclick = "nextStep({{$class_room_id}}, {{$class_room_unit_id}})" class="btn btn-outline btn-circle btn-sm blue">Tiếp theo</button>
                                          </div>
                                          
                                        </div>
                                </div>
                                <div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th class="stl-column color-column text-center">#</th>
                                                <th class="stl-column color-column text-center">Tên</th>
                                                <th class="stl-column color-column text-center">Nội dung</th>
                                                <th class="stl-column color-column text-center">Ngày tạo</th>
                                               <th  class="stl-column color-column text-center">Hành động</th>

                                            </tr>
                                            
                                        </thead>
                                            <tbody id="tbody-theory">
                                                   @if(count($theories) > 0)
                                                      @foreach($theories as $key => $theory)
                                                          <tr>
                                                              <td class="text-center">{{$key+1}}</td>
                                                              <td class="text-center">{{$theory->name}}</td>
                                                                <td class="text-center"> 
                                                                  <a href="#" class="show-content-exercise btn btn-outline btn-circle btn-sm blue" data-name = "" data-toggle="modal" data-target="#myModal-{{$theory->id}}-{{$class_room_unit_id}}">
                                                                        <i class="fa fa-eye" aria-hidden="true"></i> Chi tiết
                                                                    </a>

                                                                    <!-- Modal -->
                                                                    <div class="modal fade" id="myModal-{{$theory->id}}-{{$class_room_unit_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                      <div class="modal-dialog modal-lg" role="document">
                                                                        <div class="modal-content">
                                                                          <div class="modal-header ">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                            <h4 class="modal-title green" id="myModalLabel">{{$theory->name}}</h4>
                                                                          </div>
                                                                          <div class="modal-body">
                                                                            {!! $theory->content !!}
                                                                          </div>
                                                                          <div class="modal-footer">
                                                                            <button type="button" class="btn btn-outline btn-circle btn-sm blue" data-dismiss="modal">Đóng</button>
                                                                          </div>
                                                                        </div>
                                                                      </div>
                                                                    </div>

                                                                 </td>
                                                                
                                                                <td class="text-center">{{date('d-m-Y H:i:s ', strtotime($theory->created_at))}}</td>
                                                                <td class="text-center"> 
                                                                  <input type="hidden" id="checked-{{$theory->id}}-{{$class_room_unit_id}}" value="{{$theory->checked}}">

                                                                  @if($theory->checked)
                                                                      
                                                                     <i id="action-{{$theory->id}}-{{$class_room_unit_id}}" class="fa fa-check-circle" onclick="addTheory({{$theory->id}}, {{$class_room_unit_id}})" data-id="{{$theory->id}}" data-class_rom_unit_id="{{$class_room_unit_id}}" aria-hidden="true" style="cursor: pointer; color: #3598dc;font-size: 20px;"></i>
                                                                  @else 

                                                                    <i id="action-{{$theory->id}}-{{$class_room_unit_id}}" class="fa fa-circle-o"  onclick="addTheory({{$theory->id}}, {{$class_room_unit_id}})" aria-hidden="true" style="cursor: pointer; color: #3598dc;font-size: 20px;"></i>

                                                                  @endif
                                                                  

                                                                  {{-- <input type="checkbox" class="make-switch" @if($theory->checked) checked @endif data-on-color="success" data-off-color="warning" data-id="{{$theory->id}}" data-class> --}}
                                                                    
                                                                </td>
                                                               
                                                            </tr> 
                                                        @endforeach
                                                       
                                                    @endif
                                                    <script>
                                                      function addTheory(theory_id, class_room_unit_id) {

                                                        var checked = $('#checked-' + theory_id + '-' + class_room_unit_id).val();

                                                         $.ajaxSetup({
                                                                headers: {
                                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                                }
                                                            });

                                                            $.ajax({
                                                                  type: "PUT",
                                                                  url: "{{URL::asset('classroom-unit/update-theory')}}",
                                                                  data: {
                                                                    class_room_unit_id: class_room_unit_id,
                                                                    theory_id: theory_id,
                                                                    checked: checked,
                                                                  },
                                                                  success: function(res)
                                                                  {
                                                                    
                                                                    if (res.message == 'deleted') {
                                                                      $('#action-' + theory_id + '-' + class_room_unit_id).removeClass('fa-check-circle').addClass('fa-circle-o');
                                                                      $('#checked-' + theory_id + '-' + class_room_unit_id).val(0);
                                                                      toastr.success('Xóa thành công');
                                                                    } 

                                                                    if (res.message == 'added') {
                                                                      $('#action-' + theory_id + '-' + class_room_unit_id).removeClass('fa-circle-o').addClass('fa-check-circle');
                                                                      $('#checked-' + theory_id + '-' + class_room_unit_id).val(1);
                                                                      toastr.success('Thêm thành công');
                                                                    }
                                                                    

                                                                  },
                                                                  error: function (xhr, ajaxOptions, thrownError) {

                                                                    console.log('error');

                                                                    toastr.error(thrownError);
                                                                  }
                                                            });

                                                        }

                                                    </script>
                                            </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane @if ($step == 3) active @endif" id="tab3">

                            <div class="portlet-body">
                              
                                <div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th class="stl-column color-column text-center">#</th>
                                                <th class="stl-column color-column text-center">Tên</th>
                                                <th class="stl-column color-column text-center">Nội dung</th>
                                                <th class="stl-column color-column text-center">Lời giải</th>
                                                <th class="stl-column color-column text-center">Ngày tạo</th>
                                               <th  class="stl-column color-column text-center">Hành động</th>

                                            </tr>
                                            
                                        </thead>
                                            <tbody id="tbody-exercise">
                                                @if(!empty($exercises)) @foreach($exercises as $key => $exercie)
                                                    <tr>
                                                      <td class="text-center">{{$key+1}}</td>
                                                      <td class="text-center">{{$exercie->name}}</td>
                                                        <td class="text-center"> 
                                                          <a href="#" class="show-content-exercise btn btn-outline btn-circle btn-sm blue" data-name = "" data-toggle="modal" data-target="#myModal-{{$exercie->id}}">
                                                                <i class="fa fa-eye" aria-hidden="true"></i> Chi tiết
                                                            </a>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="myModal-{{$exercie->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                              <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                  <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title green" id="myModalLabel">{{$exercie->name}}</h4>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                    {!! $exercie->content !!}
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline btn-circle btn-sm blue" data-dismiss="modal">Đóng</button>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                            </div>

                                                         </td>
                                                        
                                                        <td class="text-center">
                                                          <select class="form-control" name="answer-{{$exercie->id}}-{{$class_room_unit_id}}" id="answer-{{$exercie->id}}-{{$class_room_unit_id}}">
                                                            @if (!empty($exercie->languages)) @foreach($exercie->languages as $an)
                                                                <option value="{{$an->id}}">{{$an->name}}</option>
                                                            @endforeach @endif
                                                          </select>
                                                        </td>
                                                        <td class="text-center">{{date('d-m-Y H:i:s ', strtotime($exercie->created_at))}}</td>

                                                        <td class="text-center"> 
                                                                <input type="hidden" id="checked-{{$exercie->id}}-{{$class_room_unit_id}}" value="{{$exercie->checked}}">

                                                                @if($exercie->checked)
                                                                  
                                                                 <i id="action-{{$exercie->id}}-{{$class_room_unit_id}}" class="fa fa-check-circle" onclick="addExercise({{$exercie->id}}, {{$class_room_unit_id}})" aria-hidden="true" style="cursor: pointer; color: #3598dc;font-size: 20px;"></i>
                                                              @else 

                                                                <i id="action-{{$exercie->id}}-{{$class_room_unit_id}}" class="fa fa-circle-o"  onclick="addExercise({{$exercie->id}}, {{$class_room_unit_id}})" aria-hidden="true" style="cursor: pointer; color: #3598dc;font-size: 20px;"></i>

                                                              @endif
                                                        </td>
                                                       
                                                    </tr> 
                                                 @endforeach @endif
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </form>
    </div>
    
</div>

@endsection

@section('footer')
    
    <script src="{{URL::asset('')}}js/jquery.datetimepicker.full.min.js"></script>
    <script src="{{URL::asset('')}}js/bootstrap-switch.min.js"></script>

  <script>

    //setup deadline
    $.datetimepicker.setLocale('vi');
    $('#deadline').datetimepicker();


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

    $('#step3').click(function(e) {
      if (!$(this).hasClass('active')) {
          e.preventDefault();
          return false;
      } else return true;
      
    });


    //init
    // $('.selectpicker').selectpicker('selectAll');

    // $(".make-switch").bootstrapSwitch();



    $('#theory_group').change(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
              type: "POST",
              url: "{{URL::asset('')}}classroom-unit/get-list-theories",
              data: {
                theory_group_id: $('#theory_group').val(),
                class_room_unit_id: "{{$class_room_unit_id}}"
              },
              success: function(res)
              { 
                console.log(res);

                    $('#tbody-theory').html(res);
              },
              error: function (xhr, ajaxOptions, thrownError) {

                console.log('error');

                toastr.error(thrownError);
              }
        });

    });

    //add exercie
    function funEditUnit(id) {

      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
              type: "PUT",
              url: "{{URL::asset('')}}classroom-unit/" + id,
              data: {
                unit_name: $('#unit_name').val(),
                unit: $('#unit').val(),
                status: $('#status').val(),
                note: $('#note').val(),
                class_room_id: $('#class_room_id').val(),
                deadline: $('#deadline').val(),
              },
              success: function(res)
              {
                
                if(!res.error) {

                    toastr.success('Cập nhật thành công!');
                    setTimeout(function () {
                        window.location.href = "{{URL::asset('')}}classroom-unit/" + res.data.id  + "/edit?class_room_id=" + res.data.class_room_id + '&class_room_unit_id=' + res.data.id + '&step=2' 
                    }, 1500);                   
                } else {

                  if (!IsNull(res.message.unit_name)) {
                    // $('#form-group-id').addClass('has-error');
                    toastr.error(res.message.unit_name[0]);
                  }
                  if (!IsNull(res.message.unit)) {
                    // $('#form-theory-id').addClass('has-error');
                    toastr.error(res.message.unit[0]);
                  }
                  if (!IsNull(res.message.status)) {
                    // $('#form-name').addClass('has-error');
                    toastr.error(res.message.status[0]);
                  }
                  if (!IsNull(res.message.class_room_id)) {
                    // $('#form-name').addClass('has-error');
                    toastr.error(res.message.class_room_id[0]);
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

    //next step 
    function nextStep(class_room_id, class_room_unit_id) {
      setTimeout(function () {
          window.location.href = "{{URL::asset('')}}classroom-unit/" + class_room_id  + "/edit?class_room_id=" + class_room_id + '&class_room_unit_id=' + class_room_unit_id + '&step=3' ;
      }, 0);  
    }

    function addExercise (exercise_id, class_room_unit_id) {

        var checked = $('#checked-' + exercise_id + '-' + class_room_unit_id).val();

        var answer_id = $('#answer-' + exercise_id + '-' + class_room_unit_id).val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
              type: "PUT",
              url: "{{URL::asset('classroom-unit/update-exercise')}}",
              data: {
                class_room_unit_id: class_room_unit_id,
                exercise_id: exercise_id,
                answer_id: answer_id,
                checked: checked,
              },
              success: function(res)
              {
                
                if (res.message == 'deleted') {
                  $('#action-' + exercise_id + '-' + class_room_unit_id).removeClass('fa-check-circle').addClass('fa-circle-o');
                  $('#checked-' + exercise_id + '-' + class_room_unit_id).val(0);
                  toastr.success('Xóa thành công');
                } 

                if (res.message == 'added') {
                  $('#action-' + exercise_id + '-' + class_room_unit_id).removeClass('fa-circle-o').addClass('fa-check-circle');
                  $('#checked-' + exercise_id + '-' + class_room_unit_id).val(1);
                  toastr.success('Thêm thành công');
                }
                

              },
              error: function (xhr, ajaxOptions, thrownError) {

                console.log('error');

                toastr.error(thrownError);
              }
        });

    }

    // add answer
    // function funAddAnswer() {

    //   $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });

    //     $.ajax({
    //           type: "POST",
    //           url: "{{route('answers.store')}}",
    //           data: {
    //             exercises_id: $('#exercise_id').val(),
    //             language_id: $('#language_id').val(),
    //             content: tinymce.get('answer').getContent(),
    //           },
    //           success: function(res)
    //           {
    //             console.log(res);

    //             if(!res.error) {

    //                 toastr.success('Thêm lời giải thành công!');
    //                 setTimeout(function () {
    //                     location.reload();
    //                 }, 2000);                   
    //             } else {

    //               if (!IsNull(res.message.language_id)) {
    //                 // $('#form-level-id').addClass('has-error');
    //                 toastr.error(res.message.language_id[0]);
    //               }
    //               if (!IsNull(res.message.content)) {
    //                 // $('#form-content').addClass('has-error');
    //                 toastr.error(res.message.content[0]);
    //               }


    //             }
    //           },
    //           error: function (xhr, ajaxOptions, thrownError) {

    //             console.log('error');

    //             toastr.error(thrownError);
    //           }
    //     });
    //     $(this).prop('disabled', true)
    // }


    // //delete answer
    // function delAnswer(id) {

    //   toastr.options = {
    //     "closeButton": false,
    //     "debug": false,
    //     "newestOnTop": true,
    //     "progressBar": true,
    //     "positionClass": "toast-top-right",
    //     "preventDuplicates": false,
    //     "onclick": null,
    //     "showDuration": "500",
    //     "hideDuration": "500",
    //     "timeOut": "2000",
    //     "extendedTimeOut": "1000",
    //     "showEasing": "swing",
    //     "hideEasing": "linear",
    //     "showMethod": "fadeIn",
    //     "hideMethod": "fadeOut"
    //   };

    //   var path = "{{URL::asset('')}}coursewares/answers/" + id;
   
    //   swal({
    //       title: "Bạn có chắc muốn xóa?",
    //       // text: "Bạn sẽ không thể khôi phục lại bản ghi này!!",
    //       type: "warning",
    //       showCancelButton: true,
    //       confirmButtonColor: "#DD6B55",
    //       cancelButtonText: "Không",
    //       confirmButtonText: "Có",
          
    //       // closeOnConfirm: false,
    //   },
    //   function(isConfirm) {
    //       if (isConfirm) {  

    //       $.ajaxSetup({
    //           headers: {
    //               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //           }
    //       });

    //       $.ajax({
    //             type: "DELETE",
    //             url: path,
    //             success: function(res)
    //             {
    //               if(!res.error) {
    //                   toastr.success('Xóa thành công!');
    //                   setTimeout(function () {
    //                       location.reload();
    //                   }, 2000)  ;                 
    //               }
    //             },
    //             error: function (xhr, ajaxOptions, thrownError) {
    //               toastr.error(thrownError);
    //             }
    //       });

              
    //       } else {
    //           toastr.info("Thao tác xóa đã bị huỷ bỏ!");
    //       }
    //   });
    // }

    // function check_submit_edit_answer() {
    //    if (!IsNull(tinymce.get('edit_answer').getContent())) {
    //             $('#update').removeAttr('disabled');
    //     } else {
    //         $('#update').prop('disabled', true);
    //     }
    // }
    // function editAnswer(id) {
    //   $('#editAnswerModal').modal('show');

    //   $.ajax({
    //           type: "GET",
    //           url: "{{URL::asset('coursewares/answers')}}/" + id,
    //           success: function(res)
    //           {

    //             $('#edit_language_id').focus();

    //             jQuery.each(res.languages, function(index, language){
    //                     jQuery('#edit_language_id').append('<option value="'+language.id+'"'+ (language.id == res.data.language_id? "selected":"")  +'>'+language.name+'</option>');
                        
    //                 });

    //             tinymce.get('edit_answer').setContent(res.data.content);

    //             $('#edit_answer_id').val(res.data.id);
    //           }
    //     });

    // }


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

