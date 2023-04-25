
@extends('layouts.app')

@section('content')

 <div id="home-first-sec" class="container-fluid">
      
        <div class="container">
			<form method="post" action="{{route('find_property')}}">
            @csrf
            <h1>LET'S<br>GET LOCO</h1>
            <h2>Finding you the best apartments for rent</h2>
            <input class="text-feild-cus-css" id="search_inputt" onkeypress="search()" type="text" placeholder="Search by city, zip or neighborhood" />
			<input id="loc_latt" hidden name="ltd">
			<input id="loc_longg" hidden name="lng">
            <input id="loc_address" hidden name="address">
            <input id="loc_city" hidden name="city">
            <input id="loc_state" hidden name="state">

            
            <br>
            <button class="btn-main mt-3" type="submit">Search</button>
			</form>
        </div>
        <video autoplay muted loop id="myVideo">
            <source src="{{ asset('images') }}/Real-Estate-Promo-Video.mp4" type="video/mp4">
          </video>
          <div class="custom-overlay"></div>
    </div>

    <div  id="home-second-sec" class="container">
        <h2>BUY, RENT or SELL with loco!</h2>
        <div class="row">
            <div class="col">
                <img src="{{ asset('images') }}/Vector Smart Object.png"/>
                <h4>Buy</h4>
            </div>
            <div class="col">
                <img src="{{ asset('images') }}/Vector Smart Object-1.png"/>
                <h4>Sell</h4>
            </div>
            <div class="col">
                <img src="{{ asset('images') }}/Vector Smart Object-2.png"/>
                <h4>Rent</h4>
            </div>
        </div>
    </div>

    <div  id="home-third-sec" class="container-fluid">
        <h3>Our rental concierge does the heavy lifting</h3>
        <div class="row">
            <div class="col">
                <img src="{{ asset('images') }}/002-favorites.png"/>
                <h2>Getting to know you</h2>
                <h4>You’ll answer a few simple questions so we understand what you are really looking for in your next home.</h4>
            </div>
            <div class="col">
                <img src="{{ asset('images') }}/001-check-mark.png"/>
                <h2>Curating top matches</h2>
                <h4>When you add an apartment to your Short List, the savings concierge compares them and recommends the best property for you.</h4>
            </div>
            <div class="col">
                <img src="{{ asset('images') }}/003-guide-book.png"/>
                <h2>Guiding you to savings</h2>
                <h4>When you add an apartment to your Short List, the savings concierge compares them and recommends the best property for you.</h4>
            </div>
        </div>
    </div>
@push('js')
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyDqnUWO38RJMjRlwsY1imxqB1WI8ZWsU3M"></script>
<script type="text/javascript">
    function search(){

        var searchInput = 'search_inputt';
        
        
        var autocomplete;
        autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
            types: ['geocode'],
            componentRestrictions: {
                country: "US"
            }
        });
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            
            var near_place = autocomplete.getPlace();
         
            document.getElementById('loc_latt').value = near_place.geometry.location.lat();
            document.getElementById('loc_longg').value = near_place.geometry.location.lng();
            document.getElementById('loc_address').value = near_place.formatted_address;
            document.getElementById('loc_city').value = near_place.address_components[0].long_name;
            document.getElementById('loc_state').value = near_place.address_components[2].long_name;

            
          });
    }
	
</script>
@endpush
    @endsection