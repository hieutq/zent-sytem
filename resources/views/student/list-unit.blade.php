@extends('layouts.master')
@section('head')
<style>
	.trick-card {
	    padding-top: 10px;
	    padding-bottom: 10px;
	}

	.trick-card-title {
	    display: block;
	    font-weight: 700;
	    color: #33383A;
	    font-size: 20px;
	    padding: 20px;
	}
	.trick-card-by {
	    border: none;
	    padding-top: 0;
	}
	.trick-card-stats {
	    color: #777;
	}

.trick-card-stats, .trick-card-tags {
    width: 100%;
    border-top: #eee 1px solid;
    padding: 10px 20px;
    font-size: 13px;
}

</style>
<link rel="stylesheet" href="{{url('css/jquery.countdown.css')}}">
@endsection

@section('contents')

<!-- BEGIN TAB PORTLET-->
<div class="portlet light bordered">
    <div class="portlet-title tabbable-line">
        <div class="caption">
            <i class="fa fa-file-text" aria-hidden="true"></i>
            <span class="caption-subject font-dark bold uppercase">Danh sách bài học</span>
        </div>
        <ul class="nav nav-tabs">
            <li>
                <a href="#portlet_tab2" data-toggle="tab"> <i class="fa fa-table" aria-hidden="true"></i> </a>
            </li>
            <li class="active">
                <a href="#portlet_tab1" data-toggle="tab"> <i class="fa fa-bars" aria-hidden="true"></i> </a>
            </li>
        </ul>
    </div>
    <div class="portlet-body">
        <div class="tab-content">
            <div class="tab-pane active " id="portlet_tab1">
            	<div class="row">
            		@if($exercises) @foreach($exercises as $key => $exercise)
            			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" >
            				<div class="portlet light bordered " style="padding:10px;">
            					<div class="portlet-title">
                                    <div class="caption">
                                        
                                        <i class="fa fa-bell-o font-red-sunglo" aria-hidden="true"></i>
                                        <span class="caption-subject font-red-sunglo bold">{{$exercise->unit}}: {{$exercise->unit_name}}</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div>
                                        <i class="fa fa-clock-o" aria-hidden="true"></i> Hạn nộp:
                                        @if (time() > strtotime($exercise->deadline)) 
											<b style="color:#E26A6A;">Hết hạn</b>
                                        @else
											<b style="color:#E26A6A;">{{ date(' H:i:s d/m/Y', strtotime($exercise->deadline)) }} </b>
                                        @endif
                                    </div>
                                    <div style="padding: 15px 0;">
                                    	{!! $exercise->note !!}
                                    </div>
                                    <div>
                                    	<ul class="pager">
                                    	<li class="previous">
                                            <a href="{{URL::asset('')}}students/class-room/{{$exercise->class_room_id}}/theories/{{$exercise->id}}" class="btn btn-outline btn-circle btn-sm blue"> <i class="fa fa-book" aria-hidden="true"></i> Lý thuyết
                                            </a>
                                        </li>
                                        <li class="next">
                                            <a href="{{URL::asset('')}}students/class-room/{{$exercise->class_room_id}}/exercises/{{$exercise->id}}" class="btn btn-outline btn-circle btn-sm purple"> <i class="fa fa-hourglass-start" aria-hidden="true"></i> Bài tập
                                            </a>
                                        </li>
                                    </ul>
                                    </div>
                                </div>		
            				</div>
                                
                        </div>
					@endforeach @endif
            	</div>
                
            </div>
            <div class="tab-pane" id="portlet_tab2">
                <div class="table-scrollable">
			        <table class="table table-striped table-bordered table-hover">
			            <thead>
			                <tr>
			                   <th class="stl-column color-column">#</th>
			                   <th class="stl-column color-column">Unit</th>
			                   <th class="stl-column color-column">Tên</th>
			                   <th class="stl-column color-column">Hạn nộp</th>
			                   <th class="stl-column color-column">Hành động</th>
			                </tr>
			                
			            </thead>
			            <tbody>
			                @if($exercises) @foreach($exercises as $key => $exercise)
			                <tr>
			                    <td class="text-center"> {{ $key + 1 }} </td>
			                    <td class="text-center"> {{ $exercise->unit }} </td>
			                    <td class="text-center"> {{ $exercise->unit_name }} </td>
			                 
			                    <td class="text-center"> 
									@if (time() > strtotime($exercise->deadline)) 
											<b style="color:#E26A6A;">Hết hạn</b>
                                        @else
											<b style="color:#E26A6A;">{{ date('d-m-Y H:i:s', strtotime($exercise->deadline)) }} </b>
                                        @endif
			                     </td>
			                    
			                    <td class="text-center"> 
			                        <a href="{{URL::asset('')}}students/class-room/{{$exercise->class_room_id}}/theories/{{$exercise->id}}" class="show-detail btn btn-outline btn-circle btn-sm blue">
			                            <i class="fa fa-book" aria-hidden="true"></i> Lý thuyết
			                        </a>

			                        <a href="{{URL::asset('')}}students/class-room/{{$exercise->class_room_id}}/exercises/{{$exercise->id}}" class="show-detail btn btn-outline btn-circle btn-sm purple">
			                            <i class="fa fa-hourglass-start" aria-hidden="true"></i> Bài tập
			                        </a>
			                      
			                    </td>
			                   
			                </tr>
			                @endforeach @else
			                  <tr>
			                    <td colspan="4" class="text-center"> Không có bản ghi nào </td>
			                  </tr>
			                @endif

			            </tbody>
			        </table>
			    </div>
            </div>
        </div>
    </div>
</div>
<!-- END TAB PORTLET-->
@endsection

@section('footer')
{{-- <script type="text/javascript" src="{{url('js/jquery.countdown.min.js')}}"></script>
<script type="text/javascript" src="{{url('js/jquery.countdown-vi.js')}}"></script>
 --}}

@endsection