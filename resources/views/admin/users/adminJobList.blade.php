@extends('admin.dashboard')

@section('dashboard-main-content')
<div class="container mt-5">
  <div class="row">
    <div class="col-md-11 mx-auto mt-5 pt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-3 rounded-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Job List</li>
            </ol>
        </nav>
    </div>
  </div>
    <div class="row">
        <div class="col-md-11 mt-4 mx-auto">
          <div class="table-heding pt-4">
            @include('fronted.message')
            <h3 class="fw-4 ms-3">Job List</h3>

          <div class="table-responsive mb-3 p-3">
            <table class="table table-borderless">
              <thead>
                <tr class="border-bottom">
                    <th>Title</th>
                    <th>Job Category</th>
                    <th>Job Timing</th>
                    <th>Location</th>
                    <th>Create By</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($jobs as $job)
                <tr class="fw-bold text-secondary">
                   <td>{{ $job->title }}</td>
                   <td>{{ $job->JobCategory->jobName }}</td>
                   <td>{{ $job->JobTypetime->timeTypeName }}</td>
                   <td>{{ $job->location }}</td>
                   <td>{{ $job->user->name }}</td>
                   <td>{{ \carbon\carbon::parse($job->create_at)->format('d M, Y') }}</td>
                   <td>
                      <div class="action-dots text-center">
                        <button  href="#" class="btn shadow-none" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                        
                            @if($job->status == 1)
                              <li><a href="{{ route('admin.ActiveJob',$job->id) }}" class="text-dark"><i class="fa-solid fa-power-off ml-3"></i> Active</a></li>
                            @else
                              <li><a href="{{ route('admin.ActiveJob',$job->id) }}"  class="text-dark"><i class="fa-solid fa-power-off deactive ml-3"></i> Deactive</a></li>
                            @endif
                        
                          <li><a class="dropdown-item" href="{{ route('Show.jobDeatail',$job->id) }}"> <i class="fa fa-eye" aria-hidden="true"></i> View</a></li>
                          <li><a class="dropdown-item" href="{{ route('Edit.AdminJob',$job->id) }}"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a></li>
                          <li><a class="dropdown-item" href="javascript:void(0)" onclick="RemoveAdminjob( {{ $job->id }} )"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a></li>
                        </ul>
                      </div>
                   </td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
      </div>
      {{ $jobs->links('pagination::bootstrap-5') }}
    </div>
 </div>
 @endsection

 @section('custom-js-jquery')
  <script>
     
    function RemoveAdminjob(id){
       if(confirm("Are You Sure You Want to Delete!")){
          $.ajax({
            url : "{{ route('Remove.AdminJob') }}",
            type : "post",
            data : { id : id},
            dataType : "json",
            success : function(response){
             if(response.status == true){
                window.location.href = "{{ url()->current() }}";
             }
           }
        });
       }
    }

     
  </script>
 @endsection