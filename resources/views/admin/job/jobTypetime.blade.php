@extends('admin.dashboard')

@section('dashboard-main-content')
 <div class="container mt-5 bg-white">
  <div class="row">
    <div class="col-md-11 mx-auto mt-5 pt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-3 rounded-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Job Type List</li>
            </ol>
        </nav>
    </div>
  </div>
    <div class="row">
       <div class="col-md-11 col-lg-11 mx-auto mt-4 ">
        <div class="border-0 rounded-0">
          @include('fronted.message')
          <div class="form-card ">
            <div class="d-flex justify-content-between align-items-center">
              <h3 class="fs-4">Job Type</h3>
              <button type="button" class="shadow-none showbtn btn-style head-btn1">Add Job Timing</button>
            </div>
            <div class="form-show collapse mt-4">
              <form action="{{ route('Create.JobTypetime') }}" method="post" name="JobTypeTimeForm" id="JobTypeTimeForm">
                @csrf
                  <div class="mb-4">
                      <label class="mb-2">Job Type*</label>
                      <input type="text" id="timeTypeName" name="timeTypeName" class="form-control" placeholder="Job Type">
                      <p class="font-weight-bold"></p>
                  </div>
                  <button type="submit" class="btn-shadow btn-style head-btn1">Submit</button>
              </form>
            </div>
          </div>
        </div>
       </div>
       <div class="col-md-11 mx-auto mt-3 pb-5">
          <div class="table-heding p-2">
              <div class="table-responsive">
                <table class="table text-center table-white table-borderless">
                  <thead>
                    <tr class="border-bottom">
                      <th>Job Type</th>
                      <th>Status</th>
                      <th>Update</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody> 
                    @if ($jobTypeTimes->isNotEmpty())
                    @foreach ($jobTypeTimes as $jobTypeTime)
                        <tr>
                           <td>{{ $jobTypeTime->timeTypeName }}</td>
                           <td> 
                              @if($jobTypeTime->status == 1)
                                <a href="{{ route('ActiveJobTypeTime',$jobTypeTime->id) }}" class="text-dark"><i class="fa-solid fa-power-off"></i></a>
                              @else
                                <a href="{{ route('ActiveJobTypeTime',$jobTypeTime->id) }}"  class="text-dark"><i class="fa-solid fa-power-off deactive"></i></a>
                              @endif
                           </td>
                           <td><a href="{{ route('Edit.JobTypetime', $jobTypeTime->id) }}"><i class="fa fa-edit"></i></a></td>
                           <td><a href="" onclick="RemoveJobTypeTime({{ $jobTypeTime->id }})"><i class="fa fa-trash"></i></a></td>
                        </tr>
                    @endforeach
                    @endif
                  </tbody>
                </table>
            </div>
          </div>
        </div>
    </div>
 </div>


@endsection

@section('custom-js-jquery')
  <script>
    $('#JobTypeTimeForm').submit((e) =>{
       e.preventDefault();
  
       $.ajax({
           url: "{{ route('Create.JobTypetime') }}",
           type: "post",
           data : $('#JobTypeTimeForm').serializeArray(),
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
                   window.location.href="{{ url()->current() }}";
            } 
          }
        });
    });

    // This Function Will Remove Job Type Time
    function RemoveJobTypeTime(id){
      if(confirm('Are You Sure you Want to Delete ?')){
        $.ajax({
          url: "{{ route('Remove.JobTypeTime') }}",
          type: "post",
          data: {id:id},
          dataType: "json",
          success: function(response){
            if(response.status != false){
              window.location.href=window.location.href;    
              console.log('Jai Shree Ram');
            }
          }
      });
      }
    } 

    $('.showbtn').click(() => {
        $('.form-show').slideToggle();
    });
  </script>
@endsection