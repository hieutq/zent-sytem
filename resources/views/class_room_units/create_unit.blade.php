@extends('layouts.master')
@section('head')
<style type="text/css">
  .error{
    color: red;
  }
</style>
@endsection

@section('contents')

<div class="portlet light bordered" id ="form_wizard_1">

       <div class="portlet-title">
        <div class="caption uppercase">
           <i class="fa fa-plus-circle" aria-hidden="true"></i> Thông Tin Lớp Học/Thêm Bài Học
        </div>
     </div>
	        	<div class="portlet-body form">
		            <form id="frmAddUit" role="form">
		                <div class="form-body">
						              <div class="form-group form-md-line-input form-md-floating-label">
                               <input type="text" class="form-control" id="name" name="name">
                               <label for="unit_name">Tên Bài Học (<span style="color:red;">*</span>)</label>
                               
                           </div>
                           <div  class="form-group form-md-line-input form-md-floating-label">
                               <input type="text" class="form-control" id="unit" name="unit">
                               <label for="unit">Số Bài Học (<span style="color:red;">*</span>)</label>
                               
                           </div>
                           <div class="form-group form-md-line-input form-md-floating-label">
                                    <select class="form-control" id="status" name="status">
                                        <option value="1">Hiển Thị</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                    <label for="status">Trạng Thái (<span style="color:red;">*</span>)</label>
                           </div>  

                           <div class="form-group form-md-line-input form-md-floating-label">
                              <textarea type="textarea" rows="4" class="form-control" id="note" name="note"></textarea>
                               <label for="note">Ghi Chú</label>
                           </div>              
      						</div>
      						<div class="row text-center" >
      							<button type="submit" class="btn green btn-circle" >Thêm mới</button>
      						</div>
					     </form>
				</div>
	</div>
</div>
@endsection

@section('footer')
<script src="{{url('js/jqueryValidate/jquery.validate.js')}}" type="text/javascript"></script>
<script src="{{url('js/classroom/class_room_unit.js')}}" type="text/javascript"></script>

<script>
  $('#frmAddUit').validate({ // initialize the plugin
              errorElement: "span",
              rules: {
                name : {
                  required : true,
                  minlength: 2,
                  maxlength:250
                  
                },
                unit : {
                  required :true,
                  number:true
                },
                status : {
                  required:true,
                  number:true
                }
              },
              messages: {
                name : {
                  required : "Vui lòng nhập tên bài học",
                  minlength: "Tên bài học có độ dài ít nhất 2 ký tự",
                  maxlength : "Tên bài học có độ dài tối đa 250 ký tự"
                },
                unit : {
                  required :"Vui lòng nhập số bài học",
                  number: "Số bài học không đúng định dạng",
                },
                status : {
                  required :"Vui lòng chọn trạng thái",
                  number : "Trạng thái không đúng định dạng"
                }
              }
  });

  $('#frmAddUit').on('submit',function(e){

            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'POST',
                url: "{{route('classroom.store')}}",
                data: {
                  name : $("#code").val(),
                  unit : $("#class_name").val(),
                  status : $("#status").val(),

                },

                success:function(data){
                    if(!data.error) {
                        toastr.success('Thêm mới bài học thành công!');

                        setTimeout(function () {   
                            window.location.href = "{{route('classroom.index')}}";
                        }, 1500);

                        $('#frmAddUit button[type="submit"]').prop('disabled',true);

                    } else {
                        toastr.error('Thêm mới không thành công !');
                        $('#frmAddUit button[type="submit"]').prop('disabled',false);
                    }
                  },
                  error: function (xhr, ajaxOptions, thrownError) {
                    toastr.error(thrownError);

                  }
            });
        });  

</script>
@endsection


