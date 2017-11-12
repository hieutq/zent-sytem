@extends('layouts.master')
@section('contents')  
<h1 class="text-center">LỚP HỌC</h1>
<div class="row portlet light bordered">
<div class="row">
<div class="col-md-12">
<h4><b>Danh Sách Lớp Học</b></h4>
   @foreach($list_classroom as $db_class)
   <div class="col-md-4" style="margin-top: 10px;">
      <div class="portlet-body">
         <div class="mt-element-list">
            <div class=" green-haze">
               <div class="row">
               	<div class="col-xs-12" style="height: 120px;">
                  <div class="col-xs-4">
						<div class="list-head-summary-container" style="margin-top: 25%;">
                                <div class="list-pending">
                                    <div><a href="{{Route('unit.load-units',['id_classroom' => $db_class->id])}}"><button class="btn btn-md green">Vào Lớp</button></a></div>
                                </div>
                            </div>
                  </div>
                   <div class="col-md-5 pull-right"><button type="button" class="btn btn-success btn-reset-theory" id="btn-reset-select">Làm Mới</button></div>
                  </div>
               </div>
            </div>
            <div class="mt-list-container list-default">

               <ul>
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
                           <h5 class="uppercase bold text-center">
                              <a href="javascript:;">Giảng Viên - @if($db_class->name_teacher != Null){{ $db_class->name_teacher}} @else <em>(Chưa Cập Nhật) </em>@endif</a>
                           </h5>
                        </li>
                     </ul>
                  </li>
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
                           <h5 class="uppercase bold text-center">
                              <a href="javascript:;">Tổng Số Buổi Học - {{$db_class->number_of_unit}}</a>
                           </h5>
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
                           <h5 class="uppercase bold text-center">
                              <a href="javascript:;" target="_blank">Số Unit Đã Học - {{$db_class->db_current_unit}} </a>
                           </h5>
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
                           <h5 class="uppercase bold text-center">
                              <a href="{{$db_class->facebook_group}}" target="_blank">Facebook Lớp  </a>
                           </h5>
                        </li>
                     </ul>
                  </li>
               </ul>
            </div>
         </div>
      </div>
   </div>
   @endforeach
</div>

</div>
</div >
</div>
@section('footer')
<script src="{{url('js/curd-class-unit.js')}}" type="text/javascript"></script>
@endsection
@endsection