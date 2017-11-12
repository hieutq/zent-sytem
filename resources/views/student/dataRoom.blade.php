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