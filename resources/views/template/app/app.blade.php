<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('restaurant/css/china-bistro-home.css')}}">
    <link rel="stylesheet" href="{{asset('restaurant/css/bootstrap/bootstrap.css')}}">
    <link rel="icon" href="{{asset('images/restaurant/restaurant-logo-favicon.png')}}" type="image/png" sizes="16x16">
    <link href='https://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
     <!-- Sección opcional para agregar más CSS si lo deseas -->
     @yield('styles')
    <title>@yield('title')</title>
</head>
<body class="normal-body">
    <div class="body">
    <header>
        <nav class="nav navbar-default">
            <div class="container-md  content-all-header">
            <div class="navbar-header">
                <div class="navbar-main-brand">
                    <a href="{{route('cooking')}}"><div id="logo" alt="logo David Chu's China Bistro"></div></a>
                    <div class="navbar-brand">
                        <a href="{{route('cooking')}}"><h1>David Chu's China Bistro</h1></a>
                        <p>
                            <img src="{{asset('images/restaurant/star-k-logo.png')}}" alt="Kosher certification">
                            <span>Kosher Certified</span>
                        </p>
                    </div>
                </div>
            <div class="nav-list">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="element-i" href="{{route('cooking.menu')}}">
                            <span class="glyphicon glyphicon-cutlery"></span>Menu
                        </a>
                    </li>
                    <li>
                        <a class="element-i" href="{{route('cook.about')}}">
                            <span class="glyphicon glyphicon-info-sign"></span>About
                        </a>
                    </li>
                    <li>
                        <a class="element-i" href="{{route('cook.awards')}}">
                            <span class="glyphicon glyphicon-certificate"></span>Awards
                        </a>
                    </li>
                    <li>
                         
                        <a class="phone" href="tel:410-602-5008">
                           <span> 410-602-5008</span>
                        </a>
                        <div>* We Deliver</div>
                    </li>
                </ul>
            </div>
            </div>
            <div class="container-burger">
                <button data-active="false" class="buttons-burger"> 
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </button>
            </div>
            </div>
           
        </nav>
        <hr class="burger-hr hr-color">
        <div class="container-burger-menu"> 
            <ul class="menu-burger">
                <li><a href="{{route('cooking')}}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                <li><a href="{{route('cooking.menu')}} "><span class="glyphicon glyphicon-cutlery"></span> Menu</a></li>
                <li><a href="{{route('cook.about')}}"><span class="glyphicon glyphicon-info-sign"></span> About</a></li>
                <li><a href="{{route('cook.awards')}}"><span class="glyphicon glyphicon-certificate"></span> Awards</a></li>
            </ul>
        </div>
    </header>
   
    <div class="contact-sm">
        <div class="contact-sm-content">
            <p><a href="tel:410-602-5008"><span class="glyphicon  glyphicon-earphone"></span> 410-602-5008</a></p>
        </div>
       
        <p class="contact-sm-deliver">* We Deliver</p>
    </div>
    <div class="body-content">
            @yield('content')
    </div>
    <footer class="panel-footer">
        <div class="container" >
      <div class="panle-footer-content row">
        <section id="hours" class="col-sm-12 col-md-4 col-padding">
            <p>
            <span class="hours-title">Hours:</span>
            <span>Sun-Thurs: 11:15am - 10:00pm</span>
            <span>Fri: 11:15am - 2:30pm</span>
            <span>Saturday Closed</span>
            
            </p>
            <hr class="d-sm-block d-md-none ">
            
           
        </section>
        <section id="address" class="col-sm-12 col-md-4 col-padding">
            <p class="p-address">
                <span class="hours-title">Address:</span>
                <span>7105 Reisterstown Road</span>
                <span>Baltimore, MD 21215</span>
                <span class="p-Delivery">* Delivery area within 3-4 miles, with minimum order of $20 plus $3 charge for all deliveries.</span>

            </p>
            <hr class="d-sm-block d-md-none">
        </section>
        <section id="testimonials" class="col-sm-12 col-md-4 col-padding">
            <p>"The best Chinese restaurant I've been to! And that's saying a lot, since I've been to many!"</p>
            <p>"Amazing food! Great service! Couldn't ask for more! I'll be back again and again!"</p>
        </section>
        </div>
        <div class="access" class="text-center">
            © Copyright David Chu's China Bistro 2016 |
            @guest
            <a href="{{Route('admin')}}"> Admin</a>   
            @endguest
            @auth
            <a href="{{ route('cook.logout') }}">Log out</a>
            @endauth

        </div>

    </div>
    </footer>
    </div>
    <script src="{{asset('restaurant/js/restaurant.js')}}"></script>
    @yield('script-category')
</body>
</html>