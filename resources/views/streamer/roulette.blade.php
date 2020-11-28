@extends('layouts.streamer')

@section('title', 'Streamer')

@section('content')
    <div>
        <section class="content">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
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
                </div>
                <div class="col-lg-4">
                    <div>
                        <button class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#createSpinWheelModal">Crear Ruleta</button>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="createSpinWheelModal" tabindex="-1" role="dialog" aria-labelledby="createSpinWheelModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-body modal-content">
                        <div class="note-modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h5 class="modal-title" id="createSpinWheelModalTitle">Crear Ruleta</h5>
                        </div>
                        <div class="modal-body">
                            <form id="create-spinwheel-form" method="post">
                                <div class="form-group">
                                    <div id="error-content" class="bg-danger"></div>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" id="id_streamer" name="id_streamer" value="1127">
                                </div>

                                <div class="form-group">
                                    <label for="question">¿Cúal es la recompensa?</label>
                                    <input type="text" id="reward" name="reward" value="" class="form-control" placeholder="¿Qué quieres regalar?">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button id="create-spinwheel-submit" type="button" class="btn btn-primary">Crear</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
