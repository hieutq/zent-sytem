<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
	<thead>
	<tr>
	    <th class="stl-column color-column">#</th>
	    <th class="stl-column color-column">Nhóm lý thuyết</th>
	    <th class="stl-column color-column">Tên Bài Tập</th>
	    <th class="stl-column color-column">Nội Dung</th>
	    <th class="stl-column color-column">Độ Khó</th>
	    <th class="stl-column color-column">
	        Hành Động
	    </th>
	</tr>
	</thead>

	<tbody id="tbodyTable">
	@if(count($exercises) > 0)
	<?php $id = 1 ?>
	@foreach($exercises as $db)
	    <tr align="center" id="Exercise{{$db->id}}">
	        <td>{{$id++}}</td>
	        <td>{{$db->theoryGroup->name}}</td>
	        <td>{{$db->name}}</td>
	        <td>{!! $db->content !!}</td>
	        <td>{{$db->levels->name}}</td>
	        <td>
	            <ul class="list-inline">
	                <li>
	                    <a href="#"><i class="fa fa-info btn-detailExercise btn-info style-css"
	                                   data-id="{{$db->id}}" aria-hidden="true" title="Xem Chi Tiết Bài Tập""></i>
	                    </a>
	                </li>
	                <li>
	                    <a href="#"><i class="fa fa-pencil-square-o btn-warning btn-editExercise style-css"
	                                   data-id="{{$db->id}}" aria-hidden="true"
	                                   title="Sửa bài tập"></i></a>
	                </li>
	                <input type="hidden" name="_token" value="{{ csrf_token() }}">
	                <li>
	                    <a href="#"><i class="fa fa-trash-o btn-danger btn-delExercise style-css"
	                                   data-id="{{$db->id}}" aria-hidden="true" title="Xóa Bài Tập""></i>
	                    </a>
	                </li>
	            </ul>
	        </td>
	    </tr>
	@endforeach
	@else
	<tr>
	    <td colspan="6">( ! không có bản ghi nào ! )</td>
	</tr>
	@endif
	</tbody> 
</table>  
	@if ($flag)
	<div class="pagination " style="float:right; ">
	    {!!$exercises->render() !!}
	</div>
	@endif
