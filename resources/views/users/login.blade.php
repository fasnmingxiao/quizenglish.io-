@extends('main')

@section('content')
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="login">
                        <div class="login--wraper">
                            <form class="form_res-login" action="{{ route('login.store') }}" method="POST">
                                @csrf
                                <div class="head">Login</div>
                                @include('alert')
                                <div class="user-box">
                                    <input type="text" name="email" id="email" value="{{ old('email') }}"
                                        placeholder="Username" required>
                                </div>
                                @error('email')
                                    <div class="alert text-danger">{{ $message }}</div>
                                @enderror
                                <div class="user-box">
                                    <input type="password" name="password" id="password" placeholder="Password" required>
                                </div>
                                @error('password')
                                    <div class="alert text-danger">{{ $message }}</div>
                                @enderror
                                <a href="/forgot-password" class="forgot_pass">Forgot your password?</a>
                                <button class="submit" type="submit">
                                    Login now!
                                </button>
                                <p class="text">or login with</p>
                                <div class="another">
                                    <a href="{{ route('login.google') }}"><img src="{{ asset('/template/img/Google.png') }}"
                                            class="item"></a>

                                    <a href="{{ route('login.facebook') }}"> <img
                                            src="{{ asset('/template/img/Facebook.png') }}" class="item"></a>

                                </div>
                            </form>
                            <img class="form_bg" src="{{ asset('/template/img/Illusttration.png') }}" alt="...">
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
