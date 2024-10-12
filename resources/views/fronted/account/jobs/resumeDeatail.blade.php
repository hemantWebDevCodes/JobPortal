@extends('fronted.layouts.app')

@section('main-section')

  @include('fronted.account.sidebar')
  <div class="col-md-9 mt-5">
    @include('fronted.message')
 
 <div class="form-card border-0 rounded-0 mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fs-4">Your Resume</h3>
        <a href="{{ route('show.Resume') }}" class="btn-style head-btn1 py-4">Upload CV</a>
    </div>

    <div class="text-center my-5 pt-2">
        <img src="{{ asset('assets/Resume-image/'.$resumeDeatail->resumeImg) }}" class="img-fluid" alt=""></td>
    </div>
   </div>
 </div>


@endsection