@extends('layouts.login')

@section('title', $site_name .' - Login')

@section('content')

    <style>
        .animate {
            animation: ease-in 3s;
        }

        @keyframes pulse {
            0% {
                background-color: #001F3F;
            }
            100% {
                background-color: #FF4136;
            }
        }
    </style>

    <div class="login-box">
        <div class="login-logo">
            <div>
                <img
                    style="max-width: 100px"
                    src="{{ asset('/storage/site_logo.png')}}"
                    alt="site logo"/>
            </div>
            <a style="color:white" href="{{url('/')}}"> {{$site_name}} </a>
        </div>
        <!-- /.login-logo -->
        <div class="card animate">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Iniciar sesión</p>

                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input
                            type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            autofocus
                            placeholder="Email"
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input
                            type="password"
                            placeholder="Password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password"
                            required
                            autocomplete="current-password"
                        >

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input
                                    type="checkbox"
                                    id="remember"
                                    name="remember"
                                    {{ old('remember') ? 'checked' : '' }}
                                >
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                {{--            <div class="social-auth-links text-center mb-3">
                                <p>- OR -</p>
                                <a href="#" class="btn btn-block btn-primary">
                                    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                                </a>
                                <a href="#" class="btn btn-block btn-danger">
                                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                                </a>
                            </div>
                            <!-- /.social-auth-links -->--}}


                @if (Route::has('password.request'))
                    <p class="mb-1">
                        <a href="{{url('/forgot-password')}}">Olvidé mi contraseña</a>
                    </p>
                @endif

                <p class="mb-0">
                    <a href="{{url('/register')}}" class="text-center">Crear una cuenta</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@endsection
