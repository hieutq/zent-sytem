@extends('layouts.master')
@section('contents')

                     <form class="form-horizontal" role="form" enctype="multipart/form-data">
                               {{ csrf_field() }}
                               
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                  <div class="form-group ">
                                           <label class="col-md-3 control-label">Tiêu đề:</label>
                                           <div class="col-md-8">
                                               <input type="text" class="form-control " name="title" placeholder="" value="{{ $post->title}}">
                                               
                                           </div>
                                  </div>
                                   <div class="form-group ">
                                        <label class="col-md-3 control-label">Nội dung ngắn:</label>
                                        <div class="col-md-8">
                                            <textarea id-"demo" class="form-control " rows="4" name="description" >{{ $post->description}}</textarea>
                                          
                                         </div>
                                  </div>
                                  <div class="form-group ">
                                        <label class="col-md-3 control-label">Nội dung:</label>
                                        <div class="col-md-8">
                                            <textarea id-"demo" class="form-control " rows="4" name="content" >{{ $post->content}}</textarea>
                                          
                                         </div>
                                  </div>
                                  <div class="form-group ">
                                           <label class="col-md-3 control-label">slug:</label>
                                           <div class="col-md-8">
                                               <input type="text" class="form-control " name="slug" placeholder="" value="{{ $post->slug}}">
                                               
                                           </div>
                                  </div>
                                  <div class="form-group">
                                        <label class="col-md-3 control-label">Ảnh icon:</label>
                                        <div class="col-md-8">
                                        
                                            <p> <img width="100px" src="../../upload/tintuc/{{$post->image_icon}}"> </p>
                                          
                                        </div>
                                  </div>
                                  <div class="form-group ">
                                        <label class="col-md-3 control-label">Ảnh:</label>
                                        <div class="col-md-8">
                                       
                                            <p> <img width="300px" src="../../upload/tintuc/{{$post->image}}"> </p>
                                          
                                        </div>
                                  </div>
                                  <div class="form-group ">
                                        <label class="col-md-3 control-label">Video:</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control " name="video" placeholder="http://" value="{{ $post->video}}">
                                         </div>
                                  </div>
                                  <div class="form-group ">
                                        <label class="col-md-3 control-label">Kiểu:</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control " name="type" placeholder="bai post thuoc loai gi?" value="{{ $post->type}}">
                                         </div>
                                  </div>
                                  <div class="form-group form-md-line-input">
                                        <label class="col-md-3 control-label">Người tạo:</label>
                                        <div class="col-md-8">
                                            <select name="user_id"  class="form-control">
                                              @foreach($users as $user)
                                              <option @if($post->user->id == $user->id) selected @endif value="{{ $user->id}}">{{$user->name}}</option>
                                              @endforeach
                                            </select>
                                         </div>
                                  </div>
                                  <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="status">Trạng Thái</label>
                                <div class="col-sm-8">
                                   <select class="form-control" name="status" id="">
                                       <option @if($post->status == 1) selected @endif value="1">Đang mở</option>
                                      <option  @if($post->status == 0) selected @endif value="0">Đang đóng</option>
                                   </select>
                                
                                </div>
                            </div>
                    
                
                     
                 
                    <div class="modal-footer">
                        <a href="{{ url('tintuc/danhsach')}}" ><button type="button" class="btn btn-default"
                           data-dismiss="modal">
                        Đóng
                        </button></a>
                        
                    </div>
                </form>
  
@endsection                      