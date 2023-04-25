@extends('layouts.front_master')

@section('content')

<!-- <section class="bg1">
    <div class="container">
    <h1 class="top">TOP 5 OVERALL</h1>
    <h4 class="apartment">APARTMENTS FOR YOU!</h4>
</div>
</section>

<section class="bg2">
    <div class="container-fluid">
        <h2 class="based">BASED ON YOUR RESPONSES</h2>
        <div class="row col-a">
        @if($listing)
            @foreach($listing as $row)
            <div class="col-md-6 col-sm-6 col-lg-3 top1">
                <div class="image-box">
                    <a href="javascript:"><img src="{{ ($row->image) ? $row->image : asset('adminTheme/images/noimage.jpg') }}" alt="1" class="property-image"></a>
                    <div class="icons">
                        <div class="heart">
                            <a href="javascript:"><i class="fa fa-2x fa-heart"></i></a>
                        </div>
                    </div>
                    <div class="category">
                        <h5 class="cat-1">Apartment</h5>
                        <h5 class="cat-2">For {{$row->type}}</h5>
                    </div>
                    <div class="property-details">
                        <p class="per"><span class="a">{{$row->price_range}}</span> </p>
                        <a href="{{url('/property_detail')}}"><h4 class="apartment1">{{ \Illuminate\Support\Str::limit($row->name, 20, $end='...') }}</h4></a>
                        <p class="perum">{{$row->detailsAddressStreet}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</div>
</section> -->

 <div id="home-first-sec" class="container-fluid">
      
        <div class="container">
            <h1>LET’S<br>GET LOCO</h1>
            <h2>Finding you the best apartments for rent</h2>
            <input class="text-feild-cus-css" type="text" placeholder="Search by city, zip or neighborhood" />
            <br>
            <button class="btn-main mt-3">Search</button>
        </div>
        <video autoplay muted loop id="myVideo">
            <source src="assests/Real-Estate-Promo-Video.mp4" type="video/mp4">
          </video>
          <div class="custom-overlay"></div>
    </div>

    <div  id="home-second-sec" class="container">
        <h2>BUY, RENT or SELL with loco!</h2>
        <div class="row">
            <div class="col">
                <img src="assests/Vector Smart Object.png"/>
                <h4>Buy</h4>
            </div>
            <div class="col">
                <img src="assests/Vector Smart Object-1.png"/>
                <h4>Sell</h4>
            </div>
            <div class="col">
                <img src="assests/Vector Smart Object-2.png"/>
                <h4>Rent</h4>
            </div>
        </div>
    </div>

    <div  id="home-third-sec" class="container-fluid">
        <h3>Our rental concierge does the heavy lifting</h3>
        <div class="row">
            <div class="col">
                <img src="assests/002-favorites.png"/>
                <h2>Getting to know you</h2>
                <h4>You’ll answer a few simple questions so we understand what you are really looking for in your next home.</h4>
            </div>
            <div class="col">
                <img src="assests/001-check-mark.png"/>
                <h2>Curating top matches</h2>
                <h4>When you add an apartment to your Short List, the savings concierge compares them and recommends the best property for you.</h4>
            </div>
            <div class="col">
                <img src="assests/003-guide-book.png"/>
                <h2>Guiding you to savings</h2>
                <h4>When you add an apartment to your Short List, the savings concierge compares them and recommends the best property for you.</h4>
            </div>
        </div>
    </div>
@endsection