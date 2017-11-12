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