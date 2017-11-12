<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
    <thead>
        <tr>
            <th class="stl-column color-column">#</th>
            <th class="stl-column color-column">Nội Dung</th>
            <th class="stl-column color-column">Hình Thức</th>   
            <th class="stl-column color-column">Thời gian</th>                   
            <th class="stl-column color-column">Trạng Thái</th>
            <th class="stl-column color-column">Hành động</th>
        </tr>
    </thead>
    <tbody id="tbodyTable">
    @if (count($studentCare) > 0 )
    <?php $i=1 ?>

    @foreach($studentCare as $db)
        <tr align="center" id="StudentstudenCare{{$db->id}}">
            <td>{{$i++}}</td>
            <td>{!!$db->content!!}</td>
            <td>@if ($db->care_type==1) <i class="fa fa-envelope-o" aria-hidden="true"></i> @elseif ($db->care_type==2) <i class="fa fa-comment" aria-hidden="true"></i>
                @elseif($db->care_type==3) <i class="fa fa-phone" aria-hidden="true"></i> @endif
                                        
            </td>
            <td>{{$db->created_at}}</td>
            <td>@if ($db->status==1)
                Gửi mail thành công
                @elseif ($db->status==2)
                Đã nghe máy
                @elseif ($db->status==3)
                <span style="color: red;">Không nghe máy (cần gọi lại)</span>
                @endif
            </td>
            <td>
            <ul class="list-inline">
                <li>
                    <a href="#"><i class="fa fa-pencil-square-o btn-warning btn-editStudentCare style-css" data-id="{{$db->id}}" aria-hidden="true" title="Sửa Thông Tin Student"></i></a>
                </li>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <li>
                    <a href="#"><i class="fa fa-trash-o btn-danger btn-delStudentCare style-css" data-id="{{$db->id}}" aria-hidden="true" title="Xóa Student"></i></a>
                </li>
            </ul> 
            </td> 
        </tr>
    @endforeach
    </tbody>
    @else
    <tr>
    <td colspan="8"><em>(Không có bản ghi nào)</em></td>
    </tr>
    @endif
</table>
    @if ($flag)
        <div class="pagination" style="float:right">
        {!! $studentCare->render() !!}
        </div>
    @endif