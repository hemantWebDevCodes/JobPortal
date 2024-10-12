@extends('fronted.layouts.app')

@section('main-section')
<section class="section-0 lazy d-flex bg-image-style align-items-center" data-bg="{{ asset('assets/images/job-banner.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-lg-7 text-white banner-text-form mb-5">
            <div class="banner-text">
                <h1 class="font-md-small">Find The Best StartUp Job That Fit You</h1>
                <p>Thounsands of jobs available.</p>
            </div>
            <div class="banner-form">
            <form action="{{ route('Show.findJob') }}" method="get">
                <div class="input-group">
                    <input type="text" class="form-control" name="keywords" id="keywords" placeholder="Keywords">
                    <input type="text" class="form-control" name="location" id="location" placeholder="Location">
                    <select name="Jobcategory" id="Jobcategory" class="text-dark">   
                        <option value="">Select a Category</option>
                        @foreach ($jobCategories as $jobCategory)
                            <option value="{{ $jobCategory->id }}">{{ $jobCategory->jobName }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary btn-block shadow-none"><i class="fa fa-search"></i></button>
                </div>
        </form>
        </div>
    </div>
            <div class="col-md-5 col-lg-5 d-lg-block d-none">
                <img src="{{ asset('assets/images/job_image.jpg') }}" alt="" class="img-fluid d-block w-100">
            </div>
        </div>
    </div>
</section>


{{--* Section 2 --}}

<section class="section-2 py-5 bg-2 section-mtop">
    <div class="container">
        <h2>Top Categories</h2>
        <div class="row pt-5">
            @if ($jobCategories->isNotEmpty())
              @foreach ($jobCategories as $categoryData)
                <div class="col-lg-3 col-md-6 mb-5">
                    <div class="single_category d-flex justify-content-center flex-column">
                    <div class="category-icon">
                        <img src="{{ asset('assets/admin-panel/admin_images/'.$categoryData->image) }}" alt="" class="img-fluid">
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('Show.findJob').'?&Jobcategory='.$categoryData->id }}" class="text-decoration-none text-dark"><span>{{ $categoryData->jobName }}</span></a>
                        {{-- <p> <span>0</span> Available position</p> --}}
                    </div>
                    </div>
                </div>
              @endforeach
            @endif
        </div>
    </div>
</section>


{{--* Section 3  --}}
<section class="section-mtop">
    <div class="container">
        <div class="row">
            <div class="col-md-11 text-center mb-3 mx-auto">
                <h1 class="">Featured Jobs</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            @if ($feturedJob->isNotEmpty())
            @foreach ($feturedJob as $job)
            <div class="d-flex flex-column flex-md-row fetured px-5 py-3">
                <div class="col-md-2 py-2">
                    <img src="{{ asset('assets/company_logo/'.$job->Company_logo) }}" class="ms-lg-5 img-fluid w-50 d-block">
                </div>
                <div class="col-md-7 py-3">
                    <h4 class="text-secondary md-py-3">{{ $job->title }}</h4>
                    <div class="d-flex justify-content-between">
                        <span>{{ $job->companyName }}</span>
                        <span><i class="fa-solid fa-location-dot text-danger"></i> {{ $job->location }}</span>
                        {{-- <span>{{ Str::words($job->Keywords,2) }}</span> --}}
                        @if (!is_Null($job->salary)) 
                        <span>{{ $job->salary }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-3 py-3">
                    <div class="d-flex justify-content-between flex-lg-column float-lg-end me-lg-3">
                        <span class=" fw-bold pb-2">{{ $job->JobTypetime->timeTypeName }}</span>
                        <a href="{{ route('Show.jobDeatail',$job->id) }}" id="job-deatail" class="btn btn-white shadow-none">View Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
        {{ $feturedJob->links('pagination::bootstrap-5') }}
    </div>
</section>

{{-- Resume Upload Section --}}
 
<section class="section-mtop">
  <div class="container">
    <div class="row">
        <div class="col-md-12 text-center mb-3">
            <h1>Upload Your CV</h1>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-6 mx-auto mb-5 mt-4">
            <div class="resume-heading">
                <h3 class="py-3">Upload Your CV for New Opportunities</h3>
                <p class="py-3">Easily upload your resume to connect with top employers and discover job opportunities that match your skills and experience. By uploading your resume, you'll benefit from personalized job recommendations and the ability to apply for jobs with just one click.</p>
                <p class="text-muted">Take your career to new heights by uploading your CV. Our platform will help you find the best opportunities. Just click the button below and upload your resume.</p>
                <a href="{{ route('show.Resume') }}" class="btn-style head-btn1 mt-5 py-4">Upload Your CV</a>
            </div>
        </div>
        <div class="col-md-5 mt-4 section-0 lazy d-flex bg-image-style align-items-center" data-bg="{{ asset('assets/images/cv.jpg') }}">
            {{-- <img src="{{ asset('assets/images/cv.jpg') }}" class="" alt=""> --}}
        </div>
    </div>
  </div>
</section>

{{-- * Team Member Section --}}
<section class="team_member section-mtop">
    <div class="container">
      <h3 class="text-center">Team Members</h3>
      <p class="text-center fst-italic p-0 mb-5 fw-bold text-muted">Dedicated professionals connecting talent with opportunity.</p>
     <div class="slider">
        @if ($TeamMembers->isNotEmpty())
        @foreach ($TeamMembers as $TeamMember)
        <div class="row mt-4">
        <div class="col-md-8 mx-auto">
              <div class="text-center">
                 <img src="{{ asset('assets/admin-panel/team_member_img/thumb/'.$TeamMember->member_img) }}" class="rounded-circle my-3" alt="">
                 <h4 class="my-2">{{ $TeamMember->name }}</h4>
                 <span class="text-secondary fs-5">{{ $TeamMember->title }}</span>
              </div>
              <div class="text-center my-5">
                 <p>“ {{ $TeamMember->bio }} ”</p>
              </div>
           </div>
        </div>
           @endforeach
           @endif
        </div>
        </div>
     </div>
    </div>
 </section>
@endsection

