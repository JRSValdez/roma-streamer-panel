@extends('layouts.admin')

@section('title', 'Super User')

@section('content')
    <!-- Small boxes (Stat box) -->
    <h1 class="text-center">Configuracion de "App Name" </h1>
    <div class="row">
        <div class="col-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h2 class="card-title">Ruleta</h2>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form name="roulette" role="form" action="{{url('/admin/configuraciones/roulette')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="max_roulette">Máximo participantes:</label>
                            <input
                                type="number"
                                class="form-control @error('max_roulette') is-invalid @enderror"
                                id="max_roulette"
                                placeholder="####"
                                name="max_roulette"
                                value="{{ old('max_roulette') ? old('max_roulette') : $configs->roulette['max']  }}"
                            >
                            @error('max_roulette')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="max_per_roulette">Máximo de ruletas diarias:</label>
                            <input
                                type="number"
                                class="form-control @error('max_per_roulette') is-invalid @enderror"
                                id="max_per_roulette"
                                placeholder="##"
                                name="max_per_roulette"
                                value="{{ old('max_per_roulette') ? old('max_per_roulette') :$configs->roulette['max_per_day']}}"
                            >
                            @error('max_per_roulette')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-6">
            <div class="card card-warning">
                <div class="card-header">
                    <h2 class="card-title">Códigos</h2>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form name="codes" role="form" action="{{url('/admin/configuraciones/codes')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="max_codes">Máximo participantes:</label>
                            <input
                                type="number"
                                class="form-control @error('max_codes') is-invalid @enderror"
                                id="maxCodes"
                                placeholder="####"
                                name="max_codes"
                                value="{{ old('max_codes') ? old('max_codes') : $configs->codes['max'] }}"
                            >
                            @error('max_codes')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="max_per_codes">Máximo de códigos diarios:</label>
                            <input
                                type="number"
                                class="form-control @error('max_per_codes') is-invalid @enderror"
                                id="max_per_codes"
                                placeholder="##"
                                name="max_per_codes"
                                value="{{ old('max_per_codes') ? old('max_per_codes') : $configs->codes['max_per_day'] }}"
                            >
                            @error('max_per_codes')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning float-right">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-6">
            <div class="card card-success">
                <div class="card-header">
                    <h2 class="card-title">Votaciones</h2>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form name="polls" role="form" action="{{url('/admin/configuraciones/polls')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="max_polls">Máximo participantes:</label>
                            <input
                                type="number"
                                class="form-control @error('max_polls') is-invalid @enderror"
                                id="max_polls"
                                placeholder="####"
                                name="max_polls"
                                value="{{ old('max_polls') ? old('max_polls') : $configs->polls['max'] }}"
                            >
                            @error('max_polls')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="max_per_polls">Máximo de encuentas diarias:</label>
                            <input
                                type="number"
                                class="form-control @error('max_per_polls') is-invalid @enderror"
                                id="max_per_polls"
                                placeholder="##"
                                name="max_per_polls"
                                value="{{ old('max_per_polls') ? old('max_per_polls') : $configs->polls['max_per_day'] }}"
                            >
                            @error('max_per_polls')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success float-right">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-6">
            <div class="card card-info">
                <div class="card-header">
                    <h2 class="card-title">Messages</h2>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form name="polls" role="form" action="{{url('/admin/configuraciones/messages')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="max_messages">Máximo bandeja de entrada:</label>
                            <input
                                type="number"
                                class="form-control @error('max_messages') is-invalid @enderror"
                                id="max_messages"
                                placeholder="####"
                                name="max_messages"
                                value="{{ old('max_messages') ? old('max_messages') : $configs->messages['max'] }}"
                            >
                            @error('max_messages')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="max_per_msg">Máximo de mensajes diarios:</label>
                            <input
                                type="number"
                                class="form-control @error('max_per_msg') is-invalid @enderror"
                                id="max_per_msg"
                                placeholder="##"
                                name="max_per_msg"
                                value="{{ old('max_per_msg') ? old('max_per_msg') : $configs->messages['max_per_day'] }}"
                            >
                            @error('max_per_msg')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-info float-right">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- ./col -->
    </div>
@endsection

