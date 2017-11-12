@extends('layouts.master')
@section('contents')

<div class="portlet light bordered">
      <div class="portlet-body">
      <div class="table-toolbar">
        <div class="row">
          <div class="col-md-6">
          </div>
          <div class="col-md-12">
             <div class="btn-group pull-left">
                <a href="{{url('tintuc/create')}}" data-toggle="modal"><button id="AddBtn" class="btn green  btn-outline dropdown-toggle">Thêm
                <i class="fa fa-plus"></i>
              </button></a>
             </div>
          </div>
        </div>
         <div class="table-scrollable">
         @if(isset($posts) && $posts->count() > 0)
            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1" >
      <thead>
          <tr>
              <th class="stl-column color-column">ID</th>
              <th class="stl-column color-column">Tiêu đề </th>                          
              <th class="stl-column color-column">Ảnh icon</th>
              <th class="stl-column color-column">Người Tạo</th>
              <th class="stl-column color-column">Kiểu</th>                        
              <th class="stl-column color-column">Ngày tạo</th>
              <th class="stl-column color-column">  
                 Hành Động
              </th> 
          </tr>
      </thead>
      <tbody>

      @foreach( $posts as $post)

          <tr align="center" >
              <td> {{ $post->id}} </td>
              <td> <p style=" width: 200px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis"><?php echo strip_tags($post->title); ?> </p></td> 
                    
              <!-- <td  > <p style=" width: 200px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis">{{ $post->description }}</p></td> -->
              <td > <img width="50px" height="30px" src="../upload/tintuc/{{$post->image_icon}}" /> </td> 
              <!-- <td style="width:150px"><a href="{{$post->video}}" style=" width: 150px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis"> {{ $post->video}} </a></td>  -->
              <td> {{ isset($post->user->name)? $post->user->name : ''}} </td>
             <!--  @if($post->image_icon == 0) src="../upload/tintuc/NoImage.jpg" @else src="../upload/tintuc/{{$post->image_icon}}" @endif -->
              
              <td> {{ $post->type}} </td> 
              <td> {{ $post->created_at }}</td>
            
              <td>
              <ul class="list-inline">
                  <li>
                      <a href="{{url('tintuc/view',$post->id)}}"><i class="fa fa-info btn-detail btn-info style-css" data-id="{{$post->id}}" aria-hidden="true" title="Xem Chi tiết"></i></a>
                  </li>
                  <li>
                      <a href="{{url('tintuc/edit',$post->id)}}"><i class="fa fa-pencil-square-o btn-warning btn-edit style-css" data-id="{{$post->id}}" aria-hidden="true" title="Sửa  User"></i></a>
                  </li>
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <li>
                      <a href="#" onclick="alertDel({{$post->id}})"><i class="fa fa-trash-o btn-danger style-css" data-id="{{$post->id}}" aria-hidden="true" title="Xóa"></i> </a>
                  </li>
              </ul> 
              </td> 
          </tr>
          
@endforeach



       
       
      </tbody>
    </table>
   
    @else
<div>
    <div class="alert alert-danger" role="alert">
        Chưa có danh sách
    </div>
</div>
@endif   
     <div class="pagination" style="float:right">      


    {!! $posts->render() !!}
 
      </div>
        </div>
      </div>
    </div>   
  </div>
<!-- endcreate -->
 




        <script>
             function alertDel(id){
              var url = '{{url('tintuc/xoa')}}/'+id;
                swal({   

                title: "Bạn có chắc chắn muốn xoá?",   
                text: "Dữ liệu sẽ bị xóa vĩnh viễn!",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Có",   
                closeOnConfirm: false
                }, function(isConfirm){   
                      if (isConfirm) {   
                        window.location.assign( url)
                      }
                    });
             }
             
         </script>

@endsection