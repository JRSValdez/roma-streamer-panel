@extends('layouts.admin')

@section('title', 'Super User')

@section('content')
    <!-- Small boxes (Stat box) -->
    <h1>Configuracion de "App Name" </h1>
    <div class="row">
        <div class="col-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Ruleta</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="" method="">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="maxParticipants">Máximo participantes:</label>
                            <input type="number" class="form-control" id="maxParticipants" placeholder="####"
                                   name="maxParticipants">
                        </div>
                        <div class="form-group">
                            <label for="maxRoulettes">Máximo de ruletas diarias:</label>
                            <input type="number" class="form-control" id="maxRoulettes" placeholder="##"
                                   name="maxRoulettes">
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
                    <h3 class="card-title">Códigos</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="" method="">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="maxParticipants">Máximo participantes:</label>
                            <input type="number" class="form-control" id="maxParticipants" placeholder="####"
                                   name="maxParticipants">
                        </div>
                        <div class="form-group">
                            <label for="maxRoulettes">Máximo de códigos diarios:</label>
                            <input type="number" class="form-control" id="maxRoulettes" placeholder="##"
                                   name="maxRoulettes">
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
                                   name="maxParticipants">
                        </div>
                        <div class="form-group">
                            <label for="maxRoulettes">Máximo de votaciones diarias:</label>
                            <input type="number" class="form-control" id="maxRoulettes" placeholder="##"
                                   name="maxRoulettes">
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
    </div>
@endsection

