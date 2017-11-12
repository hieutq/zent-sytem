<!DOCTYPE html>
<html class="no-js">
   <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# blog: http://ogp.me/ns/blog#">
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="viewport" content="width=device-width, initial-scale=1"/>
      <link rel="shortcut icon" href="{{url('img/favicon.ico')}}">
      <title>Zent Group | News</title>
      <meta name="description" content="Responsive masonry blog tumblr theme for everyone">
      <!-- Font Awesome 4.4.0 -->
      <link rel="stylesheet" href="{{url('css/font-awesome.min.css')}}" type="text/css">
      <!-- Google Webfont -->
      <link href="https://fonts.googleapis.com/css?family=Merriweather:400,700" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700,400italic,700italic" rel="stylesheet" type="text/css">
      <!-- Custom CSS -->
      <link rel="stylesheet" type="text/css" href="{{url('css/news/style.css')}}">
      <!-- Custom CSS -->
      <link rel="stylesheet" type="text/css" href="{{url('css/news/stylesheet.css')}}">
      <meta name="keywords" content="cooking,driving,encyclopedias,performance,design" />
   </head>
   <body class="">
      <div class="close"></div>
      <div class="body-wrap clearfix">
         <header class="header">
            <div class="brand">
               <div class="sidebar-toggle"><a href="#"><span class="fa fa-bars"></span> Menu</a></div>
               <div class="container">
                  <div class="logo">
                     <h1>
                        <a href="{{route('news.post')}}" class="logo-text">ZENT GROUP</a>
                     </h1>
                  </div>
                  <div class="desc">
                     <p>Be all you can be!</p>
                  </div>
               </div>
            </div>
            <div class="nav-tag">
               <nav class="tag-filter container">
                  <ul class="unlist">
                  @foreach($tags as $tag)
                     <li><a href="{{route('news.category',$tag->slug)}}">
                        #{{$tag->name}}</a>
                     </li>
                  @endforeach
                  </ul>
               </nav>
            </div>
         </header>
         <aside class="sidebar">
            <div class="sidebar-inner">
               <div class="inner">
                  <div class="sidebar--toggle clearfix">
                     <img src="{{url('img/logoZ.png')}}" style="height: 50px; width:170px;">
                     <a href="#"><span class="fa fa-close"></span></a>
                  </div>
                  <div class="sidebar-desc">
                     <p>Điều quan trọng là các bạn nên sớm tìm ra định hướng cho mình và theo đuổi nó đến cùng và HÃY KHÁC BIỆT</p>
                  </div>
                  <div class="menu">
                     <ul class="unlist">
                         <li><a href="http://zentgroup.net/home/#tf-services" class="scroll">Sự khác biệt</a></li>
                         <li><a href="http://zentgroup.net/home/#tf-about" class="scroll">Zent Start-up</a></li>
                         <li><a href="http://zentgroup.net/home/#tf-features" class="scroll">Lộ trình học tập</a></li>
                         <li><a href="http://zentgroup.net/home/#tf-works" class="scroll">Góc học viên</a></li>
                         <li><a href="http://zentgroup.net/home/#tf-process" class="scroll">Góc doanh nghiệp</a></li>
                         <li><a href="http://zentgroup.net/home/#tf-contact" class="scroll">Liên hệ</a></li>
                     </ul>
                  </div>
                  <!-- Social Icon -->
                  <div class="social-icon">
                     <ul class="unlist">
                        <li><a href="https://www.facebook.com/zent.academy/" title="https://www.facebook.com/zent.academy/" class="fa-stack" ><span class="fa fa-facebook-square"></span></a></li>
                        <li><a href="http://zentgroup.net/home/" title="http://zentgroup.net/home/" class="fa-stack" ><span class="fa fa-chrome"></span></a></li>
                        <li><a href="#" class="fa-stack" title="zentgroup@gmail.com" ><span class="fa fa-envelope"></span></a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </aside>
         @yield('contents')
         <footer class="footer">
            <div class="container">
               <div class="credit">
                  All rights reserved &copy; 2016 <a href="http://zentgroup.net/">Zent Group</a><br/>
            </div>
         </footer>
      </div>
      <!-- Jquery -->
      <script type="text/javascript" src="{{url('js/jquery.min.js')}}"></script>
      @yield('infinityScroll')
      <script type="text/javascript" src="{{url('js/news/modernizr-custom.js')}}"></script> 
      <!-- imagesLoaded js -->
      <script type="text/javascript" src="{{url('js/news/imagesloaded.pkgd.min.js')}}"></script>
      <!-- masonry js -->
      <script type="text/javascript" src="{{url('js/news/masonry.pkgd.min.js')}}"></script>
      <!-- Twitter -->
      <!-- Instafeed -->
      <!-- <script type="text/javascript" src="{{url('js/news/instafeed.min.js')}}"></script> -->
      <!-- Photosetgrid -->
      <script src="{{url('js/news/photosetgrid.js')}}" type="text/javascript" ></script>
      <!-- Magnific-popup -->
      <script src="{{url('js/news/jquery.magnific-popup.min.js')}}" type="text/javascript" ></script>
      <!-- Custom JS -->
      <script type="text/javascript" src="{{url('js/news/script.js')}}"></script>

   </body>
</html>