@extends('layouts.master')
@section('contents')
<div class="titleCourses">
   <h3 class="page-title"> Chi tiết thông tin khóa học</h3>
</div>
 <div class="row">
     <div class="col-sm-12">
     <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
         <thead>
            <tr>
               <th class="stl-column color-column col-sm-2">Tiêu đề</th>
               <th class="stl-column color-column">Nội dung</th> 
            </tr>
         </thead>
         <tbody id="tbodyTable">
            <tr>
               <td>Tên Khóa Học</td>
               <td>{{ $Course->name }}</td>
            </tr>
            <tr >
               <td>Tên Viết Tắt</td>
               <td>{{ $Course->short_name }}</td>
            </tr>
            <tr >
               <td>Khẩu Hiệu</td>
               <td>{{ $Course->slogan }}</td>
            </tr>
            <tr >
               <td>Slug</td>
               <td>{{ $Course->code }}</td>
            </tr>
            <tr >
               <td>Số lượng học viên</td>
               <td>{{ $Course->capacity }}</td>
            </tr>
            <tr >
               <td>Ngày Khai Giảng</td>
               <td>{{ date('d-m-Y',strtotime($Course->orientation_time)) }}</td>
            </tr>
            <tr >
               <td>Lịch Học</td>
               <td>{{ $Course->time_table }}</td>
            </tr>
            <tr >
               <td>Mục Tiêu Lớp Học</td>
               <td>{{ $Course->class_desire_detail }}</td>
            </tr>
            <tr >
               <td>Học Phí</td>
               <td>{{ $Course->tuition }}</td>
            </tr>
            <tr >
               <td>Trạng Thái</td>
               <td>
               @if($Course->status==1)
                  Hiển thị trên Website
               @else if($Course->status==0)
                  Không hiển thị trên Website
               @endif
               </td>
            </tr>
            <tr >
               <td>Địa Chỉ Facebook Lớp</td>
               <td><a target="_bank" href="{{ $Course->class_fb_group }}">{{ $Course->class_fb_group }}</a></td>
            </tr>
            <tr >
               <td>Thông Tin Lớp</td>
               <td>{!! $Course->class_info !!}</td>
            </tr>
            <tr >
               <td>Đối Tượng Học Viên</td>
               <td>{!! $Course->student_object !!}</td>
            </tr>
            <tr >
               <td>Nội Dung</td>
               <td>{!! $Course->content !!}</td>
            </tr>
            <tr >
               <td>Thông Tin Đăng Ký</td>
               <td>{!! $Course->register_info !!}</td>
            </tr>
            <tr >
               <td>Ngày Tạo</td>
               <td>{{ $Course->created_at }}</td>
            </tr>
         </tbody>
      </table>
      <div class="form-actions text-center">
         <div class="col-xs-12 col-sm-12" style="margin-top: 20px;">
           <a href="{{route('courses.index')}}" class="btn btn-outline green button-pre btn-circle"> Quay Lại
           </a>               
         </div>
      </div>
@endsection                      