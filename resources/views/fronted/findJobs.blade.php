@extends('fronted.layouts.app')

@section('main-section')


<section class="section-0 lazy d-flex bg-image-style align-items-center" data-bg="{{ asset('assets/images/job-search.jpg') }}">

</section>


<section class="section-3 pb-2 section-mtop">
    <div class="container">     
        <form action="" id="JobFilterForm" name="JobFilterForm">
        <div class="row pt-5">
            <div class="col-md-4 col-lg-3 sidebar mb-4">
                <div class="mb-4 mt-1">
                    <h4 class="ms-2">Find Jobs</h4>  
                </div>
                <div class="border p-4  mx-2">
                    <div class="mb-4">
                        <h5>Job Keywords</h5>
                        <input type="text" value="{{ Request::get('keyword') }}" id="keyword" name="keyword" placeholder="Keywords" class="form-control shadow-none my-1">
                    </div>

                    <div class="mb-4">
                        <h5> Job Location</h5>
                        <input type="text" value="{{ Request::get('location') }}" id="location" name="location" placeholder="Location" class="form-control shadow-none my-1">
                    </div>

                    <div class="mb-4 select-style">
                        <h5> Job Category</h5>
                        <select name="jobCategory" id="jobCategory" class="my-1">
                            <option value="">Select a Category</option>
                            @if ($jobCategory->isNotEmpty())
                               @foreach ($jobCategory as $category)
                                   <option {{ (Request::get('Jobcategory') == $category->id ? 'selected' : '') }} value="{{ $category->id }}">{{ $category->jobName }}</option>
                               @endforeach
                            @endif
                        </select>
                    </div>                   

                    <div class="mb-4 pt-5">
                        <h5>Job Type</h5>
                        @foreach ($jobTypeTime as $type)
                         <div class="form-check my-1"> 
                            <input {{ ( in_array($type->id,$jobTimingArray) ? 'checked' : '' ) }} class="form-check-input shadow-none" name="job_Typetime" type="checkbox" value="{{ $type->id }}" id="job_Typetime">    
                            <label class="form-check-label ms-3 mt-1" for="">{{ $type->timeTypeName }}</label>
                         </div>
                        @endforeach
                    </div>

                    <div class="mb-4 select-style">
                        <h5>Experience</h5>
                        <select name="experience" id="experience" class="my-1">
                            <option value="">Select Experience</option>
                            @for ($i = 1; $i <= 10; $i++)
                               <option {{ (Request::get('experience') == $i ? 'selected' : '') }} value="{{ $i }}"> {{ $i.' Year' }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="pt-5">
                      <button type="submit" class="btn head-btn2 btn-style shadow-none">Apply</button> 
                      <a href="{{ route('Show.findJob') }}" class="btn head-btn1 btn-style shadow-none">Reset</a>               
                    </div>
                </div>
            </div>

          {{-- Search Data --}}
            <div class="col-md-8 col-lg-9">
               <div class="row mb-1 mt-md-1">
                    <div class="d-flex justify-content-between">
                        <div class="ms-2">
                            <p>20, 122 Jobs found</p>
                        </div>
                        <div class="sort-By-Select d-flex">
                            <div class="mt-2 me-3">
                                <p>Sort By</p>
                            </div>
                            <div class="select-style">
                                <select name="sort float-end" id="sort">
                                    <option value="1" {{ (Request::get('sort') == '1' ) ? 'selected' : '' }}>Latest</option>
                                    <option value="0" {{ (Request::get('sort')  == '0') ? 'selected' : '' }}>Oldest</option>
                                </select>
                            </div>
                        </div>
                    </div>
               </div>
               <div class="row justify-content-center">
                    @if ($jobs->isNotEmpty())
                    @foreach ($jobs as $job)
                    <div class="d-flex flex-column flex-md-row fetured  py-3">
                        <div class="col-md-2 py-2">
                            <img src="{{ asset('assets/company_logo/'.$job->Company_logo) }}" class="img-fluid d-block border" width="100" height="100"> 
                        </div>
                        <div class="col-md-8 py-3">
                            <h4 class="text-secondary">{{ $job->title }}</h4>
                            <div class="d-flex justify-content-between">
                                <span>{{ $job->companyName }}</span>
                                <span><i class="fa-solid fa-location-dot text-danger"></i> {{ $job->location }}</span>
                                <span class="fw-bold">{{ Str::words($job->Keywords,2) }}</span>
                                @if (!is_Null($job->salary)) 
                                <span>{{ $job->salary }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2 py-3">
                            <div class="d-flex justify-content-between flex-lg-column float-lg-end">
                                <span class=" fw-bold pb-2">{{ $job->JobTypetime->timeTypeName }}</span>
                                <a href="{{ route('Show.jobDeatail',$job->id) }}" id="job-deatail" class="shadow-none btn btn-white">View Detail</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                      <h5 class="text-center text-danger mt-4">Search Not Found.</h5>
                    @endif
                </div>
                <div class="pagination-style my-5">
                   {{ $jobs->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            </div> 
        </div>
    </form> 
</div>
</section>
@endsection

@section('custom-ajax')
  <script>
     $('#JobFilterForm').submit((e) => {
        e.preventDefault();
        
       let url = '{{ route("Show.findJob") }}?';
       let keyword = $('#keyword').val();
       let location = $('#location').val();
       let jobCategory = $('#jobCategory').val();
       let experience = $('#experience').val();
       let sort = $('#sort').val();

     // if Keyword has a Value
       if(keyword != ''){
          url +='&keywords='+keyword;  
        }
   
     // if Location has    
       if(location != ''){
          url +='&location='+location;
       }

     // if Category has a value
       if(jobCategory != ''){
          url +='&Jobcategory='+jobCategory;
       }

     // if User has checked Job Time Type     
       let checkboxTypetime = $("input:checkbox[name='job_Typetime']:checked").map(function(){
           return $(this).val();
       }).get();

       if(checkboxTypetime.length > 0){
           url +='&job_Typetime='+checkboxTypetime;
       }

     // if Experiences has a value
       if(experience != ''){
           url +='&experience='+experience;
        }
    
     // Sorting Value Latest And Oldest 
       url +='&sort='+sort;   

       window.location.href = url;
    
    });
        
    
     $('#sort').change(function(){
        $('#JobFilterForm').submit();
     });
  </script>
@endsection