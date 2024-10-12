@extends('fronted.layouts.app')

@section('main-section')
<section class="section-4 my-5">
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="job_details_header p-4 border-bottom">
                    <div class="d-flex justify-content-between">        
                        <div class="jobs_conetent">
                            <a href="#">
                                <h3>{{ $jobDeatail->title }}</h3>
                            </a>
                            <div class="d-flex align-item-center">
                                <p><i class="fa-solid fa-location-dot text-danger"></i> {{ $jobDeatail->location }}</p>
                                <p class="mx-3"><i class="fa fa-clock-o"></i> Part-time</p>
                            </div>
                        </div>
                        <div class="mt-2">
                            <a href="{{ route('Show.findJob') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp; Back to Jobs</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 pb-4">
                @include('fronted.message')    
                <div class="descript_wrap mt-3 white-bg">
                    <div class="jobs_conetent">
                        <h4>Job description</h4>
                        <p>{{ strip_tags($jobDeatail->description) }}</p>
                    </div>
                    @if (!empty($jobDeatail->responsibility))
                    <div class="jobs_conetent">
                        <h4>Responsibility</h4>
                        <p>{{ strip_tags($jobDeatail->responsibility) }}</p>
                    </div>
                    @endif

                    @if (!empty($jobDeatail->qualifications))
                    <div class="jobs_conetent">
                        <h4>Qualifications</h4>
                        <p>{{ strip_tags($jobDeatail->qualifications) }}</p>
                    </div>
                    @endif

                    @if (!empty($jobDeatail->benefits))
                    <div class="jobs_conetent">
                        <h4>Benefits</h4>
                        <p>{{ strip_tags($jobDeatail->benefits) }}</p>
                    </div>                  
                    @endif  
                </div>
            </div>
            
            <div class="col-md-4">
              <div class="border-start">
                <div class="card border-0 mt-3">
                    <div class="job_sumary border-bottom">
                        <div class="">
                            <h3 class="my-3">Job Summery</h3>
                        </div>
                        <div class="job_content">
                            <ul>
                                <li>Published on : <span>{{ \carbon\carbon::parse($jobDeatail->created_at)->format('d M, Y') }}</span></li>
                                <li>Vacancy : <span>{{ $jobDeatail->vacancy }}</span></li>
                                @if (!empty($jobDeatail->salary))
                                  <li>Salary : <span>{{ $jobDeatail->salary }}</span></li>
                                @endif
                                <li>Experience : <span> {{ $jobDeatail->experience }} Years</span></li>
                                @if (!empty($jobDeatail->location))
                                  <li>Location : <span>{{ $jobDeatail->location }}</span></li>
                                @endif

                                <li>Job Nature : <span> {{ $jobDeatail->jobTypetime->timeTypeName }} </span></li>
                            </ul>
                        </div>
                        <div class="pt-3 d-flex ms-3 mb-5">

                            @if (Auth::check())
                             <a href="javascript:void(0)" onclick="savedJob({{ $jobDeatail->id }})" class="shadow-none btn-style head-btn2 ms-4">Save</a>
                             <a href="#" onclick="applyJob({{ $jobDeatail->id }})" class="shadow-none btn-style head-btn1 ms-2">Apply</a>
                            @else
                             <a href="javascript:void(0)" class="shadow-none btn-style head-btn2 disabled">Saved To Save</a>
                             <a href="javascript:void(0)" class="shadow-none btn-style head-btn1 ms-2 disabled">Login To Apply</a> 
                            @endif
                         </div>
                    </div>
                </div>
                <div class="card border-0 my-4">
                    <div class="job_sumary">
                        <div class="">
                            <h3 class="my-3">Company Details</h3>
                        </div>
                        <div class="job_content">
                            <ul>
                                <li>Name : <span>{{ $jobDeatail->companyName }}</span></li>
                                <li>Location : <span>{{ $jobDeatail->companyLocation }}</span></li>
                                <li>Webite : <span><a href="{{ $jobDeatail->companyWebsite }}">{{ $jobDeatail->companyWebsite }}</a></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection

@section('custom-ajax')
 <script>

   // Apply Job 
    function applyJob(id){
      if(confirm("Are You Sure You Want to Apply on This Job?")){
        $.ajax({
            url : "{{ route('applyJob') }}",
            type : "post",
            data : {id : id},
            dataType : "json",
            success : function(response){
                window.location.href="{{ url()->current() }}";
                window.location.href="{{ url()->current() }}";
            }
        });
      }
    }

    // Save Job
     function savedJob(id){
        $.ajax({
            url : "{{ route('savedJob') }}",
            type : "post",
            data : {id,id},
            dataType : "json",
            success : function(response){
               window.location.href= "{{ url()->current() }}";
               window.location.href= "{{ url()->current() }}";
            }
        });
    }
 </script>

@endsection