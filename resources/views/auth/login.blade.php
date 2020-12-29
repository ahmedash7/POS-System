@extends('layouts.admin.app')

@section('content')

    <!-- Sing in  Form -->
    <section class="sign-in">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="{{asset('admin/images/signin-image.jpg')}}" alt="sing up image"></figure>
                    <a href="#" class="signup-image-link">انشاء حساب جديد</a>
                </div>

                <div class="signin-form">
                    <h2 class="form-title">{{ __('Login') }}</h2>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input  class="form-control @error('email') is-invalid @enderror" type="text" name="email"  placeholder="Your Email"  value="{{ old('email') }}" required autocomplete="email" autofocus/>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                            <input class="form-control floating @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password"  required autocomplete="current-password"  />
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="remember" id="remember" class="agree-term" {{ old('remember') ? 'checked' : '' }}/>
                            <label for="remember-me" class="label-agree-term"><span><span></span></span>تذكرني</label>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                        </div>
                        <div class="text-center">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('?Forgot Your Password') }}
                                </a>
                            @endif

                        </div>
                    </form>
                    <div class="social-login">
                        <span class="social-label">تسجيل باستخدام  </span>
                        <ul class="socials">
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
