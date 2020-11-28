@extends('layouts.streamer')

@section('title', 'Streamer')

@section('panel_actual')
    <i class="fab fa-superpowers mr-2 ml-2"></i>Panel de ruleta
@endsection
        
@section('page_actual', 'Ruleta')

@section('content')
    @include('streamer.modales.modal_ruleta')
    <div class="container-fluid">
        <section class="content">
            <div class="text-right">
                <button class="btn bg-gradient-primary" data-toggle="modal" data-target="#createSpinWheelModal"><i class="fas fa-hand-sparkles mr-2 ml-2"></i> Crear Ruleta</button>
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">Ruletas</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                            <input style="height: inherit;" type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>Recompensa</th>
                                <th>Participantes</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>{{--<span class="label label-info">Activado</span>--}}</td>
                                <td class="codes-actions">
                                    {{--<i onclick="" class="fa ion-checkmark-round" title="Activar"></i>
                                    <i onclick="" class="fa ion-close-round" title="Desactivar"></i>
                                    <i onclick="" class="fa ion-trash-a" title="Eliminar"></i>
                                    <a href="" target="_blank" title="Ir a la ruleta"><i class="fa ion-trophy"></i></a>--}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
