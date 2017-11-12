<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                <thead>
                <tr>
                    <th class="stl-column color-column">ID</th>
                    <th class="stl-column color-column">Tên Nhóm Lý Thuyết</th>
                    <th class="stl-column color-column">
                        Hành Động
                    </th>
                </tr>
                </thead>
               
                <tbody id="tbodyTable">
                @if (count($theoryGroup)>0)
                <?php $id = 1 ?>
                @foreach($theoryGroup as $db)
                    <tr align="center" id="ClassRoom{{$db->id}}">
                        <td>{{$id++}}</td>
                        <td>{{$db->name}}</td>

                        <td>
                            <ul class="list-inline">
                                <li>
                                    <a href="#"><i class="fa fa-pencil-square-o btn-warning btn-editTheoryGroup style-css"
                                                   data-id="{{$db->id}}" aria-hidden="true"
                                                   title="Sửa Thông Tin Nhóm Lý Thuyết"></i></a>
                                </li>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <li>
                                    <a href="#"><i class="fa fa-trash-o btn-danger btn-delTheoryGroup style-css"
                                                   data-id="{{$db->id}}" aria-hidden="true" title="Xóa Nhóm Lý Thuyết""></i>
                                    </a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
                @else
                    <tr>
                      <td colspan="6" align="center">không tìm thấy bản ghi nào</td>
                    </tr>
                </tbody>
                @endif 
                
            </table>  
            @if ($flag)
            <div class="pagination " style="float:right; ">
                {!!$theoryGroup->render() !!}
            </div>
            @endif