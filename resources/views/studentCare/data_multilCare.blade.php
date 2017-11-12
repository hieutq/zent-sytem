
<ul  id="list-student" style="list-style: none">

@if($student)
	<input type="hidden" id="arrStudent" value="{{$student}}" name="student[]" data-content="">
  @if(count($student)>0)
		@foreach($student as $db_result)

			<li class="student-select" data-id="{{$db_result->id}}">{{$db_result->name}}</li>
		@endforeach
  @else
  			<li  class="student-unselect"><em><b>Không tìm thấy học viên</b></em></li>
  @endif
@endif
</ul>