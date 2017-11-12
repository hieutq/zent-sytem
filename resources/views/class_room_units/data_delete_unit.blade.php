               <table class="table table-striped table-bordered table-hover table-checkable order-column" id="content_unit">
                  <thead>
                     <tr>
                        <th class="stl-column color-column">#</th>
                        <th class="stl-column color-column">Tên bài học</th>
                        <th class="stl-column color-column">Unit</th>
                        <th class="stl-column color-column">Trạng Thái</th>
                        <th class="stl-column color-column">  
                           Hành Động
                        </th>
                     </tr>
                  </thead>
                  <tbody id="tbodyTable">
                     @if (count($data_unit) > 0 )        
                     @foreach($data_unit as $key => $db)
                     <tr align="center" id="unit{{$db->id}}">
                        <td>{{$key+1}}</td>
                        <td>{{$db->unit_name}}</td>
                        <td>{{$db->unit}}</td>
                        <td>@if($db->status ==1)  
                           Mở
                           @else
                           Đóng
                           @endif
                        </td>
                        <td>
                           <ul class="list-inline">
                              <li>
                                 <a href="{{route('attendances.list',['class_room_id' => $db->class_room_id, 'unit_id' => $db->id])}}"><i class="fa fa-list btn-attendance btn-success style-css" data-id="{{$db->id}}" aria-hidden="true" title="Điểm danh Học viên"></i></a>
                              </li>
                              <li>
                                 <a href="{{route('units.detail',['id_class' => $db->class_room_id,'id' => $db->unit])}}">
                                 <i class="fa fa-pencil-square-o btn-attendance btn-info style-css" data-id="{{$db->id}}" aria-hidden="true" title="Chi tiết bài học"></i></a>
                              </li>
                              <li>
                                 <a href="#"><i class="fa fa-book btn-attendance btn-warning style-css" data-id="{{$db->id}}" aria-hidden="true" title="Bài tập về nhà"></i></a>
                              </li>
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <li>
                                 <a href="#"><i class="fa fa-trash-o btn-danger btn-del-unit style-css" data-id="{{$db->id}}" aria-hidden="true" title="Xóa bài học"></i> </a>
                              </li>
                           </ul>
                        </td>
                     </tr>
                     @endforeach

                     @else
                     <tr>
                        <td colspan="5">Hiện tại không có bản ghi nào</td>
                     </tr>
                     @endif
                  </tbody>
               </table>
             <div class="portlet-body text-right" id="panigate-user" >
                @if ($flag)
                  {!! $data_unit->links() !!}
                @endif
             </div>