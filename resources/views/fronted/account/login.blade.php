@extends('fronted.layouts.app')

@section('main-section')

<section class="main-section">
    <div class="container my-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 order-lg-2">
                <div class="form-section">
                    <h5 class="text-center">Login</h5>
                    <form action="{{ route('login.Authenticate') }}" method="post">
                     @csrf 
                        <div class="input-group py-3">
                            <span class="input-group-text ms-auto"><i class="fa fa-envelope m-0"></i></span>
                            <input type="email" value="{{ old('email') }}" name="email" id="email" class=" @error('email') is-invalid @enderror" placeholder="Enter UserName">
                            @error('email')
                              <p class="invalid-feedback fw-bold text-center">{{ $message }}</p>
                            @enderror
                        </div> 
                        
                        <div class="input-group py-2">
                            <span class="input-group-text px-3 ms-auto"><i class="fa fa-lock"></i></span>
                            <input type="password" value="{{ old('email') }}" name="password" id="password" class=" @error('password') is-invalid @enderror" placeholder="Enter Password">
                            @error('password')
                                <p class="invalid-feedback fw-bold text-center ">{{ $message }}</p>
                            @enderror
                        </div> 
                        
                        <div class="form-group mt-3">
                            <button type="submit" name="login" id="loginbtn" class="btn shadow-none btn-style head-btn1 form-btn ms-4"> Login</button>
                        </div>
                    </form>                    
                    <div class="register-forgot-link mt-3 ms-4">
                        <a href="{{ route('account.ForgotPassword') }}">Forgot Password?</a><br>
                        <p>Do not have an account? <a  href="{{ route('Account.register') }}">Register</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 lazy form-img d-block order-lg-1" data-bg="{{ asset('assets/images/login-image.jpg') }}">
            </div>  
        </div>
    </div>
</section>    
@endsection