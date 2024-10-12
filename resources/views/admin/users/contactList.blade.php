@extends('admin.dashboard')

@section('dashboard-main-content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-11 mx-auto mt-5 pt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-3 rounded-0">
                    <li class="breadcrumb-item"><a href="{{ route('Home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Contact List</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-11 mx-auto mt-4">
           @include('fronted.message')
          <div class="table-heding">
            <h3 class="fs-3 pt-4 px-4">Contacts List</h3>
          <div class="table-responsive pt-1 px-4">
            <table class="table table-borderless">
              <thead>
                <tr class="border-bottom">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Subject</th>
                    <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($contacts as $contact)
                <tr class="fw-bold">
                   <td>{{ $contact->name }}</td>
                   <td>{{ $contact->email }}</td>
                   <td>{{ Str::words($contact->message,7) }}</td>
                   <td>{{ $contact->subject }}</td>
                   <td>
                      <a href="" onclick="RemoveContact( {{ $contact->id }} )"><i class="fa fa-trash" aria-hidden="true"></i></a>
                   </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          {{ $contacts->links('pagination::bootstrap-5') }}
        </div>
    </div>
 </div>
 @endsection

 @section('custom-js-jquery')
  <script>
     
    function RemoveContact(id){
       if(confirm("Are You Sure You Want to Delete!")){
          $.ajax({
            url : "{{ route('Remove.Contact') }}",
            type : "post",
            data : { id : id},
            dataType : "json",
            success : function(response){
               if(response.status != false){
                  window.location.href="{{ url()->current() }}";
               }
           }
        });
       }
    }
     
  </script>
 @endsection