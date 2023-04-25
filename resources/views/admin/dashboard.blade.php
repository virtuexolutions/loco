@extends('admin.layouts.default')

@section('title')
Admin | Dashboard
@endsection
@section('content')
<div class="container-fluid">

  <div class="row">

          <div class="col-lg-4 col-6">
                <!-- small card -->
                  <div class="small-box bg-warning">
                    <div class="inner">
                      <h3>{{$totalUsers}}</h3>
                        <p>Users</p>
                      </div>
                      <div class="icon">
                <i class="fas fa-user-plus"></i>
              </div>
              <a href="{{url('admin/users')}}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>


          <div class="col-lg-4 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$totalProperties}}</h3>

                <p>Properties</p>
              </div>
              <div class="icon">
                <i class="fas fa-shopping-cart"></i>
              </div>
              <a href="{{url('admin/properties')}}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          
          <!-- ./col -->
          
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$totalInquiries}}</h3>

                <p>New Inquiries</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
              <a href="{{url('admin/show-inquiries')}}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
	  
		  <div class="col-lg-4 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$totallove}}</h3>

                <p>Love Properties</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
              <a href="{{url('admin/show-properties?status=Love')}}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
	  
		  <div class="col-lg-4 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$totalmaybe}}</h3>

                <p>Maybe Properties</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
              <a href="{{url('admin/show-properties/?status=Maybe')}}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
        </div>

        <!-- <div class="row" style="text-align: center;">
    <div class="col-md-12">
      <img style="width: 200px;padding: 19px;" src="{{asset('adminTheme/dist/img/logo1.png')}}">
    </div>
  </div> -->

       
       
      </div>
@endsection