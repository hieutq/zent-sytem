@extends('layouts.master')
@section('contents')
<div class="portlet light bordered">
	<div class="portlet-body">
	    <div class="table-toolbar">
	      <div class="row">
	        <div class="col-md-6">
	        </div>
	        <div class="col-md-12">
	            <div class="btn-group col-md-6  pull-left">
					<h3>Thông tin phản hồi</h3>
	            </div>
	            <div class="col-md-6 text-center">
					<form method="get" action="">
					<input type="text" class="search-class form-control " id="search"  name="search"  placeholder="Nhập Thông Tin Tìm Kiếm">
					</form>
	            </div>
	        </div>
	      </div>
	    </div>
	    <div class="row table-responsive" id="replaceTable">
	    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
	      	<thead>
	          	<tr>
	              	<th class="stl-column color-column">ID</th>
	              	<th class="stl-column color-column">Họ Tên học viên</th>
	              	<th class="stl-column color-column">Nội Dung</th>   
                	<th class="stl-column color-column">Ngày tạo</th>                   
	              	<th class="stl-column color-column">  
	                 Hành Động
	              	</th>
	          	</tr>
	      	</thead>
	      	<tbody id="tbodyTable">
	      	@if (count($feedbacks) > 0 )
	      	<?php $i=1 ?>
	      
	      	@foreach($feedbacks as $db)
			<tr align="center" id="feedback{{$db->id}}">
			  <td>{{$i++}}</td>
			  <td>{{$db->student->name}}</td>
			  <td>{{$db->comment}}</td>
			<td>{{$db->created_at}}</td>  
			  	<td>
				  	<ul class="list-inline">
				      	<li>
	                      	<a href="#"><i class="fa fa-info btn-detailFeedback btn-info style-css" data-id="{{$db->id}}" aria-hidden="true" title="Xem Chi tiết phản hồi"></i></a>
	                  	</li>
	                  	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	                  	<li>
	                      	<a href="#"><i class="fa fa-trash-o btn-danger btn-delFeedback style-css" data-id="{{$db->id}}" aria-hidden="true" title="Xóa phản hồi"></i> </a>
	                  	</li>
				  	</ul> 
			  	</td> 
			</tr>
	  	    @endforeach
	      	</tbody>
			@else
	    		<tr>
	    			<td colspan="5"><em>(Không có bản ghi nào)</em></td>
	    		</tr>
    		@endif
	    </table>
	    @if($flag)
			<div class="pagination" style="float:right">
	        	{!! $feedbacks->render() !!}
	    	</div>
    	@endif
    	</div>
    </div>    
</div>	
<div class="modal fade bs-modal-lg" id="detailFeadback" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" id="themmoi">
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	            <h4 class="modal-title">Xem Chỉ tiết phản hồi</h4>
	        </div>
	        <div class="modal-body">
	        	<form id="frmDetailFeadback" name="frmDetailFeadback" class="form-horizontal" role="form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                    	<div class="col-sm-12">
                    		<div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="name">Tên Học Viên</label>
                                <div class="col-sm-8">
                                	<select class="form-control" id="student_id" name="student_id" id="">
                                	@if(count($student)) @foreach($student as $db)
                                		<option value="{{$db->id}}">{{$db->name}}</option>
                                	@endforeach @endif
                                	</select>
                                	<input type="hidden" class="form-control has-error" id="editID" name="editID" value="">
                                   <p style="color:red;display:none" class="error errorClassRoom"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="comment">Nội Dung</label>
                                <div class="col-sm-8">
                                   <textarea  id="comment" class="form-control summernote" ></textarea>
                                   <!-- <div id="summernote"></div> -->
                                   <p style="color:red;display:none" class="error errorContent"></p>
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

                    </div>
                </form>
	        </div>
		</div>
	</div>
</div>
@endsection
@section('footer')
 <script src="{{url('js/curd-feedback.js')}}" type="text/javascript"></script>
@endsection