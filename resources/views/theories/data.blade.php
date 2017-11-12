<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
    <thead>
    <tr>
        <th class="stl-column color-column">ID</th>
        <th class="stl-column color-column">Tên Lý Thuyết</th>
        <th class="stl-column color-column">Nhóm Lý Thuyết</th>
        <th class="stl-column color-column">Nội Dung</th>
        <th class="stl-column color-column">
            Hành Động
        </th>
    </tr>
    </thead>
   
    <tbody id="tbodyTable">
    @if (count($theory) > 0 )
    <?php $id = 1 ?>
    @foreach($theory as $db)
        <tr align="center" id="Theory{{$db->id}}">
            <td>{{$id++}}</td>
            <td>{{$db->name}}</td>
            <td>{{$db->theoryGroup->name}}</td>
            <td>{{$db->content}}</td>

            <td>
                <ul class="list-inline">
                    <li>
                        <a href="#"><i class="fa fa-info btn-detailTheory btn-info style-css"
                                       data-id="{{$db->id}}" aria-hidden="true" title="Xem Chi Tiết Lý Thuyết""></i>
                        </a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-pencil-square-o btn-warning btn-editTheory style-css"
                                       data-id="{{$db->id}}" aria-hidden="true"
                                       title="Sửa Lý Thuyết"></i></a>
                    </li>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <li>
                        <a href="#"><i class="fa fa-trash-o btn-danger btn-delTheory style-css"
                                       data-id="{{$db->id}}" aria-hidden="true" title="Xóa Lý Thuyết""></i>
                        </a>
                    </li>
                </ul>
            </td>
        </tr>
    @endforeach
    
    </tbody>
     @else
    <tr>
        <td colspan="5">Hiện tại không có bản ghi nào</td>
    </tr>
    @endif 
</table>  
    @if ($flag)
    <div class="pagination " style="float:right; ">
        {!!$theory->render() !!}
    </div>
    @endif