@extends('admin.dashboard')

@section('dashboard-main-content')
 <div class="container my-5 bg-white">
  <div class="row">
    <div class="col-md-11 mx-auto mt-5 pt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-3 rounded-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Team Members</li>
            </ol>
        </nav>
    </div>
  </div>
    <div class="row">
        <div class="col-md-11 col-lg-11 mx-auto mt-4">
          @include('fronted.message')
            <div class="form-card border-0 rounded-0 mb-4">
              <div class="d-flex justify-content-between align-items-center">
                <h3 class="fs-4"> Team Member</h3>
                <button type="button" class="shadow-none showTeamMemberForm btn-style head-btn1">Add Job Category</button>
              </div>
              
              <div class="TeamMember_formshow collapse mt-4">
                <form action="{{ route('Add.TeamMember') }}" method="post" name="teamMemberForm" id="teamMemberForm" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label>Name*</label>
                      <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name">
                      <p class="font-weight-bold"></p>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Title*</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Enter Title">
                        <p class="font-weight-bold"></p>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-md-6">
                      <label>Bio*</label>
                      <input type="text" id="bio" name="bio" class="form-control" placeholder="Enter Bio">
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

    <div class="col-md-11 mx-auto mb-5">
      <div class="table-heding">
      <div class="table-responsive p-3">
        <table class="table table-white table-borderless">
          <thead>
            <tr class="border-bottom text-center">
              <th>Image</th>
              <th>Name</th>
              <th>title</th>
              <th>bio</th>
              <th>Update</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($teamMembers as $teamMember)
            <tr class="text-center border-bottom">
              <td><img src="{{ asset('assets/admin-panel/team_Member_Img/thumb/'.$teamMember->member_img) }}" class="rounded-circle"></td>
              <td>{{ $teamMember->name }}</td>
              <td>{{ $teamMember->title }}</td>
              <td>{{ Str::words($teamMember->bio,5) }}</td>
              <td><a href="{{ route('edit.teamMember',$teamMember->id)}}"><i class="fa fa-edit"></i></a></td>
              <td><a href="" onclick="deleteTeamMember({{ $teamMember->id }})"><i class="fa fa-trash"></i></a></td>
            </tr>
            @endforeach
          </tbody>
         </table>
       </div>
      </div>
       <div class="mt-5">
          {{ $teamMembers->links('pagination::bootstrap-5') }}
       </div>
      <div class="mt-4">
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
           url : "{{ route('Add.TeamMember') }}",
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
              }
           }
        });
    });


    //* Delete TeamMember
    function deleteTeamMember(id){
      if(confirm('Are You Sure you Want to Delete ?')){
        $.ajax({
            url : "{{ route('delete.TeamMember') }}",
            type : "post",
            data : {id : id},
            dataType : "json",
            success : function(response){
              window.location.href = window.location.href;
            }
        });
       }
    }

    // Form Hide Show
    $('.showTeamMemberForm').click(function(){
        $('.TeamMember_formshow').slideToggle();
    });
    </script>

  @endsection
