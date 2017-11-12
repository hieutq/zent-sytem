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
                        <li class="col-md-6 pull-right text-center">
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
                    <th class="stl-column color-column">Nhóm Lý Thuyết</th>
                    <th class="stl-column color-column">Tên Bài Tập</th>
                    <th class="stl-column color-column">Nội Dung</th>
                    <th class="stl-column color-column">Độ Khó</th>
                    <th class="stl-column color-column">
                        Hành Động
                    </th>
                </tr>
                </thead>
               
                <tbody id="tbodyTable">
                @if(count($exercises) > 0)
                <?php $id = 1 ?>
                @foreach($exercises as $db)
                    <tr align="center" id="Exercise{{$db->id}}">
                        <td>{{$id++}}</td>
                        <td>{{$db->theoryGroup->name}}</td>
                        <td>{{$db->name}}</td>
                        <td>{!! $db->content !!}</td>
                        <td>{{$db->levels->name}}</td>
                        <td>
                            <ul class="list-inline">
                                <li>
                                    <a href="#"><i class="fa fa-info btn-detailExercise btn-info style-css"
                                                   data-id="{{$db->id}}" aria-hidden="true" title="Xem Chi Tiết Bài Tập""></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-pencil-square-o btn-warning btn-editExercise style-css"
                                                   data-id="{{$db->id}}" aria-hidden="true"
                                                   title="Sửa Bài Tập"></i></a>
                                </li>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <li>
                                    <a href="#"><i class="fa fa-trash-o btn-danger btn-delExercise style-css"
                                                   data-id="{{$db->id}}" aria-hidden="true" title="Xóa Bài Tập""></i>
                                    </a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="6">( ! không có bản ghi nào ! )</td>
                </tr>
                @endif
                </tbody> 
            </table>  
                @if ($flag)
                <div class="pagination " style="float:right; ">
                    {!!$exercises->render() !!}
                </div>
                @endif
            </div>    
        </div>
    </div>

     <div class="modal fade bs-modal-lg" id="createExercisesModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" id="themmoi">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thêm Mới</h4>
                </div>
                <div class="modal-body">
                    <form id="frmCreateExercises" name="frmCreateExercises" class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="name">Nhóm Lý Thuyết</label>
                                <div class="col-sm-8">
                                   <select name="theory_group_id" class="form-control" id="theory_group_id">
                                   @foreach($theoryGroup as $db)
                                        <option value="{{ $db->id }}">{{ $db->name }}</option>
                                    @endforeach
                                   </select>
                                   <p style="color:red;display:none" class="error errorTheoryGroupId"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-sm-3 control-label" for="name">Tên Bài Tập</label>
                                <div class="col-sm-8">
                                    <input class="style-formEdit form-control" id="name" name="name"
                                           placeholder="Tên Nhóm Lý Thuyết" type="text"/>
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
                                <label  class="col-sm-3 control-label" for="name">Độ Khó</label>
                                <div class="col-sm-8">
                                   <select name="level_id" class="form-control" id="level_id">
                                   @foreach($levels as $db)
                                        <option value="{{ $db->id }}">{{ $db->name }}</option>
                                    @endforeach
                                   </select>
                                   <p style="color:red;display:none" class="error errorLevel_id"></p>
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

    <div class="modal fade bs-modal-lg" id="editExerciseModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" id="sua">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Sửa</h4>
                </div>
                <div class="modal-body">
                    <form id="frmEditExercise" name="frmEditExercise" class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group form-md-line-input">
                                    <label  class="col-sm-3 control-label" for="name">Nhóm Lý Thuyết</label>
                                    <div class="col-sm-8">
                                       <select name="theory_group_id" id="editTheory_group" class="form-control">
                                       @foreach($theoryGroup as $db)
                                          <option value="{{ $db->id }}">{{ $db->name }}</option>
                                        @endforeach
                                       </select>
                                       <p style="color:red;display:none" class="error errorTheoryGroup"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-sm-3 control-label" for="name">Tên Bài Tập</label>
                                    <div class="col-sm-8">
                                        <input class="style-formEdit form-control" id="editName"
                                               name="name" placeholder="" type="text"/>
                                        <input class="style-formEdit form-control" id="editID"
                                               name="editID" placeholder="" type="hidden"/>
                                        <p style="color:red;display:none" class="error errorName"></p>
                                    </div>
                                    <div class="col-sm-1 requireds">(*)</div>
                                </div> 
                                 
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label">Nội Dung</label>
                                <div class="col-sm-8">
                                <textarea class="form-control summernote" id="editContent" name="content"></textarea>
                                <p style="color:red;display:none" class="error errorContent"></p>
                                </div>   
                            </div>
                            <div class="form-group form-md-line-input">
                                    <label  class="col-sm-3 control-label" for="name">Độ Khó</label>
                                    <div class="col-sm-8">
                                       <select name="level_id" id="editLevels_id" class="form-control">
                                       @foreach($levels as $db)
                                          <option value="{{ $db->id }}">{{ $db->name }}</option>
                                        @endforeach
                                       </select>
                                       <p style="color:red;display:none" class="error errorLevels"></p>
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
    $('#frmCreateExercises').validate({
        errorElement : "span",
        rules: {
            theory_group_id : {
                required: true, 
            },
            name : {
                required: true, 
            },
            level_id : {
                required: true,
            }
        },
        messages: {
            theory_group_id : {
                required: "Bạn vui lòng chọn nhóm lý thuyết", 
            },
            name : {
                required: "Bạn vui lòng nhập tên bài tập", 
            },
            level_id : {
                required: "Bài vui lòng chọn độ khó",
            }
        }
    });
    $('#frmEditExercise').validate({
        errorElement : "span",
        rules: {
            theory_group_id : {
                required: true, 
            },
            name : {
                required: true, 
            },
            level_id : {
                required: true,
            }
        },
        messages: {
            theory_group_id : {
                required: "Bạn vui lòng chọn nhóm lý thuyết", 
            },
            name : {
                required: "Bạn vui lòng nhập tên bài tập", 
            },
            level_id : {
                required: "Bài vui lòng chọn độ khó",
            }
        }
    });
</script>       
@endsection
@section('footer')
 <script src="{{url('js/curd-Exercises.js')}}" type="text/javascript"></script>
@endsection


