@extends('layouts.master')
@section('contents')  
<style type="text/css" media="screen">
   .error{
   color: red;
   }
</style>
<h1 class="text-center"> DANH SÁCH LỚP HỌC</h1>
<div class="row portlet light bordered">
  <div class="col-md-12">
      <div class="row group-act">
        <ul class="list-inline">
           <li class="col-md-6 pull-right">
                 <div class="input-icon right">
                    <i class="icon-magnifier"></i>
                    <input type="text" class="form-control" id="search_class" placeholder="Tìm Kiếm"> 
                 </div>         
           </li>
            <li class="col-md-2 pull-left">
            <a href="{{route('classroom.create')}}">
                <button id="addBtnClassRoom" class="btn green btn-circle" >Thêm<i class="fa fa-plus"></i></button>
           </a>
            </li>
        </ul>

        
      </div>
   </div>

   <div class="row" id="class_content">
      <div class="col-md-12" >
         @if($flag_class==true)
         @foreach($list_classroom as $db_class)
         <div class="col-md-4" style="margin-top: 10px;">
            <div class="portlet-body">
               <div class="mt-element-list">
                  <div class="mt-list-head list-default {{$db_class->color}}" >
                     <div class="row">
                        <div class="col-xs-12 col-md-12" >
                           <div class="col-xs-8 col-md-8">
                              <div class="list-head-title-container">
                                 <h4 style="text-transform: ;">{{$db_class->class_name}}</h4>
                                 <div >Khai Giảng - {{date('d-m-Y', strtotime($db_class->orientation_time))}}</div>
                              </div>
                           </div>
                           <div class="col-xs-4 edit" >
                              <div class="list-head-summary-container" style="margin-top: 25%;">
                                 <div class="list-pending ">
                                    <div><a href="{{Route('units.detail',['id_classroom' => $db_class->id])}}"><button class="btn btn-xs green"><i class="fa fa-info-circle" aria-hidden="true"></i> Vào Lớp</button></a></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="mt-list-container list-default" >
                     <ul >
                        <li class="mt-list-item">
                           <ul class="list-inline">
                              <li>
                                 <div class="list-icon-container">
                                    <a href="javascript:;">
                                    <i class="fa fa-graduation-cap"></i>
                                    </a>
                                 </div>
                              </li>
                              <li>
                                 <h6 class="stl-box-class bold text-center">
                                    Thuộc Khóa - {{$db_class->course_name}}
                                 </h6>
                              </li>
                           </ul>
                        </li>
   @if(count($db_class->teacher_name)>0)
                        <li class="mt-list-item">
                           <ul class="list-inline">
                              <li>
                                 <div class="list-icon-container">
                                    <a href="javascript:;">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    </a>
                                 </div>
                              </li>
                              <li>
                                 <h6 class="stl-box-class bold text-center">
                        <?php $length = count($db_class->teacher_name)?>
                                   Giảng Viên -  @foreach($db_class->teacher_name as $key =>$name)
                                    
                          <a href="javascript:;">{{$name}}</a>@if($length > 1 && $key < ($length-1)),@elseif($length > 1 && $key == ($length-1)).@endif
                                           @endforeach                        
                                 </h6>
                              </li>
                           </ul>
                        </li>
      @else
                      <li class="mt-list-item">
                         <ul class="list-inline">
                            <li>
                               <div class="list-icon-container">
                                  <a href="javascript:;">
                                  <i class="fa fa-user" aria-hidden="true"></i>
                                  </a>
                               </div>
                            </li>
                            <li>
                               <h6 class="stl-box-class bold text-center">
                        Giảng Viên - <em>(Chưa Cập Nhật)</em>
                               </h6>
                            </li>
                         </ul>
                      </li>
      @endif

      @if(count($db_class->tutors_name)>0)
                        <li class="mt-list-item">
                           <ul class="list-inline">
                              <li>
                                 <div class="list-icon-container">
                                    <a href="javascript:;">
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                    </a>
                                 </div>
                              </li>
                              <li>
                                 <h6 class="stl-box-class bold text-center"><?php $length = count($db_class->tutors_name)?>
                                    Trợ Giảng -  @foreach($db_class->tutors_name as $key =>$name)
                                    
                          <a href="javascript:;">{{$name}}</a>@if($length > 1 && $key < ($length-1)),@elseif($length > 1 && $key == ($length-1)).@endif
                                           @endforeach
                                 </h6>
                              </li>
                           </ul>
                        </li>
   @else
                        <li class="mt-list-item">
                           <ul class="list-inline">
                              <li>
                                 <div class="list-icon-container">
                                    <a href="javascript:;">
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                    </a>
                                 </div>
                              </li>
                              <li>
                                 <h6 class="stl-box-class bold text-center">
                                 Trợ Giảng - <em>(Chưa Cập Nhật)</em>   
                                 </h6>
                              </li>
                           </ul>
                        </li>   
   @endif
                        <li class="mt-list-item">
                           <ul class="list-inline">
                              <li>
                                 <div class="list-icon-container">
                                    <a href="javascript:;">
                                    <i class="fa fa-tasks"></i>
                                    </a>
                                 </div>
                              </li>
                              <li>
                                 <h6 class="stl-box-class bold text-center">
                                    Tổng Số Buổi Học - {{$db_class->number_of_unit}}
                                 </h6>
                              </li>
                           </ul>
                        </li>
                        <li class="mt-list-item">
                           <ul class="list-inline">
                              <li>
                                 <div class="list-icon-container">
                                    <a href="javascript:;">
                                    <i class="fa fa-book" aria-hidden="true"></i>
                                    </a>
                                 </div>
                              </li>
                              <li>
                                 <h6 class="stl-box-class bold text-center">
                                    Số Unit Đã Học - {{$db_class->db_current_unit}}
                                 </h6>
                              </li>
                           </ul>
                        </li>
                        <li class="mt-list-item">
                           <ul class="list-inline">
                              <li>
                                 <div class="list-icon-container">
                                    <a href="javascript:;">
                                    <i class="fa fa-male" aria-hidden="true"></i>
                                    </a>
                                 </div>
                              </li>
                              <li>
                                 <h6 class="stl-box-class bold text-center">
                                    Học viên - {{$db_class->students}}
                                 </h6>
                              </li>
                           </ul>
                        </li>
                        <li class="mt-list-item">
                           <ul class="list-inline">
                              <li>
                                 <div class="list-icon-container">
                                    <a href="javascript:;">
                                    <i class="fa fa-facebook"></i>
                                    </a>
                                 </div>
                              </li>
                              <li>
                                 <h6 class="stl-box-class bold text-center">
                                    <a href="{{$db_class->facebook_group}}" target="_blank">Facebook Lớp </a>
                                 </h6>
                              </li>
                           </ul>
                        </li>
                        <li class="mt-list-item">
                           <ul class="list-inline">
                              <li>
                                 <div class="list-icon-container">
                                    <a href="javascript:;">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                    </a>
                                 </div>
                              </li>
                              <li>
                                 <h6 class="stl-box-class bold text-center">
                                    Trạng Thái - @if($db_class->status == 16) Chuẩn Bị Khai Giảng  @elseif($db_class->status == 17) Đã Khai Giảng @elseif($db_class->status == 18) Đã Kết Thúc @elseif($db_class->status == 19) Đã Quyết Toán @endif
                                 </h6>
                              </li>
                           </ul>
                        </li>
                        <li class="mt-list-item">
                           <ul class="list-inline">
                              <li>
                                 <div class="list-icon-container">
                                   <a href="{{route('classroom.edit',$db_class->id)}}">
                                      <button class="btn btn-xs green btn-editClassRoom" data-id="{{$db_class->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sửa</button>
                                  </a>
                                 </div>
                              </li>
                              <li>
                                 <div class="list-icon-container">
                                    <button class="btn btn-xs green btn-delClassRoom" data-id="{{$db_class->id}}"><i class="fa fa-trash-o"></i> Xóa</button>
                                 </div>
                              </li>
                              @if ($db_class->status == 18 || $db_class->status == 19)
                              <li>
                                 <div class="list-icon-container">
                                    <button class="btn btn-xs green" onclick="funDuplicate({{$db_class->id}})" data-id="{{$db_class->id}}"><i class="fa fa-clone" aria-hidden="true"></i> Duplicate</button>
                                 </div>
                              </li>
                              @endif
                           </ul>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         @endforeach
         @else
         <div class="alert alert-danger text-center" style="margin-top: 10px">
            <button class="close" data-dismiss="alert"></button><em>(Không có bản ghi nào)</em>
         </div>
         @endif
      </div>
      @if($flag_class==true && $flag)
         <div class="row">
            <div class="pagination " style="float:right;margin-right: 3%; ">
               {!! $list_classroom->render() !!}
            </div>   
         </div>
      @endif
   </div>
</div >
</div>



<!-- modal edit -->

<div class="modal fade bs-modal-lg" id="editClassModal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header" id="sua">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Sưa</h4>
         </div>
         <div class="modal-body">
            <form id="frmEditClass" name="frmEditClass" class="form-horizontal" role="form">
               {{ csrf_field() }}
               <div class="row">
                  <div class="col-sm-12">
                     <div class="form-group form-md-line-input">
                        <label class="col-sm-3 control-label" for="code">Mã Lớp</label>
                        <div class="col-sm-8">
                           <input class="style-formEdit form-control" value="" id="editCode"
                              name="code" placeholder="" type="text"/>
                           <input type="hidden" class="form-control has-error" id="editID" name="editID"
                              value="">
                           <p style="color:red;display:none" class="error errorCode"></p>
                        </div>
                        <div class="col-sm-1 requireds">(*)</div>
                     </div>
                     <div class="form-group form-md-line-input">
                        <label class="col-sm-3 control-label" for="class_name">Tên Lớp</label>
                        <div class="col-sm-8">
                           <input class="style-formEdit form-control" id="editClass_name"
                              name="class_name" placeholder="" type="text"/>
                           <p style="color:red;display:none" class="error errorClass_name"></p>
                        </div>
                        <div class="col-sm-1 requireds">(*)</div>
                     </div>
                     <div class="form-group form-md-line-input">
                        <label class="col-sm-3 control-label" for="orientation_time">Thời Gian</label>
                        <div class="col-sm-8">
                           <input class="style-formEdit form-control" id="editOrientation_time"
                              name="orientation_time" placeholder="" type="text"/>
                           <p style="color:red;display:none" class="error errorOrientation_time"></p>
                        </div>
                        <div class="col-sm-1 requireds"></div>
                     </div>
                     <div class="form-group form-md-line-input">
                        <label class="col-sm-3 control-label" for="time_table">THời Gian Học</label>
                        <div class="col-sm-8">
                           <input class="style-formEdit form-control" id="editTime_table"
                              name="time_table" placeholder="" type="text"/>
                           <p style="color:red;display:none" class="error errorTime_table"></p>
                        </div>
                        <div class="col-sm-1 requireds"></div>
                     </div>
                     <div class="form-group form-md-line-input">
                        <label class="col-sm-3 control-label" for="number_of_unit">Số buổi học</label>
                        <div class="col-sm-8">
                           <input class="style-formEdit form-control" id="editNumber_of_unit"
                              name="number_of_unit" placeholder="" type="text"/>
                           <p style="color:red;display:none" class="error errorNumber_of_unit"></p>
                        </div>
                        <div class="col-sm-1 requireds">(*)</div>
                     </div>
                     <div class="form-group form-md-line-input">
                        <label class="col-sm-3 control-label" for="course_id">Khóa Học</label>
                        <div class="col-sm-8">
                           <select class="form-control" id="editCourse_id" name="course_id">
                           @if($flag_class==true && $list_course)
                              @foreach($list_course as $db)
                              <option value="{{$db->id}}">{{$db->name}}</option>
                              @endforeach
                          @endif
                           </select>
                           <p style="color:red;display:none" class="error errorCourse_id"></p>
                        </div>
                     </div>
                     <div class="form-group form-md-line-input">
                        <label class="col-sm-3 control-label" for="tuition">Học phí</label>
                        <div class="col-sm-8">
                           <input class="style-formEdit form-control" id="editTuition" name="tuition"
                              placeholder="" type="text"/>
                           <p style="color:red;display:none" class="error errorTuition"></p>
                        </div>
                     </div>
                     <div class="form-group form-md-line-input">
                        <label class="col-sm-3 control-label" for="icon">Icon</label>
                        <div class="col-sm-8">
                           <input class="style-formEdit form-control" id="editIcon" name="editIcon"
                              placeholder="" type="text"/>
                           <p style="color:red;display:none" class="error errorIcon"></p>
                        </div>
                     </div>
                     <div class="form-group form-md-line-input">
                        <label class="col-sm-3 control-label" for="tuition_policy">Chính Sách Giảm Học
                        phí</label>
                        <div class="col-sm-8">
                           <input class="style-formEdit form-control" id="editTuition_policy"
                              name="editTuition_policy" placeholder="" type="text"/>
                           <p style="color:red;display:none" class="error errorTuition_policy"></p>
                        </div>
                     </div>
                     <div class="form-group form-md-line-input">
                        <label class="col-sm-3 control-label" for="max_tuition_policy">Mức giảm tối
                        đa</label>
                        <div class="col-sm-8">
                           <input class="style-formEdit form-control" id="editMax_tuition_policy"
                              name="max_tuition_policy" placeholder="" type="text"/>
                           <p style="color:red;display:none" class="error errorMax_tuition_policy"></p>
                        </div>
                        <div class="col-sm-1 requireds">(*)</div>
                     </div>
                     <div class="form-group form-md-line-input">
                        <label class="col-sm-3 control-label" for="policy">Chính sách lớp học</label>
                        <div class="col-sm-8">
                           <input class="style-formEdit form-control" id="editPolicy" name="editPolicy"
                              placeholder="" type="text"/>
                           <p style="color:red;display:none" class="error errorPolicy"></p>
                        </div>
                     </div>
                     <div class="form-group form-md-line-input">
                        <label class="col-sm-3 control-label" for="facebook_group">FaceBook Lớp</label>
                        <div class="col-sm-8">
                           <input class="style-formEdit form-control" id="editFacebook_group"
                              name="editFacebook_group" placeholder="" type="text"/>
                           <p style="color:red;display:none" class="error errorFacebook_group"></p>
                        </div>
                     </div>
                     <div class="form-group form-md-line-input">
                        <label class="col-sm-3 control-label" for="editstatus">Trạng Thái</label>
                        <div class="col-sm-8">
                           <select class="form-control" id="editStatus" name="status" id="">
                              <option value="0">Chuẩn Bị Khai Giảng</option>
                              <option value="1">Đã Khai Giảng</option>
                              <option value="2">Đã Kết Thúc</option>
                              <option value="1">Đã Nghiệm Thu</option>
                           </select>
                           <p style="color:red;display:none" class="error errorStatus"></p>
                        </div>
                        <div class="col-sm-1 requireds">(*)</div>
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default"
                     data-dismiss="modal">
                  Đóng
                  </button>
                  <button type="submit" class="btn btn-primary">
                  Sửa
                  </button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection
@section('footer')
<script src="{{url('js/jqueryValidate/jquery.validate.js')}}" type="text/javascript"></script>
<script src="{{url('js/curd-ClassRoom.js')}}" type="text/javascript"></script>
<script>
    //dupliace    
  function funDuplicate(id) {
    swal({   
        title: "Bạn có chắc chắn muốn dupliace ?",
        text: "Bao gồm dupliace lý thuyết, bài tập thuộc unit ...",
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Có",   
        cancelButtonText: "Không",
        closeOnConfirm: true,   
        // closeOnCancel: true 
      },
      function(isConfirm){
        if(isConfirm){
        
          $.ajaxSetup({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            }
          });

          $.ajax({
            type: 'post',
            url :  "{{URL::asset('')}}classroom/duplicate/" + id,
            data: {'id':id},
            success:function(data){
              console.log(data);
              if (!data.error) {
                toastr["success"]("Thành công!");
                setTimeout(function () {   
                              window.location.href = web+"classroom";
                          }, 1500)
              }
              else{
                toastr["warning"]("Không thành công!");
              } 
            }
          });
        }
        else {
        toastr["warning"]("Thao tác được huỷ bỏ!");
      }      
        // window.location.href = "{{URL::to('home/list')}}"
      });

    

}
</script>
@endsection