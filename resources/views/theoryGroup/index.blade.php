@extends('layouts.master')
@section('contents')

<div class="portlet light bordered">
<div class="portlet-title">
    <div class="caption font-green uppercase">
        <i class="fa fa-file-text" aria-hidden="true"></i> HỌC LIỆU </div>
   
</div>
<div class="row">
    <div class="col-xs-12 col-sm-4 col-md-6 col-lg-5">
        <button onclick="addTheoryGroup();" class="btn green btn-circle"><i class="fa fa-plus"></i> Thêm mới</button>
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
                   <th class="stl-column color-column">Nhóm lý thuyết</th>
                   <th class="stl-column color-column">Lý thuyết</th>
                   <th class="stl-column color-column">Bài tập</th>
                   {{-- <th class="stl-column color-column">Khóa học</th> --}}
                   <th class="stl-column color-column">Ngày tạo</th>
                   <th class="stl-column color-column">Hành động</th>
                </tr>
                
            </thead>
            <tbody>
                @if($theory_groups) @foreach($theory_groups as $key => $group)
                <tr>
                    <td class="text-center"> {{ $key + 1 }} </td>
                    <td class="text-center"> {{ $group->name }} </td>
                    <td class="text-center"> {{ $group->listTheories($group->id)->count() }} </td>
                    <td class="text-center"> {{ $group->listExercises($group->id)->count() }} </td>
                    {{-- <td class="text-center"> {{ $group->course_id_group_theory($group->id)}} </td> --}}
                    <td class="text-center"> {{ date('d-m-Y H:i:s ', strtotime($group->created_at)) }} </td>
                        
                    <td class="text-center"> 
                        <a href="{{URL::asset('')}}coursewares/theory/{{$group->id}}" class="btn btn-outline btn-circle btn-sm blue">
                            <i class="fa fa-eye" aria-hidden="true"></i> Lý thuyết 
                        </a>
                        <a href="{{route('exercises.index')}}?theory_group_id={{$group->id}}" class="btn btn-outline btn-circle green btn-sm purple">
                            <i class="fa fa-list" aria-hidden="true"></i> Bài tập 
                        </a>
                        {{-- <form action="#" method="DELETE" style="display: initial;"> --}}
                          <a href="#" type="submit" onclick="alertDel({{$group->id}})" class="btn btn-outline btn-circle dark btn-sm red">
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

<div class="modal fade bs-modal-lg" id="createTheoryGroupModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header " id="themmoi">
                {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> --}}
                <h4 class="modal-title green">THÊM MỚI</h4>
            </div>
            <div class="modal-body">

                        <div id="add-group" class="form-group form-md-line-input">
                            <input type="text" class="form-control" id="name" name="name">
                            <label for="name">Tên nhóm</label>
                            
                        </div>
                        <div class="form-group form-md-line-input">
                        
                           
                                <select class="form-control" id="courses_id" name="courses_id">
                                @if(count($list_courses) >0)
                                     @foreach($list_courses as $db_course)
                                        <option value="{{$db_course->id}}">{{$db_course->short_name}}</option>
                                    @endforeach
                                 @else
                                  <option >--Chưa Có Khóa Học Nào--</option>
                                @endif
                                </select>
                         
                       
                            <label for="courses_id">Khóa Học</label>
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


@endsection

@section('footer')

{{-- <script src="{{url('js/curd-Theory.js')}}" type="text/javascript"></script> --}}

<script>
    function alertDel(id){

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
  console.log(id);
  var path = "{{URL::asset('')}}coursewares/" + id;
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

     function addTheoryGroup() {

        $('#createTheoryGroupModal').modal('show');
        $('#name').val('');
        // $('#createTheoryGroupModal').trigger('reset');
        $('#add').prop('disabled', true);
        
        $('#name').keyup(function () {

            if ($('#name').val() != '' && $('#courses_id').val() != '') {
                    $('#add').removeAttr('disabled');
            } else {
                $('#add').prop('disabled', true);
            }
        });

    }

    $('#add'). click(function () {

        $('#name').keyup(function () {

            $('#add-group').removeClass('has-error');

            $('#add').removeAttr('disabled');

        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
              type: "POST",
              url: "{{route('coursewares.store')}}",
              data: {
                name : $('#name').val(),
                course_id : $('#courses_id').val()
              },
              success: function(res)
              {

                if(!res.error) {
                    toastr.success('Thêm mới thành công!');

                    $('#createTheoryGroupModal').modal('hide');

                    $('#name').val('');

                    setTimeout(function () {   
                        window.location.href = "{{route('coursewares.index')}}";
                    }, 1500)

                } else {
                    toastr.error(res.message.name[0]);
                    $('#add-group').addClass('has-error');
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
