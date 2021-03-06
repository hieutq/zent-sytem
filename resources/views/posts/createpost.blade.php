@extends('layouts.master')
@section('contents')


                             <style type="text/css" media="screen">
                                .error{
                                  color: red;
                                }
                    </style>
             <form id="frmCreatePosts" name="frmCreatePosts" action="{{ url('tintuc/postCreate')}}" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
                               {{ csrf_field() }}
                               
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                  <div class="form-group ">
                                           <label class="col-md-2 control-label">Tiêu đề:</label>
                                           <div class="col-md-9">
                                               <input type="text" class="form-control" name="title" placeholder="" id="title" onkeyup="ChangeToSlug();">
                                                
                                           </div>
                                           <div class="col-sm-1 requireds">(*)</div>
                                  </div>
                                  <div class="form-group">
                                        <label class="col-md-2 control-label">Nội dung ngắn:</label>
                                        <div class="col-md-9">
                                            <textarea id-"demo" class="form-control" rows="2" name="description" ></textarea>
                                            
                                         </div>
                                  </div>
                                  <div class="form-group">
                                        <label class="col-md-2 control-label">Nội dung:</label>
                                        <div class="col-md-9">
                                            <textarea id-"demo" class="form-control summernote" rows="4" name="content" ></textarea>
                                            
                                         </div>
                                  </div>
                                  <div class="form-group">
                                          
                                           <div class="col-md-8">
                                               <input type="hidden" class="form-control " name="slug" id="slug">
                                             </div>    
                                  </div>
                                 <!--  <div class="form-group ">
                                        <label class="col-md-3 control-label">Image-icon:</label>
                                        <div class="col-md-8">
                                            <input type="file" name="image_icon" class="form-control">
                                         </div>
                                  </div> -->
                                  <div class="form-group ">
                                        <label class="col-md-2 control-label">Ảnh:</label>
                                        <div class="col-md-9">
                                            <img id="blah" width="150px" src="../upload/tintuc/NoImage.jpg" />
                                            <input type="file" name="image" class="form-control required" id="imgInp" accept="image/*">
                                         </div>
                                         <div class="col-sm-1 requireds">(*)</div>
                                  </div>
                                  <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label">Video:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control " name="video" placeholder="http://">
                                         </div>
                                  </div>
                                  <div class="form-group ">
                                        <label class="col-md-2 control-label">Kiểu:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control " name="type" placeholder="bai post thuoc loai gi?">
                                         
                                         </div><div class="col-sm-1 requireds">(*)</div>
                                  </div>
                                  <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label">Người tạo:</label>
                                        <div class="col-md-9">
                                            <select name="user_id"  class="form-control">
                                              @foreach($users as $user)
                                              <option value="{{ $user->id}}">{{$user->name}}</option>
                                              @endforeach
                                            </select>
                                         </div>
                                  </div>
                                  <div class="form-group form-md-line-input">
                                <label  class="col-sm-2 control-label" for="status">Trạng Thái</label>
                                <div class="col-sm-9">
                                   <select class="form-control" name="status" id="">
                                      <option value="1">Đang mở</option>
                                      <option value="0">Đang đóng</option>
                                   </select>
                                
                                </div>
                            </div>
                    
                                     <div class="modal-footer">
                                        <a href="{{url('tintuc/danhsach')}}"><button  type="button" class="btn btn-default"
                                        data-dismiss="modal">
                                        Hủy
                                        </button></a>
                                        <button type="submit" class="btn btn-primary" onclick="alertInser()">
                                        Thêm Mới
                                        </button>
                                     </div>
                                  </form>
                    
               
         <script>
         
             $("#frmCreatePosts").validate({
              errorElement: "span",
                rules:{
                    title:{
                        required:true,
                        maxlength:255,
                    },
                    
                    type:{
                        required:true,
                        digits: true,
                    },
                    
                    
                },
                messages:{
                    title:{
                        required:'Vui lòng nhập trường này',
                        minlength:'Tối đa chỉ được 255 ký tự',
                    },
                    type:{
                        required:'Vui lòng nhập trường này',
                        digits:'Chỉ được nhập số',
                    },
                    image:{
                        required:'Vui lòng nhập trường này',
                        
                    },
                    
                }
             });


             
             // function alertInser(){
             //  toastr.options = {
             //                "positionClass": "toast-top-center",
             //  }
             //   Command: toastr["success"]("Thêm mới thành công!");
             // };

             //load ảnh lên luôn nguồn:http://jsfiddle.net/LvsYc/
              function readURL(input) {
                  if (input.files && input.files[0]) {
                      var reader = new FileReader();
                      
                      reader.onload = function (e) {
                          $('#blah').attr('src', e.target.result);
                      }
                      
                      reader.readAsDataURL(input.files[0]);
                  }
              }
              
              $("#imgInp").change(function(){
                  readURL(this);
              });


             // chuyển title thành slug. nguồn : 'http://freetuts.net/tao-slug-tu-dong-bang-javascript-va-php-199.html'
             function ChangeToSlug()
              {
                  var title, slug;
               
                  //Lấy text từ thẻ input title 
                  title = document.getElementById("title").value;
               
                  //Đổi chữ hoa thành chữ thường
                  slug = title.toLowerCase();
               
                  //Đổi ký tự có dấu thành không dấu
                  slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                  slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                  slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                  slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                  slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                  slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                  slug = slug.replace(/đ/gi, 'd');
                  //Xóa các ký tự đặt biệt
                  slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                  //Đổi khoảng trắng thành ký tự gạch ngang
                  slug = slug.replace(/ /gi, " - ");
                  //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                  //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                  slug = slug.replace(/\-\-\-\-\-/gi, '-');
                  slug = slug.replace(/\-\-\-\-/gi, '-');
                  slug = slug.replace(/\-\-\-/gi, '-');
                  slug = slug.replace(/\-\-/gi, '-');
                  //Xóa các ký tự gạch ngang ở đầu và cuối
                  slug = '@' + slug + '@';
                  slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                  //In slug ra textbox có id “slug”
                  document.getElementById('slug').value = slug;
              }

         </script>

@endsection                      