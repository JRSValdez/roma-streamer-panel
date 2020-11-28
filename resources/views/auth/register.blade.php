@extends('layouts.login')

<style>
    .bootstrap-switch-normal {
        width: 120px !important;
    }
</style>

@section('content')

    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>Admin</b>LTE</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input
                            id="name"
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Nombre de usuario"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autocomplete="name"
                            autofocus
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input
                            id="email"
                            type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="Email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
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
                            id="password"
                            type="password"
                            class="form-control"
                            placeholder="Contraseña"
                            name="password"
                            required
                            autocomplete="new-password"
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user-secret"></span>
                            </div>
                        </div>

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input
                            id="password-confirm"
                            type="password"
                            class="form-control"
                            placeholder="Contraseña"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user-secret"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 mx-auto">

                            <label class="text-center">
                                Tipo de usuario
                                <input
                                    type="checkbox"
                                    name="type"
                                    class="user_switch"
                                    checked
                                    data-bootstrap-switch
                                    data-off-color="danger"
                                    data-on-color="success"
                                    data-on-text="USUARIO"
                                    data-off-text="STREAMER"
                                    data-size="normal"
                                >
                            </label>
                        </div>
                    </div>

                    <div id="streamer-form" style="display: none">
                        <div class="input-group mb-3">
                            <input
                                id="streamer_user"
                                type="text"
                                class="form-control @error('streamer_user') is-invalid @enderror"
                                placeholder="Usuario de streamer"
                                name="streamer_user"
                                autocomplete="streamer_user"
                                autofocus
                            >
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>

                            @error('streamer_user')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input
                                id="sn_1"
                                type="text"
                                class="form-control @error('sn_1') is-invalid @enderror"
                                placeholder="Facebook url"
                                name="sn_1"
                                value="{{ old('sn_1') }}"
                                autocomplete="sn_1"
                            >
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-facebook"></span>
                                </div>
                            </div>

                            @error('sn_1')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input
                                id="sn_2"
                                type="text"
                                class="form-control"
                                placeholder="Youtube Url"
                                name="sn_2"
                                autocomplete="sn_2"
                            >
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-youtube-play"></span>
                                </div>
                            </div>

                            @error('sn_1')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- /.col -->
                        <div class="col-6 offset-6">
                            <button type="submit" class="btn btn-primary btn-block">Registrarse</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>

@endsection


