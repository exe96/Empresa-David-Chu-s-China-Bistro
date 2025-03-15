
    <div class="container-md">
        <div class="jumbotron"></div>
        <div class="home-tiles row">
            <div class="col-lg-4 col-md-6 col-sm-12 col-12 col-xs-12">
                <a class="a-tile" href="{{route('cooking.menu')}}"> 
                    <div class="menu-tile">
                        <span>MENU</span>
                    </div>
                </a>
            </div>
            <div class="col-lg-4  col-md-6 col-sm-12 col-12 col-xs-12">
                <a class="a-tile" href="{{route('get.food.selected', ['food' => 'SP'])}}">
                    <div class="specials-tile">
                        <span>SPECIALS</span>
                    </div>
                </a>
            </div>    
            <div  class="col-lg-4 col-md-12 col-sm-12 col-12 col-xs-12">
                <a class="a-tile" href="#">
                    <div id="map" class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12340.20832514406!2d-76.711688!3d39.363589999999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c81a14e7817803%3A0xab20a0e99daa17ea!2sDavid%20Chu&#39;s%20China%20Bistro!5e0!3m2!1ses!2sus!4v1734562822107!5m2!1ses!2sus" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;"> allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <span>MAP</span>
                    </div>
                
                    </a>
            </div>
        </div>
        
    </div>
