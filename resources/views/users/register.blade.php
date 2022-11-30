@extends('main')

@section('content')
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="login">
                    <div class="login--wraper">
                        <form class="form_res-login" action="{{ route('user.store') }}" method="POST">
                            @csrf
                            <div class="head">Register</div>
                            <div class="user-box">
                                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}"
                                    placeholder="First name" required>
                            </div>
                            @error('first_name')
                                <div class="alert text-danger">{{ $message }}</div>
                            @enderror
                            <div class="user-box">
                                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}"
                                    placeholder="Last name" required>
                            </div>
                            @error('last_name')
                                <div class="alert text-danger">{{ $message }}</div>
                            @enderror
                            <div class="user-box">
                                <input type="text" name="email" id="email" value="{{ old('email') }}"
                                    placeholder="Email" required>
                            </div>
                            @error('email')
                                <div class="alert text-danger">{{ $message }}</div>
                            @enderror
                            <div class="user-box">
                                <input type="password" name="password" id="password" value="{{ old('password') }}"
                                    placeholder="Password" required>
                            </div>
                            @error('password')
                                <div class="alert text-danger">{{ $message }}</div>
                            @enderror
                            <button id="submit" class="submit" type="submit">Star now!</button>
                            <p class="text">or use another account</p>
                            <div class="another">
                                <img src="{{ asset('/template/img/Google.png') }}" class="item">
                                <img src="{{ asset('/template/img/Facebook.png') }}" class="item">
                            </div>
                        </form>
                        <img class="form_bg" src="{{ asset('/template/img/Illusttration.png') }}" alt="...">

                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
