@extends('admin.dashboard')

@section('dashboard-main-content')
 <div class="container my-5 bg-white">
  <div class="row">
    <div class="col-md-11 mx-auto mt-5 pt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-3 rounded-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Update Team Members</li>
            </ol>
        </nav>
    </div>
  </div>
    <div class="row">
        <div class="col-md-11 col-lg-11 mx-auto mt-4">
          @include('fronted.message')
            <div class="form-card border-0 rounded-0 mb-4">
              <div class="d-flex justify-content-between align-items-center">
                <h3 class="fs-4 mb-4"> Edit Team Member</h3>
              </div>

              <form action="{{ route('Update.TeamMember',$data->id) }}" method="put" name="teamMemberForm" id="teamMemberForm" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label>Name*</label>
                      <input type="text" value="{{ $data->name }}" id="name" name="name" class="form-control">
                      <p class="font-weight-bold"></p>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Title*</label>
                        <input type="text" value="{{ $data->title }}" id="title" name="title" class="form-control">
                        <p class="font-weight-bold"></p>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-md-6">
                      <label>Bio*</label>
                      <input type="text" value="{{ $data->bio }}" id="bio" name="bio" class="form-control">
                      <p class="font-weight-bold"></p>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Image*</label>
                        <input type="file" id="member_img" name="member_img" class="form-control">
                        <p class="font-weight-bold form-text"></p>
                    </div>
                  </div>
                    <button type="submit" class="shadow-none btn-style head-btn1">Submit</button>
                </form>
              </div>
            </div>
        </div>
  </div>
   </div>
   @endsection

  @section('custom-js-jquery')
    <script>

       $('#teamMemberForm').submit((e) => {
          e.preventDefault();
       
        let formData = new FormData($('#teamMemberForm')[0]);

        $.ajax({
           url : "{{ route('Update.TeamMember',$data->id) }}",
           type: "post",
           data : formData,
           dataType : "json",
           contentType : false,
           processData : false,
           success: function(response){
              let error = response.errors;

              if(response.status == false){
                 if(error.name){
                    $('#name').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(error.name);
                 }else{
                    $('#name').removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');
                 }

                 if(error.title){
                    $('#title').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(error.title);
                 }else{
                    $('#title').removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');
                 }

                 if(error.bio){
                    $('#bio').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(error.bio);
                 }else{
                    $('#bio').removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');
                 }

                 if(error.member_img){
                    $('#member_img').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(error.member_img);
                 }else{
                    $('#member_img').removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');
                 }
              }else{
                  window.location.href = window.location.href; 
                  window.location.href = "{{ route('teamMember.show') }}";
              }
           }
        });
    });

    </script>

  @endsection
