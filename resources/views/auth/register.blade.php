@extends('layouts.login')

@section('title', $site_name .' - Register')

@section('content')

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
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Registrarse:</p>

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
                            class="form-control  @error('password') is-invalid @enderror"
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
                                ¿Eres streamer?
                                <input
                                    type="checkbox"
                                    name="type"
                                    id="check_type"
                                    class="user_switch"
                                    checked
                                    data-bootstrap-switch
                                    data-off-color="danger"
                                    data-on-color="success"
                                    data-on-text="NO"
                                    data-off-text="SI"
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
                                value = "{{ old('streamer_user') }}"
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

                        @foreach($social_networks as $sn)
                            <div class="input-group mb-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="{{$sn['name']}} url"
                                    name="{{$sn['id']}}"
                                    value="{{old($sn['id'])}}"
                                >
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <img
                                            style="max-width: 20px"
                                            src='/storage/user_images/{{$sn['image']}}'
                                        >
                                    </div>
                                </div>
                            </div>
                        @endforeach

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

@section('js')
    <script>
        $(document).ready(function() {
            $("input[data-bootstrap-switch]").each(function(){
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            });

            $('.user_switch').on('switchChange.bootstrapSwitch', function (event, state) {
                let container = $('#streamer-form');
                if(container.css('display') === 'none'){
                    container.css('display','block');
                } else {
                    container.css('display','none');
                }
            });
            @error('streamer_user')
                $('#check_type').bootstrapSwitch('state', false)
            @enderror
        });
    </script>
@endsection


