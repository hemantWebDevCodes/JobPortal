@extends('admin.dashboard')

@include('admin.includes.sidebar')

@section('dashboard-main-content')
<br><br><br>
<div class="container">
    <div class="row">
        <div class="col-lg-8 mx-auto mt-5">
            @include('fronted.message')
                <div class="form-card">
                    <form action="{{ route('Update.User',$UserEdit->id) }}" method="put" id="UserEditForm" name="UserEditForm">
                      @csrf
                    <h3 class="fs-4 mb-1">Job Details</h3>
                    <div class="form-group">
                        <label for="" class="mb-2">Name</label>
                        <input type="text" value="{{ $UserEdit->name }}" id="name" name="name" class="form-control">
                        <p class="font-weight-bold"></p>
                    </div>
                    <div class="form-group">
                        <label for="" class="mb-2">Email</label>
                        <input type="text"  value="{{ $UserEdit->email }}" id="email" name="email" class="form-control">
                        <p class="font-weight-bold"></p>
                    </div>
                    <div class="form-group">
                        <label for="" class="mb-2">Mobile Number<span class="req">*</span></label>
                        <input type="text" value="{{ $UserEdit->mobile }}" id="mobile" name="mobile" class="form-control">
                        <p class="font-weight-bold"></p>
                    </div>
                       <button type="submit" class="shadow-none btn-style head-btn1">Update</button>
                    </form>
                </div>               
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom-js-jquery')

   <script>
     $('#UserEditForm').submit(function(e){
        e.preventDefault();

        $.ajax({
            url : "{{ route('Update.User',$UserEdit->id) }}",
            type : "put",
            data : $('#UserEditForm').serializeArray(),
            dataType : "json",
            success : function(response){
               let errors = response.errors;
               
               if(response.status == false){
                 if(errors.name){
                    $('#name').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.name);
                 }else{
                    $('#name').removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');
                 }

                 if(errors.email){
                    $('#email').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.email);
                 }else{
                    $('#email').removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');
                 }

                 if(errors.mobile){
                    $('#mobile').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.mobile);
                 }else{
                    $('#mobile').removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');
                 }
               }else{
                   window.location.href = "{{ url()->current() }}";
               }
            } 
        });

     });
    
    </script> 
@endsection