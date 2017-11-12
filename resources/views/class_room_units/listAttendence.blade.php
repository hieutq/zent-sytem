@extends('layouts.master')
@section('contents')

<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption uppercase">
            <i class="fa fa-area-chart" aria-hidden="true"></i> {{$class_room_name}} / Unit {{$unit_id}} - ĐIỂM DANH</div>
       
    </div>

    <div class="portlet-body">
        <div class="table-scrollable">
          <div id="repalceTable" class="row table-responsive">
            <form id="frmAttendence" name="frmAttendence" class="form-horizontal" method="post" action="{{ route('attendances.create') }}" role="form">
              <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                <thead>
                    <tr>
                        <th class="stl-column color-column">#</th>
                        <th class="stl-column color-column">Mã Học Viên</th>
                        <th class="stl-column color-column">Họ Tên</th>
                        <th class="stl-column color-column">Điểm Danh</th>
                        <th class="stl-column color-column">Lý Do</th>                         
                    </tr>
                </thead>

                <tbody id="tbodyTable">
                @if (!empty($attendences))
                {{ csrf_field() }}
                
                @foreach($attendences as $key => $attendence)
                  <tr align="center" id="Student{{$attendence->id}}">
                      <td>{{$key+1}}</td>
                      <td><a href="tel:{{$attendence->mobile}}">{{$attendence->mobile}}</a></td>
                      <td>{{$attendence->name}}</td>
                      <td>
                        <select class="form-control" id="type" name = "type-{{$attendence->id}}">
                          @if ($types) 
                              @foreach($types as $type)
                                <option @if($attendence->type == $type->id) selected @endif value="{{$type->id}}">{{$type->name}}</option>
                              @endforeach
                          @endif
                      </td>
                      <td>                 
                        <input class="form-control" id="reason" name = "reason-{{$attendence->id}}" value="{{$attendence->reason}}">
                        <input type="hidden" class="form-control" id="user_id" name = "user_id-{{$attendence->id}}" value="{{Auth::user()->id}}">
                        <input type="hidden" class="form-control" id="student_id" name = "student_id-{{$attendence->id}}" value="{{$attendence->id}}">
                        <input type="hidden" class="form-control" id="class_room_id" name = "class_room_id-{{$attendence->id}}" value="{{$class_room_id}}">
                        <input  type="hidden" class="form-control" id="class_room_unit_id" name = "class_room_unit_id-{{$attendence->id}}" value="{{$unit_id}}">
                      </td>
                  </tr>
                 @endforeach
                
                @else
                  <tr>
                    <td colspan="5" align="center"><em>(Không có bản ghi nào)</em></td>
                  </tr>
              
                @endif 
                </tbody>
              </table>
              @if (!empty($attendences))
              <div class="modal-footer">
                
                <button type="submit" class="btn btn-primary">
                Lưu
                </button>
              </div>
              @endif
              </form>
            </div>
            {{-- <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                  <thead>
                    <tr>
                       <th class="stl-column color-column">#</th>
                       <th class="stl-column color-column">Tên bài học</th>
                       <th class="stl-column color-column">Hạn nộp bài</th>
                       <th class="stl-column color-column">HV nộp muộn</th>
                       <th class="stl-column color-column">HV nghỉ</th>
                       <th class="stl-column color-column">Trạng Thái</th>
                       <th class="stl-column color-column">Ngày tạo</th>
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
                                  <td>
                                      @if (strtotime($db->deadline) > time())
                                          {{date('d-m-Y H:i:s', strtotime($db->deadline))}}
                                      @else
                                          <span style="color:#E08283;">Hết hạn</span>
                                      @endif
                                  </td>
                                  <td>
                                      @if (strtotime($db->deadline) < time())
                                       {{$db->student_apply_late}}
                                      @endif
                                  </td>
                                  <td>
                                      @if (strtotime($db->deadline) < time())
                                       {{$db->absent}}
                                      @endif
                                  </td>
                                  <td>
                                      @if($db->studied)  
                                          Đã học
                                      @else
                                         Mở
                                      @endif
                                  </td>
                                  <td>
                                      {{date('d-m-Y H:i:s', strtotime($db->created_at))}}
                                  </td>
                                  <td>
                                      <a href="{{route('attendances.list',['class_room_id' => $db->class_room_id, 'unit_id' => $db->id])}}" class="btn btn-outline btn-circle btn-sm blue">
                                          <i class="fa fa-eye" aria-hidden="true"></i> Điểm danh
                                      </a>
                                
                                      <a href="#" class="btn btn-outline btn-circle green btn-sm purple">
                                          <i class="fa fa-pencil-square-o" aria-hidden="true"></i>ND Bài học
                                      </a>
                                      <a href="{{route('student.listStudentHomeWork',['id_class' => $db->class_room_id,'id' => $db->unit])}}" class="btn btn-outline btn-circle green btn-sm purple">
                                          <i class="fa fa-list" aria-hidden="true"></i> DS nộp bài tập
                                      </a>
               
                                      <a href="#" type="submit" data-id="{{$db->id}}" class="btn btn-outline btn-circle dark btn-sm red btn-delFeedback">
                                          <i class="fa fa-trash-o"></i> Xóa  
                                      </a>

                                      <ul class="list-inline">
                                         <li>
                                            <a href="{{route('attendances.list',['class_room_id' => $db->class_room_id, 'unit_id' => $db->id])}}"><i class="fa fa-list btn-attendance btn-success style-css" data-id="{{$db->id}}" aria-hidden="true" title="Điểm danh Học viên"></i></a>
                                         </li>
                                         <li>
                                            <a href="{{route('units.detail.unit',['id_class' => $db->class_room_id,'id' => $db->unit])}}">
                                            <i class="fa fa-pencil-square-o btn-attendance btn-info style-css" data-id="{{$db->id}}" aria-hidden="true" title="Chi tiết bài học"></i></a>
                                         </li>
                                         <li>
                                            <a href="{{route('student.listStudentHomeWork',['id_class' => $db->class_room_id,'id' => $db->unit])}}"><i class="fa fa-book btn-attendance btn-warning style-css" data-id="{{$db->id}}" aria-hidden="true" title="Bài tập về nhà"></i></a>
                                         </li>
                                         <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                         <li>
                                            <a href="#"><i class="fa fa-trash-o btn-danger btn-delFeedback style-css" data-id="{{$db->id}}" aria-hidden="true" title="Xóa bài học"></i> </a>
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
            </table> --}}
        </div>
    </div>
</div>

@endsection