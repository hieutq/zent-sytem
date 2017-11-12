@extends('layouts.master')
@section('contents')
<style type="text/css" media="screen">
   .error{
   color: red;
   display: show;
   }

</style>
<div class="portlet light bordered">
	<div class="portlet-body">
	    <div class="table-toolbar">
	      <div class="row">
	        <div class="col-md-12" style="text-align: center;">
            <h4><b>Danh Sách Học Viên Cần Chăm Sóc</b></h4>
	        </div>
	        <div class="col-md-12">
            <ul class="list-inline">
  	          <li class="btn-group col-md-8 pull-left">
                <form method="get" action="">
                <input type="text" class="search-class form-control " id="search"  name="search"  placeholder="Nhập Thông Tin Tìm Kiếm">
                </form>
  	          </li>
              <li class="col-md-4 pull-right text-center">
                <form method="get" action="">
                  <!-- <button id="AddBtn" class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Thêm
                  <i class="fa fa-plus"></i>
                  </button> -->
                  <select name="listClass" class="form-control" id="listClass">
                    <option value="">--Tất Cả--</option>
                    @foreach ($classRoom as $db)
                    <option value="{{$db->id}}">{{$db->class_name}}</option>
                    @endforeach
                  </select>
                  
                </form>
              </li>
            </ul>
	        </div>
	      </div>
	    </div>
      <div id="replaceTable" class="row table-responsive">
  	    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
  	      <thead>
  	          <tr>
  	              <th class="stl-column color-column">#</th>
  	              <th class="stl-column color-column">Họ và tên </th>
  	              <th class="stl-column color-column">Email</th>   
                  <th class="stl-column color-column">Số điện thoại</th>                   
  	              <th class="stl-column color-column"><i class="fa fa-facebook-square"></th>
                  <th class="stl-column color-column">Đăng ký khóa học</th>
                  <th class="stl-column color-column">Thời gian</th>
                  <th class="stl-column color-column">Hành động</th>
  	          </tr>
  	      </thead>
  	      <tbody id="tbodyTable">
  	      @if (count($studentClassRoom) > 0 )
  	      <?php $i=1 ?>
  	      
  	      @foreach($studentClassRoom as $db)
  		          <tr align="center" id="StudentstudenCare{{$db->id}}">
  		              <td>{{$i++}}</td>
  		              <td>{{$db->studentName}}</td>
  		              <td><a href="{{route('studentCares-emai.get',$db->id_student)}}">{{$db->email}}</a></td>
                    <td><a href="#">{{$db->mobile}}</a></td>
                    <td><a href="{{$db->facebook}}" title="{{$db->facebook}}"><i class="fa fa-facebook-square"></a></td>
                    <td>{{$db->courseName}}</td>
                    <td>{{$db->studentCreated}}</td>  
  		              <td>
  		                <a href="{{route('studentCares-emai.get',$db->id_student)}}" class="btn btn-outline btn-circle btn-sm btn-SendEmail purple" title="Gửi email cho học viên" data-id=""><i class="fa fa-envelope" aria-hidden="true"></i>Gửi Email</a>

                      <a href="#" class="btn btn-outline btn-circle btn-sm btn-SendSms green" title="Gửi email cho học viên" data-id=""><i class="fa fa-commenting" aria-hidden="true"></i>Gửi Sms</a>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <a href="{{route('studentCares-call.get',$db->id_student)}}" class="btn btn-outline btn-circle btn-sm blue btn-Call" title="Gửi email cho học viên" data-id=""><i class="fa fa-phone-square" aria-hidden="true"></i>Gọi Điện</a>

  		              </td> 
  		          </tr>
  	  	   @endforeach
  	      </tbody>
          @else
          <tr>
            <td colspan="8"><em>(Không có bản ghi nào)</em></td>
          </tr>
          @endif
  	    </table>
  	    @if ($flag)
  		  <div class="pagination" style="float:right">
          	{!! $studentClassRoom->render() !!}
      	</div>
      	@endif
      </div>
    </div>    
</div>
<div class="modal fade bs-modal-lg" id="editStudentCareModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="themmoi">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
              <h4 class="modal-title">Thêm Mới</h4>
          </div>
          <div class="modal-body">
            <form id="frmEditStudentCare" name="frmEditStudentCare" class="form-horizontal" role="form">
                    {{ csrf_field() }}
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="name">Họ Tên User</label>
                                <div class="col-sm-8">
                                   <select name="user_id" id="user_id" class="form-control user">
                                   @foreach($user as $db)
                                      <option value="{{ $db->id }}">{{ $db->name }}</option>
                                    @endforeach
                                   </select>
                                   <p style="color:red;display:none" class="error errorUser"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="name">Họ Tên Học Viên</label>
                                <div class="col-sm-8">
                                   <select name="student_id" data-live-search="true" class="selectpicker" id="student_id" class="form-control ">
                                   @foreach($student as $db)
                                      <option data-tokens="{{ $db->name }}" value="{{ $db->id }}">{{ $db->name }}</option>
                                    @endforeach
                                   </select>
                                   <p style="color:red;display:none" class="error errorStudent"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="care_type">Kiểu Quan Tâm</label>
                                <div class="col-sm-8">
                                   <select name="care_type" id="care_type" class="form-control">
                                      <option value="">---Chọn---</option>
                                      <option value="1">Email</option>
                                      <option value="2">SMS</option>
                                      <option value="3">Call</option>
                                   </select>
                                   <p style="color:red;display:none" class="error errorCare"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="reviver_address">Hình Thức</label>
                                <div class="col-sm-8">
                                   <select name="reviver_address" id="reviver_address" class="form-control">
                                      <option value="">---Chọn---</option>
                                      <option value="1">Email</option>
                                      <option value="2">Mobile</option>
                                   </select>
                                   <p style="color:red;display:none" class="error errorReviverAddress"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="content">Nội Dung</label>
                                <div class="col-sm-8">
                                   <input type="text" class="form-control" id="content" name="content">
                                   <input type="hidden" class="form-control has-error" id="editID" name="editID" value="">
                                   <p style="color:red;display:none" class="error errorContent"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="status">Trạng Thái</label>
                                <div class="col-sm-8">
                                   <select name="status" id="status" class="form-control" >
                                      <option value="0">Create</option>
                                      <option value="1">Sended</option>
                                      <option value="2">Cancel</option>

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
	<script src="{{url('js/ajax-studentCare.js')}}" type="text/javascript"></script>
@endsection