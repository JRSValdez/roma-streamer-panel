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
                <form role="form" action="{{url('/admin/configuraciones/roulette')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="maxParticipants">Máximo participantes:</label>
                            <input
                                type="number"
                                class="form-control @error('max_roulette') is-invalid @enderror"
                                id="maxParticipants"
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
                            <label for="maxRoulettes">Máximo de ruletas diarias:</label>
                            <input
                                type="number"
                                class="form-control @error('max_per_roulette') is-invalid @enderror"
                                id="maxRoulettes"
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
                <form role="form" action="" method="">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="maxParticipants">Máximo participantes:</label>
                            <input type="number" class="form-control" id="maxParticipants" placeholder="####"
                                   name="maxParticipants" value="{{$configs->codes['max']}}">
                        </div>
                        <div class="form-group">
                            <label for="maxRoulettes">Máximo de códigos diarios:</label>
                            <input type="number" class="form-control" id="maxRoulettes" placeholder="##"
                                   name="maxRoulettes" value="{{$configs->codes['max_per_day']}}">
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
                <form role="form" action="" method="">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="maxParticipants">Máximo participantes:</label>
                            <input type="number" class="form-control" id="maxParticipants" placeholder="####"
                                   name="maxParticipants" value="{{$configs->polls['max']}}">
                        </div>
                        <div class="form-group">
                            <label for="maxRoulettes">Máximo de votaciones diarias:</label>
                            <input type="number" class="form-control" id="maxRoulettes" placeholder="##"
                                   name="maxRoulettes" value="{{$configs->polls['max_per_day']}}">
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
                <form role="form" action="" method="">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="maxParticipants">Máximo mensajes por streamer:</label>
                            <input type="number" class="form-control" id="maxParticipants" placeholder="####"
                                   name="maxParticipants" value="{{$configs->messages['max_per_streamer']}}">
                        </div>
                        <div class="form-group">
                            <label for="maxParticipants">Máximo mensajes por usuario:</label>
                            <input type="number" class="form-control" id="maxParticipants" placeholder="####"
                                   name="maxParticipants" value="{{$configs->messages['max_per_user']}}">
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

