@extends('layouts.master')
@section('contents')  
<div class="portlet light bordered" id="form_unit_act">
<h2 class="text-center" style="margin-bottom: 50px">CHI TIẾT BÀI HỌC</h2>
<div class="tabbable-custom nav-justified">
		@if($flag_data == true)
                                        <ul class="nav nav-tabs nav-justified">
                                            <li class="active">
                                                <a href="#tab_1_1_1" data-toggle="tab" aria-expanded="true"> Thông Tin Cơ Bản </a>
                                            </li>
                                            <li class="">
                                                <a href="#tab_1_1_2" data-toggle="tab" aria-expanded="false"> Lý Thuyết</a>
                                            </li>
                                            <li class="">
                                                <a href="#tab_1_1_3" data-toggle="tab" aria-expanded="false"> Bài Tập </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1_1_1">
												  <form id="frmUpdateUnit" class="form-horizontal" action="#" novalidate="novalidate">
												                  {{ csrf_field() }}
												                      <div class="form-group">
												                         <label class="control-label col-md-3">Số Bài Học
																		          	<span class="required" aria-required="true"> * </span>
												                         </label>
												                         <div class="col-md-4">
												                            <input type="text" class="form-control" id="unit_number"  value="{{$data_detail_unit->unit}}" name="unit">
												                             <input type="hidden" class="form-control" id="number_unit" value="{{$data_detail_unit->unit}}" >
												                            <span style="color:red;display:none" class="error errorUnit"></span>
												                         </div>
												                      </div>
												                      <div class="form-group">
												                          <input type="hidden" id="id_unit"  value="{{$data_detail_unit->id}}" name="id">
												                      </div>
												                      <div class="form-group">
												                         <label class="control-label col-md-3">Tên Bài Học
												                         <span class="required" aria-required="true"> * </span>
												                         </label>
												                         <div class="col-md-4">
												                         <input type="text" class="form-control" value="{{$data_detail_unit->unit_name}}" name="unit_name">
												                        <span style="color:red;display:none" class="error errorUnitName"></span>
												                         </div>
												                      </div>
												                      <div class="form-group">
												                         <label class="control-label col-md-3">Ghi Chú
																		             <span class="required" aria-required="true"></span>
												                         </label>
												                         <div class="col-md-4">
												                            <textarea type="text" name="note" class="form-control">{{$data_detail_unit->note}}</textarea> 
												                            <span style="color:red;display:none" class="error errorNoteUnit"></span>
												                         </div>
												                      </div>
												                      <div class="form-group">
												                         <label class="control-label col-md-3">Trạng Thái
												                         <span class="required" aria-required="true"></span>
												                         </label>
												                         <div class="col-md-4">
												                            <select name="status" class="form-control inputstl" id="status_unit"> 
												                                <option id="act_status1" value="1" @if($data_detail_unit->status ==1) selected="selected" @endif>Mở</option>
												                                <option id="act_status2" value="2" @if($data_detail_unit->status ==2) selected="selected" @endif>Đóng</option>
												                            </select>
												                            <span style="color:red;display:none" class="error errorStatus"></span>
												                         </div>
												                      </div>
												                      <div style="margin-left: 35%">
												                          <button type="submit" class="btn btn-outline green button-next"> Lưu Thay Đổi</button>
												                      </div>
												                </form>
                                            </div>
                                            <div class="tab-pane" id="tab_1_1_2">
												<div class="portlet-body">
													<div class="row">
															<div class="col-md-3">
																<div class="form-group form-md-line-input">
																	<select class="form-control">
																@if(count($arr_group) > 0 )
																		<option value="0">Tất cả</option>
													
																		@foreach($arr_group as $db_theory_group)
																		<option value="{{$db_theory_group['id']}}">{{$db_theory_group['name']}}</option>
																		@endforeach
																	

																@else
																		<option >--Trống--</option>	

																@endif
																													
																	</select>
																</div>
															</div>
													</div>
												    <div class="table-scrollable">
												        <table class="table table-striped table-bordered table-hover" id="theory_table">
												            <thead>
												                <tr>
												                  	<th class="stl-column color-column text-center">#</th>
												                  	<th class="stl-column color-column text-center">Tên</th>
												                  	<th class="stl-column color-column text-center">Nội dung</th>
												                  	<th class="stl-column color-column text-center">Ngày tạo</th>
												                   <th  class="stl-column color-column text-center">Hành động</th>

												                </tr>
												                
												            </thead>
													            <tbody>
													            @if(count($data_theory) > 0)
													            	@foreach($data_theory as $key => $db_theory)
													            
													                <tr>
													                 	<td class="text-center">{{$key+1}}</td>
													                 	<td class="text-center">{{$db_theory->name}}</td>
													                    <td class="text-center"> 
													                    	<a href="#" class="show-content btn btn-outline btn-circle btn-sm blue" data-name = "" data-content="{{$db_theory->content}}">
													                            <i class="fa fa-eye" aria-hidden="true"></i> Chi tiết
													                        </a>
													                     </td>
													                    <td class="text-center">{{date('d-m-Y H:i:s ', strtotime($db_theory->created_at))}}</td>
													                    <td class="text-center"> 
													                       
													                    <div class="md-checkbox">
				                                                            <input type="checkbox" name="theory_{{$db_theory->id}}" data-id="{{$db_theory->id}}" @if($db_theory->checked == true) checked @endif id="theory_{{$db_theory->id}}" class="md-check act_check_theories">
				                                                            <label for="theory_{{$db_theory->id}}">
				                                                                <span class="inc"></span>
				                                                                <span class="check"></span>
				                                                                <span class="box"></span> Chọn </label>
				                                                        	</div>
													                        
													                    </td>
													                   
													                </tr> 
													                @endforeach
													               
													               @endif
													            </tbody>
													    </table>
													</div>
												</div>
                                            </div>
                                            <div class="tab-pane" id="tab_1_1_3">
 <!-- begin exercise -->
												<div class="portlet-body">
													<div class="row">
															<div class="col-md-3">
																<div class="form-group form-md-line-input">
																	<select class="form-control">
<!-- dd($courese_theory_group->info_group);	 -->
																@if(count($arr_group) > 0 )
																		<option value="0">Tất cả</option>
													
																		@foreach($arr_group as $db_theory_group)
																		<option value="{{$db_theory_group['id']}}">{{$db_theory_group['name']}}</option>
																		@endforeach
																	

																@else
																		<option >--Trống--</option>	

																@endif
																													
																	</select>
																</div>
															</div>
													</div>
												    <div class="table-scrollable" id="content_exercise">
												        <table class="table table-striped table-bordered table-hover" id="exercise_table">
												            <thead>
												                <tr>
												                  	<th class="stl-column color-column text-center">#</th>
												                  	<th class="stl-column color-column text-center">Tên</th>
												                  	<th class="stl-column color-column text-center">Nội dung</th>
												                  	<th class="stl-column color-column text-center">Lời Giải</th>
												                  	<th class="stl-column color-column text-center">Nội Dung Lời Giải</th>
												                  	<th class="stl-column color-column text-center">Ngày tạo</th>
												                   <th  class="stl-column color-column text-center">Hành động</th>

												                </tr>
												                
												            </thead>
													            <tbody>
													            @if(count($data_exercise) > 0)
													            	@foreach($data_exercise as $key => $db_exercise)
													            
													                <tr>
													                 	<td class="text-center">{{$key+1}}</td>
													                 	<td class="text-center">{{$db_exercise->name}}</td>
													                    <td class="text-center"> 
													                    	<a href="#" class="show-content-exercise btn btn-outline btn-circle btn-sm blue" data-name = "" data-content="{{$db_exercise->content}}">
													                            <i class="fa fa-eye" aria-hidden="true"></i> Chi tiết
													                        </a>
													                     </td>
													                    <td class="text-center">
													                    		<select name="answer_id" class="form-control inputstl" id="answer_id_{{$db_exercise->id}}">
													                    			@if(count($db_exercise->answer))
													                    			

														                    			@foreach($db_exercise->answer as $db_answer)

														                    			<option  value="{{$db_answer['id']}}" @if($db_answer['selected'] ==true) selected @endif>@if(strlen($db_answer['content']) > 20)  {!! substr($db_answer['content'],0,20) !!} ... @else  {!! $db_answer['content'] !!} @endif
														                    			</option>

														                    			@endforeach

													                    			@else

													                    			<option>chưa có lời giải</option>

													                    			@endif

													                    		</select>
													                    </td>
													                    <td class="text-center"> 
														                    @if(count($db_exercise->answer))
														                    	<a href="#" class="show-content-answer btn btn-outline btn-circle btn-sm blue" data-id = "{{$db_exercise->id}}" data-content="">
														                            <i class="fa fa-eye" aria-hidden="true"></i> Chi tiết
														                        </a>
														                     @endif
													                     </td>
													                    <td class="text-center">{{date('d-m-Y H:i:s ', strtotime($db_exercise->created_at))}}</td>
													                    <td class="text-center"> 
																			@if(count($db_exercise->answer))	                       
																				<div class="md-checkbox">
								                                                    <input type="checkbox" @if($db_exercise->checked == true) checked @endif data-id="{{$db_exercise->id}}" id="exercise_{{$db_exercise->id}}" class="act_check_exercise md-check" >
								                                                    <label for="exercise_{{$db_exercise->id}}">
								                                                        <span class="inc"></span>
								                                                        <span class="check"></span>
								                                                        <span class="box"></span> Chọn</label>
								                                                </div>
														                    @endif
													                    </td>
													                   
													                </tr> 
													                @endforeach
													               
													               @endif
													            </tbody>
													    </table>
													</div>
												</div>



 <!-- end exercise -->
                                    </div>
                                </div>
                            </div>
                           @else
				               <div class="alert alert-danger text-center">
				                  <button class="close" data-dismiss="alert"></button>Bài Học Này Không Tồn Tại ! Hãy Kiểm Tra Lại.
				               </div>
                           @endif
                       </div>
  <div class="modal fade" id="content_theory" tabindex="-1" role="basic" aria-hidden="true" >
                                        <div class="modal-dialog modal-full">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title " id="slogan-modal">Nội Dung Lý Thuyết</h4>
                                                </div>
                                                <div class="modal-body" id="content-data">  </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Đóng</button>
                                                 
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
   </div>


@section('footer')
<script src="{{url('js/classroom/class_room_unit_theory.js')}}" type="text/javascript"></script>
<script src="{{url('js/classroom/class_room_unit_exercise.js')}}" type="text/javascript"></script>
<script src="{{url('js/classroom/class_room_unit.js')}}" type="text/javascript"></script>
@endsection
@endsection