<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Property | Loco Locators</title>

    <!-- Fonts -->
    <!-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->
    <!-- Styles listing page -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.css"  />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/> 
    <!-- Register -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
  
     <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.css" integrity="sha512-8D+M+7Y6jVsEa7RD6Kv/Z7EImSpNpQllgaEIQAtqHcI0H6F4iZknRj0Nx1DCdB+TwBaS+702BGWYC0Ze2hpExQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />  -->
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"> -->
    <!-- <link rel="stylesheet" href="{{asset('css/style.css')}}"> -->
    <!-- <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet"> -->


</head>
@php

$url = Request::segment(1);
@endphp
<body @if($url == 'listing') class="listing-body" @endif style="overflow-x: hidden;" @if($url == 'register') id="hodor-body" @endif>
    @include('partials_views.header')
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @include('partials_views.footer')
      
</body>
   <!-- Listing Page -->
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
   <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
   <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
   <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
   <script>
  
     $('.autoplay').slick({
       slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    prevArrow: '<button class="slide-arrow prev-arrow"></button>',
    nextArrow: '<button class="slide-arrow next-arrow"></button>',
  });
  </script> 
  
  <!-- Listing Detail Page -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
  <!-- Register -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="{{ asset('js/custom.js') }}" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>

  @stack('js')

<script>
  $(document).ready(function(){
$(".add-to-list").on("click", function() {
  var cart = $(".shopping-cart");
   var imgtodrag = $(".item").eq(0);
  //var imgtodrag = $(this).parent().prop("class");
  if (imgtodrag) {
    var imgclone = imgtodrag
      .clone()
      .offset({
        top: imgtodrag.offset().top,
        left: imgtodrag.offset().left
      })
      .css({
        opacity: "0.9",
        position: "absolute",
        height: "100vh",
        width: "25%",
        "z-index": "100"
      })
      .appendTo($("body"))
      .animate(
        {
          top: cart.offset().top + 10,
          left: cart.offset().left + 10,
          width: 0,
          height: 0
        },
        1200,
        "easeInOutExpo"
      );
    setTimeout(function() {
      cart.effect(
        "shake",
        {
          times: 2
        },
        200
      );
    }, 1500);
    
    imgclone.animate(
      {
        width: 0,
        height: 0
      },
      function() {
        $(this).detach();
      }
    );
  }
});
});
</script>

<script>
    $(document).ready(function(){
  $(".remove-to-list").on("click", function() {
    var cart = $(".shopping-cart-neg");
     var imgtodrag = $(".item").eq(0);
    //var imgtodrag = $(this).parent().prop("class");
    if (imgtodrag) {
      var imgclone = imgtodrag
        .clone()
        .offset({
          top: imgtodrag.offset().top,
          left: imgtodrag.offset().left
        })
        .css({
          opacity: "0.9",
          position: "absolute",
          height: "100vh",
          width: "25%",
          "z-index": "100"
        })
        .appendTo($("body"))
        .animate(
          {
            top: cart.offset().top + 10,
            left: cart.offset().left + 10,
            width: 0,
            height: 0
          },
          700,
          "easeInOutExpo"
        );
      setTimeout(function() {
        cart.effect(
          "shake",
          {
            times: 2
          },
          200
        );
      }, 1500);
  
      imgclone.animate(
        {
          width: 0,
          height: 0
        },
        function() {
          $(this).detach();
        }
      );
    }
  });
  });
  </script>
  <script>
    const nav = document.getElementById('nav123');
const burger = document.getElementById('burger');
const overlay = document.getElementById('overlay123');


burger.addEventListener('click', () => {
    burger.classList.toggle('active');
    nav.classList.toggle('active');
    overlay.classList.toggle('active');
});
  </script>
   <script>
    const navv = document.getElementById('nav123');
const burgerr = document.getElementById('burger-back');
const overlayy = document.getElementById('overlay123');

burgerr.addEventListener('click', () => {
    burgerr.classList.remove('active');
    navv.classList.remove('active');
    overlayy.classList.remove('active');
});




</script>





   <!-- Scripts -->

   <!-- React Listing toogle -->


@if($url == 'property_detail') 
<script type="text/javascript">
  $(document).ready(function(){
  function initialize() {
    var input = document.getElementById('search_input');
    var autocomplete = new google.maps.places.Autocomplete(input);
    
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var place = autocomplete.getPlace();  
        alert(place)
            // get lat/long using place.geometry.location      
            document.getElementById('loc_lat').value = place.geometry.location.lat();
            document.getElementById('loc_long').value = place.geometry.location.lng();
            
        });
      }
    });
    
  </script>
  @endif
</html>
