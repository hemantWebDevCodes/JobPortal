        {{--* Success And Error Message Show  --}}
        @if (Session::has('success'))
            <div class="success-msg alert alert-success d-flex align-items-center justify-content-between fade show" role="alert">
                <span class="">
                   <i class="fa fa-check-circle pr-1"></i> 
                   {{ session::get('success') }}
                </span>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(Session::has('error'))
            <div class="error-msg alert alert-danger pb-1 alert-dismissible fade show">
                <p class="px-3">
                   <i class="fa fa-exclamation-circle"></i>
                   {{ session::get('error') }}
                </p>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    
    <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
    @if(Session::has('error'))
        <script> 
            swal('{{ session::get("error") }}','','error');
        </script>
    @endif
 
    @if (Session::has('success'))
        <script>
            swal('{{ session::get("success") }}','','success');
        </script>
    @endif
