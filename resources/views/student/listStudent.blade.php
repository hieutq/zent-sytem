@extends('layouts.master')
@section('contents')
<style type="text/css" media="screen">
   .error{
   color: red;
   display: show;
   }

</style>
<div class="portlet light bordered">
	<div class="portlet-body">
	    <div class="table-toolbar">
	      <div class="row">
	        <div class="col-md-6">
	        </div>
	        <div class="col-md-12">
            <ul class="list-inline">
  	          <li class="btn-group col-md-6 pull-left">
                <button id="AddBtn" class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Thêm
                <i class="fa fa-plus"></i>
                </button>
  	          </li>
              <li class="col-md-6 text-center pull-right">
                <form method="get" action="">
                  <input type="text" class="search-class form-control " id="search"  name="search"  placeholder="Nhập Thông Tin Tìm Kiếm">
                </form>
              </li>
            </ul>
	        </div>
	      </div>
	    </div>
      <div id="repalceTable" class="row table-responsive">
  	    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
  	      <thead>
  	          <tr>
  	              <th class="stl-column color-column">ID</th>
  	              <th class="stl-column color-column">Họ Tên </th>
  	              <th class="stl-column color-column">Số Điện Thoại</th>
  	              <th class="stl-column color-column">Email</th>
                  <th class="stl-column color-column">Ngày Tạo</th>                         
  	              <th class="stl-column color-column">  
  	                 Hành Động
  	              </th>
  	          </tr>
  	      </thead>

  	      <tbody id="tbodyTable">
          @if (count($students)>0)
          <?php $id=1 ?>
  	      @foreach($students as $db)
  		          <tr align="center" id="Student{{$db->id}}">
  		              <td>{{$id++}}</td>
  		              <td>{{$db->name}}</td>
  		              <td>{{$db->mobile}}</td>  
  		              <td><a href="{{$db->email}}">{{$db->email}}</a></td>
                    <td>{{$db->created_at}}</td>
  		              <td>
  		              <ul class="list-inline">
  		                  <li>
  		                      <a href="#"><i class="fa fa-pencil-square-o btn-warning btn-editStudent style-css" data-id="{{$db->id}}" aria-hidden="true" title="Sửa Thông Tin User"></i></a>
  		                  </li>
  		                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  		                  <li>
  		                      <a href="#"><i class="fa fa-trash-o btn-danger btn-delStudent style-css" data-id="{{$db->id}}" aria-hidden="true" title="Xóa User"></i> </a>
  		                  </li>
  		              </ul> 
  		              </td> 
  		          </tr>
  	  	   @endforeach
          @else
            <tr>
              <td colspan="6" align="center"><em>(Không có bản ghi nào)</em></td>
            </tr>
          @endif 
  	      </tbody>
  	    </table>
          @if ($flag)
          <div class="pagination" style="float:right">
              {!!$students->render() !!}
          </div>
          @endif
      </div>
    </div>
      
    
</div>
<div class="modal fade bs-modal-lg" id="createStudentModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" id="themmoi">
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	            <h4 class="modal-title">Thêm Mới</h4>
	        </div>
	        <div class="modal-body">
	        	<form id="frmCreateStudent" name="frmCreateStudent" method="POST" class="form-horizontal" role="form">
                    {{ csrf_field() }}
                    <div class="row">
                    	<div class="col-sm-12">
                    		<div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="name">Họ Tên</label>
                                <div class="col-sm-8">
                                   <input class="style-formEdit form-control valName" id="name"  name="name" placeholder="Nhập Họ Tên" type="text"/>
                                   <p style="color:red;display:none" class="error errorName "></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="mobile">Số điện thoại</label>
                                <div class="col-sm-8">
                                   <input class="style-formEdit form-control mobile" id="mobile"  name="mobile" placeholder="Nhập số điện thoại" type="text"/>
                                   <p style="color:red;display:none" class="error errorMobile "></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
							              <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="email">Email</label>
                                <div class="col-sm-8">
                                   <input class="style-formEdit form-control email" id="email"  name="email" placeholder="Nhập địa chỉ Email" type="email"/>
                                   <p style="color:red;display:none" class="error errorEmail"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
							              <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="password">Mật Khẩu</label>
                                <div class="col-sm-8">
                                   <input class="style-formEdit form-control" id="password" name="password" placeholder="Nhập mật khẩu" type="password"/>
                                   <p style="color:red;display:none" class="error errorPassword errorValPassword"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
							              <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="gender">Giới Tính</label>
                                <div class="col-sm-8">
                                   <select class="form-control gender" name="gender" id="gender" >
                                   		<option value="1">Nam</option>
                                   		<option value="2">Nữ</option>
                                   </select>
                                   <p style="color:red;display:none" class="error errorGender"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
							              <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="birthday">Ngày Sinh</label>
                                <div class="col-sm-8">
                                   <input class="style-formEdit form-control birthday" id="birthday" name="birthday" placeholder="Nhập ngày sinh" type="text"/>
                                   <p style="color:red;display:none" class="error errorBirthday"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="facebook">Facebook</label>
                                <div class="col-sm-8">
                                   <input class="style-formEdit form-control" id="facebook" name="facebook" placeholder="Nhập địa chỉ Facebook VD: https://www.facebook.com/" type="text"/>
                                   <p style="color:red;display:none" class="error errorFacebook errorValFacebook"></p>
                                </div>
                                
                            </div>
							              <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="skype">Skype</label>
                                <div class="col-sm-8">
                                   <input class="style-formEdit form-control" id="skype" name="skype" placeholder="Nhập địa chỉ Skype" type="text"/>
                                   <p style="color:red;display:none" class="error errorskype"></p>
                                </div>
                                
                            </div>
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="address">Địa Chỉ</label>
                                <div class="col-sm-8">
                                   <input class="style-formEdit form-control" id="address" name="address" placeholder="Nhập địa chỉ" type="text"/>
                                   <p style="color:red;display:none" class="error erroraddress"></p>
                                </div>
                                
                            </div>
							                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="school">Trường Học</label>
                                <div class="col-sm-8">
                                   <input class="style-formEdit form-control" id="school" name="school" placeholder="Nhập Trường Học" type="text"/>
                                   <p style="color:red;display:none" class="error errorschool"></p>
                                </div>
                                
                            </div>
							              <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="status">Trạng Thái</label>
                                <div class="col-sm-8">
                                   <select class="form-control" name="status" id="status" class="status">
                                   		<option value="1">Đang mở</option>
                                   		<option value="2">Đã Đóng</option>
                                   </select>
                                   <p style="color:red;display:none" class="error errorStatus errorValStatus"></p>
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
                        Thêm Mới
                        </button>
                    </div>
                </form>
	        </div>
		</div>
	</div>
</div>
<div class="modal fade bs-modal-lg" id="editStudentModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="themmoi">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
              <h4 class="modal-title">Sửa</h4>
          </div>
          <div class="modal-body">
            <form id="frmEditStudent" name="frmEditStudent" class="form-horizontal" role="form">
                    {{ csrf_field() }}
                    <div class="row">
                      
                      <div class="col-sm-12">
                        <div class="form-group form-md-line-input">

                                <label  class="col-sm-3 control-label" for="name">Họ Tên</label>
                                <div class="col-sm-8">
                                   <input class="style-formEdit form-control" value=""  id="editName" class="name" name="name" placeholder="Nhập họ tên" type="text" />
                                   <p style="color:red;display:none" class="error errorName"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="mobile">Số Điện Thoại</label>
                                <div class="col-sm-8">
                                   <input class="style-formEdit form-control mobile" id="editMobile" class="mobile" name="mobile" placeholder="Nhập Số điện thoại" type="text"/>
                                   <p style="color:red;display:none" class="error errorMobile"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>              
                            </div>
                           <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="email">Email</label>
                                <div class="col-sm-8">
                                   <input class="style-formEdit form-control editEmail" id="editEmail" data-id="" class="email" name="email" placeholder="Nhập địa chỉ Email" type="email"/>
                                   <input type="hidden" class="form-control has-error" id="editID" name="editID" value="">
                                   <input class="style-formEdit form-control" id="editPassword" name="password" placeholder="Nhập mật khẩu" type="hidden"/>
                                   <p style="color:red;display:none" class="error errorEmail"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="editgender">Giới Tính</label>
                                <div class="col-sm-8">
                                   <select class="form-control" id="editGender" class="gender" name="gender" id="">
                                      <option value="1">Nam</option>
                                      <option value="2">Nữ</option>
                                   </select>
                                   <p style="color:red;display:none" class="error errorGender"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="birthday">Ngày Sinh</label>
                                <div class="col-sm-8">
                                   <input class="style-formEdit form-control" id="editBirthday" class="birthday" name="birthday" placeholder="Nhập ngày sinh" type="text"/>
                                   <p style="color:red;display:none" class="error errorBirthday"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="facebook">Facebook</label>
                                <div class="col-sm-8">
                                   <input class="style-formEdit form-control" id="editFacebook" class="facebook" name="facebook" placeholder="Nhập địa chỉ Facebook VD: https://www.facebook.com/" type="text"/>
                                   <p style="color:red;display:none" class="error errorFacebook"></p>
                                </div>
                                
                            </div>
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="skype">Skype</label>
                                <div class="col-sm-8">
                                   <input class="style-formEdit form-control" id="editSkype" name="skype" placeholder="Nhập địa chỉ Skype" type="text"/>
                                   <p style="color:red;display:none" class="error errorskype"></p>
                                </div>
                                
                            </div>
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="address">Địa Chỉ</label>
                                <div class="col-sm-8">
                                   <input class="style-formEdit form-control" id="editAddress" name="address" placeholder="nhập đỉa chỉ" type="text"/>
                                   <p style="color:red;display:none" class="error erroraddress"></p>
                                </div>
                                
                            </div>
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="school">Trường Học</label>
                                <div class="col-sm-8">
                                   <input class="style-formEdit form-control" id="editSchool" name="editSchool" placeholder="Nhập tên Trường Học" type="text"/>
                                   <p style="color:red;display:none" class="error errorschool"></p>
                                </div>
                                
                            </div>
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="editstatus">Trạng Thái</label>
                                <div class="col-sm-8">
                                   <select class="form-control" id="editStatus" name="status" class="status">
                                      <option value="1">Đang mở</option>
                                      <option value="2">Đã Đóng</option>
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
  <script type="text/javascript">
  jQuery.validator.addMethod("phoneUS", function (phone_number, element) {
            phone_number = phone_number.replace(/\s+/g, "");
            return this.optional(element) || phone_number.length > 9 &&
                  phone_number.match(/^(\(?(0|\+84)[1-9]{1}\d{1,4}?\)?\s?\d{3,4}\s?\d{3,4})$/);
        }, "Invalid phone number");
    $('#frmCreateStudent').validate({
      errorElement: "span",
        rules: {
          name : {
            required: true,
          },
          mobile : {
            required:true,
            minlength : 9,
            phoneUS   : true,
            number    : true,
          },
          email : {
            required:true,
            email : true,
          },
          password : {
            required:true,
            minlength : 6,
          },
          birthday : {
            required:true,
            date: true,
          },
          facebook : {
            url : true,
          },
          status : {
            required : true,
          },
        },
        messages: {
          name : {
            required: "Bạn vui lòng nhập họ tên",
          },
          mobile : {
            required:"Bạn vui lòng nhập số điện thoại",
            minlength : "Số điện thoại tối thiểu 9 số",
            phoneUS   : "Số điện thoại không đúng định dạng VD:(0|+84)999 999 999",
            number : "ký tự nhập vào phải là kiểu số",
          },
          email : {
            required:"Bạn vui lòng nhập địa chỉ email",
            email : "Email không đúng định dạng. VD: xyz@gmail.com",
          },
          password : {
            required:"Bạn vui lòng nhập password",
            minlength : "Mật khẩu tối thiểu 6 ký tự",
          },
          birthday : {
            required:"Bạn vui lòng chọn ngày sinh",
            date: true,
          },
          facebook : {
            url : "Link facebook không đúng định dạngv VD:'http://google.com'",
          },
          status : {
            required : "Bạn vui lòng chọn trạng thái",
          },
        }
    });
    $('#frmEditStudent').validate({
      errorElement: "span",
        rules: {
          name : {
            required: true,
          },
          mobile : {
            required:true,
            minlength : 9,
            phoneUS   : true,
          },
          email : {
            required:true,
            email : true,
          },
          birthday : {
            required:true,
            date: true,
          },
          facebook : {
            url : true,
          },
          status : {
            required : true,
          },
        },
        messages: {
          name : {
            required: "Bạn vui lòng nhập họ tên",
          },
          mobile : {
            required:"Bạn vui lòng nhập số điện thoại",
            minlength : "Số điện thoại tối thiểu 9 số",
            phoneUS   : "Số điện thoại không đúng định dạng",
          },
          email : {
            required:"Bạn vui lòng nhập địa chỉ email",
            email : "Email không đúng định dạng. VD: xyz@gmail.com",
          },
          birthday : {
            required:"Bạn vui lòng chọn ngày sinh",
            date: "Bạn vui lòng nhập đúng ngày sinh",
          },
          facebook : {
            url : "Link facebook không đúng định dạngv VD:'http://google.com'",
          },
          status : {
            required : "Bạn vui lòng chọn trạng thái",
          },
        }
    });
  </script>
@endsection
@section('footer')
 <script src="{{url('js/curd-student.js')}}" type="text/javascript"></script>
@endsection