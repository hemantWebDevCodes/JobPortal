<section class="profile-section bg-2">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 col-lg-3 mt-5">
            <div class="border-0 mb-4">
              <div class="rounded-0 sidebar-top">
                <div class="text-center mt-3">
                    @if (Auth::user()->image != '')
                     <img src="{{ asset('profile_pic/thumb/'.Auth::user()->image) }}" alt="avatar"  class="bg-white text-center rounded-circle img-fluid">                 
                    @else
                      <img src="{{ asset('assets/images/avatar7.png') }}" alt="avatar"  class="bg-white rounded-circle img-fluid" style="width: 120px;">
                    @endif
                  
                    <h5 class="mt-3 pb-0">{{ Auth::user()->name }}</h5>
                    <p class="text-white mb-1 fs-6">{{ Auth::user()->designation }}</p>
                    <div class="d-flex justify-content-center mt-3 mb-2">
                        <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="btn btn-white shadow-none">Change Profile Picture</button>
                    </div>
                </div>
              </div>
                <div class="sidebar-bottom">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="{{ route('Account.Profile') }}">Account Settings</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('Accont.job') }}">Post a Job</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('Account.MyJobs') }}">My Jobs</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('myJob.Applied') }}">Jobs Applied</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('Show.savedJob') }}">Saved Jobs</a>
                        </li> 
                        <li class="list-group-item">
                            <a href="{{ route('show.Resume') }}">Uploaded CV</a>
                        </li>  
                        <li class="list-group-item">
                            <a href="{{ route('Account.logout') }}"> Logout</a>
                        </li>                                                    
                    </ul>
                </div>
            </div>
        </div>