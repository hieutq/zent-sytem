@extends('layouts.master')
@section('contents')

<div class="portlet light bordered">
<div class="portlet-title">
    <div class="caption uppercase">
        <i class="fa fa-book" aria-hidden="true"></i>{{$name}} / LÝ THUYẾT </div>
   
</div>

<div class="portlet-body">
    <div class="panel-group accordion">

    	@if (count($theories)) 

    	@foreach ($theories as $key => $theory)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#" href="#collapse-{{$theory->id}}">  {{$theory->name}} </a>
                </h4>
            </div>
            <div id="collapse-{{$theory->id}}" class="panel-collapse in">
                <div class="panel-body">
                    {!! $theory->content !!}
                </div>
            </div>
        </div>
        @endforeach 
		@else 
			<h4 class="text-center" style="font-style: italic; font-size:16px;"> Không có bản ghi nào.</h4>
        @endif

    </div>
</div>
</div>


@endsection
