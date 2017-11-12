@extends('layouts.master')
@section('contents')
    <div id ="portlet-body" class="portlet light bordered">
        <div class="portlet-body">
            <div class="table-toolbar">
                <div class="row">
                    <div class="col-md-3 text-right" id="timkiem" style="color:#0099FF"><h4><b></b></h4></div>
                   
                    <div class="col-md-12">

                        <div class="btn-group pull-left">
                            <button id="addBtnClassRoom" class="btn green  btn-outline dropdown-toggle"
                                    data-toggle="dropdown">Thêm
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <div class="col-md-6 text-center">
                        <form method="get" action="">
                        <input type="text" class="search-class form-control " id="search"  name="search"  placeholder="Nhập Thông Tin Tìm Kiếm">
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="repalceTable" class="row">
            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="content_class_room">
                <thead>
                <tr>
                    <th class="stl-column color-column">ID</th>
                    <th class="stl-column color-column">Tên Lớp Học</th>
                    <th class="stl-column color-column">Tên Viết Tắt</th>
                    <th class="stl-column color-column">Học Phí</th>
                    <th class="stl-column color-column">
                        Hành Động
                    </th>
                </tr>
                </thead>
               <!--  @if (count($classR) > 0 ) -->
               
                <tbody id="tbodyTable">
                <?php $id = 1 ?>
                @foreach($classR as $db)
                    <tr align="center" id="ClassRoom{{$db->id}}">
                        <td>{{$id++}}</td>
                        <td>{{$db->class_name}}</td>
                        <td>{{$db->code}}</td>
                        <td>{{number_format($db->tuition)}}</td>

                        <td>
                            <ul class="list-inline">
                                <li>
                                    <a href="#"><i class="fa fa-info btn-detailClassRoom btn-info style-css"
                                                   data-id="{{$db->id}}" aria-hidden="true" title="Xem Chi tiết Lớp Học""></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-pencil-square-o btn-warning btn-editClassRoom style-css"
                                                   data-id="{{$db->id}}" aria-hidden="true"
                                                   title="Sửa Thông Tin Lớp Học"></i></a>
                                </li>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <li>
                                    <a href="#"><i class="fa fa-trash-o btn-danger btn-delClassRoom style-css"
                                                   data-id="{{$db->id}}" aria-hidden="true" title="Xóa Lớp Học""></i>
                                    </a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
                
                </tbody>
                
                
                 <!-- @else
                <tr>
                    <td colspan="5" class="text-center">Hiện tại không có bản ghi nào</td>
                </tr>
                @endif -->
            </table>  
            @if ($flag)
            <div class="pagination " style="float:right; ">
                {!!$classR->render() !!}
            </div>
            @endif
            </div>    
        </div>
    </div>
    <div class="modal fade bs-modal-lg" id="createClassRoomModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" id="themmoi">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thêm Mới</h4>
                </div>
                <div class="modal-body">
                    <form id="frmCreateClassRoom" name="frmCreateClassRoom" class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        <div class="row">

                            <div class="form-group form-md-line-input">
                                <label class="col-sm-3 control-label" for="code">Mã Lớp</label>
                                <div class="col-sm-8">
                                    <input class="style-formEdit form-control" id="code" name="code"
                                           placeholder="Mã Lớp" type="text"/>
                                    <p style="color:red;display:none" class="error errorCode"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-sm-3 control-label" for="class_name">Tên Lớp</label>
                                <div class="col-sm-8">
                                    <input class="style-formEdit form-control" id="class_name" name="class_name"
                                           placeholder="Tên Lớp" type="text"/>
                                    <p style="color:red;display:none" class="error errorClass_name"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>

                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-sm-3 control-label" for="orientation_time">Ngày Khai Giảng</label>
                                <div class="col-sm-8">
                                    <input class="style-formEdit form-control" id="orientation_time"
                                           name="orientation_time" placeholder="Nhập ngày " type="text"/>
                                    <p style="color:red;display:none" class="error errorOrientation_time"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-sm-3 control-label" for="time_table">Ngày Học</label>
                                <div class="col-sm-8">
                                    <input class="style-formEdit form-control" id="time_table" name="time_table"
                                           placeholder="Nhập ngày " type="text"/>
                                    <p style="color:red;display:none" class="error errorTime_table"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-sm-3 control-label" for="number_of_unit">Số Buổi Học</label>
                                <div class="col-sm-8">
                                    <input class="style-formEdit form-control" id="number_of_unit" name="number_of_unit"
                                           placeholder="Nhập  Số Buổi Học" type="text"/>
                                    <p style="color:red;display:none" class="error errorNumber_of_unit"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-sm-3 control-label" for="tuition">Học Phí</label>
                                <div class="col-sm-8">
                                    <input class="style-formEdit form-control" id="tuition" name="tuition"
                                           placeholder="Nhập Học Phí" type="text"/>
                                    <p style="color:red;display:none" class="error errorTuition"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>


                            <div class="form-group form-md-line-input">
                                <label class="col-sm-3 control-label " for=" id=""">Khóa Học</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="course_id" id="course_id">
                                        <option value="">---Chọn---</option>
                                        @foreach($course as $db)
                                            <option value="{{$db->id}}">{{$db->name}}</option>
                                        @endforeach
                                    </select>

                                    <p style="color:red;display:none" class="error errorCourse_id"></p>
                                </div>

                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-sm-3 control-label" for="icon">Icon</label>
                                <div class="col-sm-8">
                                    <input class="style-formEdit form-control" id="icon" name="icon" placeholder=""
                                           type="text"/>
                                    <p style="color:red;display:none" class="error errorIcon"></p>
                                </div>

                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-sm-3 control-label" for="tuition_policy">Chính Sách Học Phí</label>
                                <div class="col-sm-8">
                                    <input class="style-formEdit form-control" id="tuition_policy" name="tuition_policy"
                                           placeholder="" type="text"/>
                                    <p style="color:red;display:none" class="error errorTuition_policy"></p>
                                </div>

                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-sm-3 control-label" for="max_tuition_policy">Học Phí Giảm Tối Đa</label>
                                <div class="col-sm-8">
                                    <input class="style-formEdit form-control" id="max_tuition_policy"
                                           name="max_tuition_policy" placeholder="" type="text"/>
                                    <p style="color:red;display:none" class="error errorMax_tuition_policy"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-sm-3 control-label" for="policy">Chính Sách Lớp Học</label>
                                <div class="col-sm-8">
                                    <input class="style-formEdit form-control" id="policy" name="policy" placeholder=""
                                           type="text"/>
                                    <p style="color:red;display:none" class="error errorPolicy"></p>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-sm-3 control-label" for="facebook_group">Facebook Lớp</label>
                                <div class="col-sm-8">
                                    <input class="style-formEdit form-control" id="facebook_group" name="facebook_group"
                                           placeholder="" type="text"/>
                                    <p style="color:red;display:none" class="error errorFacebook_group"></p>
                                </div>

                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-sm-3 control-label" for="status">Trạng Thái</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="status" id="">
                                        <option value="">---Chọn---</option>
                                        <option value="0">Chuẩn Bị Khai Giảng</option>
                                        <option value="1">Đã Khai Giảng</option>
                                        <option value="2">Đã Kết Thúc</option>
                                        <option value="1">Đã Nghiệm Thu</option>
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
    <div class="modal fade bs-modal-lg" id="editClassModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" id="sua">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Sưa</h4>
                </div>
                <div class="modal-body">
                    <form id="frmEditClass" name="frmEditClass" class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group form-md-line-input">

                                    <label class="col-sm-3 control-label" for="code">Mã Lớp</label>
                                    <div class="col-sm-8">
                                        <input class="style-formEdit form-control" value="" id="editCode"
                                               name="editCode" placeholder="" type="text"/>
                                        <input type="hidden" class="form-control has-error" id="editID" name="editID"
                                               value="">
                                        <p style="color:red;display:none" class="error errorCode"></p>
                                    </div>
                                    <div class="col-sm-1 requireds">(*)</div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-sm-3 control-label" for="class_name">Tên Lớp</label>
                                    <div class="col-sm-8">
                                        <input class="style-formEdit form-control" id="editClass_name"
                                               name="editClass_name" placeholder="" type="text"/>
                                        <p style="color:red;display:none" class="error errorClass_name"></p>
                                    </div>
                                    <div class="col-sm-1 requireds">(*)</div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-sm-3 control-label" for="orientation_time">Thời Gian</label>
                                    <div class="col-sm-8">
                                        <input class="style-formEdit form-control" id="editOrientation_time"
                                               name="editOrientation_time" placeholder="" type="text"/>
                                        <p style="color:red;display:none" class="error errorOrientation_time"></p>
                                    </div>
                                    <div class="col-sm-1 requireds">(*)</div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-sm-3 control-label" for="time_table">Thời Gian Học</label>
                                    <div class="col-sm-8">
                                        <input class="style-formEdit form-control" id="editTime_table"
                                               name="editTime_table" placeholder="" type="text"/>
                                        <p style="color:red;display:none" class="error errorTime_table"></p>
                                    </div>
                                    <div class="col-sm-1 requireds">(*)</div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="col-sm-3 control-label" for="number_of_unit">Số Buổi Học</label>
                                    <div class="col-sm-8">
                                        <input class="style-formEdit form-control" id="editNumber_of_unit"
                                               name="editNumber_of_unit" placeholder="" type="text"/>
                                        <p style="color:red;display:none" class="error errorNumber_of_unit"></p>
                                    </div>
                                    <div class="col-sm-1 requireds">(*)</div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-sm-3 control-label" for="course_id">Khóa Học</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="editCourse_id" name="editCourse_id">
                                            @foreach($course as $db)
                                                <option value="{{$db->id}}">{{$db->name}}</option>
                                            @endforeach
                                        </select>
                                        <p style="color:red;display:none" class="error errorCourse_id"></p>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-sm-3 control-label" for="tuition">Học Phí</label>
                                    <div class="col-sm-8">
                                        <input class="style-formEdit form-control" id="editTuition" name="editTuition"
                                               placeholder="" type="text"/>
                                        <p style="color:red;display:none" class="error errorTuition"></p>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-sm-3 control-label" for="icon">Icon</label>
                                    <div class="col-sm-8">
                                        <input class="style-formEdit form-control" id="editIcon" name="editIcon"
                                               placeholder="" type="text"/>
                                        <p style="color:red;display:none" class="error errorIcon"></p>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-sm-3 control-label" for="tuition_policy">Chính Sách Giảm Học
                                        phí</label>
                                    <div class="col-sm-8">
                                        <input class="style-formEdit form-control" id="editTuition_policy"
                                               name="editTuition_policy" placeholder="" type="text"/>
                                        <p style="color:red;display:none" class="error errorTuition_policy"></p>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-sm-3 control-label" for="max_tuition_policy">Mức Giảm Tối
                                        Đa</label>
                                    <div class="col-sm-8">
                                        <input class="style-formEdit form-control" id="editMax_tuition_policy"
                                               name="editMax_tuition_policy" placeholder="" type="text"/>
                                        <p style="color:red;display:none" class="error errorMax_tuition_policy"></p>
                                    </div>
                                    <div class="col-sm-1 requireds">(*)</div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-sm-3 control-label" for="policy">Chính Sách Lớp Học</label>
                                    <div class="col-sm-8">
                                        <input class="style-formEdit form-control" id="editPolicy" name="editPolicy"
                                               placeholder="" type="text"/>
                                        <p style="color:red;display:none" class="error errorPolicy"></p>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-sm-3 control-label" for="facebook_group">Facebook Lớp</label>
                                    <div class="col-sm-8">
                                        <input class="style-formEdit form-control" id="editFacebook_group"
                                               name="editFacebook_group" placeholder="" type="text"/>
                                        <p style="color:red;display:none" class="error errorFacebook_group"></p>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-sm-3 control-label" for="editstatus">Trạng Thái</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="editStatus" name="editStatus" id="">
                                            <option value="">---Chọn---</option>
                                            <option value="0">Chuẩn Bị Khai Giảng</option>
                                            <option value="1">Đã Khai Giảng</option>
                                            <option value="2">Đã Kết Thúc</option>
                                            <option value="1">Đã Nghiệm Thu</option>
                                        </select>
                                        <p style="color:red;display:none" class="error errorStatus"></p>
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

    <div class="modal fade bs-modal-lg" id="detailClassModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" id="sua">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Chi Tiết</h4>
                </div>
                <div class="modal-body">
                    <form id="frmShowClass" name="frmShowClass" class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group form-md-line-input">

                                    <label class="col-sm-3 control-label" for="code">Mã Lớp</label>
                                    <div class="col-sm-8">
                                        <input class="style-formEdit form-control" value="" id="detailCode"
                                               name="editCode" placeholder="" type="text"/>
                                        <input type="hidden" class="form-control has-error" id="editID" name="detailID"
                                               value="">
                                        <p style="color:red;display:none" class="error errorCode"></p>
                                    </div>
                                    <div class="col-sm-1 requireds">(*)</div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-sm-3 control-label" for="class_name">Tên Lớp</label>
                                    <div class="col-sm-8">
                                        <input class="style-formEdit form-control" id="detailClass_name"
                                               name="detailClass_name" placeholder="" type="text"/>
                                        <p style="color:red;display:none" class="error errorClass_name"></p>
                                    </div>
                                    <div class="col-sm-1 requireds">(*)</div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-sm-3 control-label" for="orientation_time">Thời Gian</label>
                                    <div class="col-sm-8">
                                        <input class="style-formEdit form-control" id="detailOrientation_time"
                                               name="detailtOrientation_time" placeholder="" type="text"/>
                                        <p style="color:red;display:none" class="error errorOrientation_time"></p>
                                    </div>
                                    <div class="col-sm-1 requireds">(*)</div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-sm-3 control-label" for="time_table">Thời Gian Học</label>
                                    <div class="col-sm-8">
                                        <input class="style-formEdit form-control" id="detailTime_table"
                                               name="detailTime_table" placeholder="" type="text"/>
                                        <p style="color:red;display:none" class="error errorTime_table"></p>
                                    </div>
                                    <div class="col-sm-1 requireds">(*)</div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="col-sm-3 control-label" for="number_of_unit">Số Buổi Học</label>
                                    <div class="col-sm-8">
                                        <input class="style-formEdit form-control" id="detailNumber_of_unit"
                                               name="detailNumber_of_unit" placeholder="" type="text"/>
                                        <p style="color:red;display:none" class="error errorNumber_of_unit"></p>
                                    </div>
                                    <div class="col-sm-1 requireds">(*)</div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-sm-3 control-label" for="course_id">Khóa Học</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="detailCourse_id" name="detailCourse_id">
                                            @foreach($course as $db)
                                                <option value="{{$db->id}}">{{$db->name}}</option>
                                            @endforeach
                                        </select>
                                        <p style="color:red;display:none" class="error errorCourse_id"></p>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-sm-3 control-label" for="tuition">Học phí</label>
                                    <div class="col-sm-8">
                                        <input class="style-formEdit form-control" id="detailTuition" name="detailTuition"
                                               placeholder="" type="text"/>
                                        <p style="color:red;display:none" class="error errorTuition"></p>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-sm-3 control-label" for="icon">Icon</label>
                                    <div class="col-sm-8">
                                        <input class="style-formEdit form-control" id="detailIcon" name="detailIcon"
                                               placeholder="" type="text"/>
                                        <p style="color:red;display:none" class="error errorIcon"></p>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-sm-3 control-label" for="tuition_policy">Chính Sách Giảm Học
                                        phí</label>
                                    <div class="col-sm-8">
                                        <input class="style-formEdit form-control" id="detailTuition_policy"
                                               name="detailTuition_policy" placeholder="" type="text"/>
                                        <p style="color:red;display:none" class="error errorTuition_policy"></p>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-sm-3 control-label" for="max_tuition_policy">Mức Giảm Tối
                                        đa</label>
                                    <div class="col-sm-8">
                                        <input class="style-formEdit form-control" id="detailMax_tuition_policy"
                                               name="detailMax_tuition_policy" placeholder="" type="text"/>
                                        <p style="color:red;display:none" class="error errorMax_tuition_policy"></p>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-sm-3 control-label" for="policy">Mức Giảm Tối Đa</label>
                                    <div class="col-sm-8">
                                        <input class="style-formEdit form-control" id="detailPolicy" name="detailPolicy"
                                               placeholder="" type="text"/>
                                        <p style="color:red;display:none" class="error errorPolicy"></p>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-sm-3 control-label" for="facebook_group">Facebook Lớp</label>
                                    <div class="col-sm-8">
                                        <input class="style-formEdit form-control" id="detailFacebook_group"
                                               name="detailFacebook_group" placeholder="" type="text"/>
                                        <p style="color:red;display:none" class="error errorFacebook_group"></p>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-sm-3 control-label" for="editstatus">Trạng Thái</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="detailStatus" name="detailStatus" id="">
                                            <option value="">---Chọn---</option>
                                            <option value="0">Chuẩn Bị Khai Giảng</option>
                                            <option value="1">Đã Khai Giảng</option>
                                            <option value="2">Đã Kết Thúc</option>
                                            <option value="1">Đã Nghiệm Thu</option>
                                        </select>
                                        <p style="color:red;display:none" class="error errorStatus"></p>
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script src="{{url('js/curd-ClassRoom.js')}}" type="text/javascript"></script>
@endsection


