@extends('fronted.layouts.app')

@section('main-section')

@include('fronted.account.sidebar')
<div class="col-lg-9 col-md-9 my-5">
    <div class="form-card border-0 shadow">
        @include('fronted.message')
        <form action="{{ route('Account.SaveJob') }}" method="post" id="CreateJobForm" name="CreateJobForm" enctype="multipart/form-data">
        @csrf
        <h3 class="fs-4 mb-4">Job Details</h3>
            <div class="row">
                <div class="form-group col-md-6">
                    <input type="text" placeholder="Job Title" id="title" name="title" class="form-control">
                    <p class="font-weight-bold"></p>
                </div>

                <div class="form-group col-md-6 select-style">
                    <select name="job_category" id="job_category" class="">
                        <option value="">Select a Category</option>
                       @foreach ($jobCategory as $job)
                         <option value="{{ $job->id }}">{{ $job->jobName }}</option>   
                       @endforeach
                        <option value="">Engineering</option>
                    </select>
                    <p class="font-weight-bold"></p>
                </div>
            </div>
            
            <div class="row mt-1">
                <div class="form-group col-md-6 select-style">
                    <select id="job_timeType" name="job_timeType" class="">
                       <option value="">Job Type</option>
                        @foreach ($jobTypeTime as $typeTime)
                           <option value="{{ $typeTime->id }}">{{ $typeTime->timeTypeName }}</option>
                        @endforeach
                    </select>
                    <p class="font-weight-bold"></p>
                </div>
                <div class="form-group col-md-6 ">
                    <input type="text" min="1" placeholder="Vacancy" id="vacancy" name="vacancy" class="form-control">
                    <p class="font-weight-bold"></p>
                </div>
            </div>

            <div class="row mt-1">
                <div class="form-group col-md-6">
                    <input type="text" placeholder="Salary" id="salary" name="salary" class="form-control">
                    <p class="font-weight-bold"></p>
                </div>

                <div class="form-group col-md-6">
                    <input type="text" placeholder="location" id="location" name="location" class="form-control">
                    <p class="font-weight-bold"></p>
                </div>
            </div>

            <div class="form-group my-1 mb-4">
                <textarea class="form-control" name="description" id="description" cols="5" rows="5" placeholder="Description"></textarea>
                <p class="font-weight-bold"></p>
            </div>
            <div class="form-group mb-4">
                <textarea class="form-control" name="benefits" id="benefits" cols="5" rows="5" placeholder="Benefits"></textarea>
                <p class="font-weight-bold"></p>
            </div>
            <div class="form-group mb-4">
                <textarea class="form-control" name="responsibility" id="responsibility" cols="5" rows="5" placeholder="Responsibility"></textarea>
                <p class="font-weight-bold"></p>
            </div>
            <div class="form-group mb-4">
                <textarea class="form-control" name="qualifications" id="qualifications" cols="5" rows="5" placeholder="Qualifications"></textarea>
                <p class="font-weight-bold"></p>
            </div>
            
            <div class="row">
                <div class="form-group col-md-6">
                    <input type="text" placeholder="keywords" id="keywords" name="keywords" class="form-control">
                    <p class="font-weight-bold"></p>
                </div>
                <div class="form-group col-md-6 select-style">
                    <select id="experience" name="experience" class="">
                            @for ($i = 1; $i <= 9; $i++)
                                <option>{{ $i.' Year' }}</option>
                            @endfor
                                <option value="10+">10+</option>
                    </select>
                    <p class="font-weight-bold"></p>
                </div>
            </div>

            <h3 class="fs-4 mt-5 border-top py-4">Company Details</h3>
               
            <div class="row my-2">
                <div class="form-group col-md-6">
                    <input type="file" placeholder="Company Logo" id="Company_logo" name="Company_logo" class="form-control">
                    <p class="font-weight-bold"></p>
                </div>

                <div class="form-group col-md-6">
                    <input type="text" placeholder="Company Name" id="company_name" name="company_name" class="form-control">
                    <p class="font-weight-bold"></p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <input type="text" placeholder="Location" id="Company_location" name="Company_location" class="form-control">
                    <p class="font-weight-bold"></p>
                </div>
                <div class="form-group col-md-6">
                    <input type="text" placeholder="Website" id="website" name="website" class="form-control">
                    <p class="font-weight-bold"></p>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="shadow-none btn-style head-btn1">Save Job</button>
            </div>
          </form>
        </div>               
       </div>
      </div>
     </div>

@endsection

@section('custom-ajax')

   <script>
     $('#CreateJobForm').submit(function(e){
        e.preventDefault();
        let formData = new FormData(this);
        
        $.ajax({
            url : "{{ route('Account.SaveJob') }}",
            type : "post",
            data : formData,
            dataType : "json",
            contentType: false,
            processData: false,
            success : function(response){
               let errors = response.errors;
               
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

                 if(errors.Company_logo){
                    $('#Company_logo').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.Company_logo);
                 }else{
                    $('#Company_logo').removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');
                 }

                 if(errors.company_name){
                    $('#company_name').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.company_name);
                 }else{
                    $('#company_name').removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');
                 }
               }else{
                   window.location.href = "{{ route('Account.MyJobs') }}";
               }
            } 
        });
     });
    
    </script>  

@endsection