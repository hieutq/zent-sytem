<div class="modal fade bs-modal-lg" id="editStudentModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" id="themmoi">
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	            <h4 class="modal-title">Thêm Mới</h4>
	        </div>
	        <div class="modal-body">
	        	<form id="frmEditStudent" name="frmEditStudent" class="form-horizontal" role="form">
                    {{ csrf_field() }}
                    <div class="row">
                    	
                    	<div class="col-sm-12">
                    		<div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="name">Họ Tên</label>
                                <div class="col-sm-8">
                                   <input class="style-formEdit form-control" value=""  id="editname" name="editname" placeholder="Full Name" type="text"/>
                                   <p style="color:red;display:none" class="error errorName"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="mobile">Số điện thoại</label>
                                <div class="col-sm-8">
                                   <input class="style-formEdit form-control" id="editmobile" name="editmobile" placeholder="Số điện thoại" type="text"/>
                                   <p style="color:red;display:none" class="error errorMobile"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>              
                            </div>
							             <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="email">Email</label>
                                <div class="col-sm-8">
                                   <input class="style-formEdit form-control" id="editemail" name="editemail" placeholder="Nhập  Email" type="text"/>
                                   <p style="color:red;display:none" class="error errorEmail"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
							              <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="password">Mật Khẩu</label>
                                <div class="col-sm-8">
                                   <input class="style-formEdit form-control" id="editpassword" name="editpassword" placeholder="Nhập Password" type="text"/>
                                   <p style="color:red;display:none" class="error errorPassword"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
							              <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="editgender">Giới Tính</label>
                                <div class="col-sm-8">
                                   <select class="form-control" name="gender" id="">
                                   		<option value="">---Chọn---</option>
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
                                   <input class="style-formEdit form-control" id="editbirthday" name="editbirthday" placeholder="Nhập ngày sinh" type="text"/>
                                   <p style="color:red;display:none" class="error errorBirthday"></p>
                                </div>
                                <div class="col-sm-1 requireds">(*)</div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="facebook">Facebook</label>
                                <div class="col-sm-8">
                                   <input class="style-formEdit form-control" id="editfacebook" name="editfacebook" placeholder="Nhập Facebook VD: https://www.facebook.com/" type="text"/>
                                   <p style="color:red;display:none" class="error errorfacebook"></p>
                                </div>
                                
                            </div>
							              <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="skype">skype</label>
                                <div class="col-sm-8">
                                   <input class="style-formEdit form-control" id="editskype" name="editskype" placeholder="Nhập Skype" type="text"/>
                                   <p style="color:red;display:none" class="error errorskype"></p>
                                </div>
                                
                            </div>
                            <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="address">Địa Chỉ</label>
                                <div class="col-sm-8">
                                   <input class="style-formEdit form-control" id="editaddress" name="editaddress" placeholder="Trường Học" type="text"/>
                                   <p style="color:red;display:none" class="error erroraddress"></p>
                                </div>
                                
                            </div>
							              <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="school">Trường Học</label>
                                <div class="col-sm-8">
                                   <input class="style-formEdit form-control" id="editschool" name="editschool" placeholder="Trường Học" type="text"/>
                                   <p style="color:red;display:none" class="error errorschool"></p>
                                </div>
                                
                            </div>
							              <div class="form-group form-md-line-input">
                                <label  class="col-sm-3 control-label" for="editstatus">Trạng Thái</label>
                                <div class="col-sm-8">
                                   <select class="form-control" name="status" id="">
                                   		<option value="">---Chọn---</option>
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