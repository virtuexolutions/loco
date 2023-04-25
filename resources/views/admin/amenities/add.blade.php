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
      <button type="button" class="close" data-dismiss="alert">X</button>
      <strong>{{ $message }}</strong>
    </div>
    @endif

    @if($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
      <button type="button" class="close" data-dismiss="alert">X</button>
      <strong>{{ $message }}</strong>
    </div>
    @endif
    

    
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Add Amenities</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->       
          <form action="{{route('amenities.store')}}" method="post" id="Form" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <h5><b>Amenities Information</b></h5>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="title">Name</label>
                        <input type="text" class="form-control"name="title" id="title" value="{{old('title')}}">                                                      
                      </div>
                    </div>   

                    <div class="col-md-6">
                      <label for="title">Image</label>
                      <div class="input-group">
                        <span class="input-group-btn">
                          <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Choose
                          </a>
                        </span>
                        <input id="thumbnail" class="form-control" type="text" name="image">
                      </div>
                      <img id="holder" style="margin-top:15px;max-height:100px;">
                    </div>
                    
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="submit btn btn-primary">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
      <!-- /.card-body -->
  </div>


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

