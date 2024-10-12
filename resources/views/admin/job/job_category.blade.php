@extends('admin.dashboard')

@section('dashboard-main-content')
 <div class="container my-5 bg-white">
  <div class="row">
    <div class="col-md-11 mx-auto mt-5 pt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-3 rounded-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Job Category List</li>
            </ol>
        </nav>
    </div>
  </div>
    <div class="row">
        <div class="col-md-11 col-lg-11 mx-auto mt-4">
          @include('fronted.message')
            <div class="form-card border-0 rounded-0 mb-4">
              <div class="d-flex justify-content-between align-items-center">
                <h3 class="fs-4">Job Category</h3>
                <button type="button" class="shadow-none showcategorybtn btn-style head-btn1">Add Job Category</button>
              </div>
              
              <div class="ctegory_formshow collapse mt-4">
                <form action="{{ route('Create.JobCategory') }}" method="post" name="JobCategorForm" id="JobCategorForm" >
                  @csrf
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label>Job Name*</label>
                      <input type="text" id="jobName" name="jobName" class="form-control" placeholder="Job Name">
                      <p class="font-weight-bold"></p>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Image</label>
                        <input type="file" id="image" name="image" class="form-control">
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
            <tr class="border-bottom">
              <th>Job Category Name</th>
              <th>Image</th>
              <th>Status</th>
              <th>Update</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody class="border-0">
            @if ($Categories->isNotEmpty())
            @foreach ($Categories as $category)
               <tr>
                  <td>{{ $category->jobName }}</td>
                  <td><img src="{{ asset('assets/admin-panel/admin_images/'.$category->image) }}" alt="" width="100"></td>
                  <td> 
                    @if($category->status == 1)
                      <a href="{{ route('ActiveJobCategory',$category->id) }}" class="text-dark"><i class="fa-solid fa-power-off"></i></a>
                    @else
                      <a href="{{ route('ActiveJobCategory',$category->id) }}"  class="text-dark"><i class="fa-solid fa-power-off deactive"></i></a>
                    @endif
                  </td>
                  <td><a href="{{ route('Edit.JobCategory',$category->id) }}"><i class="fa fa-edit"></i></a></td>
                  <td><a href="javascript:void(0)" onclick="DeleteJobCategory({{ $category->id }})"><i class="fa fa-trash"></i></a></td>
               </tr>
            @endforeach
            @endif
           </tbody>
         </table>
       </div>
      </div>
      <div class="mt-4">
        {{ $Categories->links('pagination::bootstrap-5') }}
      </div>
   </div>
  </div>
   </div>
  
@endsection


@section('custom-js-jquery')
  <script>
    
     $('#JobCategorForm').submit((e) => {
         e.preventDefault();

         let formData = new FormData($('#JobCategorForm')[0]);

        $.ajax({
            url: "{{ route('Create.JobCategory') }}",
            type: "post",
            data: formData,
            dataType:"json",  
            contentType: false, 
            processData: false,
            success: function(response){
               let error = response.errors;

               if(response.status == false){
                if(error.jobName){
                  $('#jobName').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(error.jobName);
                }else{
                  $('#jobName').removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');
                }

               if(error.image){
                  $('#image').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(error.image);
               }else{
                  $('#image').removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').html('');
               }
            }else{
               window.location.href="{{ url()->current() }}";
            }
          }
        });
     });

   // This Ajax Mathod Will Delete Job Category
    function DeleteJobCategory(id){
       $.ajax({
          url: "{{ route('Delete.JobCategory') }}",
          type: "post",
          data : { id : id },
          dataType: "json",
          success: function(response){
             window.location.href="{{ url()->current() }}";
          }
       });
    }   

    // Show form On Btn Click
    $('.showcategorybtn').click(() => {
      $('.ctegory_formshow').slideToggle();
    });

  </script>
@endsection