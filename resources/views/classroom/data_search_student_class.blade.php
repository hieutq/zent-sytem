               <table class="table table-striped table-bordered table-hover table-checkable order-column" id="content_unit">
                  <thead>
                     <tr>
                        <th class="stl-column color-column">#</th>
                        <th class="stl-column color-column">Tên học viên</th>
                        <th class="stl-column color-column">Ngày Sinh</th>
                        <th class="stl-column color-column">Email</th>
                        <th class="stl-column color-column">Số Điện Thoại</th>
                        <th class="stl-column color-column">  
                           Hành Động
                        </th>
                     </tr>
                  </thead>
                  <tbody id="tbodyTableStudent">
                     @if (count($data_search_student) > 0 )        
                     @foreach($data_search_student as $key => $db_student_search)
                     <tr align="center" id="student{{$db_student_search->id}}">
                        <td>{{$key+1}}</td>
                        <td>{{$db_student_search->name}}</td>
                        <td>{{$db_student_search->birthday}}</td>
                        <td>{{$db_student_search->email}}</td>
                        <td>{{$db_student_search->mobile}}</td>
                        <td>
                           <ul class="list-inline">
                              <li>
                                 <a href="#"><i class="fa fa-trash-o btn-danger btn-del-student-class style-css" data-id="{{$db_student_search->student_id}}" aria-hidden="true" title="Xóa Học Viên"></i> </a>
                              </li>
                           </ul>
                        </td>
                     </tr>
                     @endforeach

                        @else
                     <tr>
                        <td colspan="6"><em>Hiện tại không có bản ghi nào</em></td>
                     </tr>
                     @endif
                  </tbody>
               </table>
               @if($flag==true)
                      <div class="portlet-body text-right" id="panigate-user" >
                     
                          @if ($data_search_student)
                            {!! $data_search_student->links() !!}
                          @endif
                     
                    </div>
               @endif