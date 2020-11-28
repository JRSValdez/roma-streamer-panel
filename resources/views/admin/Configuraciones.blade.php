@extends('layouts.admin')

@section('title', 'Super User')

@section('content')
    <!-- Small boxes (Stat box) -->
    <h1>Configuraciones</h1>
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <p>Configuraciones Ruleta</p>
                </div>
                <div class="icon">
                    <i class="ion ion-load-b"></i>
                </div>
                <a href="{{url('/admin/configuracion_ruleta')}}" class="small-box-footer">Siguiente<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
        
                    <p>Configuraciones Encuestas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-compose"></i>
                </div>
                <a href="{{url('/admin/configuracion_encuesta')}}" class="small-box-footer">Siguiente <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        
        <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
  
    <!-- /.row (main row) -->
@endsection

