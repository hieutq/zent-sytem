@extends('layouts.master')
@section('contents')
	<div class="portlet light bordered">
	<div class="portlet-body">
	    <div class="table-toolbar">
	      <div class="row">
	        <div class="col-md-6">
	        </div>
	        <div class="col-md-12">
	            <div class="btn-group col-md-6 pull-left">
	              <button id="AddBtn" class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Thêm
	              <i class="fa fa-plus"></i>
	              </button>
	            </div>
                <div class="col-md-6 text-center">
                    <form method="get" action="">
                        <input type="text" class="search-class form-control " id="search"  name="search"  placeholder="Nhập Thông Tin Tìm Kiếm">
                    </form>
                </div>
	        </div>
	      </div>
	    </div>
        <div id="replaceTable" class="row table-responsive">
    	    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
    	      <thead>
    	          <tr>
    	              <th class="stl-column color-column">ID</th>
    	              <th class="stl-column color-column">Tên Lớp học</th>
    	              <th class="stl-column color-column">Tên học viên</th>
    	              <th class="stl-column color-column">Tên Khóa Học</th> 
    	              <th class="stl-column color-column">Địa Chỉ</th>
    	               <th class="stl-column color-column">Ngày Tạo</th>                     
    	              <th class="stl-column color-column">  
    	                 Hành Động
    	              </th>
    	          </tr>
    	      </thead>
    	      <tbody id="tbodyTable">
    	      	@if (count($studentClassRoom) > 0 )
            	<?php $id=1 ?>
    		      	@foreach($studentClassRoom as $db)
    			          <tr align="center" id="StudentClassRoom{{$db->id}}">
    			              	<td>{{$id++}}</td>
    			              	<td>{{$db->ClassRoom->class_name}}</td>
    			              	<td>{{$db->student->name}}</td>
    			              	<td>{{$db->Course->name}}</td>
    			              	<td>{{$db->Branch->address}}</td>  
    			              	 <td>{{$db->created_at}}</td>   
    			              	<td>
    			              	<ul class="list-inline">
    			                  	<li>
    			                      <a href="#"><i class="fa fa-pencil-square-o btn-warning btn-editStudent style-css" data-id="{{$db->id}}" aria-hidden="true" title="Sửa Thông Tin User"></i></a>
    			                  	</li>
    			                  	<input type="hidden" name="_token" value="{{ csrf_token() }}">
    			                  	<li>
    			                      <a href="#"><i class="fa fa-trash-o btn-danger btn-delStudent style-css" data-id="{{$db->id}}" aria-hidden="true" title="Xóa User"></i> </a>
    			                  	</li>
    			              	</ul> 
    			              	</td> 
    			          </tr>
    		  	   	@endforeach
                    @else
                       
                        <tr>
                            <td colspan="7"><em>(Không có bản ghi nào)</em></td>
                        </tr>
                       
                    @endif
    	  	   
    	      </tbody>
    	    </table>
            @if ($flag)
    	    <div class="pagination" style="float:right">
    	        {!!$studentClassRoom->render() !!}
    	    </div>
    	    @endif
        </div>
    </div>
      
    
</div>
<div class="modal fade bs-modal-lg" id="createStudentClassRoomModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" id="themmoi">
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	            <h4 class="modal-title">Thêm Mới</h4>
	        </div>
	        <div class="modal-body">
	        	<form id="frmCreateStudentClassRoom" name="frmCreateStudentClassRoom" class="form-horizontal" role="form">
                    {{ csrf_field() }}
                    <div class="row">
                    	<div class="col-sm-12">
                    		<div class="form-group form-md-line-input">
                                <label  class="col-sm-2 control-label" for="name">Tên lớp học</label>
                                <div class="col-sm-9">
                                	<select class="form-control" name="class_room_id" id="">
                                	@if(count($ClassRoom)) @foreach($ClassRoom as $db)
                                		<option value="{{$db->id}}">{{$db->class_name}}</option>
                                	@endforeach @endif
                                	</select>
                                   <p style="color:red;display:none" class="error errorClassRoom"></p>
                                </div>
                                <div class="col-sm-1 requireds"></div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-2 control-label" for="name">Tên học viên</label>
                                <div class="col-sm-9">
                                	<select class="form-control" name="student_id" id="">
                                	@if(count($Student)) @foreach($Student as $db)
                                		<option value="{{$db->id}}">{{$db->name}}</option>
                                	@endforeach @endif
                                	</select>
                                   <p style="color:red;display:none" class="error errorStudent"></p>
                                </div>
                                <div class="col-sm-1 requireds"></div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-2 control-label" for="name">Tên khóa học</label>
                                <div class="col-sm-9">
                                	<select class="form-control" name="course_id" id="">
                                	@if(count($Course)) @foreach($Course as $db)
                                		<option value="{{$db->id}}">{{$db->name}}</option>
                                	@endforeach @endif
                                	</select>
                                   <p style="color:red;display:none" class="error errorCourse"></p>
                                </div>
                                <div class="col-sm-1 requireds"></div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-2 control-label" for="branch_id">Địa Chỉ lớp</label>
                                <div class="col-sm-9">
                                	<select class="form-control" name="branch_id" id="">
                                	@if(count($Branch)) @foreach($Branch as $db)
                                		<option value="{{$db->id}}">{{$db->address}}</option>
                                	@endforeach @endif
                                	</select>
                                   <p style="color:red;display:none" class="error errorBranch"></p>
                                </div>
                                <div class="col-sm-1 requireds"></div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-2 control-label" for="note">Ghi chú</label>
                                <div class="col-sm-9">
                                   <textarea  id="note" name="note" class="form-control summernote" ></textarea>
                                   <p style="color:red;display:none" class="error errorContent"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
                            
							<div class="form-group form-md-line-input">
                                <label  class="col-sm-2 control-label" for="status">Trạng Thái</label>
                                <div class="col-sm-9">
                                   <select class="form-control" name="status" >
                                   		<option value="">---Chọn---</option>
                                   		<option value="0">Mới đăng ký</option>
                                   		<option value="1">chăm sóc</option>
                                   		<option value="2">Đã thanh toán học phí</option>
                                   		<option value="3">Tham gia lớp</option>
                                   		<option value="3">Đã rời khỏi lớp</option>
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
                        Thêm Mới
                        </button>
                    </div>
                </form>
	        </div>
		</div>
	</div>
</div>
<div class="modal fade bs-modal-lg" id="editStudentClassRoomModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" id="themmoi">
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	            <h4 class="modal-title">Thêm Mới</h4>
	        </div>
	        <div class="modal-body">
	        	<form id="frmEditStudentClassRoom" name="frmEditStudentClassRoom" class="form-horizontal" role="form">
                    {{ csrf_field() }}
                    <div class="row">
                    	<div class="col-sm-12">
                    		<div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="name">Tên lớp học</label>
                                <div class="col-sm-8">
                                	<select class="form-control" id="class_room_id" name="class_room_id" id="">
                                	@if(count($ClassRoom)) @foreach($ClassRoom as $db)
                                		<option value="{{$db->id}}">{{$db->class_name}}</option>
                                	@endforeach @endif
                                	</select>
                                	<input type="hidden" class="form-control has-error" id="editID" name="editID" value="">
                                   <p style="color:red;display:none" class="error errorClassRoom"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="name">Tên học viên</label>
                                <div class="col-sm-8">
                                	<select class="form-control" id="student_id" name="student_id" id="">
                                	@if(count($Student)) @foreach($Student as $db)
                                		<option value="{{$db->id}}">{{$db->name}}</option>
                                	@endforeach @endif
                                	</select>
                                   <p style="color:red;display:none" class="error errorStudent"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="name">Tên khóa học</label>
                                <div class="col-sm-8">
                                	<select class="form-control" id="course_id" name="course_id" id="">
                                	@if(count($Course)) @foreach($Course as $db)
                                		<option value="{{$db->id}}">{{$db->name}}</option>
                                	@endforeach @endif
                                	</select>
                                   <p style="color:red;display:none" class="error errorCourse"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="branch_id">Địa Chỉ lớp</label>
                                <div class="col-sm-8">
                                	<select class="form-control" id="branch_id" name="branch_id" id="">
                                	@if(count($Branch)) @foreach($Branch as $db)
                                		<option value="{{$db->id}}">{{$db->address}}</option>
                                	@endforeach @endif
                                	</select>
                                   <p style="color:red;display:none" class="error errorBranch"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
                            
							<div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="status">Trạng Thái</label>
                                <div class="col-sm-8">
                                   <select class="form-control" id="status" name="status">
                                   		<option value="">---Chọn---</option>
                                   		<option value="0">Mới đăng ký</option>
                                   		<option value="1">chăm sóc</option>
                                   		<option value="2">Đã thanh toán học phí</option>
                                   		<option value="3">Tham gia lớp</option>
                                   		<option value="4">Đã rời khỏi lớp</option>
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
 <script src="{{url('js/StudentClassRoom.js')}}" type="text/javascript"></script>
@endsection