@extends('cook.template.app.app')
@section('content')
@section('styles')
<link rel="stylesheet" href="{{asset('restaurant/css/about.css')}}">

@endsection
<div class="container section-about" >
<h1>About This Website</h1>
<p>It may be hard to tell, but this website does much more than just help you choose a delicious dish from this cozy little restaurant. The website of this restaurant has served over 100,000 students all over the world (and counting), teaching them the skills of how to develop a website from scratch. <a href="https://www.davidchuschinabistro.com/">Original page</a> | <a href="https://www.coursera.org/learn/html-css-javascript-for-web-developers/home/module/1">Original course</a></p>
<div class="video-container">
<iframe title="Coursera course video" width="1280" height="720" src="https://www.youtube.com/embed/YR_rIjUIDeE" title="Field Trip In a Coding Course? - Web Development Client Visit and Interview" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
</div>
</div>
@endsection
