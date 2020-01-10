@extends('layouts.app')
@section('title')Register @endsection
@section('content')
<!-- Titlebar
================================================== -->
<div id="titlebar" class="gradient">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h2>Register</h2>

                <!-- Breadcrumbs -->
                <nav id="breadcrumbs" class="dark">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li>Register</li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>
</div>


<!-- Page Content
================================================== -->
<div class="container">
    <div class="row">
        <div class="col-xl-5 offset-xl-3">

            <div class="login-register-page">
                <!-- Welcome Text -->
                <div class="welcome-text">
                    <h3 style="font-size: 26px;">Let's create your account!</h3>
                    <span>Already have an account? <a href="{{route('login')}}">Log In!</a></span>
                </div>

                <!-- Account Type -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    @error('name')
                    <div class="notification error closeable">
                        <p>{{ $message }}</p>
                        <a class="close"></a>
                    </div>
                    @enderror
                    @error('contact_number')
                    <div class="notification error closeable">
                        <p>{{ $message }}</p>
                        <a class="close"></a>
                    </div>
                    @enderror
                    @error('date_of_birth')
                    <div class="notification error closeable">
                        <p>{{ $message }}</p>
                        <a class="close"></a>
                    </div>
                    @enderror
                    @error('gender')
                    <div class="notification error closeable">
                        <p>{{ $message }}</p>
                        <a class="close"></a>
                    </div>
                    @enderror
                    @error('password')
                    <div class="notification error closeable">
                        <p>{{ $message }}</p>
                        <a class="close"></a>
                    </div>
                    @enderror
                    @error('email')
                    <div class="notification error closeable">
                        <p>{{ $message }}</p>
                        <a class="close"></a>
                    </div>
                    @enderror
                <div class="account-type">
                    <div>
                        <input type="radio" name="type" id="freelancer-radio" class="account-type-radio" checked value="1" />
                        <label for="freelancer-radio" class="ripple-effect-dark"><i class="icon-material-outline-account-circle"></i> Seeker</label>
                    </div>

                    <div>
                        <input type="radio" name="type" id="employer-radio" class="account-type-radio" value="2" />
                        <label for="employer-radio" class="ripple-effect-dark"><i class="icon-material-outline-business-center"></i> Recruiter</label>
                    </div>
                </div>
                    
                <!-- Form -->
                
                    <div class="input-with-icon-left" style="margin-bottom: 10px">
                        <i class="icon-material-outline-account-circle"></i>
                        <input id="name" type="text" class="input-text with-border @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  placeholder="Full Name" autofocus>
                         
                    </div>
                
                    <div class="input-with-icon-left">
                        <i class="icon-material-baseline-mail-outline"></i>
                        <input id="email" type="email" class="input-text with-border @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  placeholder="Email" autofocus>
                    </div>
                
                    <div class="input-with-icon-left">
                        <i class="icon-feather-phone"></i>
                        <input id="contact_number" type="text" class="input-text with-border @error('contact_number') is-invalid @enderror" name="contact_number" value="{{ old('contact_number') }}" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" maxlength="10" autofocus  placeholder="Mobile Number">
                    </div>
                             

                    <div class="input-with-icon-left">
                                 <i class="icon-line-awesome-mars-stroke-v"></i>
                            
                                 <select name="gender"  class="input-text with-border @error('mobile') is-invalid @enderror" value="{{ old('gender') }}" style="padding:0px 65px;">
                            <option value="" selected>Select Gender</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                            <option value="3">Other</option>
                        </select>
                    </div> 
                    <div class="input-with-icon-left">
                        <i class="icon-material-outline-cake"></i>
                        <input id="date_of_birth" type="date" class="input-text with-border @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}" maxlength="10" autofocus  placeholder="Date Of Birth">
                    </div>  

                    <div class="input-with-icon-left" title="Should be at least 8 characters long" data-tippy-placement="bottom">
                        <i class="icon-material-outline-lock"></i>
                        <input type="password" class="input-text with-border @error('password') is-invalid @enderror" name="password" id="password-register" placeholder="Password"  autofocus/>
                    </div>

                    <div class="input-with-icon-left">
                        <i class="icon-material-outline-lock"></i>
                        <input type="password" class="input-text with-border" name="password_confirmation" id="password-confirm" placeholder="Repeat Password" autofocus/>
                    </div>
                 <button type="submit" class="button full-width button-sliding-icon ripple-effect margin-top-10">
                                    {{ __('Register') }} <i class="icon-material-outline-arrow-right-alt"></i>
                                </button>
                </form>
                
                <!-- Button -->
                
                <!-- Social Login -->
                <div class="social-login-separator"><span>or</span></div>
                <div class="social-login-buttons">
                    <button class="facebook-login ripple-effect"><i class="icon-brand-facebook-f"></i> Register via Facebook</button>
                    <button class="google-login ripple-effect"><i class="icon-brand-google-plus-g"></i> Register via Google+</button>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Spacer -->
<div class="margin-top-70"></div>
<!-- Spacer / End-->
@endsection
