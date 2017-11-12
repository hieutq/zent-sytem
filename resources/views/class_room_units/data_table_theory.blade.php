                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table_theory">
                            <thead>
                                <tr>
                                    <th class="stl-column color-column">#</th>
                                    <th class="stl-column color-column">Tên Lý Thuyết </th>
                                    <th class="stl-column color-column">Thuộc Nhóm Lý Thuyết</th>
                                    <th class="stl-column color-column">Hành Động</th>
                                </tr>
                            </thead>
                             <tbody id="table_tbody_theory">
                             @if($flag==true && count($data_theories)>0)
                                @foreach($data_theories as $key => $db)
                               <tr id="theory{{$db->id}}">
                                 <td class="text-center">{{$key+1}}</td>
                                 <td class="text-center">{{$db->name}}</td>
                                 <td class="text-center">{{$db->TheoryGroup->name}}</td>
                                 
                                 <td class="text-center"><input type="checkbox"  data-id="{{$db->id}}" @foreach($data_theories_choice as $db_choice) @if($db->id == $db_choice->theory_id) checked="checked" @endif @endforeach class="toggle act_check_theories"  name="val{{$db->id}}"></td>
                           
                               </tr>
                               @endforeach
                              @else
                              <tr>
                                 <td class="text-center" colspan="4"><em>(Chưa có dữ liệu)</em></td>
                              </tr>
                             @endif 
                             </tbody>
                        </table>
                         @if($flag==true)
                            <div class="portlet-body text-right" id="panigate-user" >
                           
                                @if ($flag_theories)
                                  {!! $data_theories->links() !!}
                                @endif
                           
                          </div>
                            @endif