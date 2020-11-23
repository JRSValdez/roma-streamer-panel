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

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-6 mx-auto">

                            <label class="text-center">
                                Tipo de usuario
                                <input
                                    type="checkbox"
                                    name="user_type"
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


