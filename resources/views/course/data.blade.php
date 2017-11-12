<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
 <thead>
    <tr>
       <th class="stl-column color-column">ID</th>
       <th class="stl-column color-column">Tên Khóa Học </th>
       <th class="stl-column color-column">Học Phí</th>
       <th class="stl-column color-column">Thời Gian Tạo</th>
       <th class="stl-column color-column">  
          Hành Động
       </th>
    </tr>
 </thead>
 <tbody id="tbodyTable">
    <?php $id=1 ?>
    @if (count($courses)>0)
    @foreach($courses as $db)
    <tr align="center" id="Course{{$db->id}}">
       <td>{{$id++}}</td>
       <td>{{$db->short_name}}</td>
       <td>{{$db->tuition}} <span style="color: grey">VND</span></td>
       <td>{{$db->created_at}}</td>
       <td>
          <ul class="list-inline">
            <li>
                <a href="{{url('courses/view',$db->id)}}"><i class="fa fa-info btn-detailStudent btn-info style-css"  aria-hidden="true" title="Xem Chi tiết"></i></a>
            </li>
            <li>
                <a href="{{url('courses/edit',$db->id)}}"><i class="fa fa-pencil-square-o btn-warning btn-editStudent style-css" data-id="{{$db->id}}" aria-hidden="true" title="Sửa  User"></i></a>
            </li>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <li>
                <a href="#" onclick="alertDel({{$db->id}})"><i class="fa fa-trash-o btn-danger btn-delStudent style-css" aria-hidden="true" title="Xóa"></i> </a>
            </li>
          </ul>
       </td>
    </tr>
    @endforeach
    @else
    <tr>
      <td colspan="5" align="center">Hiện tại không có bản ghi nào</td>
    </tr>
    @endif 
 </tbody>
</table>
@if ($flag)
<div class="pagination" style="float:right">
  {!!$courses->render() !!}
</div>
@endif