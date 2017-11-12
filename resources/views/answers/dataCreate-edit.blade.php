<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
    <thead>
    <tr>
        <th class="stl-column color-column">#</th>
        <th class="stl-column color-column">Ngôn ngữ</th>
        <th class="stl-column color-column">Tên Bài Tâp</th>
        <th class="stl-column color-column">Tên Bài Giải</th>
        <th class="stl-column color-column">Nội Dung</th>
        <th class="stl-column color-column">Trạng Thái</th>
        <th class="stl-column color-column">
            Hành Động
        </th>
    </tr>
    </thead>
   
    <tbody id="tbodyTable">
     @if (count($answer) > 0 )
    <?php $id = 1 ?>
    @foreach($answer as $db)
        <tr align="center" id="Answer{{$db->id}}">
            <td>{{$id++}}</td>
            <td>{{$db->language->name}}</td>
            <td>{{$db->exercises->name}}</td>
            <td>{{$db->name}}</td>
            <td>{!!$db->content!!}</td>
            <td>@if($db->status==1)
                Đang Mở
                @endif                           
                @if($db->status==0)
                Đã Đóng
                @endif  
            </td>
   
            <td>
                <ul class="list-inline">
                    <li>
                        <a href="#"><i class="fa fa-pencil-square-o btn-warning btn-editAnswer style-css"
                                       data-id="{{$db->id}}" aria-hidden="true"
                                       title="Sửa bài tập"></i></a>
                    </li>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <li>
                        <a href="#"><i class="fa fa-trash-o btn-danger btn-delAnswere style-css"
                                       data-id="{{$db->id}}" aria-hidden="true" title="Xóa Bài Tập""></i>
                        </a>
                    </li>
                </ul>
            </td>
        </tr>
    @endforeach
    
    </tbody> 
    @else
    <tr>
        <td colspan="7">Hiện tại không có bản ghi nào</td>
    </tr>
    @endif
</table>  
    @if ($flag)
    <div class="pagination " style="float:right; ">
        {!!$answer->render() !!}
    </div>
    @endif