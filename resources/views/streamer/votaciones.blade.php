@extends('layouts.streamer')

@section('title', 'Streamer')

@section('content')
    <div>
        <section class="content">
            <div class="row">
                <div class="col-lg-8">
                    <div class="input-group input-group-sm">
                        <div class="row"  style="width: 100%">
                            <div class="col-md-11" style="width: 100%">
                                <p id="link-message" class="links-copy">Links</p>
                            </div>
                            <div class="col-md-1" style="align-content: end; align-items: end">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-info btn-flat" onclick="">Copiar</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Últimos loots</h3>
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
                                        <th>Usuario</th>
                                        <th>Fecha</th>
                                        <th>Estado</th>
                                        <th>Mensaje</th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>{{--<span class="label label-warning">Pendiente</span>--}}</td>
                                        <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div>
                        <button class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#createVotationModal">Crear Votación</button>
                    </div>
                    <br>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="createVotationModal" tabindex="-1" role="dialog" aria-labelledby="createVotationModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h5 class="modal-title" id="createVotationModalTitle">Crea tu encuesta</h5>
                        </div>
                        <div class="modal-body">
                            <form id="create-votation-form" method="post">
                                <div class="form-group">
                                    <div id="error-content" class="bg-danger"></div>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" id="id_streamer" name="id_streamer" value="1127">
                                </div>

                                <div class="form-group">
                                    <label for="question">¿Que quieres preguntar?</label>
                                    <input type="text" id="question" name="question" value="" class="form-control" placeholder="Haz tu pregunta">
                                </div>

                                <div class="form-group">
                                    <label for="max_reclaims">Opciones</label>
                                    <input type="text" name="options[0]" value="" class="form-control" placeholder="Si">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="options[1]" value="" class="form-control" placeholder="No">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button id="create-votation-submit" type="button" class="btn btn-primary">Crear</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection


