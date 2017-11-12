@extends('layouts.master')
@section('contents')

<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption uppercase">
            <i class="fa fa-file-text" aria-hidden="true"></i> Thông Tin Lớp Học </div>
       
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-6 col-lg-5">
            <button id="addUnitBtn"  onclick="addUnit({{$class_room_id}});" class="btn green btn-circle"><i class="fa fa-plus"></i> Thêm mới</button>
        </div>
        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-7">
            <form method="get" action="">
                <input type="text" class="search-class form-control" id="search" name="search" placeholder="Nhập Thông Tin Tìm Kiếm">
            </form>
        </div>
    </div>
    <div class="portlet-body">
        @if (count($data_unit) > 0 ) 
        <div class="table-scrollable">
            
            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                <thead>
                  <tr>
                     <th class="stl-column color-column">#</th>
                     <th class="stl-column color-column">Tên bài học</th>
                     <th class="stl-column color-column">Hạn nộp bài</th>
                     <th class="stl-column color-column">HV nộp muộn</th>
                     <th class="stl-column color-column">HV không nộp</th>
                     <th class="stl-column color-column">HV nghỉ</th>
                     {{-- <th class="stl-column color-column">Trạng Thái</th> --}}
                     <th class="stl-column color-column">Ngày tạo</th>
                     <th class="stl-column color-column">  
                        Hành Động
                     </th>
                  </tr>
                </thead>
                <tbody id="tbodyTable">
                           
                        @foreach($data_unit as $key => $db)
                            <tr align="center" id="unit{{$db->id}}">
                                <td>{{$key+1}}</td>
                                <td>{{$db->unit_name}}</td>
                                <td>
                                    @if (strtotime($db->deadline) > time())
                                        {{date('d-m-Y H:i:s', strtotime($db->deadline))}}
                                    @else
                                        <span style="color:#E08283;">Hết hạn</span>
                                    @endif
                                </td>
                                <td>
                                   
                                    {{$db->student_apply_late}}
                                 
                                </td>
                                <td>
                                    
                                     {{$db->student_dont_work}}
                                    
                                </td>
                                <td>
                                     {!! $db->absent !!}
                                </td>
                               {{--  <td>
                                    @if($db->studied)  
                                        Đã học
                                    @else
                                       Mở
                                    @endif
                                </td> --}}
                                <td>
                                    {{date('d-m-Y H:i:s', strtotime($db->created_at))}}
                                </td>
                                <td>
                                    <a href="{{route('attendances.list',['class_room_id' => $db->class_room_id, 'unit_id' => $db->id])}}" class="btn btn-outline btn-circle btn-sm blue">
                                        <i class="fa fa-eye" aria-hidden="true"></i> Điểm danh
                                    </a>
                              
                                    <a href="{{URL::asset('')}}classroom-unit/{{$db->id}}/edit?step=1" class="btn btn-outline btn-circle green btn-sm purple">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>ND Bài học
                                    </a>
                                    <a href="{{route('student.listStudentHomeWork',['id_class' => $db->class_room_id,'id' => $db->unit])}}" class="btn btn-outline btn-circle green btn-sm purple">
                                        <i class="fa fa-list" aria-hidden="true"></i> DS nộp bài tập
                                    </a>
             
                                    <a href="#" type="button" onclick="funDelete({{$db->id}})" class="btn btn-outline btn-circle dark btn-sm red btn-delFeedback">
                                        <i class="fa fa-trash-o"></i> Xóa  
                                    </a>
                                </td>
                            </tr>
                        @endforeach
               </tbody>
            </table>
            
        </div>
        @else
            <em>Hiện tại không có bản ghi nào</em>
        @endif
    </div>
</div>


@endsection

@section('footer')
<script src="{{url('js/jqueryValidate/jquery.validate.js')}}" type="text/javascript"></script>
<script src="{{url('js/classroom/class_room_unit.js')}}" type="text/javascript"></script>

<!-- <script src="{{url('js/curd-class-unit.js')}}" type="text/javascript"></script>

<script src="{{url('js/jquery-ui.js')}}" type="text/javascript"></script>

<script src="{{url('js/curd-add-student-class.js')}}" type="text/javascript"></script> -->

<script>
    function funDelete(id) {
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

          var path = "{{URL::asset('')}}classroom-unit/" + id;
          console.log(path);

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
</script>

@endsection