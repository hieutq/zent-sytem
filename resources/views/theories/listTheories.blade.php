@extends('layouts.master')
@section('contents')

<div class="portlet light bordered">
<div class="portlet-title">
    <div class="caption">
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
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                   <th class="stl-column color-column">#</th>
                   <th class="stl-column color-column">Tên nhóm</th>
                   <th class="stl-column color-column">Lý thuyết</th>
                   <th class="stl-column color-column">Bài tập</th>
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
                 
                    <td class="text-center"> {{ date('H:i:s d-m-Y', strtotime($group->created_at)) }} </td>
                    
                    <td class="text-center"> 
                        <a href="#" class="btn btn-outline btn-circle btn-sm blue">
                            <i class="fa fa-eye" aria-hidden="true"></i> Lý thuyết 
                        </a>
                        <a href="#" class="btn btn-outline btn-circle green btn-sm purple">
                            <i class="fa fa-eye" aria-hidden="true"></i> Bài tập 
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

        {{-- <div class="modal fade bs-modal-lg" id="editTheoryModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" id="sua">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Sửa</h4>
                </div>
                <div class="modal-body">
                    <form id="frmEditTheory" name="frmEditTheory" class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group form-md-line-input">
                                    <label  class="col-sm-3 control-label" for="name">Nhóm Lý Thuyết</label>
                                    <div class="col-sm-8">
                                     
                                       <p style="color:red;display:none" class="error errorTheoryGroup"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-sm-3 control-label" for="name">Tên Lý Thuyết</label>
                                    <div class="col-sm-8">
                                        <input class="style-formEdit form-control" id="name_theory"
                                               name="name" placeholder="" type="text"/>
                                        <input class="style-formEdit form-control" id="editID"
                                               name="editID" placeholder="" type="hidden"/>
                                        <p style="color:red;display:none" class="error errorName_theory"></p>
                                    </div>
                                    <div class="col-sm-1 requireds">(*)</div>
                                </div> 
                                 
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-2 control-label">Nội Dung</label>
                                <div class="col-sm-9">
                                <textarea class="form-control summernote" id="content_theory" name="content"></textarea>
                                <p style="color:red;display:none" class="error errorContent"></p>
                                </div>
                                
                                 
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
    </div> --}}

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
    "timeOut": "2500",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  };
  console.log(id);
  var path = "{{URL::asset('')}}theorygroups/" + id;
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
                    }, 2500)                   
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
@section('footer')
    <script src="{{url('js/curd-Theory.js')}}" type="text/javascript"></script>

<script>
     function addTheoryGroup() {

        $('#createTheoryGroupModal').modal('show');
        $('.error').hide();
        // $('#frmCreateTheoryGroup').trigger('reset');
        // $('#frmCreateTheoryGroup button[type="submit"]').prop('disabled',false);

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
              url: "{{route('theorygroups.store')}}",
              data: {
                name : $('#name').val()
              },
              success: function(res)
              {

                if(!res.error) {
                    toastr.success('Thêm mới thành công!');

                    $('#name').val('');

                    setTimeout(function () {   
                        window.location.href = "{{route('theorygroups.index')}}";
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
