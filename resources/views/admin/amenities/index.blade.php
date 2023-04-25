@extends('admin.layouts.default')

@section('title')
  Admin | Ameninties
@endsection

@section('content')


<div class="card card-primary card-outline">
          <div class="card-header">
        <div class="card-body">
             @if($message = Session::get('success'))
              <div class="alert alert-success alert-block">
                  <button type="button" class="close" data-dismiss="alert">X</button>
                      <strong>{{ $message }}</strong>
              </div>
            @endif
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Amenities Page </a>
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
                    <th>Title</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  	@foreach($amenities as $row)
	                  <tr>
                      <td>{{$row->id}}</td>
	                    <td>{{$row->title}}</td>
	                    <td><img src="{{$row->image}}" alt="" width="200"></td>
	                    <td>
	                    	<a href="{{route('amenities.edit',['id' => $row->id])}}"><i style="color: #c49f47;" class="fas fa-pen-square"></i></a> |
	                    	<a href="{{route('amenities.delete' , ['id' => $row->id])}}" onclick="return confirm('Are You Sure Want To Delete This.???')"><i style="color: #bd0a0a;" class="fa fa-trash" aria-hidden="true"></i></a> 
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
