@extends('fronted.layouts.app')

@section('main-section')
  @include('fronted.account.sidebar')
  
  <div class="col-lg-9 mt-5">
     @include('fronted.message')
    <div class="card border-0 shadow mb-4 p-3">
        <div class="card-body card-form">
            <div class="d-flex justify-content-between">
                <div class="table-account-hading">
                    <h3 class="fs-4 fw-bold mb-1">Saved Jobs</h3>
                </div>
                
            </div>
            <div class="table-responsive mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Location</th>
                            <th scope="col">Applicants</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="border-0">
                        @if ($savedJobs->isNotEmpty())
                          @foreach ($savedJobs as $savedJob)

                          <tr class="active">
                            <td>
                                <div>{{ $savedJob->job->title }}</div>
                            </td>
                            <td class="fw-bold">{{ $savedJob->Job->location }}, <br> {{ $savedJob->job->JobTypetime->timeTypeName }}</td>
                            <td>{{ $savedJob->job->Application->count() }} Applications</td>
                            <td>
                             @if ($savedJob->job->status == 1)
                               <div class="job-status text-capitalize">Active</div>
                             @else
                               <div class="job-status text-capitalize">Dective</div>
                             @endif
                            </td>
                            <td>
                                <div class="action-dots float-center">
                                    <button  href="#" class="btn shadow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="{{ route('Show.jobDeatail',$savedJob->id) }}"> <i class="fa fa-eye" aria-hidden="true"></i> Deatail</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0)" onclick="removeSavedJob( {{ $savedJob->id }} )"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>                              
                          @endforeach
                            
                        @endif
                    </tbody>       
                </table>
            </div>
             {{ $savedJobs->links('pagination::bootstrap-5') }}
        </div>
    </div> 
</div>
</div>
@endsection

 @section('custom-ajax')
     
 <script>
     
     function removeSavedJob(id){
    
      if(confirm("Are You Sure You Want to Delete!")){
       $.ajax({
          url : "{{ route('remove.SavedJob') }}",
          type : "post",
          data : { id : id },
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