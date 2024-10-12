@extends('admin.dashboard')

@include('admin.includes.sidebar')

@section('dashboard-main-content')
 <div class="container mt-5">
    <div class="row">
        <div class="col-md-6 col-lg-6 mx-auto my-5">
            <div class="form-card">
                @include('fronted.message')
                   <form action="{{ route('Update.JobCategory',$category->id) }}" method="post" name="UpdateJobCategoryForm" id="UpdateJobCategoryForm" enctype="multipart/form-data">
                    @csrf
                    <h3 class="fs-4 mb-1 pb-3">Job Category</h3>
                    <div class="mb-4">
                        <label class="mb-2">Job Name*</label>
                        <input type="text" value="{{ $category->jobName }}" id="jobName" name="jobName" class="form-control" placeholder="Job Name">
                        <p class="font-weight-bold"></p>
                    </div>
                    <div class="mb-4">
                        <label class="mb-2">Image</label>
                        <input type="file" value="" id="image" name="image" class="form-control">
                        <p class="font-weight-bold form-text"></p>
                    </div>
                    <button type="submit" class="shadow-none btn-style head-btn1">Update</button>
                   </form>
                </div>
            </div>
        </div>
    </div>
 </div>
 @endsection

 @section('custom-js-jquery')
  <script>
    $('#UpdateJobCategoryForm').submit(function(e){
        e.preventDefault();

     let formData = new FormData(this);

     $.ajax({
        url: "{{ route('Update.JobCategory',$category->id) }}",
        type: "post",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        success : function(response){
         let error = response.errors;
         
         if(response.status == false){
            if(error.jobName){
               $('#jobName').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(error.jobName);
            }else{
               $('#jobName').removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');
            }
            
            if(error.image){
               $('#image').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(error.jobName);
            }else{
               $('#image').removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');
            }
         }else{
            window.location.href = "{{ url()->current() }}";
            window.location.href="{{ route('show.JobCategory') }}";
         }
        }
     });    
    });
  </script>
 @endsection