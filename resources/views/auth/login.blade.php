@extends('layouts.app')
@section('title')Login @endsection
@section('content')
<!-- Titlebar
================================================== -->
<div id="titlebar" class="gradient">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h2>Log In</h2>

                <!-- Breadcrumbs -->
                <nav id="breadcrumbs" class="dark">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li>Log In</li>
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
                    <h3>We're glad to see you again!</h3>
                    <span>Don't have an account? <a href="{{ route('register') }}">Sign Up!</a></span>
                </div>
                    
                <!-- Form -->
                <form method="POST" action="{{ route('login') }}">
                     @csrf
                                    @error('email')
                                    
                                                  <div class="notification error closeable">
                <p>{{ $message }}</p>
                <a class="close"></a>
            </div>
                                @enderror
                    <div class="input-with-icon-left">
                        <i class="icon-material-baseline-mail-outline"></i>
                        <input id="email" type="email" class="input-text with-border @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>
            
                    </div>

                    <div class="input-with-icon-left">
                        <i class="icon-material-outline-lock"></i>
                        <input id="password" type="password" class="input-text with-border @error('password') is-invalid @enderror" name="password" required autocomplete="off">

                                @error('password')
                                    
                                                  <div class="notification error closeable">
                <p>{{ $message }}</p>
                <a class="close"></a>
            </div>
                                @enderror

      
                    </div>
                    <div class="row">
                        <div class="col-md-6">           
                         <div class="checkbox">
                <input type="checkbox" id="chekcbox" {{ old('remember') ? 'checked' : '' }}>
                <label for="chekcbox"><span class="checkbox-icon"></span> Remember</label>
            </div></div>
                        <div class="col-md-6" style="text-align: right">
                            
                     @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                        </div>
                    </div>
        

 
                    {{-- <a href="#" class="forgot-password">Forgot Password?</a> --}}
                
                <!-- Button -->
                {{-- <button class="button full-width button-sliding-icon ripple-effect margin-top-10" type="submit" form="login-form">Log In <i class="icon-material-outline-arrow-right-alt"></i></button> --}}
                  <button type="submit" class="button full-width button-sliding-icon ripple-effect margin-top-10">
                                    {{ __('Login') }} <i class="icon-material-outline-arrow-right-alt"></i>
                                </button>
                </form>
                
                <!-- Social Login -->
                <div class="social-login-separator"><span>or</span></div>
                <div class="social-login-buttons">
                    <button class="facebook-login ripple-effect"><i class="icon-brand-facebook-f"></i> Log In via Facebook</button>
                    <button class="google-login ripple-effect"><i class="icon-brand-google-plus-g"></i> Log In via Google+</button>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Spacer -->
<div class="margin-top-70"></div>
<!-- Spacer / End-->
@endsection
