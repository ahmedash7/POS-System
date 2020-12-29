@extends('layouts.admin.app')

@section('content')

    <!-- Sign up form -->
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">{{ __('Register') }}</h2>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">

                            <label for="first_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>
                        <div class="form-group">

                            <label for="last_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>

                        <div class="form-group">

                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>
                        <div class="form-group">

                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">

                            <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        {{--<div class="form-group">--}}
                            {{--<input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />--}}
                            {{--<label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>--}}
                        {{--</div>--}}
                        <div class="form-group form-button">

                            <button type="submit" class="btn btn-primary">

                                {{ __('Register') }}
                            </button>

                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="{{asset('admin/images/signup-image.jpg')}}" alt="sing up image"></figure>
                    <a href="{{route('login')}}" class="signup-image-link">I am already member</a>
                </div>
            </div>
        </div>
    </section>


@endsection
