@extends('admin.layouts.default')

@section('title')
  Admin | Cms Pages
@endsection

@section('content')


<div class="card card-primary card-outline">
          <div class="card-header">
           <?php 
                 $page = Request::segment(2);
                 $pg = ucfirst($page);
           ?>
            <h3 class="card-title">
              <i class="fas fa-edit"></i>
              <?=$pg?> Add Details to <?=$pg?> Page
            </h3>
            <!-- Button trigger modal -->
              <div style="text-align: right;">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Import
              </button>
              <a class="btn btn-warning" href="{{ route('export') }}">Export Data</a>
            </div><br>

              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" class="form-control">
                        <br>
                        <button class="btn btn-success">Import Property Data</button>
                        <!-- <a class="btn btn-warning" href="{{ route('export') }}">Export User Data</a> -->
                    </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                  </div>
                </div>
              </div>
            <?php $pageLink = 'admin/'.Request::segment(2).'/add-content'; ?>
            <!-- <a href="{{url('admin/properties/add')}}">
             <div style="text-align: right;"><button class="btn btn-dark btn-sm">Add Content</button></div>
            </a> -->
          </div>
        <div class="card-body">
             @if($message = Session::get('success'))
              <div class="alert alert-success alert-block">
                  <button type="button" class="close" data-dismiss="alert">X</button>
                      <strong>{{ $message }}</strong>
              </div>
            @endif
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true"><?=$pg?> Page </a>
              </li>
            </ul>
            <div class="tab-content" id="custom-content-below-tabContent">
              <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                <div class="container">
                  <div class="card">
                      <!-- <div class="card-header">
                        <h3 class="card-title">Home Page Data</h3>
                      </div> -->
                      <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Property Listing ID</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  	@foreach($propertys as $property)
                    <?php //$content = strip_tags($contact->content); ?>
	                  <tr>
                      <td>{{$property->id}}</td>
	                    <td>{{$property->listing_id}}</td>
	                    <td><img src="{{$property->image}}" alt="" width="200"></td>
	                    <td>
	                    	<!-- <a href=""><i class="fa fa-eye" aria-hidden="true"></i></a> | -->
	                    	<a href="{{route('property.edit',['id' => $property->id])}}"><i style="color: #c49f47;" class="fas fa-pen-square"></i></a> |
	                    	<a href="{{route('property.delete' , ['id' => $property->id])}}" onclick="return confirm('Are You Sure Want To Delete This.???')"><i style="color: #bd0a0a;" class="fa fa-trash" aria-hidden="true"></i></a> 

	                    </td>
	                  </tr>
                  	@endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
@endsection
