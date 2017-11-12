@extends('layouts.news')
@section('contents')
<main class="main-content">
  <div class="container">
     <article class="post photo  driving city skills shopping" data-id="photoset141262044798">
        <!-- <figure class="post-media photo-lightbox">
           <a href="http://67.media.tumblr.com/33c8c381c4e8508e6098d7f47d5a7c92/tumblr_o48vmfD1mj1vocbulo1_r3_1280.png">
           <img itemprop="image" src="{{$detail->image}}" alt="{{$detail->title}}">
           </a>
        </figure> -->
        <div class="post-body">
           <div class="post-meta clearfix">
              <span class="date">
              <a href="http://mariustheme.tumblr.com/post/141262044798/driving-in-the-city-driving-in-the-city-is-a-very">
              <time datetime="2016-18-3">{{$detail->convertTime()}}</time>
              </a>
              </span>
              <div class="share">
                 <span class="fa fa-share-alt"></span>
                 <div class="share-area">
                    <ul class="unlist">
                       <li><a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fmariustheme.tumblr.com%2Fpost%2F141262044798%2Fdriving-in-the-city-driving-in-the-city-is-a-very" onclick="window.open(this.href, 'facebook-share','width=580,height=296');return false;" class="facebook"><span class="fa fa-facebook"></span>Facebook</a></li>
                       <li><a href="https://twitter.com/share?url=http%3A%2F%2Fmariustheme.tumblr.com%2Fpost%2F141262044798%2Fdriving-in-the-city-driving-in-the-city-is-a-very" onclick="window.open(this.href, 'twitter-share', 'width=550,height=235');return false;" class="twitter"><span class="fa fa-twitter"></span>Twitter</a></li>
                       <li><a href="https://plus.google.com/share?url=http%3A%2F%2Fmariustheme.tumblr.com%2Fpost%2F141262044798%2Fdriving-in-the-city-driving-in-the-city-is-a-very" onclick="window.open(this.href, 'googleplus-share','width=580,height=296');return false;" class="google"><span class="fa fa-google-plus"></span>Google Plus</a></li>
                       <li><a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());" class="pinterest"><span class="fa fa-pinterest"></span>Pinterest</a></li>
                       <li><a href="https://www.tumblr.com/reblog/141262044798/7MnW3zkq" class="reblog-btn"><span class="fa fa-retweet"></span>Reblog</a></li>
                       <li>
                          <div class="like">
                             <div class="like_button" data-post-id="141262044798" data-blog-name="mariustheme" id="like_button_141262044798"><iframe id="like_iframe_141262044798" src="http://assets.tumblr.com/assets/html/like_iframe.html?_v=662afb16c40c53f44feaf453f106a197#name=mariustheme&amp;post_id=141262044798&amp;rk=7MnW3zkq&amp;root_id=141262044798" scrolling="no" width="12" height="12" frameborder="0" class="like_toggle" allowTransparency="true" name="like_iframe_141262044798"></iframe></div>
                             <div class="like-btn"><span class="fa fa-heart-o"></span>Like</div>
                          </div>
                       </li>
                       <li><a href="http://mariustheme.tumblr.com/post/141262044798/driving-in-the-city-driving-in-the-city-is-a-very"><span class="fa fa-link"></span> Permalink</a></li>
                    </ul>
                 </div>
              </div>
           </div>
           <div class="excerpt">
              <h2>{{$detail->title}}</h2>
              <p>{!! $detail->content !!}</p>
           </div>
           <!-- <div class="tags">
              <a href="http://mariustheme.tumblr.com/tagged/driving">#driving</a><a href="http://mariustheme.tumblr.com/tagged/city">#city</a><a href="http://mariustheme.tumblr.com/tagged/skills">#skills</a><a href="http://mariustheme.tumblr.com/tagged/shopping">#shopping</a>
           </div> -->
        </div>
        <div class="post-footer">
           <div class="comments" >
              <div id="disqus_thread">
                
              </div>
           </div>
        </div>
     </article>
  </div>
</main>
@endsection
 