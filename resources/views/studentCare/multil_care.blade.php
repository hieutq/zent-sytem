@extends('layouts.master')
@section('head')

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

@endsection
@section('contents')
<div class="portlet light bordered">
    <div class="portlet-body">
    	<div class="row">
    		<div class="col-md-12"><h4 style="text-align: center;">Gửi Mail Cho Học Viên</h4></div>
    		<form action="" name="frmCreateStudentCare" id="frmCreateStudentCare" class="form-horizontal" role="form">
    			<div class="row col-md-12">
                    <div class="form-group form-md-line-input">
                    	<ul class="list-inline">
                    		<li class="btn-group col-md-2"></li>
                    		<li class="btn-group col-md-9 pull-left">

                                    <input class="style-formEdit form-control" id="search_student" name="student[]" placeholder="" type="text"/>
                                    <input type="hidden" data-id="" value="" id="student_id" name="id_student">
                                    <div id="data-search"></div>
                    		</li>
                    	</ul>

                    </div>
                    <div class="form-group form-md-line-input">
                        <div class="col-sm-2"></div>
                    	<div class="col-sm-9">
                           <input class="style-formEdit form-control " id="title"  name="title" placeholder="Tiêu đề email" type="text"/>
                           <input class="style-formEdit form-control " id="reviver_address"  name="reviver_address" value="1" type="hidden"/>
                           <input class="style-formEdit form-control " id="care_type"  name="care_type" value="1" type="hidden"/>
                           <input class="style-formEdit form-control " id="status"  name="status" value="1" type="hidden"/>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-9">
                           <textarea id="contentx" name="content" class="EditorControl" placeholder="Nội Dung Email" rows="15" > </textarea>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <div class="col-sm-12" style="text-align: center;">
                        <button type="submit" class="btn btn-primary">
                            Gửi
                        </button>
                        </div>
                    </div>
    			</div>
    		</form>
    		
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
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script type="text/javascript">

            $('#search_student').autocomplete({
                source: '{!!URL::route('studentCares.multil-Search')!!}',
                minlength:1,
                autoFocus:true,
                select:function(e,ui) {
                    alert(ui);
                }
            });
    
    </script>
    <!-- <script src="{{url('js/curd-multilCare.js')}}" type="text/javascript"></script> -->
  
@endsection