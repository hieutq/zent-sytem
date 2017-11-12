@extends('layouts.master')
@section('contents')
	<div class="portlet-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr align="center">
                        <th >ID</th>
                        <th>Tên User</th>
                        <th width="50px;">Số Điện Thoại</th>
                        <th width="50px;">Ngày Sinh</th>
                        <th width="50px;">Giới tính</th>
                        <th>Email</th>
                        <th>Giới tính</th>
                        <td><button type="button" class="btn btn-info btn-sm" id="myBtn" value="add">thêm</button></td>
                        <th>Facebook</th>
                        <th>Skype</th>
                        <th>Địa Chỉ</th>
                        <th>Nơi Làm Việc</th>
                        <th>Trình Độ</th>
                        <th>Kỹ Năng</th>
                        <th>Chức Vụ</th>
                         <th>Loại Người Dùng</th>
                          <th>Trạng Thái</th>
                          <td></td>
                        <td style="width:200px"><button type="button" class="btn btn-info btn-sm" id="myBtn" value="add">thêm</button></td>


                    </tr>
                </thead>
                <tbody>
                @foreach($users as $db)

                    <tr align="center" id = "user{{$db->id}}">
                    <tr align="left" id="userRow{{$db->id}}">
                        <td>{{$db->id}}</td>
                        <td>{{$db->name}}</td>
                        <td width="50px;">{{$db->mobile}}</td>   
                        <td width="50px;">{{$db->birthday}}</td> 
                        <td></td>
                        <td></td>
                        <td></td>
                        <td width="50px;">@if($db->gender==1)
                        Nam
                        @else
                        Nữ
                        @endif

                        </td>  
                        <td width="50px;">{{$db->email}}</td>
                        <td><a href="{{$db->facebook}}" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></td>
                         <td><a href="{{$db->skype}}" target="_blank"><i class="fa fa-skype" aria-hidden="true"></i></a></td>
                        <td>{{$db->address}}</td>
                        <td>{{$db->work_place}}</td>
                        <td>{{$db->education_info}}</td>
                        <td>{{$db->skill}}</td>
                        <td>{{$db->position}}</td>
                        <td>
                        @if($db->type==1)
                          Quản Lý
                        @endif
                        @if($db->type==2)
                         Giáo Viên
                        @endif 
                        @if($db->type==3)
                         Trợ Lý
                        @endif

                        </td>
                        <td>
                        @if($db->status==1)
                          Đang Mở
                        @endif                            
                        @if($db->status==2)
                          Đã Đóng
                        @endif  
                        </td>
                        <td style="width:200px" >
                        <button class="btn btn-warning open_modal btn-edit" id="btn-edit" data-id="{{$db->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Sửa</button>
                        <button class="btn btn-danger btnDelete" style="margin-left:15px" data-id="{{$db->id}}"><i class="fa fa-trash-o" aria-hidden="true"></i>Xóa</button>     
                        </td> 
                    </tr>
            	@endforeach
                </tbody>
            </table>
        </div>
    </div>
 
      <div class="modal fade" id="User-modal-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <h4 class="modal-title text-center"  style="font-style:bold">Sửa Người Dùng</h4>
             <div class="modal-body">
               <form id="frmEditUser" name="frmEditUser" class="form-horizontal" novalidate="">
                  {{ csrf_field() }}
                         <div class="form-group"> <!-- Date input -->
                               <div class="input-group">
                            <div class="input-group-addon">
                             <i class="fa fa-user" aria-hidden="true"></i>
                            </div>
                            <input class="form-control" id="editName" name="editName" placeholder="Họ Và Tên" type="text"/>
                           </div>
                         </div> 
                               <div class="form-group ">
                                  <div class="input-group">
                                   <div class="input-group-addon">
                                    <i class="fa fa-calendar">
                                    </i>
                                   </div>
                                   <input class="form-control" id="editBirthday"   name="date" placeholder="MM/DD/YYYY" type="text"/>
                                  </div>
                                 </div>                  
                         <div class="form-group"> <!-- Date input -->
                               <div class="input-group">
                            <div class="input-group-addon">
                           <i class="fa fa-transgender-alt" aria-hidden="true"></i>
                            </div>
                      
                        <input type="hidden" class="form-control has-error" id="editID" name="editID" placeholder="Name" value="">
                            <select id="editGender" name="editGender" style="width:100%">
                        
                                <option  value="1">Nam</option>
                                <option value="2" >Nữ</option>
                            </select>
                           </div>
                         </div> 
                         <div class="form-group"> <!-- Date input -->
                               <div class="input-group">
                            <div class="input-group-addon">
                             <i class="fa fa-calendar">
                             </i>
                            </div>
                             <input class="form-control" id="editMobile" name="editMobile" placeholder="Số Điện Thoại" type="text"/>
                           </div>
                         </div>                          
                         <div class="form-group"> <!-- Date input -->
                               <div class="input-group">
                            <div class="input-group-addon">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            </div>
                            <input class="form-control" id="editEmail" name="editEmail" placeholder="Email" type="email"/>
                           </div>
                         </div> 
                         <div class="form-group"> <!-- Date input -->
                               <div class="input-group">
                            <div class="input-group-addon">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                            </div>
                            <input class="form-control" id="editFacebook" name="editFacebook" placeholder="Link Facebook" type="text"/>
                           </div>
                         </div> 
                         <div class="form-group"> <!-- Date input -->
                               <div class="input-group">
                            <div class="input-group-addon">
                            <i class="fa fa-skype" aria-hidden="true"></i>  
                            </div>
                            <input class="form-control" id="editSkype" name="editSkype" placeholder="Skype" type="text"/>
                           </div>
                         </div>  
                         <div class="form-group"> <!-- Date input -->
                               <div class="input-group">
                            <div class="input-group-addon">
                         <i class="fa fa-map-marker" aria-hidden="true"></i>
                            </div>
                            <input class="form-control" id="editAddress" name="editAddress" placeholder="Địa Chỉ" type="text"/>
                           </div>
                         </div>
                          <div class="form-group"> <!-- Date input -->
                               <div class="input-group">
                            <div class="input-group-addon">
                            <i class="fa fa-location-arrow" aria-hidden="true"></i>
                            </div>
                            <input class="form-control" id="editWorkFace" name="editWorkFace" placeholder="Nơi Làm Việc" type="text"/>
                           </div>
                         </div>
                         <div class="form-group"> <!-- Date input -->
                               <div class="input-group">
                            <div class="input-group-addon">
                             <i class="fa fa-level-up" aria-hidden="true"></i>
                            </div>
                            <input class="form-control" id="editEducation" name="editEducation" placeholder="Trình Độ" type="text"/>
                           </div>
                         </div>
                          <div class="form-group"> <!-- Date input -->
                               <div class="input-group">
                            <div class="input-group-addon">
                            <i class="fa fa-renren" aria-hidden="true"></i>
                            </div>
                            <input class="form-control" id="editSkill" name="editSkill" placeholder="Kỹ Năng" type="text"/>
                           </div>
                         </div> 
                         <div class="form-group"> <!-- Date input -->
                               <div class="input-group">
                            <div class="input-group-addon">
                           <i class="fa fa-blind" aria-hidden="true"></i>
                            </div>
                            <input class="form-control" id="editPosition" name="editPosition" placeholder="Chức Vụ" type="text"/>
                           </div>
                         </div>
                          <div class="form-group"> <!-- Date input -->
                               <div class="input-group">
                            <div class="input-group-addon">
                             <i class="fa fa-calendar">
                             </i>
                            </div>
                              <select id="editType" name="editType" style="width:100%">
                                <option value="1">Quản Lý</option>
                                <option value="2">Giáo Viên</option>
                                <option value="3">Trợ Lý</option>
                            </select>
                           </div>
                         </div>  
                        <div class="form-group"> <!-- Date input -->
                               <div class="input-group">
                            <div class="input-group-addon">
                             <i class="fa fa-calendar">
                             </i>
                            </div>
                              <select id="editStatus" name="editStatus" style="width:100%">
                                <option value="1">Đang Mở</option>
                                <option value="2">Đã Đóng</option>
                            </select>
                           </div>
                         </div>                                                                                
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="btn-save" value="edit">Lưu Thay Đổi</button>
            </div>
            </form>
            </div>

        </div>
      </div>
  </div>
  
</div>
<script type="text/javascript">
     $('tbody').delegate('.btn-edit','click',function(){
    var value=$(this).data('id');
    var url ='{{URL::to('home/user-update')}}';
            $.ajax({
            type : 'get',
            url  :url,
            data :{'id':value},
            success:function(data){
            console.log(data);
            $('#editID').val(data.id);
            $('#editName').val(data.name);
            $('#editEmail').val(data.email);
            $('#editBirthday').val(data.birthday);
            $('#editMobile').val(data.mobile);
            $('#editFacebook').val(data.facebook);
            $('#editEmail').val(data.email);
            $('#editSkype').val(data.skype);
            $('#editWorkFace').val(data.work_place);
            $('#editAddress').val(data.address);
            $('#editSkill').val(data.skill);
            $('#editPosition').val(data.position);
            $('#editEducation').val(data.education_info);
             var gender=  data.gender;
             var type=data.type;
             var status=data.status;
            for (var i = 1; i < 4; i++) {
               if (gender==i) {
                 $('#editGender option[value='+gender+']').attr('selected','selected');             
               }
               if (type==i) {
                $('#editType option[value='+type+']').attr('selected','selected');
               }
               if (status==i) {
                $('#editStatus option[value='+status+']').attr('selected','selected');
               }
            }
            $('#User-modal-edit').modal('show');
            }
      });
 });


     //submit postUpdate
     $('#frmEditUser').on('submit',function(e){
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        e.preventDefault();
           var userID = $('#editID').val();
           var formData= $('#frmEditUser').serialize();
           var url = '{{URL::to('home/user-update')}}';
        $.ajax({
            type : 'put',
            url  : url,
            data : formData,
            success:function(data){
                var gt =data.gender;
                if (data.gender==1) {
                    gt="Nam";
                }else if (data.gender==2) {
                    gt="Nữ";
                }
                var type_user=data.type;
                if (data.type==1) {
                    type_user="Quản Lý";
                }else if (data.type==2) {
                    type_user="Giáo Viên";
                }
                else if (data.type==3) {
                    type_user="Trợ Lý";
                }
                var status_user=data.status;
                if (data.status==1) {
                    type_user="Đang Mở";
                }else if (data.status==2) {
                    type_user="Đã Đóng";
                }
             console.log(data);
            var row ='<tr id="userRow'+ data.id + '">'+
            '<td>'+data.id+'</td>'+
            '<td>'+data.name+'</td>'+
            '<td>'+data.mobile+'</td>'+
            '<td>'+data.birthday+'</td>'+
            '<td>'+gt+'</td>'+
            '<td>'+data.email+'</td>'+
            '<td><a href="'+data.facebook+'" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></td>'+
            '<td><a href="'+data.skype+'" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></td>'+
            '<td>'+data.address+'</td>'+
            '<td>'+data.work_place+'</td>'+
            '<td>'+data.education_info+'</td>'+
            '<td>'+data.skill+'</td>'+
            '<td>'+data.position+'</td>'+
            '<td>'+type_user+'</td>'+
            '<td>'+type_user+'</td>';
          
           row += '<td><button class="btn btn-warning open_modal btn-edit" id="btn-edit" data-id="'+data.id+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Sửa</button>';
           row +=  '<button class="btn btn-danger btnDelete" style="margin-left:15px" data-id="'+data.id+'"><i class="fa fa-trash-o" aria-hidden="true"></i>Xóa</button></td></tr>';
             $("#userRow" +data.id).replaceWith(row);
             $('#User-modal-edit').modal('hide') ;  
              swal("Success!", "Sửa người dùng thành công !", "success");     
                },
             error: function (data) {
                console.log('Error:', data);
            }
            });
       })
</script>
    <script type="text/javascript">
        $('.btn-edit').on('click',function(){
           $('#editUserModal').modal('show');
        })
    </script>
@endsection

