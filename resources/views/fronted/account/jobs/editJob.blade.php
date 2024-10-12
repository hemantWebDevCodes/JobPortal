@extends('fronted.layouts.app')

@section('main-section')

@include('fronted.account.sidebar')
<div class="col-lg-9 mt-5">
    <div class="border-0 mb-4 ">
        <div class="form-card p-4">
            @include('fronted.message')
            <form action="{{ route('Account.updateJob',$job->id) }}" method="post" id="EditJobForm" name="EditJobForm" enctype="multipart/form-data">
             @csrf
             @method("PUT")
            <h3 class="fs-4 mb-3">Job Details</h3>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="" class="mb-2">Title<span class="req">*</span></label>
                    <input type="text" value="{{ $job->title }}" id="title" name="title" class="form-control">
                    <p class="font-weight-bold"></p>
                </div>

                <div class="col-md-6 select-style mb-4">
                    <label for="" class="mb-2">Category<span class="req">*</span></label><br>
                    <select name="job_category" id="job_category">
                      <option value="">Select a Category</option>
                       @foreach ($jobCategory as $jobNames)
                         <option {{ $job->job_category_id == $jobNames->id ? 'selected' : ''}} value="{{ $jobNames->id }}">{{ $jobNames->jobName }}</option> 
                       @endforeach
                    </select>
                    <p class="font-weight-bold"></p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 select-style mb-4">
                    <label for="" class="mb-2">Job Nature<span class="req">*</span></label><br>
                    <select id="job_timeType" name="job_timeType">
                       <option value="">Job Type</option>
                        @foreach ($jobTypeTime as $typeTime)
                            <option {{ $job->job_typetime_id == $typeTime->id ? 'selected' : ''}} value="{{ $typeTime->id }}">{{ $typeTime->timeTypeName }}</option>    
                        @endforeach
                    </select>
                    <p class="font-weight-bold"></p>
                </div>
                <div class="col-md-6  mb-4">
                    <label for="" class="mb-2">Vacancy<span class="req">*</span></label>
                    <input type="text" min="1" value="{{ $job->vacancy }}" id="vacancy" name="vacancy" class="form-control">
                    <p class="font-weight-bold"></p>
                </div>
            </div>

            <div class="row">
                <div class="mb-4 col-md-6">
                    <label for="" class="mb-2">Salary</label>
                    <input type="text"  value="{{ $job->salary }}" placeholder="Salary" id="salary" name="salary" class="form-control">
                </div>

                <div class="mb-4 col-md-6">
                    <label for="" class="mb-2">Location<span class="req">*</span></label>
                    <input type="text" value="{{ $job->location }}" placeholder="location" id="location" name="location" class="form-control">
                    <p class="font-weight-bold"></p>
                </div>
            </div>

            <div class="mb-4">
                <label for="" class="mb-2">Description<span class="req">*</span></label>
                <textarea class="form-control" name="description" id="description" cols="5" rows="5" placeholder="Description">{{ $job->description }}
                </textarea>
                <p class="font-weight-bold"></p>
            </div>

            <div class="mb-4">
                <label for="" class="mb-2">Benefits</label>
                <textarea class="form-control" name="benefits" id="benefits" cols="5" rows="5" placeholder="Benefits">{{ $job->benefits }}</textarea>
            </div>

            <div class="mb-4">
                <label for="" class="mb-2">Responsibility</label>
                <textarea class="form-control" name="responsibility" id="responsibility" cols="5" rows="5" placeholder="Responsibility">{{ $job->responsibility }}</textarea>
            </div>

            <div class="mb-4">
                <label for="" class="mb-2">Qualifications</label>
                <textarea class="form-control" name="qualifications" id="qualifications" cols="5" rows="5" placeholder="Qualifications">{{ $job->qualifications }}</textarea>
            </div>
        

        <div class="row mb-4">
            <div class="col-md-6">
                <label for="" class="mb-2">Keywords<span class="req">*</span></label>
                <input type="text" value="{{ $job->Keywords }}" placeholder="keywords" id="keywords" name="keywords" class="form-control">
                <p class="font-weight-bold"></p>
            </div>

            <div class="col-md-6 select-style">
                <label for="" class="mb-2">Experience<span class="req">*</span></label><br>
                <select id="experience" name="experience">
                        @for ($i = 1; $i <= 11; $i++)
                            <option {{ $job->experience == $i ? 'selected' : ''}} value="{{ $i }}">{{ 'Experience '. $i }}</option>
                        @endfor
                </select>
            </div>
        </div>

            <h3 class="fs-4 mb-3 pt-3 border-top">Company Details</h3>

            <div class="row">
                <div class="mb-4 col-md-6">
                    <label for="" class="mb-2">Company logo<span class="req">*</span></label>
                    <input type="file" id="company_logo" name="company_logo" class="form-control">
                    <p class="font-weight-bold"></p>
                </div>

                <div class="mb-4 col-md-6">
                    <label for="" class="mb-2">Company Name<span class="req">*</span></label>
                    <input type="text" value="{{ $job->companyName }}" placeholder="Company Name" id="company_name" name="company_name" class="form-control">
                    <p class="font-weight-bold"></p>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="" class="mb-2">Location</label>
                    <input type="text" value="{{ $job->companyLocation }}" placeholder="Location" id="Company_location" name="Company_location" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="" class="mb-2">Website</label>
                    <input type="text" value="{{ $job->companyWebsite }}" placeholder="Website" id="website" name="website" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-style head-btn1">Update</button>
          </form>
        </div>               
       </div>
      </div>
     </div>

@endsection

@section('custom-ajax')

   <script>
     $('#EditJobForm').submit(function(e){
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url : "{{ route('Account.updateJob',$job->id) }}",
            type : "post",
            data : formData,
            dataType : "json",
            contentType: false,
            processData: false,
            success : function(response){
               let errors = response.errors;

               console.log(response);
               
               if(response.status == false){
                 if(errors.title){
                    $('#title').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.title);
                 }else{
                    $('#title').removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');
                 }

                 if(errors.job_category){
                    $('#job_category').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.job_category);
                 }else{
                    $('#job_category').removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');
                 }

                 if(errors.job_timeType){
                    $('#job_timeType').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.job_timeType);
                 }else{
                    $('#job_timeType').removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');
                 }

                 if(errors.vacancy){
                    $('#vacancy').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.vacancy);
                 }else{
                    $('#vacancy').removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');
                 }

                 if(errors.location){
                    $('#location').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.location);
                 }else{
                    $('#location').removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');
                 }

                 if(errors.description){
                    $('#description').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.description);
                 }else{
                    $('#description').removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');
                 }

                 if(errors.comapny_logo){
                    $('#company_logo').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.company_logo);
                 }else{
                    $('#company_logo').removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');
                 }

                 if(errors.company_name){
                    $('#company_name').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.company_name);
                 }else{
                    $('#company_name').removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');
                 }
               
            //     }else{
            //        window.location.href = "{{ route('Account.MyJobs') }}";
               }
            } 
        });
     });
    
    </script>  

@endsection