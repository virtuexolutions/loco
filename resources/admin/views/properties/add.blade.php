@extends('layouts.default')

@section('content')


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
            <h3 class="card-title">Add Property</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{route('property.store')}}" method="post" id="Form" enctype="multipart/form-data">
            @csrf
            <?php $path = '/uploads/cms'; ?>
            <input type="hidden" name="imagepath" value="{{$path}}">
            <div class="card-body">

              <div class="row">
                <div class="col-md-7">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="title">Property Name *</label>
                        <input type="text" class="form-control" name="property[title]" id="title"
                          placeholder="Property Name">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="type_of_buiding">Property Type*</label>
                        <select type="text" class="form-control multi_select" name="property[type]">
                          <option value="1">HighRise</option>
                          <option vasue="2">MidRise</option>
                          <option value="3">Garden Style</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="title">Property Code *</label>
                        <input type="text" class="form-control" name="property[code]" id="title"
                          placeholder="Property Code">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="title">Address *</label>
                        <input type="text" class="form-control" name="property[address]" id="search_input"
                          placeholder="Type address..." />
                        <input type="hidden" name="property[ltd]" id="loc_lat" />
                        <input type="hidden" name="property[lng]" id="loc_long" />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-5">
                  <div id="myDropzone" class="dropzone"></div>
                </div>
              </div>
              {{-- <div class="col-md-12 mt-3">
                <button class="btn btn-default btn-lg" data-toggle="modal" data-target="#exampleModal">Add Unit</button>
              </div> --}}
              <fieldset class="unit-wrapper p-3">
              <legend>Unit Detail</legend>
              <div class="row ">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="h_M_D">Unit Name *</label>
                    <input type="Title" class="form-control" name="unit_detail[title][]" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="h_M_D">Unit Floor *</label>
                    <input type="Title" class="form-control" name="unit_detail[Floor][]" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="h_M_D">Unit Type</label>
                    <select type="text" class="form-control select2" name="unit_detail[unit_type][]" id="h_M_D">
                      <option value="1">Studio</option>
                      <option value="2">1 Bed</option>
                      <option value="3">1 + Den</option>
                      <option value="4">2 Bed</option>
                      <option value="5">2 + Den</option>
                      <option value="6">3 Bed</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="Price">Price *</label>
                    <input type="text" class="form-control" name="Price" id="Price" placeholder="Price">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="Price">Bed Rooms *</label>
                    <input type="text" class="form-control" name="unit_detail[no_of_Bedrooms][]" id="Price" placeholder="Price">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="Price">Bath Rooms *</label>
                    <input type="text" class="form-control" name="unit_detail[no_of_Bedrooms][]" id="Price" placeholder="Price">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="Price">Total Rooms *</label>
                    <input type="text" class="form-control" name="unit_detail[no_of_Bedrooms][]" id="Price" placeholder="Price">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="Price">Square Foot *</label>
                    <input type="text" class="form-control" name="unit_detail[no_of_Bedrooms][]" id="Price" placeholder="Price">
                  </div>
                </div>
                <div class="col-md-6 p-3">
                  <h5 class="font-bolder">Features & Amenities</h5>
                  @php
                  $features = explode(",","Balcony,Pool,Gym,Conclerge,Hot tub at pool,Hard wook floor,Residents media
                  room,Heated pool,Rooftop pool,Valet parking,Dry cleaning,Pet spa,VR golf,Downtown view");
                  @endphp

                  <select class="form-control multi_select" name="unit_detail[features][]">
                    @foreach($features as $k => $ft )
                      <option>{{$ft}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-6 p-3">
                  <h5 class="font-bolder">Bathroom Features</h5>
                  <?php 
                    $features =  explode(",","Hard wook floor,Residents media room,Heated pool");
                  ?>
                  <select class="form-control multi_select" name="unit_detail[features][]">
                    @foreach($features as $k => $ft )
                      <option>{{$ft}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-4 p-3">
                  <h5 class="font-bolder">Allow Furry Friends</h5>
                  <?php 
                            $features =  explode(",","Dog,Cat");
                          ?>
                    <select class="form-control multi_select" name="unit_detail[features][]">
                      @foreach($features as $k => $ft )
                        <option>{{$ft}}</option>
                      @endforeach
                    </select>
                </div>
                <div class="col-md-4 p-3">
                  <h5 class="font-bolder">Transportation</h5>
                  <?php 
                            $features =  explode(",","Walk,Bike,Drive");
                          ?>
                   <select class="form-control multi_select" name="unit_detail[features][]">
                    @foreach($features as $k => $ft )
                      <option>{{$ft}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-4 p-3">
                  <h5 class="font-bolder">Evicted Allow</h5>
                  <?php 
                            $features =  explode(",","yes,No");
                  ?>
                  @foreach($features as $k => $ft )
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="inlineCheckbox1{{$k}}" name="evicted"
                      value="{{ $k+1 }}">
                    <label class="form-check-label" for="features{{$k}}">{{$ft }}</label>
                  </div>
                  @endforeach
                </div>
              </div>
             </fieldset>
              {{-- end row --}}





              {{-- <div class="properties_records">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="title">options*</label>
                      <select class="form-control" name="dimention">
                        <option>Unit</option>
                        <option>How Many Bedrooms</option>
                        <option>sqft</option>
                        <option>sqft</option>
                        <option>type of building</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="Price">value *</label>
                      <input type="text" class="form-control" name="Price" id="Price" placeholder="Value">
                    </div>
                  </div>
                </div>
              </div>
              <div class="properties_records_dynamic"></div>
              <div class="col-md-2 pt-4">
                <a class="add-option-properites btn btn-default btn-sm" href="javscript:;">Add Option</a>
              </div>--}}

            </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>

    <div class="card-footer">
      <button type="submit" class="submit btn btn-primary">Save</button>
    </div>
    </form>
  </div>


</div>

</div>



</div>
<!-- /.card -->
</div>

<!-- Modal -->
{{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl	">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> --}}
@endsection