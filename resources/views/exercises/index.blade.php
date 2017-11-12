@extends('layouts.master')
@section('contents')

<div class="portlet light bordered">
<div class="portlet-title">
    <div class="caption font-green uppercase">
        <i class="fa fa-file-text" aria-hidden="true"></i> {{$theory_group_name}} / {{$theory_name}} </div>
   
</div>
<div class="row">
    <div class="col-xs-12 col-sm-4 col-md-6 col-lg-5">
        <button onclick="addExercise({{$theory_group_id}}, {{$theory_id}});" class="btn green btn-circle"><i class="fa fa-plus"></i> Thêm mới</button>
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
                   <th class="stl-column color-column">Tên bài tập</th>
                   <th class="stl-column color-column">Nội dung</th>
                   <th class="stl-column color-column">Lý thuyết</th>
                   <th class="stl-column color-column">Nhóm lý thuyết</th>
                   <th class="stl-column color-column">Mức độ</th>
                   <th class="stl-column color-column">Ngày tạo</th>
                   <th class="stl-column color-column">Hành động</th>
                </tr>
                
            </thead>
            <tbody>
                @if($exercises) @foreach($exercises as $key => $ex)
                <tr>
                    <td class="text-center"> {{ $key + 1 }} </td>
                    <td class="text-center"> {{ $ex->name }} </td>
                    <td class="text-center"> {!! $ex->content !!} </td>
                    <td class="text-center"> {{ $ex->theory->name }} </td>
                    <td class="text-center"> {{ $ex->theory_group->name }} </td>
                    <td class="text-center"> {{ $ex->level->name }} </td>
                 
                    <td class="text-center"> {{ date('d-m-Y H:i:s ', strtotime($ex->created_at)) }} </td>
                    
                    <td class="text-center"> 
                        {{-- <a href="#" class="btn btn-outline btn-circle btn-sm blue">
                            <i class="fa fa-eye" aria-hidden="true"></i> Chi tiết
                        </a> --}}

                        <a href="{{route('exercises.edit',$ex->id)}}?theory_group_id={{$ex->theory_group_id}}&theory_id={{$ex->id}}&step=1&edit=1" class="btn btn-outline btn-circle green btn-sm purple">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sửa
                        </a>

                        <a href="{{route('exercises.edit',$ex->id)}}?theory_group_id={{$ex->theory_group_id}}&theory_id={{$ex->id}}&step=2&edit=1" class="btn btn-outline btn-circle btn-sm green-dark">
                            <i class="fa fa-eye" aria-hidden="true"></i> Lời giải
                        </a>
                        
                        {{-- <form action="#" method="DELETE" style="display: initial;"> --}}
                          <a href="#" type="submit" onclick="alertDel({{$ex->id}})" class="btn btn-outline btn-circle dark btn-sm red">
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

                        <div id="add-group" class="form-group form-md-line-input form-md-floating-label">
                            <input type="text" class="form-control" id="name" name="name">
                            <label for="class_fb_group">Tên nhóm</label>
                            
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

  var path = "{{URL::asset('')}}coursewares/exercises/" + id;
 
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

     function addExercise(theory_group_id, theory_id) {

        window.location.href = "{{route('exercises.create')}}" + "?theory_group_id=" + theory_group_id + "&theory_id=" + theory_id + '&step=1';

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
                name : $('#name').val()
              },
              success: function(res)
              {

                if(!res.error) {
                    toastr.success('Thêm mới thành công!');

                    $('#createTheoryGroupModal').modal('hide');

                    $('#name').val('');

                    setTimeout(function () {   
                        window.location.href = "{{route('coursewares.index')}}";
                    }, 2500)

                } else {
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
