                  <table class="table table-striped table-bordered table-hover table-checkable order-column" id="content_unit">
                     <thead>
                        <tr>
                           <th class="stl-column color-column">#</th>
                           <th class="stl-column color-column">Họ Và Tên</th>
                           <th class="stl-column color-column">Chức Vụ</th>
                           <th class="stl-column color-column">  
                              Hành Động
                           </th>
                        </tr>
                     </thead>
                     <tbody id="tbodyTableStudent">
                        @if (count($list_manager_class) > 0 )        
                        @foreach($list_manager_class as $key => $db_manager)
                        <tr align="center" id="manager{{$db_manager->user_id}}">
                           <td>{{$key+1}}</td>
                           <td>{{$db_manager->user->name}}</td>
                           <td>@if($db_manager->type ==1) Giảng Viên @elseif($db_manager->type ==2) Trợ Giảng @endif</td>
                           <td>
                              <ul class="list-inline">
                                 <li>
                                    <a href="#"><i class="fa fa-trash-o btn-danger btn-del-manager-class style-css" data-id="{{$db_manager->user_id}}" aria-hidden="true" title="Xóa"></i> </a>
                                 </li>
                              </ul>
                           </td>
                        </tr>
                        @endforeach

                           @else
                        <tr>
                           <td colspan="6"><em>(Hiện tại không có bản ghi nào)</em></td>
                        </tr>
                        @endif
                     </tbody>
                  </table>
                  @if($flag_manager_class==true)
                         <div class="portlet-body text-right" id="panigate-manager" >
                        
                             @if ($list_manager_class)
                               {!! $list_manager_class->links() !!}
                             @endif
                        
                       </div>
                  @endif