@extends('admin.dashboard')

@section('dashboard-main-content')
<div class="container mt-5 bg-light">
    <div class="row">
      <h3 class="mt-5 text-secondary mb-4">Dashboard</h3>
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box text-white" style="background-color:steelblue">
          <div class="inner">
            <h3>{{ $user }}</h3>
            <p>Total Users</p>
          </div>
          <div class="icon">
            <i class="fa-solid fa-user-plus"></i>
          </div>
          <a href="{{ route('userList') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box text-white" style="background-color:coral;">
          <div class="inner text-white">
            <h3>{{ $job }}</h3>
            <p>Total Jobs</p>
          </div>
          <div class="icon">
            <i class="fa-solid fa-laptop-file"></i>
          </div>
          <a href="{{ route('Show.AdminJob') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box text-white" style="background-color:cadetblue;">
          <div class="inner">
            <h3>{{ $AppliedJob }}</h3>
            <p>Applid Jobs</p>
          </div>
          <div class="icon">
            <i class="fa-solid fa-users"></i>
          </div>
          <a href="{{ route('admin.JobApplication') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ $category }}</h3>
            <p>Total Categories</p>
          </div>
          <div class="icon">
            <i class="fa-solid fa-layer-group"></i>
          </div>
          <a href="{{ route('show.JobCategory') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
@endsection