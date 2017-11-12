<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
  <thead>
      <tr>
          <th class="stl-column color-column">ID</th>
          <th class="stl-column color-column">Họ Tên </th>
          <th class="stl-column color-column">Số Điện Thoại</th>
          <th class="stl-column color-column">Email</th>
          <th class="stl-column color-column">Ngày Tạo</th>                         
          <th class="stl-column color-column">  
             Hành Động
          </th>
      </tr>
  </thead>
  <tbody id="tbodyTable">
  @if (count($students)>0)
  <?php $id=1 ?>
  @foreach($students as $db)
        <tr align="center" id="Student{{$db->id}}">
            <td>{{$id++}}</td>
            <td>{{$db->name}}</td>
            <td>{{$db->mobile}}</td>  
            <td><a href="{{$db->email}}">{{$db->email}}</a></td>
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
      <td colspan="6" align="center"><em>(Không có bản ghi nào)</em></td>
    </tr>
 
  @endif 
  </tbody>
</table>
  @if($flag)
  <div class="pagination" style="float:right">
      {!! $students->render() !!}
  </div>
  @endif