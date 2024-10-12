@extends('fronted.layouts.app')

@section('main-section')
  @include('fronted.account.sidebar')
  
  <div class="col-lg-9 mt-5">
     @include('fronted.message')
    <div class="card border-0 shadow mb-4 p-3">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="table-account-hading">
                    <h3 class="fs-4 mb-1">My Jobs</h3>
                </div>
                <div style="margin-top: -10px;">
                    <a href="{{ route('Accont.job') }}" class="shadow-none btn-style head-btn1">Post a Job</a>
                </div>
                
            </div>
            <div class="table-responsive mt-4">
                <table class="table">
                    <thead>
                        <tr class="border-0">
                            <th scope="col">Title</th>
                            <th scope="col">job Type</th>
                            <th scope="col">Job Created</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="border-0">
                        @if ($jobs->isNotEmpty())
                          @foreach ($jobs as $myjobs)

                          <tr class="active">
                            <td>
                                <div class="job-name">{{ $myjobs->title }},</div>
                                <div class="info1"> {{ $myjobs->location }}</div>
                            </td>
                            <td>{{ $myjobs->JobTypetime->timeTypeName }}</td>
                            <td>{{ \Carbon\Carbon::parse($myjobs->created_at)->format('d M, Y') }}</td>
                            <td>
                                @if ($myjobs->status == 1)
                                <div class="job-status text-capitalize">Active</div>
                                @else
                                <div class="job-status text-capitalize">Dective</div>
                                @endif
                            </td>
                            <td>
                            <div class="action-dots">
                                    <button  href="#" class="btn shadow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="{{ route('Show.findJob',$myjobs->id) }}"> <i class="fa fa-eye" aria-hidden="true"></i> View</a></li>
                                        <li><a class="dropdown-item" href="{{ route('Account.editJob',$myjobs->id) }}"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="DeleteJob( {{ $myjobs->id }} )"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a></li>
                                    </ul>
                                </div>
                            </td>
            
                        </tr>                              
                          @endforeach
                            
                        @endif
                    </tbody>       
                </table>
            </div>
             {{ $jobs->links('pagination::bootstrap-5') }}
        </div>
    </div> 
</div>
</div>
@endsection

 @section('custom-ajax')
     
 <script>
     
     function DeleteJob(jobId){
    
      if(confirm("Are You Sure You Want to Delete!")){
       $.ajax({
          url : "{{ route('Account.delete') }}",
          type : "post",
          data : { jobId : jobId },
          dataType : "json",
          success : function(response){
            window.location.href="{{ route('Account.MyJobs') }}";
          }
       });
     }
    }
    
 </script>
 
 @endsection