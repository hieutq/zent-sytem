@extends('layouts.master')
@section('contents')
<style>
    .error {
        color: red;
    }
</style>
    <div id ="portlet-body" class="portlet light bordered">
        <div class="portlet-body">
            <div class="table-toolbar">
                <div class="row">
                    <div class="col-md-3 text-right" id="timkiem" style="color:#0099FF"><h4><b></b></h4></div>
                   
                    <div class="col-md-12">
                    <ul class="list-inline">
                        <li class="btn-group pull-left col-md-6">
                            <button id="AddBtn" class="btn green  btn-outline dropdown-toggle"
                                    data-toggle="dropdown">Thêm
                                <i class="fa fa-plus"></i>
                            </button>
                        </li>
                        <li class="col-md-6 text-center">
                        <form method="get" action="">
                        <input type="text" class="search-class form-control " id="search"  name="search"  placeholder="Nhập Thông Tin Tìm Kiếm">
                        </form>
                        </li>
                    </ul>
                    </div>
                </div>
            </div>
            <div id="replaceTable" class="row">
            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                <thead>
                <tr>
                    <th class="stl-column color-column">#</th>
                    <th class="stl-column color-column">Ngôn ngữ</th>
                    <th class="stl-column color-column">Tên Bài Tâp</th>
                    <th class="stl-column color-column">Tên Bài Giải</th>
                    <th class="stl-column color-column">Nội Dung</th>
                    <th class="stl-column color-column">Trạng Thái</th>
                    <th class="stl-column color-column">
                        Hành Động
                    </th>
                </tr>
                </thead>
               
                <tbody id="tbodyTable">
                 @if (count($answer) > 0 )
                <?php $id = 1 ?>
                @foreach($answer as $db)
                    <tr align="center" id="Answer{{$db->id}}">
                        <td>{{$id++}}</td>
                        <td>{{$db->language->name}}</td>
                        <td>{{$db->exercises->name}}</td>
                        <td>{{$db->name}}</td>
                        <td>{!!$db->content!!}</td>
                        <td>@if($db->status==1)
                            Đang Mở
                            @endif                           
                            @if($db->status==0)
                            Đã Đóng
                            @endif  
                        </td>
               
                        <td>
                            <ul class="list-inline">
                                <li>
                                    <a href="#"><i class="fa fa-pencil-square-o btn-warning btn-editAnswer style-css"
                                                   data-id="{{$db->id}}" aria-hidden="true"
                                                   title="Sửa Bài Tập"></i></a>
                                </li>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <li>
                                    <a href="#"><i class="fa fa-trash-o btn-danger btn-delAnswere style-css"
                                                   data-id="{{$db->id}}" aria-hidden="true" title="Xóa Bài Tập""></i>
                                    </a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
                
                </tbody> 
                @else
                <tr>
                    <td colspan="7">Hiện tại không có bản ghi nào</td>
                </tr>
                @endif
            </table>  
                @if ($flag)
                <div class="pagination " style="float:right; ">
                    {!!$answer->render() !!}
                </div>
                @endif
            </div>    
        </div>
    </div>

    <div class="modal fade bs-modal-lg" id="createAnswerModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" id="themmoi">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thêm Mới</h4>
                </div>
                <div class="modal-body">
                    <form id="frmCreateAnswer" name="frmCreateAnswer" class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="name">Ngôn Ngữ</label>
                                <div class="col-sm-8">
                                   <select name="language_id" class="form-control" id="language_id">
                                   @foreach($language as $db)
                                        <option value="{{ $db->id }}">{{ $db->name }}</option>
                                    @endforeach
                                   </select>
                                   <p style="color:red;display:none" class="error errorLanguage_id"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="name">Tên Bài Tập</label>
                                <div class="col-sm-8">
                                   <select name="exercises_id" class="form-control" id="exercises_id">
                                   @foreach($exercises as $db)
                                        <option value="{{ $db->id }}">{{ $db->name }}</option>
                                    @endforeach
                                   </select>
                                   <p style="color:red;display:none" class="error errorExercises_id"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-sm-3 control-label" for="name">Tên Bài Giải</label>
                                <div class="col-sm-8">
                                    <input class="style-formEdit form-control" id="name" name="name"
                                           placeholder="Tên Bài Giải" type="text"/>
                                    <p style="color:red;display:none" class="error errorName"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label">Nội Dung</label>
                                <div class="col-sm-8">
                                <textarea class="form-control summernote" id="content" name="content"></textarea>
                                <p style="color:red;display:none" class="error errorContent"></p>
                                </div>
                                 <div class="col-sm-1 requireds">(*)</div>
                                 
                            </div>
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="status">Trạng Thái</label>
                                <div class="col-sm-8">
                                   <select name="status" class="form-control" id="status">
                                        <option value="1">Đang Mở</option>
                                        <option value="0">Đã Đóng</option>
                                    
                                   </select>
                                   <p style="color:red;display:none" class="error errorStatus"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default"
                                    data-dismiss="modal">
                                Đóng
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Thêm Mới
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <div class="modal fade bs-modal-lg" id="editAnswerModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" id="sua">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Sửa</h4>
                </div>
                <div class="modal-body">
                    <form id="frmEditAnswer" name="frmEditAnswer" class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="name">Ngôn Ngữ</label>
                                <div class="col-sm-8">
                                   <select name="language_id" class="form-control" id="editLanguage_id">
                                   @foreach($language as $db)
                                        <option value="{{ $db->id }}">{{ $db->name }}</option>
                                    @endforeach
                                   </select>
                                   <p style="color:red;display:none" class="error errorEditLanguage_id"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="name">Tên Bài Tập</label>
                                <div class="col-sm-8">
                                   <select name="exercises_id" class="form-control" id="editExercises_id">
                                   @foreach($exercises as $db)
                                        <option value="{{ $db->id }}">{{ $db->name }}</option>
                                    @endforeach
                                   </select>
                                   <p style="color:red;display:none" class="error errorExercises_id"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-sm-3 control-label" for="name">Tên Bài Giải</label>
                                <div class="col-sm-8">
                                    <input class="style-formEdit form-control" id="editName" name="name"
                                           placeholder="Tên Bài Giải" type="text"/>
                                    <input class="style-formEdit form-control" id="editID"
                                       name="editID" placeholder="" type="hidden"/>
                                    <p style="color:red;display:none" class="error errorEditName"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label">Nội Dung</label>
                                <div class="col-sm-8">
                                <textarea class="form-control summernote" id="editContent" name="content"></textarea>
                                <p style="color:red;display:none" class="error erroreditContent"></p>
                                </div>
                                 <div class="col-sm-1 requireds">(*)</div>
                                 
                            </div>
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="name">Tên Bài Tập</label>
                                <div class="col-sm-8">
                                  <select name="status" class="form-control" id="editStatus">
                                        <option value="1">Đang Mở</option>
                                        <option value="0">Đã Đóng</option>
                                    
                                   </select>

                                   <p style="color:red;display:none" class="error errorEditStatus"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default"
                                    data-dismiss="modal">
                                Đóng
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Sửa
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>   
<script>
    $('#frmCreateAnswer').validate({
        errorElement : "span",
        rules: {
            language_id : {
                required: true, 
            },
            exercises_id : {
                required: true, 
            },
            name : {
                required: true, 
            },
            status : {
                required: true, 
            },
        },
        messages: {
            language_id : {
                required: "Bạn vui lòng chọn loại ngôn ngữ", 
            },
            exercises_id : {
                required: "Bạn vui lòng chọn loại bài tập", 
            },
            name : {
                required: "Bạn vui lòng nhập tên bài giải", 
            },
            status : {
                required: "Bạn vui lòng chọn trạng thái", 
            },

        }
    });
    $('#frmEditAnswer').validate({
        errorElement : "span",
        rules: {
            language_id : {
                required: true, 
            },
            exercises_id : {
                required: true, 
            },
            name : {
                required: true, 
            },
            status : {
                required: true, 
            },
        },
        messages: {
            language_id : {
                required: "Bạn vui lòng chọn loại ngôn ngữ", 
            },
            exercises_id : {
                required: "Bạn vui lòng chọn loại bài tập", 
            },
            name : {
                required: "Bạn vui lòng nhập tên bài giải", 
            },
            status : {
                required: "Bạn vui lòng chọn trạng thái", 
            },

        }
    });
</script>
@endsection
@section('footer')
 <script src="{{url('js/curd-Answer.js')}}" type="text/javascript"></script>
@endsection