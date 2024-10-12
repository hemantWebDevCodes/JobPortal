@extends('fronted.layouts.app')

@section('main-section')
  @include('fronted.account.sidebar')

<div class="col-md-8 mt-5">
    @include('fronted.message')
   <form action="" method="post" id="ChangePasswordForm" name="ChangePasswordForm">
    @csrf
    <div class="card border-0 shadow mb-4">
        <div class="card-body p-4">
            <h3 class="fs-4 mb-1">Change Password</h3>
            <div class="my-4">
                <label for="" class="mb-2">Old Password*</label>
                <input type="password" id="old_password" name="old_password" placeholder="Old Password" class="form-control">
                <p></p>
            </div>
            <div class="mb-4">
                <label for="" class="mb-2">New Password*</label>
                <input type="password" id="new_password" name="new_password" placeholder="New Password" class="form-control">
                <p></p>
            </div>
            <div class="mb-4">
                <label for="" class="mb-2">Confirm Password*</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" class="form-control">
                <p></p>
               <br>
            </div>                        
        </div>
        <div class="card-footer  p-4">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
    </form>  
</div>
@endsection

@section('custom-ajax')
<script>
  $('#ChangePasswordForm').submit(function(e){
    e.preventDefault();
   
    $.ajax({
       url : "{{ route('Process.Updatepassword') }}",
       type : "post",
       data : $('#ChangePasswordForm').serializeArray(),
       dataType : "json",
       success : function(response){
        
        let errors = response.errors;
          
        if(response.status == false){
            if(errors.old_password){
                $('#old_password').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.old_password);
            }else{
                $('#old_password').removeClass('is-invalid').addClass('is-valid').siblings('p').addClass('invalid-feedback').html('');
            }

            if(errors.new_password){
                $('#new_password').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.new_password);
            }else{
                $('#new_password').removeClass('is-invalid').addClass('is-valid').siblings('p').addClass('invalid-feedback').html('');
            }

            if(errors.confirm_password){
                $('#confirm_password').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.confirm_password);
            }else{
                $('#confirm_password').removeClass('is-invalid').addClass('is-valid').siblings('p').addClass('invalid-feedback').html('');
            }
        }
          
        if(response.errors == "justuseRelodePage"){
            window.location.href="{{ url()->current() }}";
        }else{
            window.location.href="{{ url()->current() }}";
        }
       }
    });
  });
</script>
@endsection