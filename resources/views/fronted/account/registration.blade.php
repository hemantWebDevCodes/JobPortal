@extends('fronted.layouts.app')

@section('main-section')

<section class="main-section">
    <div class="container my-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 order-lg-2">
                <div class="form-section">
                    <h5 class="text-center mb-3">Register</h5>
                    <form method="post" name="registrationform" id="registrationform">
                     @csrf
                        <div class="input-group py-2">
                            <span class="input-group-text ms-auto"><i class="fa fa-user"></i></span>
                            <input type="text" name="name" id="name" placeholder="Enter Name">
                            <p class="fw-bold ps-4 ms-5"></p>
                        </div> 
                       
                        <div class="input-group">
                            <span class="input-group-text ms-auto"><i class="fa fa-envelope"></i></span>
                            <input type="email" name="email" id="email" placeholder="Enter Email">
                            <p class="fw-bold ps-4 ms-5"></p>
                        </div> 
                       
                        <div class="input-group py-2">
                            <span class="input-group-text ms-auto"><i class="fa fa-lock"></i></span>
                            <input type="password" name="password" id="password" placeholder="Enter Password">
                            <p class="fw-bold ps-4 ms-5"></p>
                        </div> 
                       
                        <div class="input-group">
                            <span class="input-group-text ms-auto"><i class="fa fa-lock"></i></span>
                            <input type="password" name="confirm_password" id="confirm_password" placeholder="Enter Password">
                            <p class="fw-bold ps-4 ms-5"></p>
                        </div> 
                       
                        <div class="form-group py-2 ms-2">
                            <button type="submit" id="register-btn" value="Register" class="btn shadow-none btn-style head-btn1 form-btn ms-4">Register</button>
                        </div>
                    </form> 
                <div class="mt-4 text-center register-forgot-link">
                    <p>Have an account? <a  href="{{ route('Account.login') }}">Login</a></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 form-img lazy order-lg-1" data-bg="{{ asset('assets/images/login-image.jpg') }}">
        </div>
        </div>
    </div>
</section>
@endsection

@section('custom-ajax')
 <script>
    
    $("#register-btn").click(function(e){
      e.preventDefault();
    
    $.ajax({
       url : "{{ route('Register.process') }}",
       type : "POST",
       data : $('#registrationform').serializeArray(),
       dataType: "json",
       success : function(response){
           
        let errors = response.errors;
        
        if(response.status == false){

            if(errors.name){
                $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.name);
            }else{
                $("#name").removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');
            }

            if(errors.email){
                $("#email").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.email);
            }else{
                $("#email").removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');
            }

            if(errors.password){
                $("#password").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.password);
            }else{
                $("#password").removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');
            }

            if(errors.confirm_password){
                $("#confirm_password").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.confirm_password);
            }else{
                $("#confirm_password").removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');
            }

          }else{

            window.location.href = "{{ url()->current() }}";
            window.location.href = "{{ route('Account.login') }}";

            if(errors.name){
                $("#name").removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');
            }
            if(errors.email){
                $("#name").removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');
            }
            if(errors.password){
                $("#password").removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');
            }
            if(errors.confirm_password){
                $("#confirm_password").removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');
            }
          }
       }
    });
    
 });
 </script>
@endsection

