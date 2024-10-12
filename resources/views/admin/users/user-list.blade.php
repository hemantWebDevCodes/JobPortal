@extends('admin.dashboard')

@section('dashboard-main-content')
<div class="container mt-5">
  <div class="row">
    <div class="col-md-11 mx-auto mt-5 pt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-3 rounded-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">User List</li>
            </ol>
        </nav>
    </div>
  </div>
  <div class="row">
    <div class="col-md-11 mx-auto mt-4">
      @include('fronted.message')
        <div class="table-heding">
          <h3 class="fs-3 py-3 px-4 ms-4">User List</h3>
        <div class="table-responsive">
          <table class="table table-borderless text-center">
           <thead>
             <tr class="border-bottom">
                 <th>User Pic</th>
                  <th>User Name</th>
                  <th>Email</th>
                  <th>Mobile Number</th>
                  <th>Role</th>
                  <th>action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
              <tr class="fw-bold">
                <td><img src="{{ asset('profile_pic/thumb/'.$user->image) }}" alt="avatar"  class="bg-white rounded-circle img-fluid"></td>
                 <td>{{ $user->name }}</td>
                 <td>{{ $user->email }}</td>
                 <td>{{ $user->mobile }}</td>
                 <td>{{ $user->role }}</td>
                 <td>
                    <div class="action-dots float-end">
                      <button  href="#" class="btn shadow-none" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('Edit.User',$user->id) }}"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a></li>
                        <li><a class="dropdown-item" href="#" onclick="RemoveUser( {{ $user->id }} )"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a></li>
                      </ul>
                    </div>
                 </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
          {{ $users->links('pagination::bootstrap-5') }}
      </div>
    </div>
 </div>
 @endsection

 @section('custom-js-jquery')
  <script>
     
    function RemoveUser(id){
       if(confirm("Are You Sure You Want to Delete!")){
          $.ajax({
            url : "{{ route('Remove.User') }}",
            type : "post",
            data : { id : id},
            dataType : "json",
            success : function(response){
             
           }
        });
       }
    }
     
  </script>
 @endsection