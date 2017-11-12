      <div class="col-md-12" >
     @if(count($list_classroom))
         @foreach($list_classroom as $db_class)
         <div class="col-md-4" style="margin-top: 10px;">
            <div class="portlet-body">
               <div class="mt-element-list">
                  <div class="mt-list-head list-default green-haze" >
                     <div class="row">
                        <div class="col-xs-12 col-md-12" >
                           <div class="col-xs-8 col-md-8">
                              <div class="list-head-title-container">
                                 <h4 style="text-transform: ;">{{$db_class->class_name}}</h4>
                                 <div >{{date('d-m-Y', strtotime($db_class->orientation_time))}}</div>
                              </div>
                           </div>
                           <div class="col-xs-4 edit" >
                              <div class="list-head-summary-container" style="margin-top: 25%;">
                                 <div class="list-pending ">
                                    <div><a href="{{Route('unit.load-units',['id_classroom' => $db_class->id])}}"><button class="btn btn-xs green">Vào Lớp</button></a></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="mt-list-container list-default" >
                     <ul >
                        <li class="mt-list-item">
                           <ul class="list-inline">
                              <li>
                                 <div class="list-icon-container">
                                    <a href="javascript:;">
                                    <i class="fa fa-graduation-cap"></i>
                                    </a>
                                 </div>
                              </li>
                              <li>
                                 <h6 class="stl-box-class bold text-center">
                                    Thuộc Khóa - {{$db_class->course_name}}
                                 </h6>
                              </li>
                           </ul>
                        </li>
  @if(count($db_class->teacher_name)>0)
                        <li class="mt-list-item">
                           <ul class="list-inline">
                              <li>
                                 <div class="list-icon-container">
                                    <a href="javascript:;">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    </a>
                                 </div>
                              </li>
                              <li>
                                 <h6 class="stl-box-class bold text-center">
                        <?php $length = count($db_class->teacher_name)?>
                                    Giảng Viên -  @foreach($db_class->teacher_name as $key =>$name)
                                    
                          <a href="javascript:;">{{$name}}</a>@if($length > 1 && $key < ($length-1)),@elseif($length > 1 && $key == ($length-1)).@endif
                                           @endforeach                        
                                 </h6>
                              </li>
                           </ul>
                        </li>
      @else
                      <li class="mt-list-item">
                         <ul class="list-inline">
                            <li>
                               <div class="list-icon-container">
                                  <a href="javascript:;">
                                  <i class="fa fa-user" aria-hidden="true"></i>
                                  </a>
                               </div>
                            </li>
                            <li>
                               <h6 class="stl-box-class bold text-center">
                        Giảng Viên - <em>(Chưa Cập Nhật)</em>
                               </h6>
                            </li>
                         </ul>
                      </li>
      @endif
      @if(count($db_class->tutors_name)>0)
                        <li class="mt-list-item">
                           <ul class="list-inline">
                              <li>
                                 <div class="list-icon-container">
                                    <a href="javascript:;">
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                    </a>
                                 </div>
                              </li>
                              <li>
                                 <h6 class="stl-box-class bold text-center"><?php $length = count($db_class->tutors_name)?>
                                    Trợ Giảng -  @foreach($db_class->tutors_name as $key =>$name)
                                    
                          <a href="javascript:;">{{$name}}</a>@if($length > 1 && $key < ($length-1)),@elseif($length > 1 && $key == ($length-1)).@endif
                                           @endforeach
                                 </h6>
                              </li>
                           </ul>
                        </li>
   @else
                        <li class="mt-list-item">
                           <ul class="list-inline">
                              <li>
                                 <div class="list-icon-container">
                                    <a href="javascript:;">
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                    </a>
                                 </div>
                              </li>
                              <li>
                                 <h6 class="stl-box-class bold text-center">
                                 Trợ Giảng - <em>(Chưa Cập Nhật)</em>   
                                 </h6>
                              </li>
                           </ul>
                        </li>   
   @endif
                        <li class="mt-list-item">
                           <ul class="list-inline">
                              <li>
                                 <div class="list-icon-container">
                                    <a href="javascript:;">
                                    <i class="fa fa-tasks"></i>
                                    </a>
                                 </div>
                              </li>
                              <li>
                                 <h6 class="stl-box-class bold text-center">
                                    Tổng Số Buổi Học - {{$db_class->number_of_unit}}
                                 </h6>
                              </li>
                           </ul>
                        </li>
                        <li class="mt-list-item">
                           <ul class="list-inline">
                              <li>
                                 <div class="list-icon-container">
                                    <a href="javascript:;">
                                    <i class="fa fa-book" aria-hidden="true"></i>
                                    </a>
                                 </div>
                              </li>
                              <li>
                                 <h6 class="stl-box-class bold text-center">
                                    Số Unit Đã Học - {{$db_class->db_current_unit}}
                                 </h6>
                              </li>
                           </ul>
                        </li>
                        <li class="mt-list-item">
                           <ul class="list-inline">
                              <li>
                                 <div class="list-icon-container">
                                    <a href="javascript:;">
                                    <i class="fa fa-facebook"></i>
                                    </a>
                                 </div>
                              </li>
                              <li>
                                 <h6 class="stl-box-class bold text-center">
                                    <a href="{{$db_class->facebook_group}}" target="_blank">Facebook Lớp </a>
                                 </h6>
                              </li>
                           </ul>
                        </li>
                        <li class="mt-list-item">
                           <ul class="list-inline">
                              <li>
                                 <div class="list-icon-container">
                                    <a href="javascript:;">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                    </a>
                                 </div>
                              </li>
                              <li>
                                 <h6 class="stl-box-class bold text-center">
                                    Trạng Thái - @if($db_class->status == 0) Chuẩn Bị Khai Giảng  @elseif($db_class->status == 1) Đã Khai Giảng @elseif($db_class->status == 2) Đã Kết Thúc @elseif($db_class->status == 3) Đã Quyết Toán @endif
                                 </h6>
                              </li>
                           </ul>
                        </li>
                        <li class="mt-list-item">
                           <ul class="list-inline">
                              <li>
                                 <div class="list-icon-container">
                                    <button class="btn btn-xs green btn-editClassRoom" data-id="{{$db_class->id}}">Sửa Lớp</button>
                                 </div>
                              </li>
                              <li>
                                 <h6 class=" bold text-center">
                                    <button class="btn btn-xs green btn-delClassRoom" data-id="{{$db_class->id}}">Xóa Lớp</button>
                                 </h6>
                              </li>
                           </ul>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         @endforeach
         @else
         <div class="alert alert-danger text-center" style="margin-top: 10px">
            <button class="close" data-dismiss="alert"></button><em>(Không tìm thấy lớp học nào)</em>
         </div>
         @endif
      </div>
      @if($flag)
         <div class="row">
            <div class="pagination " style="float:right;margin-right: 3%; ">
              <p>{!! $list_classroom->links()!!}</p>
            </div>   
         </div>
      @endif