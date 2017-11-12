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