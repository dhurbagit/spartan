@extends('layouts.app')

@section('content')
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                <div class="login_image_wrapper">
                                    <img src="{{ asset('backend/img/login_image.jpg') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5 vertical_center_wrapper">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">{{ __('Reset Password') }}</h1>
                                    </div>

                                    <form class="user" method="POST" action="{{ route('password.update') }}">
                                        @csrf

                                        <div class="form-group">
                                            <input type="hidden" name="token" value="{{ $token }}">

                                            <input id="email" type="email" placeholder="Email"
                                                class="form-control form-control-user @error('email') is-invalid @enderror"
                                                name="email" value="{{ $email ?? old('email') }}" required
                                                autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">

                                            <input id="password" type="password"
                                                class="form-control form-control-user @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="new-password"
                                                placeholder="New Password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input id="password-confirm" type="password"
                                                class="form-control form-control-user" name="password_confirmation" required
                                                autocomplete="new-password" placeholder="Confirm Password">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                           Reset Password
                                        </button>


                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
