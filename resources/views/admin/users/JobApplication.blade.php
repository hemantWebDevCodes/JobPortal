@extends('admin.dashboard')

@section('dashboard-main-content')
<div class="container mt-5">
  <div class="row">
    <div class="col-md-11 mx-auto mt-5 pt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-3 rounded-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Job Applicant List</li>
            </ol>
        </nav>
    </div>
  </div>
    <div class="row">
        <div class="col-md-11  mx-auto mt-4">
           @include('fronted.message')
           <div class="table-heding p-4">
            <h3 class="fs-4">Job Applicant</h3>
          <div class="table-responsive mt-4">
            <table class="table table-borderless">
              <thead>
                <tr class="border-bottom">
                    <th>Title</th>
                    <th>User</th>
                    <th>Employer </th>
                    <th>Applied Date</th>
                    <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($JobApplications as $JobApplication)
                <tr class="fw-bold">
                   <td>{{ $JobApplication->job->title }}</td>
                   <td>{{ $JobApplication->user->name }}</td>
                   <td>{{ $JobApplication->employer->name }}</td>
                   <td>{{ $JobApplication->applied_date }}</td>
                   <td><a href="#" onclick="RemoveJobApplication({{$JobApplication->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          {{ $JobApplications->links('pagination::bootstrap-5') }}
        </div>
    </div>
    </div>
 @endsection
{{-- </div> --}}

 @section('custom-js-jquery')
  <script>
     
    function RemoveJobApplication(id){
       if(confirm("Are You Sure You Want to Delete?")){
          $.ajax({
            url : "{{ route('Remove.JobApplication') }}",
            type : "post",
            data : { id : id},
            dataType : "json",
            success : function(response){
             if(response.status == true){
                window.location.href="{{ url()->current() }}";
             }
           }
        });
       }
    }
     
  </script>
 @endsection