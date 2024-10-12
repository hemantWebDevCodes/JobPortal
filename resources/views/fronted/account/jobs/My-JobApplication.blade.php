@extends('fronted.layouts.app')

@section('main-section')
  @include('fronted.account.sidebar')
  
  <div class="col-lg-9 mt-5">
     @include('fronted.message')
    <div class="card border-0 shadow mb-4 p-3">
        <div class="card-body card-form">
            <div class="d-flex justify-content-between">
                <div class="table-account-hading">
                    <h3 class="fs-4 fw-bold mb-1">Jobs Applied</h3>
                </div>
                
            </div>
            <div class="table-responsive mt-4">
                <table class="table ">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Job Created</th>
                            <th scope="col">Applicants</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="border-0">
                        @if ($JobApplications->isNotEmpty())
                          @foreach ($JobApplications as $JobApplication)

                          <tr class="active">
                            <td>
                                <div class="job-name fw-500">{{ $JobApplication->job->title }}</div>
                                <div class="fw-bold">{{ $JobApplication->job->JobTypetime->timeTypeName }} . {{ $JobApplication->Job->location }}</div>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($JobApplication->applied_date)->format('d M, Y') }}</td>
                            <td>{{ $JobApplication->job->Application->count() }} Applications</td>
                            <td>
                             @if ($JobApplication->job->status == 1)
                               <div class="job-status text-capitalize">Active</div>
                             @else
                               <div class="job-status text-capitalize">Dective</div>
                             @endif
                            </td>
                            <td>
                                <div class="action-dots text-center">
                                    <button  href="#" class="btn shadow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="{{ route('Show.jobDeatail',$JobApplication->id) }}"> <i class="fa fa-eye" aria-hidden="true"></i> Deatail</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="removeAppliedJob( {{ $JobApplication->id }} )"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>                              
                          @endforeach
                            
                        @endif
                    </tbody>       
                </table>
            </div>
             {{ $JobApplications->links('pagination::bootstrap-5') }}
        </div>
    </div> 
</div>
</div>
@endsection

 @section('custom-ajax')
     
 <script>
     
     function removeAppliedJob(id){
    
      if(confirm("Are You Sure You Want to Delete!")){
       $.ajax({
          url : "{{ route('Remove.AppliedJob') }}",
          type : "post",
          data : { id : id },
          dataType : "json",
          success : function(response){
            if(response.status == true){
                window.location.href="{{ route('myJob.Applied') }}";
                window.location.href="{{ route('myJob.Applied') }}";
            }
          }
        });
       }
     }
    
 </script>
 
 @endsection