@extends('fronted.layouts.app')

@section('main-section')

<section class="section-0 section-bg lazy d-flex align-items-center" data-bg="{{ asset('assets/images/contact-us.jpg') }}">
</section>

 <section class="section-mtop">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
             <div class="contact-form mx-auto">
                @include('fronted.message')
                <div class="mb-4">
                    <h3>Contact Form</h3>
                </div>
                    <form action="{{ route('create.Contact') }}" method="POST" id="CreateContactForm" name="CreateContactForm">
                        <div class="form-group pb-3">
                            <textarea name="message" id="message" cols="10" rows="5" class="form-control shadow-none" placeholder="Enter Message"></textarea>
                            <p class="fw-bold"></p>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" name="name" id="name" class="form-control shadow-none" placeholder="Enter Your Name">
                                <p class="fw-bold"></p>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" name="email" id="email" class="form-control shadow-none" placeholder="Enter Your Email">
                                <p class="fw-bold"></p>
                            </div>
                        </div>
                        <div class="form-group pt-3">
                            <input type="text" name="subject" id="subject" class="form-control shadow-none" placeholder="Enter Your Subject">
                            <p class="fw-bold"></p>
                        </div>
                        <div class="form-group py-4 mt-3">
                            @if (Auth::check())
                                <button type="submit" class="btn-head1 btn-style shadow-none py-4">Submit</button>
                            @else   
                                <a href="{{ route('Account.login') }}" class="btn head-btn1 btn-style shadow-none">Login To Submit</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4 mt-5">
                <div class="float-lg-end me-5 ms-4 contact-icon">
                    @if(Auth::user() != "")
                    <div class="py-4">
                        <span><i class="fa-solid fa-house mx-2"></i> Jaipur, Rajsthan, India.</span><br>
                        <small class="ms-4 ps-3">Bhainslana. MD 91770</small>
                    </div>
                    <div class="pb-3">
                        @if(Auth::user()->role == "admin")
                          <span><i class="fas fa-phone mx-2"></i> +91 {{ Auth::user()->mobile }}</span><br>
                        @else
                          <span><i class="fas fa-phone mx-2"></i> +91 253 565 2365</span><br>
                        @endif
                        <small class="ms-4 ps-3">Mon to Fri 9am to 6pm</small>
                    </div>
                    <div class="py-3">
                        @if(Auth::user()->role == "admin")
                          <span><i class="fas fa-envelope mx-2"></i> {{ Auth::user()->email }}</span><br>
                        @else
                          <span><i class="fas fa-envelope mx-2"></i> jonnest@gmail.com</span><br>
                        @endif
                        <small class="ms-4 ps-2">Send us your query anytime!</small>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
 </section>

 @endsection
 
  @section('custom-ajax')
    <script>
        $('#CreateContactForm').submit((e)=>{
            e.preventDefault();

            $.ajax({
               url: "{{ route('create.Contact') }}",
               type: "post",
               data: $('#CreateContactForm').serializeArray(),
               dataType: "json",
               success: function(response){
                 let error = response.errors;

                 if(response.status == false){
                    if(error.message){
                        $('#message').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(error.message);
                    }else{
                        $('#message').addClass('is-valid').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    }

                    if(error.name){
                        $('#name').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(error.name);
                    }else{
                        $('#name').addClass('is-valid').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    }

                    if(error.email){
                        $('#email').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(error.email);
                    }else{
                        $('#email').addClass('is-valid').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    }

                    if(error.subject){
                        $('#subject').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(error.subject);
                    }else{
                        $('#subject').addClass('is-valid').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    }
                 }else{
                    window.location.href="{{ url()->current() }}";
                 }
               }
            });
        });

    </script>
  @endsection