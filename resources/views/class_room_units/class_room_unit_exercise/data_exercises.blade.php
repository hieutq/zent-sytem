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
													                 	<td class="text-center">{{$db_exercise['name']}}</td>
													                 
													                    <td class="text-center"> 
													                    	<a href="#" class="show-content-exercise btn btn-outline btn-circle btn-sm blue" data-name = "" data-content="{{$db_exercise['content']}}">
													                            <i class="fa fa-eye" aria-hidden="true"></i> Chi tiết
													                        </a>
													                     </td>
													                    <td class="text-center">
													                    		<select name="answer_id"  class="form-control inputstl" id="answer_id_{{$db_exercise['id']}}">
													                    			@if(count($db_exercise['answer']))
													                    			

														                    			@foreach($db_exercise['answer'] as $db_answer)

														                    			<option @if($db_answer['selected'] ==true) selected="" @endif value="{{$db_answer['id']}}">@if(strlen($db_answer['content']) > 20)  {!! substr($db_answer['content'],0,20) !!} ... @else  {!! $db_answer['content'] !!} @endif
														                    			</option>

														                    			@endforeach

													                    			@else

													                    			<option>chưa có lời giải</option>

													                    			@endif
													                    			
													                    			
													                    		</select>
													                    </td>
													                    <td class="text-center"> 
													                    @if(count($db_exercise['answer'])) 
													                    	<a href="#" class="show-content-answer btn btn-outline btn-circle btn-sm blue" data-id = "{{$db_exercise['id']}}" data-content="">
													                            <i class="fa fa-eye" aria-hidden="true"></i> Chi tiết
													                        </a>
													                      @endif
													                     </td>
													                    <td class="text-center">{{ date('d-m-Y H:i:s ', strtotime($db_exercise['created_at'])) }}</td>
													                    <td class="text-center"> 
													                     @if(count($db_exercise['answer']))  
														                    <div class="md-checkbox">

					                                                            <input type="checkbox" class="act_check_exercise md-check" name="exercise_{{$db_exercise['id']}}" @if($db_exercise['checked'] == true ) checked @endif data-id="{{$db_exercise['id']}}" id="exercise_{{$db_exercise['id']}}">
					                                                            <label for="exercise_{{$db_exercise['id']}}">
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