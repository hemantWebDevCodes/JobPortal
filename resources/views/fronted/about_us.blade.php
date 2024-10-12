@extends('fronted.layouts.app')

@section('main-section')

 <section class="section-0 section-bg lazy d-flex align-items-center" data-bg="{{ asset('assets/images/about_us.jpg') }}">
 </section>

 <section class="about-us section-mtop">
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto mb-5">
                <span>WHAT WE ARE DOING</span>

                 <h1 class="my-2">24k Talented people are getting Jobs</h1>

                 <p class="py-3">
                    At Job Finder, our mission is to transform the job search and recruitment experience. We are dedicated to connecting talented job seekers with top employers, fostering growth, and building successful careers.
                 </p>

                 <p>
                    Founded in 2006, Job Finder was created with the vision of bridging the gap between job seekers and employers. We understand the challenges faced by both candidates searching for the right job and employers looking for the perfect fit. Our platform aims to streamline this process, making it more efficient and effective for everyone involved.
                 </p>

                 <a href="{{ route('Accont.job') }}" class="btn-style head-btn1 mt-3">Post a Job</a>
            </div>
            <div class="col-md-6 md-order-1 section-0 lazy d-flex align-items-center" data-bg="{{ asset('assets/images/jobboy.png') }}">
        </div>
      </div>
    </div>
 </section>

  {{--* Team Member Section --}}
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
