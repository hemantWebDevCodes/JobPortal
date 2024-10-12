@extends('fronted.layouts.app')

@section('main-section')

  @include('fronted.account.sidebar')
    <div class="col-md-9 col-lg-9 mt-5">
      <div class="form-card shadow-md border-0 rounded-0 mb-4">
      @include('fronted.message')
          <form action="{{ route('Account.UpdateProfile') }}" method="put" id="UpdateProfileForm" name="UpdateProfileForm">
          @csrf
            <h3 class="fs-4 mb-1 pb-3">My Profile</h3>
            <div class="form-group py-2">
              <input type="text" value="{{ $user->name }}" id="name" name="name" class="form-control">
              <p class="font-weight-bold"></p>
            </div>
            <div class="form-group">
              <input type="text" value="{{ $user->email }}" id="email" name="email" class="form-control">
              <p class="font-weight-bold form-text"></p>
            </div>
            <div class="form-group py-2">
              <input type="text" value="{{ $user->designation }}" id="designation" name="designation" class="form-control" placeholder="Enter Designation">
              <p class="font-weight-bold"></p>
            </div>
            <div class="form-group">
              <input type="text" value="{{ $user->mobile }}" id="mobile" name="mobile" class="form-control" placeholder="Enter Your Mobile Number">
              <p class="font-weight-bold"></p>
            </div>
            <div class="form-group py-2">
              <button type="submit" id="UpdateProfile" class="btn btn-style head-btn1">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</section>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="form-card">
      <div class="modal-header">
        <h3 class="modal-title pb-0 fs-3" id="exampleModalLabel">Change Profile Picture</h3>
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('Account.UpdateProfileImage') }}" method="post" id="ProfileImageForm" name="ProfileImageForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Profile Image</label>
                <input type="file" class="form-control" id="image"  name="image">
                <p class="font-weight-bold"></p>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" id="ProImageUpdate_btn" class="btn-style head-btn1 mx-3">Update</button>
                <button type="button" class="btn btn-danger rounded-0 px-4" data-bs-dismiss="modal">Close</button>
            </div>        
        </form>
      </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('custom-ajax')

 <script>
     
   $('#UpdateProfile').click(function(e){
      e.preventDefault();

      $.ajax({
         url : "{{ route('Account.UpdateProfile') }}",
         type : "PUT",
         data : $('#UpdateProfileForm').serializeArray(),
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
             
            window.location.href = "{{ route('Account.Profile') }}";
          }
         }
      });
   });


   $('#ProfileImageForm').submit(function(e){
      e.preventDefault();

      let formData = new FormData(this); 

     $.ajax({
        url : '{{ route("Account.UpdateProfileImage") }}',
        type : "post",
        data : formData,
        dataType : "json",
        contentType : false,
        processData : false,
        success : function(response){
           let errors = response.errors;
           
           if(response.status == false){
             if(errors.image){
                $('#image').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.image);
             }else{
                $('#image').removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');  
             }
        }else{
            window.location.href = "{{ url()->current() }}";
            window.location.href = "{{ url()->current() }}";
        }
       }
     });
   }); 



 </script>

@endsection