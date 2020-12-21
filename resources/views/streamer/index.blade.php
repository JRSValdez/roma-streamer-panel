@extends('layouts.streamer')

@section('title', 'Streamer')

@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$messages_count}}</h3>
                    <p>Mensajes</p>
                </div>
                <div class="icon">
                    <i class="fas fa-envelope"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-md-3 col-sm-12">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$polls_count}}</h3>
                    <p>Encuestas creadas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-rocket"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-md-3 col-sm-12">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$roulette_count}}</h3>
                    <p>Ruletas creadas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-life-ring"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-md-3 col-sm-12">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$codes_count}}</h3>

                    <p>Codigos creados</p>
                </div>
                <div class="icon">
                    <i class="fas fa-qrcode"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <!-- /.row (main row) -->
@endsection

