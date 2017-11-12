@extends('layouts.master')
@section('contents')
<div class="portlet light bordered">
  <div class="portlet-title tabbable-line">
      <div class="caption">
          <span class="caption-subject font-green uppercase"><i class="fa fa-file-text" aria-hidden="true"></i> {{$class_room_name}} / UNIT {{$unit_id}} - DANH SÁCH NỘP BÀI TẬP VỀ NHÀ </span>
      </div>
      <ul class="nav nav-tabs">
          <li class="active">
              <a href="#portlet_comments_1" data-toggle="tab"> Đã nộp </a>
          </li>
          <li>
              <a href="#portlet_comments_2" data-toggle="tab"> Chưa nộp </a>
          </li>
      </ul>
  </div>
  <div class="portlet-body">
      <div class="tab-content">
          <div class="tab-pane active" id="portlet_comments_1">
            @if(count($students_home_work) > 0)
              <div class="table-scrollable">
                 <table class="table table-striped table-bordered table-hover table-checkable order-column table-home-work" id="sample_1">
                    <thead>
                        <tr>
                            <th class="stl-column color-column">#</th>
                            <th class="stl-column color-column">Mã học viên</th>
                            <th class="stl-column color-column">Học Viên</th>
                            <th class="stl-column color-column">Link bài tập</th>
                            <th class="stl-column color-column">Thời gian nộp bài</th>              
                            <th class="stl-column color-column">Trạng Thái</th>
                            <th class="stl-column color-column">Điểm</th>
                            <th class="stl-column color-column">Hành Động</th>
                        </tr>
                    </thead>

                    <tbody id="tbodyTable">
                      

                      @foreach($students_home_work as $key => $db)
                          <tr align="center" id="StudentHomework{{$db->id}}">
                          <input type="hidden" class="form-control has-error getID" id="getID" name="editID" placeholder="Name" value="{{$db->id}}">
                           <input type="hidden" class="form-control status" id="status" name="status" value="{{$db->status}}">
                            <td>   
                              {{$key + 1}}
                            </td>
                            
                            <td><a href="tel:{{$db->mobile}}">{{$db->mobile}}</a></td>  
                            <td>{{$db->name}}</td>
                            <td>
                              <a href="{{$db->url}}" class="btn btn-details btn-outline btn-circle btn-sm blue">
                                        <i class="fa fa-eye" aria-hidden="true"></i> Chi tiết </a>
                              </td>
                            <td>{{date('H:i:s d-m-y',strtotime($db->time_submit))}}</td>
                            <td>
                              @if( strtotime($db->time_submit) < strtotime($class_room_unit->deadline))
                                Đúng Giờ
                              @else
                                Muộn (phạt 10k)
                              @endif
                            </td>
                            <td id="point-{{$db->id}}">
                              {{$db->point + $db->point_plus}}
                            </td>
                            <td>
                              <ul class="list-inline">
                                      
                                    </a>
                                      
                                     <a href="#" class="btn btn-grades btn-outline btn-circle green btn-sm purple" data-id="{{$db->id}}">
                                        <i class="fa fa-calendar-check-o" aria-hidden="true"></i> Chấm điểm
                                    </a>
                                    <a href="#" class="btn btn-outline btn-circle green btn-sm purple">
                                        <i class="fa fa-paper-plane-o" aria-hidden="true"></i> Gửi thông báo
                                    </a>
                                       {{-- <a href="#" type="submit"  class="btn btn-outline btn-dels btn-circle dark btn-sm red">
                                        <i class="fa fa-trash-o"></i> Xóa 
                                      </a> --}}
                              </ul> 
                              </td> 
                          </tr>
                          
                     @endforeach
                    </tbody>
                  </table>
              </div>
              @else 
                  <em>Hiện tại không có bản ghi nào</em>
              @endif
          </div>
          <div class="tab-pane" id="portlet_comments_2">
            @if(count($student_not_works) > 0)
              <div class="table-scrollable">
              <table class="table table-striped table-bordered table-hover table-checkable order-column table-home-work" id="sample_1">
                    <thead>
                        <tr>
                            <th class="stl-column color-column">#</th>
                            <th class="stl-column color-column">Mã học viên</th>
                            <th class="stl-column color-column">Học Viên</th>           
                            <th class="stl-column color-column">Trạng Thái</th>
                            <th class="stl-column color-column">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyTable">
                      @foreach($student_not_works as $key1 => $student)
                          <tr align="center">
                            <td>   
                              {{$key1 + 1}}
                            </td>
                            
                            <td><a href="tel:{{$student->mobile}}">{{$student->mobile}}</a></td>  
                            <td>{{$student->name}}</td>
                            <td>
                                Không nộp (phạt 20k)
                            </td>
                            
                            <td>
                              <ul class="list-inline">
                                      
                                    </a>
                                            
                                     <a href="#" class="btn btn-outline btn-circle green btn-sm purple">
                                        <i class="fa fa-paper-plane-o" aria-hidden="true"></i> Gửi thông báo
                                    </a>
                              </ul> 
                              </td> 
                          </tr>
                          
                     @endforeach
                    </tbody>
                  </table>
                </div>
                @else
                    <em>(Không có bản ghi nào)</em>
                @endif
              </div>
          </div>
      </div>
  </div>
</div>

<!-- poup Show Detail -->
<div  class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="Homework-modal-grade" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" id="chitietou" style="background: #36c6d3;color:white;">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Đóng</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                  Chấm điểm
                </h4>
            </div>        
            <!-- Modal Body -->
            <div class="modal-body">
                
             <form class="form-horizontal" id="frmHomeWorkGrade" role="form" name="frmHomeWorkGrade" >
             <div class="row">
                  <div class="col-sm-12">

                          <div class="form-group form-md-line-input">
                            <label  class="col-sm-3 control-label " for="student_id">Học Viên</label>
                              <div class="col-sm-8 ">
                                  <input class="style-formEdit form-control" id="infoStudent1" type="text"/>
                              </div>
                            <div class="col-sm-1 requireds"></div>
                          </div>
                          <input type="hidden" class="form-control has-error" id="infoID1" name="infoID1" value="">
                                      
                    <div class="form-group form-md-line-input">
                            <label class="col-sm-3 control-label">
                               Điểm
                            </label>
                            <div class="col-sm-8 ">
                              <input class="form-control" id="infoPoint1"  type="text"/>
                              <p style="color:red;display:none" class="error errorPoint"></p>
                          </div>
                          <div class="col-sm-1 requireds">*</div>
                    </div>
                   <div class="form-group form-md-line-input">
                        <label class="col-sm-3 control-label">
                           Điểm Thêm
                        </label>
                        <div class="col-sm-8 ">
                        <input type="text" class="form-control" id="infoPoint_plus1"  >
                        <p style="color:red;display:none" class="error errorPoint_plus"></p>
                        </input>
                      </div>
                      <div class="col-sm-1 requireds">*</div>
                  </div> 
                    <div class="form-group form-md-line-input">
                            <label class="col-sm-3 control-label">
                               Nhận xét
                            </label>                                       
                        <div class="col-sm-8">
                           <textarea id="infoComment1" name="content" class="EditorControl" placeholder="Nội Dung" rows="50" ></textarea>
                           <p style="color:red;display:none" class="error errorComment"></p>
                           <div class="col-sm-1"></div>                       
                        </div>
                        <div class="col-sm-1 requireds">*</div>
                    </div>                                 
               </div>
          
           </div>   
                     
              <div class="modal-footer">
                <button type="button" class="btn btn-outline btn-circle green"
                        data-dismiss="modal">
                           Hủy
                </button>
               <button type="submit" class="btn btn-save btn-outline btn-circle green" id="btn-save">
                           Lưu
                </button>
            </div>                                                                     
                </form>     
            </div>
            
            <!-- Modal Footer -->

        </div>
    </div>
</div>

@endsection
@section('footer')

<script src='http://cdn.tinymce.com/4/tinymce.min.js'></script>

  <script>
       tinymce.PluginManager.add('placeholder', function (editor) {
            editor.on('init', function () {
                var label = new Label;
                onBlur();
                tinymce.DOM.bind(label.el, 'click', onFocus);

                editor.on('focus', onFocus);
                editor.on('blur', onBlur);
                editor.on('change', onBlur);
                editor.on('setContent', onBlur);
                function onFocus() { if (!editor.settings.readonly === true) { label.hide(); } editor.execCommand('mceFocus', false); }
                function onBlur() { if (editor.getContent() == '') { label.show(); } else { label.hide(); } }
            });
            var Label = function () {
                var placeholder_text = editor.getElement().getAttribute("placeholder") || editor.settings.placeholder;
                var placeholder_attrs = editor.settings.placeholder_attrs || { style: { position: 'absolute', top: '2px', left: 0, color: '#aaaaaa', padding: '.25%', margin: '5px', width: '80%', 'font-size': '17px !important;', overflow: 'hidden', 'white-space': 'pre-wrap' } };
                var contentAreaContainer = editor.getContentAreaContainer();
                tinymce.DOM.setStyle(contentAreaContainer, 'position', 'relative');
                this.el = tinymce.DOM.add(contentAreaContainer, "label", placeholder_attrs, placeholder_text);
            }
            Label.prototype.hide = function () { tinymce.DOM.setStyle(this.el, 'display', 'none'); }
            Label.prototype.show = function () { tinymce.DOM.setStyle(this.el, 'display', ''); }
        });

        tinymce.init({
          selector: '#infoComment1',
          height: 250,
          menubar: false,
          plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
          ],
          toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
          content_css: '//www.tinymce.com/css/codepen.min.css'
        });

  </script>
  
 <script src="{{url('js/curd_studentHomeWork.js')}}" type="text/javascript"></script>
@endsection