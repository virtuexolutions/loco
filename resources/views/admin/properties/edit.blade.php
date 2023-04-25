@extends('admin.layouts.default')

@section('content')


<style>
  .select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #000000;
    }
</style>
<div class="card card-primary card-outline">
  <div class="card-header">

    <h3 class="card-title">
      <i class="fas fa-edit"></i>
      Property Managment
    </h3>
    <!-- <a href="{{url('admin/add-content')}}">
             <div style="text-align: right;"><button class="btn btn-primary">Add Content</button></div>
            </a> -->

  </div>

  <div class="card-body">
    @if(count($errors) > 0)
    @foreach($errors->all() as $error)
    <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
    @endif

    @if($message = Session::get('success'))
    <div class="alert alert-success alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>{{ $message }}</strong>
    </div>
    @endif

    @if($message = Session::get('error'))
    <div class="alert alert-warning alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>{{ $message }}</strong>
    </div>
    @endif


    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Edit Property</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{route('property.update',$property->id)}}" method="post" id="Form" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <h5><b>Property Basic Information</b></h5>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Name</label>
                        <input type="text" class="form-control"name="name" id="title" value="{{$property->name}}">                                                      
                      </div>
                    </div>   
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Submarket</label>
                        <input type="text" class="form-control"name="supmarket" id="title" value="{{$property->supmarket}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Built/Renov</label>
                        <input type="text" class="form-control" name="built" id="title" value="{{$property->built}}">
                      </div>
                    </div>
                    
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Bed/Bath</label>
                        <input type="text" class="form-control"name="bath" id="title" value="{{$property->bath}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <label for="title">Photo</label>
                      <div class="input-group">
                        <span class="input-group-btn">
                          <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Choose
                          </a>
                        </span>
                        <input id="thumbnail" value="{{$property->photo}}" class="form-control" type="text" name="image">
                      </div>
                      <img id="holder" style="margin-top:15px;max-height:100px;">
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Rent/Sqft</label>
                        <input type="text" class="form-control"  name="rent" id="title" value="{{$property->rent}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Apartment Name</label>
                        <input type="text" class="form-control"  name="apartment_name" id="title" value="{{$property->apartment_name}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Price Range</label>
                        <input type="text" class="form-control"  name="price_range" id="title" value="{{$property->price_range}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Bedrooms</label>
                        <input type="text" class="form-control"  name="bedrooms" id="title" value="{{$property->bedrooms}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Year Built/Renovated</label>
                        <input type="text" class="form-control"  name="year_built_renovated" id="title" value="{{$property->year_built_renovated}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Type</label>
                        <input type="text" class="form-control"  name="type" id="title" value="{{$property->type}}">
                      </div>
                    </div>
                    </div><hr>
                    <h5><b>Amenites</b></h5>
                    <div class="row">
                      @php 
                      $amenities_id = explode(',',$property->amenities_id);
                      
                      @endphp
                      @foreach($amenities as $row)
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="title">{{$row->title}}</label>
                          <input type="checkbox"  {{ ( ( in_array( "$row->id",$amenities_id ) ) ? 'checked' : '')}} name="amenities_id[]" id="title" value="{{$row->id}}">
                        </div>
                      </div>
                      @endforeach
                    </div>
                    <hr>
                    <h5><b>Other Information</b></h5>
                    
                    <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Send</label>
                        <input type="text" class="form-control" name="send" id="title" value="{{$property->send}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Escort</label>
                        <input type="text" class="form-control" name="escort" id="title" value="{{$property->escort}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Commission Confirmed</label>
                        <input type="text" class="form-control" name="commission" id="title" value="{{$property->commission}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Bonus</label>
                        <input type="text" class="form-control" name="bonus" id="title" value="{{$property->bonus}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Amenity</label>
                        <input type="text" class="form-control"  name="amenity" id="title" value="{{$property->amenity}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Studio Net Cost</label>
                        <input type="text" class="form-control"  name="studio_net_cost" id="title" value="{{$property->studio_net_cost}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">1 BR Starting</label>
                        <input type="text" class="form-control"  name="br_starting_1" id="title" value="{{$property->br_starting_1}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">2 Br Starting</label>
                        <input type="text" class="form-control"  name="br_starting_2" id="title" value="{{$property->br_starting_2}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">3 BR</label>
                        <input type="text" class="form-control"  name="br_3" id="title" value="{{$property->br_3}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">1 BR DEN</label>
                        <input type="text" class="form-control"  name="br_den_1" id="title" value="{{$property->br_den_1}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">2 Bed + Den</label>
                        <input type="text" class="form-control"  name="bed_den_2" id="title" value="{{$property->bed_den_2}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Penthouse</label>
                        <input type="text" class="form-control"  name="penthouse" id="title" value="{{$property->penthouse}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Amenity Fees</label>
                        <input type="text" class="form-control"  name="amenity_fees" id="title" value="{{$property->amenity_fees}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Essential Housing Available</label>
                        <input type="text" class="form-control"  name="essential_housing_available" id="title" value="{{$property->essential_housing_available}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Flooring</label>
                        <input type="text" class="form-control"  name="flooring" id="title" value="{{$property->flooring}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Flooring color</label>
                        <input type="text" class="form-control"  name="flooring_color" id="title" value="{{$property->flooring_color}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Flooring color 2</label>
                        <input type="text" class="form-control"  name="flooring_color_2" id="title" value="{{$property->flooring_color_2}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Cabinet Color</label>
                        <input type="text" class="form-control"  name="cabinet_color" id="title" value="{{$property->cabinet_color}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Cabinet Color 2</label>
                        <input type="text" class="form-control"  name="cabinet_color_2" id="title" value="{{$property->cabinet_color_2}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Counter top color</label>
                        <input type="text" class="form-control"  name="counter_top_color" id="title" value="{{$property->counter_top_color}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Counter Color 2</label>
                        <input type="text" class="form-control"  name="counter_color_2" id="title" value="{{$property->counter_color_2}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Stand up showers</label>
                        <input type="text" class="form-control"  name="stand_up_showers" id="title" value="{{$property->stand_up_showers}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Garden Tubs</label>
                        <input type="text" class="form-control"  name="garden_tubs" id="title" value="{{$property->garden_tubs}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Pool</label>
                        <input type="text" class="form-control"  name="pool" id="title" value="{{$property->pool}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Roof Top Pool</label>
                        <input type="text" class="form-control"  name="roof_top_pool" id="title" value="{{$property->roof_top_pool}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Lap Pool</label>
                        <input type="text" class="form-control"  name="lap_pool" id="title" value="{{$property->lap_pool}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Heated Pool</label>
                        <input type="text" class="form-control"  name="heated_pool" id="title" value="{{$property->heated_pool}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Hot Tub</label>
                        <input type="text" class="form-control"  name="hot_tub" id="title" value="{{$property->hot_tub}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Sauna</label>
                        <input type="text" class="form-control"  name="sauna" id="title" value="{{$property->sauna}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Fitness Center</label>
                        <input type="text" class="form-control"  name="fitness_center" id="title" value="{{$property->fitness_center}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Floor to Ceiling Windows</label>
                        <input type="text" class="form-control"  name="floor_to_ceiling_windows" id="title" value="{{$property->floor_to_ceiling_windows}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Downtown views</label>
                        <input type="text" class="form-control"  name="downtown_views" id="title" value="{{$property->downtown_views}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Private Yards</label>
                        <input type="text" class="form-control"  name="private_yards" id="title" value="{{$property->private_yards}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Stories</label>
                        <input type="text" class="form-control"  name="stories" id="title" value="{{$property->stories}}">
                      </div>
                    </div>
                    
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Pet Spa</label>
                        <input type="text" class="form-control"  name="pet_spa" id="title" value="{{$property->pet_spa}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Rooftop Amenities</label>
                        <input type="text" class="form-control"  name="rooftop_amenities" id="title" value="{{$property->rooftop_amenities}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">washer dryer in unit</label>
                        <input type="text" class="form-control"  name="washer_dryer_in_unit" id="title" value="{{$property->washer_dryer_in_unit}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">washer dryer laundry facility on site</label>
                        <input type="text" class="form-control"  name="washer_dryer_laundry_facility" id="title" value="{{$property->washer_dryer_laundry_facility}}">
                      </div>
                    </div>
                    
                    
                    
                    
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="title">Specials</label>
                        <textarea name="specials" id="" cols="30" rows="5" class="form-control">{{$property->specials}}</textarea>
                      </div>
                    </div> 
                  </div><hr>
                  <h5><b>Address Information</b></h5>
                  <div class="row">
                  <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Street</label>
                        <input type="text" class="form-control"  name="street" id="title" value="{{$property->street}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">City</label>
                        <input type="text" class="form-control"  name="city" id="title" value="{{$property->city}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">State</label>
                        <input type="text" class="form-control"  name="state" id="title" value="{{$property->state}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Neighborhood</label>
                        <input type="text" class="form-control"  name="neighborhood" id="title" value="{{$property->neighborhood}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Latitude</label>
                        <input type="text" class="form-control"  name="latitude" id="title" value="{{$property->latitude}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title">Longitude</label>
                        <input type="text" class="form-control"  name="longitude" id="title" value="{{$property->longitude}}">
                      </div>
                    </div>
                  </div><hr>
                </div>
              </div>
            </div>
            
        </div>
      </div>
      <!-- /.card-body -->
    </div>

    <div class="card-footer">
      <button type="submit" class="submit btn btn-warning">Update</button>
    </div>
    </form>
  </div>


</div>

</div>



</div>
<!-- /.card -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="{{asset('/')}}/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

<script>
   $('#lfm').filemanager('file');
   
</script>
@endsection