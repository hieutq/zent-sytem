@extends('layouts.master')
@section('contents')
<style>
    .error{
        color:red;
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
                            <button id="addBtnTheoryGroup" class="btn green  btn-outline dropdown-toggle"
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
            <div id="repalceTable" class="row">
            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                <thead>
                <tr>
                    <th class="stl-column color-column">#</th>
                    <th class="stl-column color-column">Tên Nhóm Lý Thuyết</th>
                    <th class="stl-column color-column">
                        Hành Động
                    </th>
                </tr>
                </thead>
               
                <tbody id="tbodyTable">
                <?php $id = 1 ?>
                @foreach($theoryGroup as $db)
                    <tr align="center" id="TheoryGroup{{$db->id}}">
                        <td>{{$id++}}</td>
                        <td>{{$db->name}}</td>

                        <td>
                            <ul class="list-inline">
                                <li>
                                    <a href="#"><i class="fa fa-pencil-square-o btn-warning btn-editTheoryGroup style-css"
                                                   data-id="{{$db->id}}" aria-hidden="true"
                                                   title="Sửa Thông Tin Nhóm Lý Thuyết"></i></a>
                                </li>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <li>
                                    <a href="#"><i class="fa fa-trash-o btn-danger btn-delTheoryGroup style-css"
                                                   data-id="{{$db->id}}" aria-hidden="true" title="Xóa Nhóm Lý Thuyết""></i>
                                    </a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
                
                </tbody>
                
                
            </table>  
            @if ($flag)
            <div class="pagination " style="float:right; ">
                {!!$theoryGroup->render() !!}
            </div>
            @endif
            </div>    
        </div>
    </div>

    <div class="modal fade bs-modal-lg" id="createTheoryGroupModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" id="themmoi">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thêm Mới</h4>
                </div>
                <div class="modal-body">
                    <form id="frmCreateTheoryGroup" name="frmCreateTheoryGroup" class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        <div class="row">

                            <div class="form-group form-md-line-input">
                                <label class="col-sm-3 control-label" for="name">Tên</label>
                                <div class="col-sm-8">
                                    <input class="style-formEdit form-control" id="name" name="name"
                                           placeholder="Tên Nhóm Lý Thuyết" type="text"/>
                                    <p style="color:red;display:none" class="error errorName"></p>
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

    <div class="modal fade bs-modal-lg" id="editTheoryGroupModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" id="sua">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Sửa</h4>
                </div>
                <div class="modal-body">
                    <form id="frmEditTheoryGroup" name="frmEditTheoryGroup" class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group form-md-line-input">
                                    <label class="col-sm-3 control-label" for="name">Tên Nhóm Lý Thuyết</label>
                                    <div class="col-sm-8">
                                        <input class="style-formEdit form-control" id="editName"
                                               name="name" placeholder="" type="text"/>
                                        <input class="style-formEdit form-control" id="editID"
                                               name="editID" placeholder="" type="hidden"/>
                                        <p style="color:red;display:none" class="error errorName"></p>
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
    $('#frmCreateTheoryGroup').validate({
      errorElement: "span",
        rules: {
          name : {
            required: true,
          }
        },
        messages: {
          name : {
            required: "Bạn vui lòng nhập tên nhóm lý thuyết",
          }
        }
    });
    $('#frmEditTheoryGroup').validate({
      errorElement: "span",
        rules: {
          name : {
            required: true,
          }
        },
        messages: {
          name : {
            required: "Bạn vui lòng nhập tên nhóm lý thuyết",
          }
        }
    });
</script>
@endsection
@section('ajax-TheoryGroup')
    <script src="{{url('js/curd-TheoryGroup.js')}}" type="text/javascript"></script>
@endsection


