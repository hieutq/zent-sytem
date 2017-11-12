<ul  id="list-student" style="list-style: none">
@if($data_search_student)
  @if(count($data_search_student)>0)
		@foreach($data_search_student as $db_result)
			<li class="student-select" data-id="{{$db_result->id}}">{{$db_result->name}}</li>
		@endforeach
  @else
  			<li  class="student-unselect"><em><b>Không tìm thấy học viên</b></em></li>
  @endif
@endif
</ul>