@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div id="overlay123"></div>
    <div class="toggle-list-1"><span><i class="shopping-cart-neg"><img src="{{asset('assests/cart-icon.png')}}" /></i></span></div>
        <div class="row inner-cus-row">
            <div class="col-md-4 left-parent">
                @if($listing)
                <div class="left-inner-main item">
                    <h3 class="pro-desc">2 of 132 From Best Combo Of Price,<br> Location, And Amenities</h3>
                    <img class="main-pro-img" id="pr-image" src="{{ ( $listing['image']) ? $listing['image'] : asset('adminTheme/images/noimage.jpg') }}" />
                    <div class="custom-width-sec">
                        <div class="two-point-five">
                            <h4 class="pro-title" id="pr-title">{{$listing['name']}}</h4>
                        </div>
                        <div class="point-five-div">
                            <h5 class="pro-price" id="pr-price">{{ '$'.$listing->price_range}}</h5>
                        </div>
                    </div>
                    <div class="custom-width-sec">
                        <div class="two-point-five">
                            <h5 class="pro-contact" id="pr-contact">{{$listing['contact_no']}}</h5>
                        </div>
                        <div class="point-five-div">
                            <div class="rating-div-property-page">
                                <ul>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li>10/10</li>
                                </ul>
                                </div>   
                        </div>
                    </div>      
                    <div class="pro-scroller">
                        <div class="pro-ul">
                            <ul>
                                <li>
                                    <div class="ul-inner-parent-div">
                                        <div class="ul-inner-first-child">
                                            <img src="{{asset('assests/003-pin.svg')}}" />
                                        </div>
                                        <div class="ul-inner-second-child">
                                            <h5 id="pr-address"></h5>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="ul-inner-parent-div">
                                        <div class="ul-inner-first-child">
                                            <img src="{{asset('assests/001-building.svg')}}" />
                                        </div>
                                        <div class="ul-inner-second-child">
                                            <ul class="apt-feat-pro">
                                                <!-- <li><img src="{{asset('assests/bed-side-a.svg')}}" /><h5 id="pr-bad">{{str_replace('Bedrooms', ' ',$listing['bedrooms']) }}Bedrooms</h5></li>
                                                <li><img src="{{asset('assests/bathup.svg')}}" /><h5 id="pr-bath">{{$listing['total_baths']}}</h5></li>
                                                <li><img src="{{asset('assests/iconspace_Intersect_25px.svg')}}" /><h5 id="pr-square">{{$listing['sqFt']}}</h5></li> -->
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="ul-inner-parent-div">
                                        <div class="ul-inner-first-child">
                                            <img src="{{asset('assests/004-sports-car.svg')}}" />
                                        </div>
                                        <div class="ul-inner-second-child">
                                            <h5 class="orange">+Add Commute</h5>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="ul-inner-parent-div">
                                        <div class="ul-inner-first-child">
                                            <img src="{{asset('assests/002-youtube.svg')}}" />
                                        </div>
                                        <div class="ul-inner-second-child">
                                            <h5 class="orange" data-bs-toggle="modal" data-bs-target="#exampleModal">Live remote tours available</h5>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="avaial-sec-div">
                            <div class="price-avail-headings">
                                <h3>Price and Availability</h3>
                                <h4>Verified 24 hrs ago</h4>
                            </div>
                            <!-- Button trigger modal -->

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Live remote tours</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <video width="770"  controls>
                                        <source src="{{$listing['virtual_tour']}}" type="video/mp4">
                                        </video>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="best-match-pro">
                                <h4>Best match for you</h4>
                                @if($best_maches)
                                @foreach($best_maches as $row)
                                @if($row['distance'] > 0)
                                <div class="main-avail-sec-div">
                                    <div class="left-avail-sec-div">
                                        <img src="{{asset('assests/005-blueprint.svg')}}" />
                                    </div>
                                    <div class="middle-avail-sec-div">
                                        <h4>{{$row['unitname']}}</h4>
                                        <h5>{{str_replace('Bedrooms', ' ',$row['bedrooms']) }} Bed . {{$row['total_baths']}} Bath . {{$row['sqFt']}} sqft</h5>
                                        <h6>Available 8/26</h6>
                                    </div>
                                    <div class="right-avail-sec-div">
                                        <h3>{{'$'.$row->price_range}}</h3>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                @endif
                            </div>
                            
                        </div>
                    </div>
                    <div class="bottom-button-fancy">
                        <div class="two-button-cta-div">
                            <div class="cta-left-div">
                                <a href="/email-form">Email</a>
                            </div>
                            <div class="cta-right-div">
                                <a href="#">Schedule a Tour</a>
                            </div>
                        </div>
                        <div class="swiper-buttons-main">
                            <a class="remove-to-list" onclick="update_property('Nope')" href="javascript:void(0);"><img src="{{asset('assests/Group 173.png')}}" /><h6>NOPE</h6></a>
                            <a class="add-to-list" onclick="update_property('Love')" href="javascript:void(0);"><img src="{{asset('assests/Group 174.png')}}" /><h6>LOVE IT</h6></a>
                            <a class="add-to-list" onclick="update_property('Maybe')" href="javascript:void(0);"><img src="{{asset('assests/Group 175.png')}}" /><h6>MAYBE</h6></a>
                        </div>
                    </div>
                </div>
                @else
                <div class="left-inner-main item">
                    <div class="text-danger">
                        Property Not Found.!!
                    </div>
                </div>
                @endif
            </div>
            <div class="col-md-8 right-parent">
                <div id="googleMap" style="width:100%;height:100%;"></div>
                <div class="toggle-list"><span><i class="shopping-cart"><img id="burger" src="{{asset('assests/cart-icon.png')}}" /></i></span></div>
                    
                        <div id="nav123">
                        <div class="side-main-div">
                            <div class="side-head-main-div-upper">
                                <div class="side-head-main-div">
                                    <h4>Shortlist</h4>
                                    <a href="#">See all</a>
                                </div>
                                <div id="burger-back" class="backtomain-cross">X</div>
                            </div>
                            <div class="sidebar-bottom"> 
                                <div class="sidebar-visiting">
                                    <!-- <h4>Love It</h4> -->
                             
                                    <div class="sidebar-visitng-inner">
                                        @if($properties)
                                        @foreach($properties as  $row)
                                        @if($row['hasoptions'][0]->status == 'Love')
                                            @once
                                                <h4>Love it</h4>
                                                <br>
                                            @endonce
                                            <div class="sidebar-visiting-card" id="sidebar-visiting-card-{{$row->id}}">
                                                <div class="sidebar-card-image">
                                                    <img src="{{ ($row->image) ? $row->image : asset('adminTheme/images/noimage.jpg') }}" width="50" />
                                                </div>
                                                <div class="sidebar-card-details">
                                                    <h6 class="sidebar-card-title">{{$row->street_name}}</h6>
                                                    <h6 class="sidebar-card-amen"><span class="sidebar-card-price">{{$row->price}}</span> - <span class="sidebar-card-room">{{$row->bedrooms}}</span> - <span class="sidebar-card-bath">{{$row->full_baths}} Bath</span></h6>
                                                    <h6 class="sidebar-card-cta"><span class="sidebar-card-cta-a"></span> - <span class="sidebar-card-cta-b">Avail now</span></h6>
                                                </div>
                                                <div onclick="remove_property({{$row->id}})" class="backtomain-cross">X</div>
                                            </div>
                                            @endif
                                        @if($row['hasoptions'][0]->status == 'Maybe')
                                        @once
                                            <h4>Maybe</h4>
                                            <br>
                                        @endonce
                                            <div class="sidebar-visiting-card" id="sidebar-visiting-card-{{$row->listing_id}}">
                                                <div class="sidebar-card-image">
                                                    <img src="{{ ($row->image) ? $row->image : asset('adminTheme/images/noimage.jpg') }}" width="50" />
                                                </div>
                                                <div class="sidebar-card-details">
                                                    <h6 class="sidebar-card-title">{{$row->street_name}}</h6>
                                                    <h6 class="sidebar-card-amen"><span class="sidebar-card-price">{{$row->price}}</span> - <span class="sidebar-card-room">{{$row->bedrooms}} </span> - <span class="sidebar-card-bath">{{$row->full_baths}} Bath</span></h6>
                                                    <h6 class="sidebar-card-cta"><span class="sidebar-card-cta-a">{{$row->listing_agent}}</span> - <span class="sidebar-card-cta-b">Avail now</span></h6>
                                                </div>
                                                <div onclick="remove_property({{$row->id}})" class="backtomain-cross">X</div>
                                            </div>
                                        @endif
                                            @endforeach
                                        @else
                                        <p class="text-danger">empty</p>
                                        @endif
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>            
            </div>
        </div>
    </div>
<input type="hidden" id="property_id" value="{{ ($listing != null) ? $listing->id : 0 }}">
<input type="hidden" id="latitude" value="{{ ($listing != null) ? $listing->latitude : 0 }}">
<input type="hidden" id="longitude" value="{{ ($listing != null) ? $listing->longitude : 0 }}">
  
  @push('js')
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDqnUWO38RJMjRlwsY1imxqB1WI8ZWsU3M&callback=myMap"></script>
<script scr="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>
<script>
@if(session('success'))
  toastr.success("{{session('success')}}");
@endif
@if(session('error'))
  toastr.error("{{session('error')}}")
@endif
@if($errors->any())
    @foreach ($errors->all() as $error)
    toastr.error("{{$error}}")
    @endforeach
@endif
</script>
  @endpush
  


  <script>
function update_property(status)
{
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var property_id = $('#property_id').val();
    var user_id = {{ ( Auth::check() == true ) ? Auth::user()->id : 0 }};
      
    $.ajax({
        url: "{{route('property_status')}}",
        type: 'post',
        data: {_token: CSRF_TOKEN,status: status,property_id: property_id,user_id:user_id },
        success: function(response)
        {
			//alert(user_id);
            fetch_property();
			//alert(response.success)
            // toastr.success(response.msg);
            // location.reload();
        }
    });
}

function fetch_property()
{

    $.ajax({
        url: "{{route('fetch_property_detail')}}",
        type: 'get',
        success: function(response)
        {
        
            if(response.listing != null)
            {
				var limage = response.listing['image'];
				if(!limage == false){
					
					limage = response.listing['image'];
					
				}
				else
				{
					limage  = 'adminTheme/images/noimage.jpg';
				}
                const pr = response.listing['price'];
				const price = response.listing['price_range'];
                $('#pr-title').html(response.listing['name']);
                $('#pr-price').html(price);
                $('#pr-image').attr('src',limage);
                $('#pr-bad').html(response.listing['bedrooms']);
                $('#pr-bath').html(response.listing['total_baths']);
                $('#pr-square').html(response.listing['sqFt'] + 'sqft');
                
                $('#pr-contact').html(response.listing['contact_no']);
                $('#pr-address').html(response.listing['detailsAddressStreet']);
                $('#latitude').val(response.listing['latitude']);
                $('#longitude').val(response.listing['longitude']);
                $('#property_id').val(response.listing['id']);
                
				var image = response.listing['image'];
				if(!image == false){
					
					image = response.listing['image'];
					
				}
				else
				{
					image  = 'adminTheme/images/noimage.jpg';
				}
				
				// alert(image);
				// alert(response.listing['image']);
                var	detail = '<h3 class="pro-desc">2 of 132 From Best Combo Of Price,<br> Location, And Amenities</h3>';
					detail += '<img class="main-pro-img" id="pr-image" src="'+image+'" />';
					detail += '<div class="custom-width-sec">';
					detail += '<div class="two-point-five">';
					detail += '<h4 class="pro-title" id="pr-title">'+response.listing['name']+'</h4>';
					detail += '</div>';
					detail += '<div class="point-five-div">';
					detail += '<h5 class="pro-price" id="pr-price">'+ price +'</h5>';
					detail += '</div>';
					detail += '</div>';
					detail += '<div class="custom-width-sec">';
					detail += '<div class="two-point-five">';
					detail += '<h5 class="pro-contact" id="pr-contact">'+response.listing['contact_no']+'</h5>';
					detail += '</div>';
					detail += '<div class="point-five-div">';
					detail += '<div class="rating-div-property-page">';
					detail += '<ul>';
					detail += '<li><i class="fa fa-star" aria-hidden="true"></i></li>';
					detail += '<li><i class="fa fa-star" aria-hidden="true"></i></li>';
					detail += '<li><i class="fa fa-star" aria-hidden="true"></i></li>';
					detail += '<li><i class="fa fa-star" aria-hidden="true"></i></li>';
					detail += '<li><i class="fa fa-star" aria-hidden="true"></i></li>';
					detail += '<li>10/10</li>';
					detail += '</ul>';
					detail += '</div> ';
					detail += '</div>';
					detail += '</div>';
					detail += '<div class="pro-scroller"><div class="pro-ul">';
					detail += '<ul>';
					detail += '<li>';
					detail += '<div class="ul-inner-parent-div">';
					detail += '<div class="ul-inner-first-child">';
					detail += '<img src="{{asset('assests/003-pin.svg')}}" />';
					detail += '</div>';
					detail += '<div class="ul-inner-second-child">';
					detail += '<h5 id="pr-address">'+response.listing['detailsAddressStreet']+'</h5>';
					detail += '</div>';
					detail += '</div>';
					detail += '</li>';
					detail += '<li>';
					detail += '<div class="ul-inner-parent-div">';
					detail += '<div class="ul-inner-first-child">';
					detail += '<img src="{{asset('assests/001-building.svg')}}" />';
					detail += '</div>';
					detail += '<div class="ul-inner-second-child">';
					detail += '<ul class="apt-feat-pro">';
					detail += '<li><img src="{{asset('assests/bed-side-a.svg')}}" /><h5 id="pr-bad">'+['no_of_Bedrooms']+'</h5></li>';
					detail += '<li><img src="{{asset('assests/bathup.svg')}}" /><h5 id="pr-bath">'+['bathrooms']+'</h5></li>';
					detail += '<li><img src="{{asset('assests/iconspace_Intersect_25px.svg')}}" /><h5 id="pr-square">'+response.listing['square_foot']+'</h5></li>';
					detail += '</ul>';
					detail += '</div>';
					detail += '</div>';
					detail += '</li>';
					detail += '<li>';
					detail += '<div class="ul-inner-parent-div">';
					detail += '<div class="ul-inner-first-child">';
					detail += '<img src="{{asset('assests/004-sports-car.svg')}}" />';
					detail += '</div>';
					detail += '<div class="ul-inner-second-child">';
					detail += '<h5 class="orange">+Add Commute</h5>';
					detail += '</div>';
					detail += '</div>';
					detail += '</li>';
					detail += '<li>';
					detail += '<div class="ul-inner-parent-div">';
					detail += '<div class="ul-inner-first-child">';
					detail += '<img src="{{asset('assests/002-youtube.svg')}}" />';
					detail += '</div>';
					detail += '<div class="ul-inner-second-child">';
					detail += '<h5 class="orange" data-bs-toggle="modal" data-bs-target="#exampleModal">Live remote tours available</h5>';
					detail += '</div>';
					detail += '</div>';
					detail += '</li>';
					detail += '</ul>';
					detail += '</div>';
					detail += '<div class="avaial-sec-div">';
					detail += '<div class="price-avail-headings">';
					detail += '<h3>Price and Availability</h3>';
					detail += '<h4>Verified 24 hrs ago</h4>';
					detail += '</div>';
					detail += '<!-- Button trigger modal -->';
					detail += '<!-- Modal -->';
					detail += '<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
					detail += '<div class="modal-dialog modal-lg">';
					detail += '<div class="modal-content">';
					detail += '<div class="modal-header">';
					detail += '<h5 class="modal-title" id="exampleModalLabel">Live remote tours</h5>';
					detail += '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
					detail += '</div>';
					detail += '<div class="modal-body">';
					detail += '<video width="770"  controls>';
					detail += '<source src="'+response.listing['virtual_tour']+'" type="video/mp4">';
					detail += '</video>';
					detail += '</div>';
					detail += '<div class="modal-footer">';
					detail += '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
					detail += '</div>';
					detail += '</div>';
					detail += '</div>';
					detail += '</div>';
					detail += '</div>';
					detail += '</div>';
					detail += '<div class="bottom-button-fancy">';
					detail += '<div class="two-button-cta-div">';
					detail += '<div class="cta-left-div">';
					detail += '<a href="/email-form">Email</a>';
					detail += '</div>';
					detail += '<div class="cta-right-div">';
					detail += '<a href="#">Schedule a Tour</a>';
					detail += '</div>';
					detail += '</div>';
					detail += '<div class="swiper-buttons-main">';
					detail += '<a class="remove-to-list" onclick="update_property("Nope")" href="javascript:void(0);"><img src="{{asset('assests/Group 173.png')}}" /><h6>NOPE</h6></a>';
					detail += '<a class="add-to-list" onclick="update_property("Love")" href="javascript:void(0);"><img src="{{asset('assests/Group 174.png')}}" /><h6>LOVE IT</h6></a>';
					detail += '<a class="add-to-list" onclick="update_property("Maybe")" href="javascript:void(0);"><img src="{{asset('assests/Group 175.png')}}" /><h6>MAYBE</h6></a>';
					detail += '</div>';
					detail += '</div>';
					detail += '</div>';

					if($('.left-inner-main').html() == '<div class="text-danger">Property Not Found.!!</div>')
					{
                        // alert(detail);
						$('.left-inner-main').html(detail);
					}
				myMap();
            }
            else
            {
                
                $('.left-inner-main').html('<div class="text-danger">Property Not Found.!!</div>');
                $('#latitude').val('');
                $('#longitude').val('');
                myMap();
            }

                var lcount = 0;
                var mcount = 0;
                var htm = '<div class="sidebar-visitng-inner">';
                $.each(response.properties, function( index, value ) {
					var image = value.image;
					if(image == null)
					{
						image = 'adminTheme/images/noimage.jpg';
					}
                    if(value['hasoptions'][0].status == 'Love')
                    {
                        if(lcount == 0)
                        {
                            htm += '<h4>Love It</h4><br>';
                            lcount++
                        }
						
                        htm += '<div class="sidebar-visiting-card" id="sidebar-visiting-card-'+value.id+'">';
                        htm += '<div class="sidebar-card-image">';
                        htm += '<img src="'+image+'" width="50" />';
                        htm += '</div>';
                        htm += '<div class="sidebar-card-details">';
                        htm += '<h6 class="sidebar-card-title">'+value.name+'</h6>';
                        htm += '<h6 class="sidebar-card-amen"><span class="sidebar-card-price">'+value.price+'</span> - <span class="sidebar-card-room">'+value.bedrooms+' Bed</span> - <span class="sidebar-card-bath">'+value.full_baths+' Bath</span></h6>';
                        htm += '<h6 class="sidebar-card-cta"><span class="sidebar-card-cta-a">'+value.listing_agent+'</span> - <span class="sidebar-card-cta-b">Avail now</span></h6>';
                        htm += '</div>';
						htm += '<div onclick="remove_property('+value.id+')" class="backtomain-cross">X</div>';
                        htm += '</div>';
                    }
                    if(value['hasoptions'][0].status == 'Maybe')
                    {
                        if(mcount == 0)
                        {
                            htm += '<h4>Maybe</h4><br>';
                            mcount++
                        }
                        htm += '<div class="sidebar-visiting-card" id="sidebar-visiting-card-'+value.id+'">';
                        htm += '<div class="sidebar-card-image">';
                        htm += '<img src="'+image+'" width="50" />';
                        htm += '</div>';
                        htm += '<div class="sidebar-card-details">';
                        htm += '<h6 class="sidebar-card-title">'+value.name+'</h6>';
                        htm += '<h6 class="sidebar-card-amen"><span class="sidebar-card-price">'+value.price+'</span> - <span class="sidebar-card-room">'+value.bedrooms+' Bed</span> - <span class="sidebar-card-bath">'+value.full_baths+' Bath</span></h6>';
                        htm += '<h6 class="sidebar-card-cta"><span class="sidebar-card-cta-a">'+value.listing_agent+'</span> - <span class="sidebar-card-cta-b">Avail now</span></h6>';
                        htm += '</div>';
						htm += '<div onclick="remove_property('+value.id+')" class="backtomain-cross">X</div>';
                        htm += '</div>';
                    }
                }); 
                htm += '</div>';
                $('.sidebar-visiting').html(htm);
               
        }
    });

}
	  
	  
function fetch_options()
{

    $.ajax({
        url: "{{route('fetch_property_detail')}}",
        type: 'get',
        success: function(response)
        {
        
            if(response.properties != null)
            {
                var lcount = 0;
                var mcount = 0;
                var htm = '<div class="sidebar-visitng-inner">';
                $.each(response.properties, function( index, value ) 
				{
					var image = value.image;
					if(image == null)
					{
						image = 'adminTheme/images/noimage.jpg';
					}
					
                    if(value['hasoptions'][0].status == 'Love')
                    {
                        if(lcount == 0)
                        {
                            htm += '<h4>Love It</h4><br>';
                            lcount++
                        }
						
						
						
                        htm += '<div class="sidebar-visiting-card" id="sidebar-visiting-card-'+value.id+'">';
                        htm += '<div class="sidebar-card-image">';
                        htm += '<img src="'+image+'" width="50" />';
                        htm += '</div>';
                        htm += '<div class="sidebar-card-details">';
                        htm += '<h6 class="sidebar-card-title">'+value.name+'</h6>';
                        htm += '<h6 class="sidebar-card-amen"><span class="sidebar-card-price">'+value.price+'</span> - <span class="sidebar-card-room">'+value.bedrooms+' Bed</span> - <span class="sidebar-card-bath">'+value.full_baths+' Bath</span></h6>';
                        htm += '<h6 class="sidebar-card-cta"><span class="sidebar-card-cta-a">'+value.listing_agent+'</span> - <span class="sidebar-card-cta-b">Avail now</span></h6>';
                        htm += '</div>';
						htm += '<div onclick="remove_property('+value.id+')" class="backtomain-cross">X</div>';
                        htm += '</div>';
                    }
                    if(value['hasoptions'][0].status == 'Maybe')
                    {
                        if(mcount == 0)
                        {
                            htm += '<h4>Maybe</h4><br>';
                            mcount++
                        }
                        htm += '<div class="sidebar-visiting-card" id="sidebar-visiting-card-'+value.id+'">';
                        htm += '<div class="sidebar-card-image">';
                        htm += '<img src="'+image+'" width="50" />';
                        htm += '</div>';
                        htm += '<div class="sidebar-card-details">';
                        htm += '<h6 class="sidebar-card-title">'+value.name+'</h6>';
                        htm += '<h6 class="sidebar-card-amen"><span class="sidebar-card-price">'+value.price+'</span> - <span class="sidebar-card-room">'+value.bedrooms+' Bed</span> - <span class="sidebar-card-bath">'+value.full_baths+' Bath</span></h6>';
                        htm += '<h6 class="sidebar-card-cta"><span class="sidebar-card-cta-a">'+value.listing_agent+'</span> - <span class="sidebar-card-cta-b">Avail now</span></h6>';
                        htm += '</div>';
						htm += '<div onclick="remove_property('+value.id+')" class="backtomain-cross">X</div>';
                        htm += '</div>';
                    }
                }); 
                htm += '</div>';
                $('.sidebar-visiting').html(htm);
			}
		}
	 }); 
}


function myMap() {
    var latitude = document.getElementById('latitude').value;
    var longitude = document.getElementById('longitude').value;
    var mapProp= {
        center:new google.maps.LatLng(latitude,longitude),
        zoom:15,
    };
    
    var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
    console.log(new google.maps.LatLng(latitude,longitude));
    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(latitude,longitude),
        icon: 'http://www.google.com/mapfiles/marker.png',
        map: map
    });
}


function remove_property(id)
{
	
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
        url: "{{route('remove_property')}}",
        type: 'post',
        data: {_token: CSRF_TOKEN,id: id },
        success: function(response)
        {
            fetch_options();
			$('#sidebar-visiting-card-'+id).empty();
            alert(response.msg);
            // location.reload();
        }
    });
}


</script>

@endsection