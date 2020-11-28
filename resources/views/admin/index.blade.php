@extends('layouts.admin')

@section('title', 'Super User')

@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>150</h3>
                    <p>Configuraciones Ruleta</p>
                </div>
                <div class="icon">
                    <i class="ion ion-gear-b"></i>
                </div>
                <a href="{{url('/admin/configuraciones')}}" class="small-box-footer">Siguiente<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>53<sup style="font-size: 20px"></sup></h3>

                    <p>Redes Sociales</p>
                </div>
                <div class="icon">
                    <i class="ion ion-at"></i>
                </div>
                <a href="{{url('/admin/redes_sociales')}}" class="small-box-footer">Siguiente <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>44</h3>

                    <p>Registrar Usuarios</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{url('/admin/crear_usuarios')}}" class="small-box-footer">Siguiente <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>65</h3>

                    <p>Estadisticas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">Siguiente<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
  
    <!-- /.row (main row) -->
@endsection

