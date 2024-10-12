@extends('admin.dashboard')

@section('dashboard-main-content')
 <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-6 mt-5">
            @include('fronted.message')
            <div class="form-card border-0 rounded-0 shadow mb-4">
                   <form action="{{ route('Update.JobTypeTime',$jobtime->id) }}" method="put" name="UpdateJobTypeyimeForm" id="UpdateJobTypeyimeForm">
                    @method('PUT')
                    @csrf
                    <h3 class="fs-4 mb-1 pb-3">Job Timing</h3>
                    <div class="mb-4">
                        <label class="mb-2">Job Type*</label>
                        <input type="text" value="{{ $jobtime->timeTypeName }}" id="timeTypeName" name="timeTypeName" class="form-control" placeholder="Job Name">
                        <p class="font-weight-bold"></p>
                    </div>
                    <button type="submit" class="shadow-none btn-style head-btn1">UpDate</button>
                   </form>
                </div>
            </div>
        </div>
    </div>

    @endsection


@section('custom-js-jquery')
  <script>
    $('#UpdateJobTypeyimeForm').submit((e) =>{
       e.preventDefault();

       $.ajax({
           url: "{{ route('Update.JobTypeTime',$jobtime->id) }}",
           type: "post",
           data : $('#UpdateJobTypeyimeForm').serializeArray(),
           dataType: "json",
           success : function(response){
              let error = response.errors;

              if(response.status == false){
                 if(error.timeTypeName){
                   $('#timeTypeName').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(error.timeTypeName); 
                }else{
                   $('#timeTypeName').addClass('is-valid').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                }
              }else{
                window.location.href="{{ route('display.JobTypeTime') }}";
              } 
            }
        });
    });
  </script>
@endsection