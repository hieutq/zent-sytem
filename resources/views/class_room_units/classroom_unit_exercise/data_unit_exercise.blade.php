												        <table class="table table-striped table-bordered table-hover" id="exercise_table">
												            <thead>
												                <tr>
												                  	<th class="stl-column color-column text-center">#</th>
												                  	<th class="stl-column color-column text-center">Tên</th>
												                  	<th class="stl-column color-column text-center">Nội dung</th>
												                  	<th class="stl-column color-column text-center">Lời Giải</th>
												                  	<th class="stl-column color-column text-center">Độ Khó</th>
												                  	<th class="stl-column color-column text-center">Ngày tạo</th>
												                   <th  class="stl-column color-column text-center">Hành động</th>

												                </tr>
												                
												            </thead>
													            <tbody>
													            @if(count($data) > 0)

													            	@foreach($data as $key => $db_exercise)
																	 <tr>
													                 	<td class="text-center">{{$key+1}}</td>
													                 	<td class="text-center">{{$db_exercise[0]['name']}}</td>
													                    <td class="text-center"> 
													                    	<a href="#" class="show-content btn btn-outline btn-circle btn-sm blue"  data-content="{{$db_exercise[0]['content']}}">
													                            <i class="fa fa-eye" aria-hidden="true"></i> Chi tiết
													                        </a>
													                     </td>
													                    <td class="text-center">
													                    	
															                    <select name="answer_{{$db_exercise[0]['id']}}" id="answer_{{$db_exercise[0]['id']}}" class="form-control" style="width: 100%">
																					@if(count($db_exercise[0]['info_answer']))
																						@foreach($db_exercise[0]['info_answer'] as $db_answer)
																						<option value="{{$db_answer->id}}">{{$db_answer->id}}</option>
																						@endforeach
																					@else

																					<option>Chưa có lời giải</option>

																					@endif
															                    </select>
														               
													                    </td>
													                    <td class="text-center" id="lever_{{$db_exercise[0]['id']}}">{{$db_exercise[0]['level_id']}}</td>
													                    <td class="text-center">{{$db_exercise[0]['created_at']}}</td>
													                    <td class="text-center"> 
														                      @if(count($db_exercise[0]['info_answer']))
															                    <div class="md-checkbox">
						                                                            <input type="checkbox" name="exercise_{{$db_exercise[0]['id']}}" data-id="{{$db_exercise[0]['id']}}" @if($db_exercise[0]['checked'] == true) checked @endif id="exercise_{{$db_exercise[0]['id']}}" class="md-check act_check_exercise">
						                                                            <label for="exercise_{{$db_exercise[0]['id']}}">
						                                                                <span class="inc"></span>
						                                                                <span class="check"></span>
						                                                                <span class="box"></span> Chọn </label>
						                                                        </div>

						                                                        @endif
						                                              
													                        
													                    </td>
													                   
													                </tr> 												            	

													            	@endforeach

													               @endif
													            </tbody>
													    </table>