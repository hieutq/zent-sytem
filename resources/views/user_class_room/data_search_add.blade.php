<ul  id="list-manager" style="list-style: none">
@if($data_search_user)
  @if(count($data_search_user)>0)
		@foreach($data_search_user as $db_result)
			<li class="manager-select" data-id="{{$db_result->id}}">{{$db_result->name}}</li>
		@endforeach
  @else
  			<li  class="manager-unselect"><em><b>Không tìm thấy quản lý này</b></em></li>
  @endif
@endif
</ul>