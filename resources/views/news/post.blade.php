@extends('layouts.news')
@section('contents')
<main class="main-content">
   <div class="container">
      <div class="grid effect-2" id="grid">
	      <div class="post-loader">
	         <div class="loader-inner">
	            Loading...
	         </div>
	      </div>
         @include('news.data')     
      </div>
   </div>
</main>
@endsection
@section('infinityScroll')
 <!-- Infinite ajax scroll -->
<script type="text/javascript" src="{{url('js/news/infinitescroll.js')}}"></script>
@endsection
