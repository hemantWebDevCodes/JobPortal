@extends('fronted.layouts.app')

@section('main-section')

  @include('fronted.account.sidebar')
  <div class="col-md-9 mt-5">
    @include('fronted.message')
 
 <div class="form-card border-0 rounded-0 mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="fs-4">Upload CV</h3>
        <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="btn-style head-btn1">Upload Your CV</button>
    </div>

 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="form-card">
      <div class="modal-header">
        <h3 class="modal-title pb-0 fs-3" id="exampleModalLabel">Upload Your CV</h3>
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('UploadResume') }}" method="post" id="ResumeUploadForm" name="ResumeUploadForm" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Upload CV</label>
                <input type="file" class="form-control" id="resumeImg"  name="resumeImg" accept=".png,.jpg,.jpeg,.pdf,.webp">
                <p class="fw-bold"></p>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" id="ProImageUpdate_btn" class="btn-style head-btn1 mx-3">Upload</button>
                <button type="button" class="btn btn-danger rounded-0 px-4" data-bs-dismiss="modal">Close</button>
            </div>        
        </form>
      </div>
      </div>
    </div>
  </div>
 </div>
   {{-- * List Uploaded Images --}}
   <div class="table-responsive mt-4">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Uploaded CV</th>
                <th>Deatail</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody class="border-0">
            @if ($uploadedCv->isNotEmpty())
              @foreach ($uploadedCv as $uploaded)

              <tr class="active">
                <td><img src="{{ asset('assets/Resume-image/'.$uploaded->resumeImg) }}" alt="" width="130"></td>
                <td>
                  <a href="{{ route('ResumeDeatail',$uploaded->id) }}">
                  <i class="fa fa-eye" aria-hidden="true"></i></a>
                </td>
                <td><a href="javascript:void(0)" onclick="DeleteUploadedResume({{ $uploaded->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
              </tr>                              
              @endforeach
                
            @endif
        </tbody>       
    </table>
</div>
 </div>
</div>

@endsection

@section('custom-ajax')

 <script>
    $('#ResumeUploadForm').submit(function(e){
 
        e.preventDefault(); 
        let formData = new FormData(this);

        $.ajax({
            url : "{{ route('UploadResume') }}",
            type : "post",
            data : formData,
            dataType : "json",
            contentType : false,
            processData : false,
            success : function(response){
               let error = response.errors;

               if(response.status == false){
                 if(error.resumeImg){
                    $('#resumeImg').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(error.resumeImg);
                 }else{
                    $('#resumeImg').removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');
                 }
               }else{
                  window.location.href = window.location.href;
               }
            }
        });
    });

    // Remove Uploaded Resume
    function DeleteUploadedResume(id){
      if(confirm('Are You Sure you Want to Delete ?')){
        $.ajax({
          url : "{{ route('Delete.UploadedResume') }}",
          type : "post",
          data : {id : id},
          dataType : "json",
          success : function(response){
              if(response.status == true){
                window.location.href = window.location.href;
              }
          }
        });
      }
    } 
 </script>

@endsection