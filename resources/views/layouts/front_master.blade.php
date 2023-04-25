<!doctype html>
<html lang="en">
  <head>
    <title>Loco Locators</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS v5.2.0-beta1 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  >
    <link rel="stylesheet" href="{{asset('/')}}assests/style.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
  <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">

  </head>
  <body @if(request()->segment(1) == 'listing') class="listing-body" @endif  @if(request()->segment(1) == 'register') id="hodor-body" @endif>
    <header>
        <nav class="navbar navbar-expand-sm">
              <div class="container-fluid px-5">
              <a class="navbar-brand" href="{{url('/')}}">
                @php
                $logo = \DB::table('logos')->first();
                @endphp
                <img id="logo" src="{{ ($logo) ? asset('/adminTheme/uploads/logo/'.$logo->image) : asset("images") }}" /></a>
                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                        <li class="nav-item hover">
                            <a class="nav-link fw-bolder" href="#">ABOUT US</a>
                        </li>
                        <li class="nav-item hover">
                            <a class="nav-link fw-bolder" href="{{url('listing')}}">RENTAL</a>
                        </li>
                        <li class="nav-item hover">
                            <a class="nav-link fw-bolder" href="#">LOCO REWARDS</a>
                        </li>
                        <li class="nav-item hover">
                            <a class="nav-link fw-bolder" href="{{url('register')}}">SIGN UP</a>
                        </li>
                        <li class="nav-item hover">
                            <a class="nav-link fw-bolder" href="{{ route('login') }}">LOG IN</a>
                        </li>
                    </ul>
                </div>
          </div>
        </nav>
        
    </header>
    @yield('content')
    <footer>
    <div id="main-footer" class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <img src="assests/logo.png"/>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
                <div class="col-md-2">
                    <h2>Discover</h2>
                    <ul>
                        <li>About us</li>
                        <li>Rental</li>
                        <li>Loco Rewards</li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h2>Follow Us</h2>
                    <ul>
                        <li>Facebook</li>
                        <li>Twitter</li>
                        <li>Instagram</li>
                        <li>Youtube</li>
                    </ul>
                </div>
            </div>
            <div id="footer-bottom" class="row">
                <div class="col-md-9"><p>© 2022 All Right Reserved</p></div>
                <div class="col-md-3">
                    <ul class="ms-auto">
                        <li>Terms |</li>
                        <li>Privacy |</li>
                        <li>Compliances</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
   
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyDqnUWO38RJMjRlwsY1imxqB1WI8ZWsU3M"></script>
	  
    <!-- Listin -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>


$(".autoplay").slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        prevArrow: '<button class="slide-arrow prev-arrow"></button>',
        nextArrow: '<button class="slide-arrow next-arrow"></button>',

        responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }

  ]

      }); 
	
</script>
  <script>
      //jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var  top, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$("#move_calender").datepicker({
  navigationAsDateFormat: true
});
$(".next").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	next_fs = $(this).parent().next();
	
	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
	
	//show the next fieldset
	next_fs.show(); 
	
  current_fs.hide();
  animating = false;
});

$(".previous").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();
	
	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
	
	//show the previous fieldset
	previous_fs.show(); 
	
  current_fs.hide();
			animating = false;
});

$(".submit").click(function(){
	return false;
})
  </script>
  <script>
    $(".image-checkbox").each(function () {
  if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
    $(this).addClass('image-checkbox-checked');
  }
  else {
    $(this).removeClass('image-checkbox-checked');
  }
});

// sync the state to the input
$(".image-checkbox").on("click", function (e) {
  $(this).toggleClass('image-checkbox-checked');
  var $checkbox = $(this).find('input[type="checkbox"]');
  $checkbox.prop("checked",!$checkbox.prop("checked"))

  e.preventDefault();
});
  </script>
   <script>
    $(".image-checkbox-1").each(function () {
  if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
    $(this).addClass('image-checkbox-1-checked');
  }
  else {
    $(this).removeClass('image-checkbox-1-checked');
  }
});

// sync the state to the input
$(".image-checkbox-1").on("click", function (e) {
  $(this).toggleClass('image-checkbox-1-checked');
  var $checkbox = $(this).find('input[type="checkbox"]');
  $checkbox.prop("checked",!$checkbox.prop("checked"))

  e.preventDefault();
});
  </script>


<script>
  var canvas = document.getElementById('map-canvas');
var myLatlng = new google.maps.LatLng(52.512594,13.431108);

var mapOptions = {
	zoom: 13,
	center: myLatlng,
	mapTypeId: google.maps.MapTypeId.ROADMAP
};
var map = new google.maps.Map(canvas, mapOptions);

var circleOptions = {
	draggable: true,
	editable: true,
   	strokeColor: '#eeeeee',
   	strokeOpacity: 0.8,
	strokeWeight: 1,
   	fillColor: '#FF0000',
   	fillOpacity: 0.15,
   	map: map,
   	center: myLatlng,
   	radius: 2000
};
var circle = new google.maps.Circle(circleOptions);

google.maps.event.addListener(circle, 'center_changed', update);
google.maps.event.addListener(circle, 'radius_changed', update);
	
function update() {
	var debug = document.getElementById("debug");
	var d = Math.pow(10,5);
	debug.innerHTML = "lat: " + Math.round(circle.getCenter().lat()*d)/d + "<br>";
	debug.innerHTML += "lng: " + Math.round(circle.getCenter().lng()*d)/d + "<br>";
	debug.innerHTML += "radius: " + Math.round(circle.getRadius()) + " m<br>";
}

update();

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
	var $progControl = $(".progControlSelect2").select2({
		placeholder: "Type to add an activity to user..."
	});
	//Disable select open on option remove
	$("select").on("select2:unselect", function (evt) {
		if (!evt.params.originalEvent) {
			return;
		}
		evt.params.originalEvent.stopPropagation();
	});
	
	
});
</script>

<script type="text/javascript">
//   $(document).ready(function(){
  function initialize() {
    var input = document.getElementById('search_input');
    var autocomplete = new google.maps.places.Autocomplete(input);
    
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var place = autocomplete.getPlace();  
            // get lat/long using place.geometry.location      
            document.getElementById('loc_lat').value = place.geometry.location.lat();
            document.getElementById('loc_long').value = place.geometry.location.lng();
            
        });
      }
    // });
    
  </script>
  </body>
</html>