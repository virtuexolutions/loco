@extends('layouts.default')

@section('title')
Admin | Dashboard
@endsection
@section('content')
<div class="container-fluid">

  <div class="row">

          <div class="col-lg-3 col-6">
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

          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$totalProducts}}<sup style="font-size: 20px">%</sup></h3>

                <p>Products</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{url('admin/product')}}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>


          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>0</h3>

                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="fas fa-shopping-cart"></i>
              </div>
              <a href="{{url('admin/order')}}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          
          <!-- ./col -->
          
          <!-- ./col -->
          <div class="col-lg-3 col-6">
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
          <!-- ./col -->
        </div>

        <!-- <div class="row" style="text-align: center;">
    <div class="col-md-12">
      <img style="width: 200px;padding: 19px;" src="{{asset('adminTheme/dist/img/logo1.png')}}">
    </div>
  </div> -->

        <div class="row">
          
          
        
         
        </div>
       
      </div>
@endsection