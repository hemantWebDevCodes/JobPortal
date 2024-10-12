@extends('fronted.layouts.app')

@section('main-section')
<section class="section-5">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                @include('fronted.message')
                <div class="form-card">
                    <h3 class="fs-3 py-3">Reset Password</h3>
                    <form action="{{ route('Process.ResetPassword') }}" method="post">
                        @csrf
                        <input type="hidden" name="token" value="{{ $tokenString }}">
                        
                        <div class="form-group mb-3">
                            <label for="" class="mb-2">New Password*</label>
                            <input type="password" name="new_password" id="new_password" class="form-control  @error('new_password') is-invalid @enderror" placeholder="New Password">
                            @error('new_password')
                              <p class="invalid-feedback fw-bold">{{ $message }}</p>
                            @enderror
                        </div> 

                        <div class="form-group mb-3">
                            <label for="" class="mb-2">Confirm Password*</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control  @error('confirm_password') is-invalid @enderror" placeholder="Confirm Password">
                            @error('confirm_password')
                              <p class="invalid-feedback fw-bold">{{ $message }}</p>
                            @enderror
                        </div> 
                        
                        <div class="justify-content-between d-flex">
                        <button class="shadow-none btn-style head-btn1 mt-2">Submit</button>
                            <a href="{{ route('Account.login') }}" class="mt-3 fw-bold">Back To Login</a>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</section>
@endsection