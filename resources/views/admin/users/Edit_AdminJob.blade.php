@extends('admin.dashboard')

@section('dashboard-main-content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-9 mt-5 mx-auto">
            <div class="border-0 shadow mb-4 ">
                <div class="form-card p-4">
                    @include('fronted.message')
                    <form action="{{ route('Update.Adminjob',$editJob->id) }}" method="put" id="EditAdminJobForm" name="EditAdminJobForm">
                     @csrf
                     @method("PUT")
                    <h3 class="fs-4 mb-3">Job Details</h3>
                    <div class="row">
                        <div class="form-group col-md-6 mb-1">
                            <label for="" class="mb-1">Title<span class="req">*</span></label>
                            <input type="text" value="{{ $editJob->title }}" id="title" name="title" class="form-control">
                            <p class="font-weight-bold"></p>
                        </div>
        
                        <div class="form-group col-md-6 mb-1">
                           <div class="select-style">
                            <label for="">Job Category</label>
                            <select name="job_category" id="job_category">
                              <option value="">Select a Category</option>
                               @foreach ($jobCategory as $jobNames)
                                 <option {{ $editJob->job_category_id == $jobNames->id ? 'selected' : ''}} value="{{ $jobNames->id }}">{{ $jobNames->jobName }}</option> 
                               @endforeach
                            </select>
                            <p class="font-weight-bold"></p>
                        </div>
                    </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-md-6 select-style">
                            <label for="" class="mb-1">Job Type<span class="req">*</span></label><br>
                            <select id="job_timeType" name="job_timeType">
                               <option value="">Job Type</option>
                                @foreach ($jobTypeTime as $typeTime)
                                    <option {{ $editJob->job_typetime_id == $typeTime->id ? 'selected' : ''}} value="{{ $typeTime->id }}">{{ $typeTime->timeTypeName }}</option>    
                                @endforeach
                            </select>
                            <p class="font-weight-bold"></p>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="mb-1">Vacancy<span class="req">*</span></label>
                            <input type="text" min="1" value="{{ $editJob->vacancy }}" id="vacancy" name="vacancy" class="form-control">
                            <p class="font-weight-bold"></p>
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="mb-4 form-group col-md-6">
                            <label for="" class="mb-2">Salary</label>
                            <input type="text"  value="{{ $editJob->salary }}" placeholder="Salary" id="salary" name="salary" class="form-control">
                        </div>
        
                        <div class="mb-4 form-group col-md-6">
                            <label for="" class="mb-2">Location<span class="req">*</span></label>
                            <input type="text" value="{{ $editJob->location }}" placeholder="location" id="location" name="location" class="form-control">
                            <p class="font-weight-bold"></p>
                        </div>
                    </div>
        
                    <div class="mb-4">
                        <label for="" class="mb-2">Description<span class="req">*</span></label>
                        <textarea class="form-control" name="description" id="description" cols="5" rows="5" placeholder="Description">{{ $editJob->description }}
                        </textarea>
                        <p class="font-weight-bold"></p>
                    </div>
        
                    <div class="mb-4">
                        <label for="" class="mb-2">Benefits</label>
                        <textarea class="form-control" name="benefits" id="benefits" cols="5" rows="5" placeholder="Benefits">{{ $editJob->benefits }}</textarea>
                    </div>
        
                    <div class="mb-4">
                        <label for="" class="mb-2">Responsibility</label>
                        <textarea class="form-control" name="responsibility" id="responsibility" cols="5" rows="5" placeholder="Responsibility">{{ $editJob->responsibility }}</textarea>
                    </div>
        
                    <div class="mb-4">
                        <label for="" class="mb-2">Qualifications</label>
                        <textarea class="form-control" name="qualifications" id="qualifications" cols="5" rows="5" placeholder="Qualifications">{{ $editJob->qualifications }}</textarea>
                    </div>
                    
                 <div class="row">
                    <div class="form-group col-md-6">
                        <label for="" class="mb-2">Keywords<span class="req">*</span></label>
                        <input type="text" value="{{ $editJob->Keywords }}" placeholder="keywords" id="keywords" name="keywords" class="form-control">
                        <p class="font-weight-bold"></p>
                    </div>
        
                    <div class="form-group col-md-6 select-style">
                        <label for="" class="mb-2">Experience<span class="req">*</span></label>
                        <select id="experience" name="experience">
                                @for ($i = 1; $i <= 9; $i++)
                                    <option {{ $editJob->experience == $i ? 'selected' : ''}} value="{{ $i }}">{{$i.' Year' }}</option>
                                @endfor
                                    <option value="10+">10+</option>
                        </select>
                    </div>
                 </div>
        
                    <h3 class="fs-4 mb-1 border-top py-3">Company Details</h3>
        
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="" class="mb-2">Company Name<span class="req">*</span></label>
                            <input type="file" value="{{ $editJob->Company_logo }}" placeholder="Company logo" id="company_logo" name="company_logo" class="form-control">
                            <p class="font-weight-bold"></p>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="" class="mb-2">Company Name<span class="req">*</span></label>
                            <input type="text" value="{{ $editJob->companyName }}" placeholder="Company Name" id="company_name" name="company_name" class="form-control">
                            <p class="font-weight-bold"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="" class="mb-2">Location</label>
                            <input type="text" value="{{ $editJob->companyLocation }}" placeholder="Location" id="Company_location" name="Company_location" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Website</label>
                            <input type="text" value="{{ $editJob->companyWebsite }}" placeholder="Website" id="website" name="website" class="form-control">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="shadow-none btn-style head-1">Update</button>
                  </form>
                </div>               
               </div>
              </div>
             </div>

@endsection

@section('custom-js-jquery')

   <script>
     $('#EditAdminJobForm').submit(function(e){
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url : "{{ route('Update.Adminjob',$editJob->id) }}",
            type : "post",
            data : formData,
            dataType : "json",
            contentType : false,
            processData : false,
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

                 if(errors.company_name){
                    $('#company_name').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.company_name);
                 }else{
                    $('#company_name').removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');
                 }

                if(errors.company_logo){
                    $('#company_logo').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.company_logo);
                 }else{
                    $('#company_logo').removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');
                }

               }else{
                   window.location.href = "{{ route('Show.AdminJob') }}";
               }
            } 
        });
     });
    
    </script>  


@endsection