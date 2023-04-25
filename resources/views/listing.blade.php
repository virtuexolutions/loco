@extends('layouts.front_master')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

<section class="main-listing-sec">
    <div class="container lisitng-main-inner-div">
        <div class="top-heading-listing">
            <h2>TOP 5 OVERALL</h2>
            <h3>APARTMENTS FOR YOU!</h3>
            <p>(BASED ON YOUR RESPONSES)</p>
        </div>
        <div class="row apt-main-card">
            @if($asc)
            @foreach($asc as $row)
            <div class="col-md-3 transform-bigger">
                <a href="{{url('/property_detail')}}">
                    <div class="upper-card-sec">
                        <div class="heart-icon">
                            <img src="{{asset('/')}}assests/heart.svg" />
                        </div>
                        <div class="rating-div">
                            <ul>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star-half" aria-hidden="true"></i></li>
                            </ul>
                        </div>   
                        <img src="{{ ($row->image) ? $row->image : asset('adminTheme/images/noimage.jpg') }}" />
                        <div class="inner-card-sec">
                            <h3>Apartment</h3>
                            <h3>For {{$row->type}}</h3>
                        </div>
                    </div>
                    <div class="lower-card-sec">   
                        <h3 class="apt-price">{{$row->price_range}} </h3>  
                        <h3 class="apt-title">{{ \Illuminate\Support\Str::limit($row->name, 20, $end='...') }}</h3>
                        <h3 class="apt-desc">{{$row->detailsAddressStreet}}</h3>   
                    </div>
                    <ul class="apt-feat">
                        <li><img src="assests/bed-side-a.svg" /><h5></h5></li>
                        <li><img src="assests/bathup.svg" /><h5></h5></li>
                        <li><img src="assests/iconspace_Intersect_25px.svg" /><h5></h5></li>
                    </ul>
                </a>
            </div>
            @endforeach
            @endif
        </div>
            
                

            <div class="top-locations">
             <h2>TOP 5 LOCATIONS</h2>   
            <div class="autoplay row apt-main-card">
            @foreach($desc as $row)
                <div class="col-md-3">
                    <a href="{{url('/property_detail')}}">
                    <div class="upper-card-sec">
                     <div class="heart-icon"><img src="assests/heart.svg" /></div>   
                     <div class="rating-div">
                        <ul>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                        </ul>
                     </div>   
                    <img src="{{ ($row->image) ? $row->image : asset('adminTheme/images/noimage.jpg') }}" />
                    <div class="inner-card-sec">
                    <h3>Apartment</h3>
                    <h3>For {{$row->type}}</h3>
                    </div>
                    </div>
                 <div class="lower-card-sec">   
                 <h3 class="apt-price">{{$row->price_range}} </h3>  
                        <h3 class="apt-title">{{ \Illuminate\Support\Str::limit($row->name, 20, $end='...') }}</h3>
                        <h3 class="apt-desc">{{$row->detailsAddressStreet}}</h3> 
                </div>
                <ul class="apt-feat">
                    <li><img src="assests/bed-side-a.svg" /><h5></h5></li>
                    <li><img src="assests/bathup.svg" /><h5></h5></li>
                    <li><img src="assests/iconspace_Intersect_25px.svg" /><h5></h5></li>
                </ul>
            </a>
                </div>
            @endforeach
              

            </div>
        </div>
        <div class="top-amenities">
            <h2>TOP 5 AMENITIES</h2>   
           <div class="autoplay row apt-main-card">
               <div class="col-md-3">
                   <a href="property.html">
                   <div class="upper-card-sec">
                    <div class="heart-icon"><img src="assests/heart.svg" /></div>   
                    <div class="rating-div">
                       <ul>
                           <li><i class="fa fa-star" aria-hidden="true"></i></li>
                           <li><i class="fa fa-star" aria-hidden="true"></i></li>
                           <li><i class="fa fa-star" aria-hidden="true"></i></li>
                           <li><i class="fa fa-star" aria-hidden="true"></i></li>
                           <li><i class="fa fa-star" aria-hidden="true"></i></li>
                       </ul>
                    </div>   
                   <img src="assests/Mask.png" />
                   <div class="inner-card-sec">
                   <h3>Apartment</h3>
                   <h3>For Rent</h3>
                   </div>
                   </div>
                <div class="lower-card-sec">   
                 <h3 class="apt-price">$ 220,00 <span>per month</span></h3>  
                 <h3 class="apt-title">Apartment MBS</h3>
                 <h3 class="apt-desc">Perum MBS, No 113 Condong Catur, Sleman Yogyakarta.</h3>   
               </div>
               <ul class="apt-feat">
                   <li><img src="assests/bed-side-a.svg" /><h5>2 Bd</h5></li>
                   <li><img src="assests/bathup.svg" /><h5>1 Bd</h5></li>
                   <li><img src="assests/iconspace_Intersect_25px.svg" /><h5>726sqft</h5></li>
               </ul>
           </a>
               </div>
               <div class="col-md-3">
                   <a href="property.html">
                   <div class="upper-card-sec">
                    <div class="heart-icon"><img src="assests/heart.svg" /></div>   
                    <div class="rating-div">
                       <ul>
                           <li><i class="fa fa-star" aria-hidden="true"></i></li>
                           <li><i class="fa fa-star" aria-hidden="true"></i></li>
                           <li><i class="fa fa-star" aria-hidden="true"></i></li>
                           <li><i class="fa fa-star" aria-hidden="true"></i></li>
                           <li><i class="fa fa-star" aria-hidden="true"></i></li>
                       </ul>
                    </div>   
                   <img src="assests/Mask-2.png" />
                   <div class="inner-card-sec">
                   <h3>Home</h3>
                   <h3>For Sell</h3>
                   </div>
                   </div>
                <div class="lower-card-sec">   
                 <h3 class="apt-price">$ 144.220,00 <span></span></h3>  
                 <h3 class="apt-title">House of Raminten</h3>
                 <h3 class="apt-desc">Perum MBS, No 113 Condong Catur, Sleman Yogyakarta.</h3>   
               </div>
               <ul class="apt-feat">
                   <li><img src="assests/bed-side-a.svg" /><h5>2 Bd</h5></li>
                   <li><img src="assests/bathup.svg" /><h5>1 Bd</h5></li>
                   <li><img src="assests/iconspace_Intersect_25px.svg" /><h5>726sqft</h5></li>
               </ul>
</a>
               </div>
               <div class="col-md-3">
                   <a href="property.html">
                   <div class="upper-card-sec">
                    <div class="heart-icon"><img src="assests/heart.svg" /></div>   
                    <div class="rating-div">
                       <ul>
                           <li><i class="fa fa-star" aria-hidden="true"></i></li>
                           <li><i class="fa fa-star" aria-hidden="true"></i></li>
                           <li><i class="fa fa-star" aria-hidden="true"></i></li>
                           <li><i class="fa fa-star" aria-hidden="true"></i></li>
                           <li><i class="fa fa-star-half" aria-hidden="true"></i></li>
                       </ul>
                    </div>   
                   <img src="assests/Mask-3.png" />
                   <div class="inner-card-sec">
                   <h3>Home</h3>
                   <h3>For Sell</h3>
                   </div>
                   </div>
                <div class="lower-card-sec">   
                 <h3 class="apt-price">$ 144.530,00 <span></span></h3>  
                 <h3 class="apt-title">House of BTPN</h3>
                 <h3 class="apt-desc">Perum MBS, No 113 Condong Catur, Sleman Yogyakarta.</h3>   
               </div>
               <ul class="apt-feat">
                   <li><img src="assests/bed-side-a.svg" /><h5>2 Bd</h5></li>
                   <li><img src="assests/bathup.svg" /><h5>1 Bd</h5></li>
                   <li><img src="assests/iconspace_Intersect_25px.svg" /><h5>726sqft</h5></li>
               </ul>
               </a>
               </div>
               <div class="col-md-3">
                   <a href="property.html">
                   <div class="upper-card-sec">
                    <div class="heart-icon"><img src="assests/heart.svg" /></div>   
                    <div class="rating-div">
                       <ul>
                           <li><i class="fa fa-star" aria-hidden="true"></i></li>
                           <li><i class="fa fa-star" aria-hidden="true"></i></li>
                           <li><i class="fa fa-star" aria-hidden="true"></i></li>
                           <li><i class="fa fa-star" aria-hidden="true"></i></li>
                           <li><i class="fa fa-star-half" aria-hidden="true"></i></li>
                       </ul>
                    </div>   
                   <img src="assests/Mask-3.png" />
                   <div class="inner-card-sec">
                   <h3>Home</h3>
                   <h3>For Sell</h3>
                   </div>
                   </div>
                <div class="lower-card-sec">   
                 <h3 class="apt-price">$ 144.530,00 <span></span></h3>  
                 <h3 class="apt-title">House of BTPN</h3>
                 <h3 class="apt-desc">Perum MBS, No 113 Condong Catur, Sleman Yogyakarta.</h3>   
               </div>
               <ul class="apt-feat">
                   <li><img src="assests/bed-side-a.svg" /><h5>2 Bd</h5></li>
                   <li><img src="assests/bathup.svg" /><h5>1 Bd</h5></li>
                   <li><img src="assests/iconspace_Intersect_25px.svg" /><h5>726sqft</h5></li>
               </ul>
               </a>
               </div>
               <div class="col-md-3">
                   <a href="property.html">
                   <div class="upper-card-sec">
                    <div class="heart-icon"><img src="assests/heart.svg" /></div>   
                    <div class="rating-div">
                       <ul>
                           <li><i class="fa fa-star" aria-hidden="true"></i></li>
                           <li><i class="fa fa-star" aria-hidden="true"></i></li>
                           <li><i class="fa fa-star" aria-hidden="true"></i></li>
                           <li><i class="fa fa-star" aria-hidden="true"></i></li>
                           <li><i class="fa fa-star-half" aria-hidden="true"></i></li>
                       </ul>
                    </div>   
                   <img src="assests/Mask-3.png" />
                   <div class="inner-card-sec">
                   <h3>Home</h3>
                   <h3>For Sell</h3>
                   </div>
                   </div>
                <div class="lower-card-sec">   
                 <h3 class="apt-price">$ 144.530,00 <span></span></h3>  
                 <h3 class="apt-title">House of BTPN</h3>
                 <h3 class="apt-desc">Perum MBS, No 113 Condong Catur, Sleman Yogyakarta.</h3>   
               </div>
               <ul class="apt-feat">
                   <li><img src="assests/bed-side-a.svg" /><h5>2 Bd</h5></li>
                   <li><img src="assests/bathup.svg" /><h5>1 Bd</h5></li>
                   <li><img src="assests/iconspace_Intersect_25px.svg" /><h5>726sqft</h5></li>
               </ul>
               </a>
               </div>
               <div class="col-md-3">
                   <a href="property.html">
                   <div class="upper-card-sec">
                    <div class="heart-icon"><img src="assests/heart.svg" /></div>   
                    <div class="rating-div">
                       <ul>
                           <li><i class="fa fa-star" aria-hidden="true"></i></li>
                           <li><i class="fa fa-star" aria-hidden="true"></i></li>
                           <li><i class="fa fa-star" aria-hidden="true"></i></li>
                           <li><i class="fa fa-star" aria-hidden="true"></i></li>
                           <li><i class="fa fa-star-half" aria-hidden="true"></i></li>
                       </ul>
                    </div>   
                   <img src="assests/Mask-3.png" />
                   <div class="inner-card-sec">
                   <h3>Home</h3>
                   <h3>For Sell</h3>
                   </div>
                   </div>
                <div class="lower-card-sec">   
                 <h3 class="apt-price">$ 144.530,00 <span></span></h3>  
                 <h3 class="apt-title">House of BTPN</h3>
                 <h3 class="apt-desc">Perum MBS, No 113 Condong Catur, Sleman Yogyakarta.</h3>   
               </div>
               <ul class="apt-feat">
                   <li><img src="assests/bed-side-a.svg" /><h5>2 Bd</h5></li>
                   <li><img src="assests/bathup.svg" /><h5>1 Bd</h5></li>
                   <li><img src="assests/iconspace_Intersect_25px.svg" /><h5>726sqft</h5></li>
               </ul>
               </a>
               </div>
             

           </div>
       </div>
       <div class="top-special">
        <h2>TOP 5 SPECIAL</h2>   
       <div class="autoplay row apt-main-card">
           <div class="col-md-3">
               <a href="property.html">
               <div class="upper-card-sec">
                <div class="heart-icon"><img src="assests/heart.svg" /></div>   
                <div class="rating-div">
                   <ul>
                       <li><i class="fa fa-star" aria-hidden="true"></i></li>
                       <li><i class="fa fa-star" aria-hidden="true"></i></li>
                       <li><i class="fa fa-star" aria-hidden="true"></i></li>
                       <li><i class="fa fa-star" aria-hidden="true"></i></li>
                       <li><i class="fa fa-star" aria-hidden="true"></i></li>
                   </ul>
                </div>   
               <img src="assests/Mask.png" />
               <div class="inner-card-sec">
               <h3>Apartment</h3>
               <h3>For Rent</h3>
               </div>
               </div>
            <div class="lower-card-sec">   
             <h3 class="apt-price">$ 220,00 <span>per month</span></h3>  
             <h3 class="apt-title">Apartment MBS</h3>
             <h3 class="apt-desc">Perum MBS, No 113 Condong Catur, Sleman Yogyakarta.</h3>   
           </div>
           <ul class="apt-feat">
               <li><img src="assests/bed-side-a.svg" /><h5>2 Bd</h5></li>
               <li><img src="assests/bathup.svg" /><h5>1 Bd</h5></li>
               <li><img src="assests/iconspace_Intersect_25px.svg" /><h5>726sqft</h5></li>
           </ul>
       </a>
           </div>
           <div class="col-md-3">
               <a href="property.html">
               <div class="upper-card-sec">
                <div class="heart-icon"><img src="assests/heart.svg" /></div>   
                <div class="rating-div">
                   <ul>
                       <li><i class="fa fa-star" aria-hidden="true"></i></li>
                       <li><i class="fa fa-star" aria-hidden="true"></i></li>
                       <li><i class="fa fa-star" aria-hidden="true"></i></li>
                       <li><i class="fa fa-star" aria-hidden="true"></i></li>
                       <li><i class="fa fa-star" aria-hidden="true"></i></li>
                   </ul>
                </div>   
               <img src="assests/Mask-2.png" />
               <div class="inner-card-sec">
               <h3>Home</h3>
               <h3>For Sell</h3>
               </div>
               </div>
            <div class="lower-card-sec">   
             <h3 class="apt-price">$ 144.220,00 <span></span></h3>  
             <h3 class="apt-title">House of Raminten</h3>
             <h3 class="apt-desc">Perum MBS, No 113 Condong Catur, Sleman Yogyakarta.</h3>   
           </div>
           <ul class="apt-feat">
               <li><img src="assests/bed-side-a.svg" /><h5>2 Bd</h5></li>
               <li><img src="assests/bathup.svg" /><h5>1 Bd</h5></li>
               <li><img src="assests/iconspace_Intersect_25px.svg" /><h5>726sqft</h5></li>
           </ul>
</a>
           </div>
           <div class="col-md-3">
               <a href="property.html">
               <div class="upper-card-sec">
                <div class="heart-icon"><img src="assests/heart.svg" /></div>   
                <div class="rating-div">
                   <ul>
                       <li><i class="fa fa-star" aria-hidden="true"></i></li>
                       <li><i class="fa fa-star" aria-hidden="true"></i></li>
                       <li><i class="fa fa-star" aria-hidden="true"></i></li>
                       <li><i class="fa fa-star" aria-hidden="true"></i></li>
                       <li><i class="fa fa-star-half" aria-hidden="true"></i></li>
                   </ul>
                </div>   
               <img src="assests/Mask-3.png" />
               <div class="inner-card-sec">
               <h3>Home</h3>
               <h3>For Sell</h3>
               </div>
               </div>
            <div class="lower-card-sec">   
             <h3 class="apt-price">$ 144.530,00 <span></span></h3>  
             <h3 class="apt-title">House of BTPN</h3>
             <h3 class="apt-desc">Perum MBS, No 113 Condong Catur, Sleman Yogyakarta.</h3>   
           </div>
           <ul class="apt-feat">
               <li><img src="assests/bed-side-a.svg" /><h5>2 Bd</h5></li>
               <li><img src="assests/bathup.svg" /><h5>1 Bd</h5></li>
               <li><img src="assests/iconspace_Intersect_25px.svg" /><h5>726sqft</h5></li>
           </ul>
           </a>
           </div>
           <div class="col-md-3">
               <a href="property.html">
               <div class="upper-card-sec">
                <div class="heart-icon"><img src="assests/heart.svg" /></div>   
                <div class="rating-div">
                   <ul>
                       <li><i class="fa fa-star" aria-hidden="true"></i></li>
                       <li><i class="fa fa-star" aria-hidden="true"></i></li>
                       <li><i class="fa fa-star" aria-hidden="true"></i></li>
                       <li><i class="fa fa-star" aria-hidden="true"></i></li>
                       <li><i class="fa fa-star-half" aria-hidden="true"></i></li>
                   </ul>
                </div>   
               <img src="assests/Mask-3.png" />
               <div class="inner-card-sec">
               <h3>Home</h3>
               <h3>For Sell</h3>
               </div>
               </div>
            <div class="lower-card-sec">   
             <h3 class="apt-price">$ 144.530,00 <span></span></h3>  
             <h3 class="apt-title">House of BTPN</h3>
             <h3 class="apt-desc">Perum MBS, No 113 Condong Catur, Sleman Yogyakarta.</h3>   
           </div>
           <ul class="apt-feat">
               <li><img src="assests/bed-side-a.svg" /><h5>2 Bd</h5></li>
               <li><img src="assests/bathup.svg" /><h5>1 Bd</h5></li>
               <li><img src="assests/iconspace_Intersect_25px.svg" /><h5>726sqft</h5></li>
           </ul>
           </a>
           </div>
           <div class="col-md-3">
               <a href="property.html">
               <div class="upper-card-sec">
                <div class="heart-icon"><img src="assests/heart.svg" /></div>   
                <div class="rating-div">
                   <ul>
                       <li><i class="fa fa-star" aria-hidden="true"></i></li>
                       <li><i class="fa fa-star" aria-hidden="true"></i></li>
                       <li><i class="fa fa-star" aria-hidden="true"></i></li>
                       <li><i class="fa fa-star" aria-hidden="true"></i></li>
                       <li><i class="fa fa-star-half" aria-hidden="true"></i></li>
                   </ul>
                </div>   
               <img src="assests/Mask-3.png" />
               <div class="inner-card-sec">
               <h3>Home</h3>
               <h3>For Sell</h3>
               </div>
               </div>
            <div class="lower-card-sec">   
             <h3 class="apt-price">$ 144.530,00 <span></span></h3>  
             <h3 class="apt-title">House of BTPN</h3>
             <h3 class="apt-desc">Perum MBS, No 113 Condong Catur, Sleman Yogyakarta.</h3>   
           </div>
           <ul class="apt-feat">
               <li><img src="assests/bed-side-a.svg" /><h5>2 Bd</h5></li>
               <li><img src="assests/bathup.svg" /><h5>1 Bd</h5></li>
               <li><img src="assests/iconspace_Intersect_25px.svg" /><h5>726sqft</h5></li>
           </ul>
           </a>
           </div>
           <div class="col-md-3">
               <a href="property.html">
               <div class="upper-card-sec">
                <div class="heart-icon"><img src="assests/heart.svg" /></div>   
                <div class="rating-div">
                   <ul>
                       <li><i class="fa fa-star" aria-hidden="true"></i></li>
                       <li><i class="fa fa-star" aria-hidden="true"></i></li>
                       <li><i class="fa fa-star" aria-hidden="true"></i></li>
                       <li><i class="fa fa-star" aria-hidden="true"></i></li>
                       <li><i class="fa fa-star-half" aria-hidden="true"></i></li>
                   </ul>
                </div>   
               <img src="assests/Mask-3.png" />
               <div class="inner-card-sec">
               <h3>Home</h3>
               <h3>For Sell</h3>
               </div>
               </div>
            <div class="lower-card-sec">   
             <h3 class="apt-price">$ 144.530,00 <span></span></h3>  
             <h3 class="apt-title">House of BTPN</h3>
             <h3 class="apt-desc">Perum MBS, No 113 Condong Catur, Sleman Yogyakarta.</h3>   
           </div>
           <ul class="apt-feat">
               <li><img src="assests/bed-side-a.svg" /><h5>2 Bd</h5></li>
               <li><img src="assests/bathup.svg" /><h5>1 Bd</h5></li>
               <li><img src="assests/iconspace_Intersect_25px.svg" /><h5>726sqft</h5></li>
           </ul>
           </a>
           </div>
         

       </div>
   </div>
           
        </div>
    </section>
    <script>
//   $('.autoplay').slick({
//   slidesToShow: 4,
//   slidesToScroll: 1,
//   autoplay: true,
//   autoplaySpeed: 2000,
//   prevArrow: '<button class="slide-arrow prev-arrow"></button>',
//     nextArrow: '<button class="slide-arrow next-arrow"></button>',
// });


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
@endsection
