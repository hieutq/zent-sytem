@extends('layouts.master')
@section('contents')
<div class="portlet light bordered">
    <div class="portlet-body">
    	<div class="row">
            <div class="col-md-4">
               <a href="{{ route('studentCares') }}" class="btn btn-outline btn-circle btn-sm yellow"><i class="fa fa-undo" aria-hidden="true"></i>Trở Lại</a> 
                
            </div>
    		<div class="col-md-4"><h4 style="text-align: center;">Gửi Mail Cho Học Viên</h4></div>
            <div class="col-sm-4"></div>
    		<form action="" name="frmCreateStudentCare" id="frmCreateStudentCare" class="form-horizontal" role="form">
    			<div class="row col-md-12">
                    <div class="form-group form-md-line-input">
                    	@foreach ($studentClassRoom as $db)
                    	<label  class="col-sm-2 control-label" for="name"><i>Học Viên</i> : </label>
                    	<label  class="col-sm-2 control-label text-pull-left" for="name">{{$db->studentName}}</label>
                    	<label  class="col-sm-2 control-label" for="name"><i>Điện Thoại</i> : </label>
                    	<label  class="col-sm-2 control-label text-pull-left" for="name">{{$db->mobile}}</label>
                    	<label  class="col-sm-2 control-label" for="name"><i>Lớp</i> : </label>
                    	<label  class="col-sm-2 control-label text-pull-left" for="name">{{$db->class_name}}</label>
                        <input type="hidden" name="student_id" id="student_id" value="{{$db->student_id}}">
                        <input type="hidden" name="email" id="email" value="{{$db->email}}">
                        <input type="hidden" name="name" id="name" value="{{$db->studentName}}">
                    	@endforeach

                    </div>
                    <div class="form-group form-md-line-input">
                        <div class="col-sm-2"></div>
                    	<div class="col-sm-9">
                           <input class="style-formEdit form-control " id="title"  name="title" placeholder="Chủ đề" type="text"/>
                           <input class="style-formEdit form-control " id="reviver_address"  name="reviver_address" value="1" type="hidden"/>
                           <input class="style-formEdit form-control " id="care_type"  name="care_type" value="1" type="hidden"/>
                           <input class="style-formEdit form-control " id="status"  name="status" value="1" type="hidden"/>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-9">
                           <textarea id="content" name="content" class="EditorControl" placeholder="Nội Dung" rows="15" > </textarea>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <div class="col-sm-12" style="text-align: center;">
                        <button type="submit" id="submitbuttum" class="btn btn-primary">
                            Gửi
                        </button>
                        </div>
                    </div>
    			</div>
    		</form>
    		
    	</div>
    </div>
</div>
<div class="portlet light bordered">
    <div class="portlet-body">
        <div class="table-toolbar">
            <div class="row">
                <div class="col-md-12" style="text-align: center;">
                <h4><b>Danh Sách Số Lần Chăm Sóc Học Viên</b></h4>
                </div>
            
            </div>
        </div>
        <div class="row" id="replaceTable">
            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                <thead>
                    <tr>
                        <th class="stl-column color-column">#</th>
                        <th class="stl-column color-column">Nội Dung</th>
                        <th class="stl-column color-column">Hình Thức</th>   
                        <th class="stl-column color-column">Thời gian</th>                   
                        <th class="stl-column color-column">Trạng Thái</th>
                        <th class="stl-column color-column">Hành động</th>
                    </tr>
                </thead>
                <tbody id="tbodyTable">
                @if (count($studentCare) > 0 )
                <?php $i=1 ?>

                @foreach($studentCare as $db)
                    <tr align="center" id="StudentstudenCare{{$db->id}}">
                        <td>{{$i++}}</td>
                        <td>{!!$db->content!!}</td>
                        <td>@if ($db->care_type==1) <i class="fa fa-envelope-o" aria-hidden="true"></i> @elseif ($db->care_type==2) <i class="fa fa-comment" aria-hidden="true"></i>
                            @elseif($db->care_type==3) <i class="fa fa-phone" aria-hidden="true"></i> @endif
                                                    
                        </td>
                        <td>{{$db->created_at}}</td>
                        <td>@if ($db->status==1)
                            Gửi mail thành công
                            @elseif ($db->status==2)
                            Đã nghe máy
                            @elseif ($db->status==3)
                            <span style="color: red;">Không nghe máy (cần gọi lại)</span>
                            @endif
                        </td>
                        <td>
                        <ul class="list-inline">
                            <li>
                                <a href="#"><i class="fa fa-pencil-square-o btn-warning btn-editStudentCare style-css" data-id="{{$db->id}}" aria-hidden="true" title="Sửa Thông Tin Student"></i></a>
                            </li>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <li>
                                <a href="#"><i class="fa fa-trash-o btn-danger btn-delStudentCare style-css" data-id="{{$db->id}}" aria-hidden="true" title="Xóa Student"></i></a>
                            </li>
                        </ul> 
                        </td> 
                    </tr>
                @endforeach
                </tbody>
                @else
                <tr>
                <td colspan="8"><em>(Không có bản ghi nào)</em></td>
                </tr>
                @endif
            </table>
                @if ($flag)
                    <div class="pagination" style="float:right">
                    {!! $studentCare->render() !!}
                    </div>
                @endif
        </div>
    </div>
</div>
@endsection
@section('footer')
<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
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

        tinymce.init({selector: ".EditorControl",plugins: ["placeholder"]});
         $(window).load(function () {

        $('#tuition_policy').css('height', '550px');

        });
  </script>
    <script src="{{url('js/jqueryValidate/jquery.validate.js')}}" type="text/javascript"></script>
    <script src="{{url('js/jqueryValidate/additional-methods.js')}}" type="text/javascript"></script>
	<script src="{{url('js/ajax-studentCare.js')}}" type="text/javascript"></script>
    
@endsection