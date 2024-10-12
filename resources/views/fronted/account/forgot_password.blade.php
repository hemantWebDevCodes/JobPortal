@extends('fronted.layouts.app')

@section('main-section')
<section class="section-5">
    <div class="container my-5">
        <div class="py-lg-2">&nbsp;</div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                @include('fronted.message')
                <div class="form-card shadow-md border-0 p-5">
                    <h3 class="pb-4 fs-3">Forgot Password</h3>
                    <form action="{{ route('account.ProcessForgotPassword') }}" method="post">
                        @csrf
                        <div>
                            <input type="text" value="{{ old('email') }}" name="email" id="email" class="form-control fw-bold  @error('email') is-invalid @enderror" placeholder="Enter Your Email">
                            @error('email')
                              <p class="invalid-feedback fw-bold">{{ $message }}</p>
                            @enderror
                        </div> 
                        <div class="justify-content-between d-flex mt-4">
                        <button class="shadow-none btn-style head-btn1">Submit</button>
                            <a href="{{ route('Account.login') }}" class="mt-3 fw-bold">Back To Login</a>
                        </div>
                    </form>                    
                </div>
                <div class="mt-4 register-forgot-link text-center">
                    <p>Do not have an account? <a  href="{{ route('Account.register') }}">Register</a></p>
                </div>
            </div>
        </div>
        <div class="py-lg-5">&nbsp;</div>
    </div>
</section>
@endsection