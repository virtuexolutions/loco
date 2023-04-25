@extends('layouts.app')

@section('content')
<section class="main-listing-sec">
    <div class="container lisitng-main-inner-div">
        <div class="top-heading-listing">
            <h2>Your Search RESPONSE</h2>
        </div>
         <div class="top-locations">
            <!-- <h2></h2>    -->
            <div class="autoplay row apt-main-card">
            @if($listing)
            @foreach($listing as $row)
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
                            <img src="{{asset($row->image)}}" />
                            <!-- <div class="inner-card-sec">
                                <h3>Apartment</h3>
                                <h3>For Rent</h3>
                            </div> -->
                        </div>
                        <div class="lower-card-sec">   
                            <h3 class="apt-price">{{(!empty(explode($row->price,'$'))) ? $row->price : '$'.$row->price}}</h3>  
                            <h3 class="apt-title">{{$row->title}}</h3>
                            <h3 class="apt-desc">{{$row->address}}</h3>   
                        </div>
                        <ul class="apt-feat">
                            <li><img src="assests/bed-side-a.svg" /><h5>{{$row->no_of_Bedrooms}} Bd</h5></li>
                            <li><img src="assests/bathup.svg" /><h5>{{$row->bathrooms}} Bd</h5></li>
                            <li><img src="assests/iconspace_Intersect_25px.svg" /><h5>{{$row->square_foot}}sqft</h5></li>
                        </ul>
                    </a>
                </div>
            @endforeach
                <div>
                    <p style="color:red">No Rcord Found</p>
                </div>
            @endif
            </div>
        </div>
    </div>
</section>
    @endsection