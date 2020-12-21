@extends('layouts.streamer')

@section('title', Auth::user()->site_name . ' - Votaciones')

@section('panel_actual')
    <i class="fas fa-rocket mr-2 ml-2"></i>Panel de votaciones
@endsection

@section('page_actual', 'Votaciones')

@section('content')
    @include('streamer.modales.modal_votaciones')
    @include('streamer.modales.modal_poll_answer_detail')
    <div class="container-fluid">
        <section class="content">
                    <div class="input-group input-group-sm">
                        <div class="row"  style="width: 100%">
                            <div class="col-md-8" style="width: 100%">
                                <p id="link-message" class="links-copy">Links OBS</p>
                            </div>
                            <div class="col-md-4 text-right">
                                <span class="input-group-btn">
                                    <button type="button" class="btn bg-gradient-info" onclick="">Copiar link</button>
                                    <button class="btn bg-gradient-primary ml-2" data-toggle="modal" data-target="#createVotationModal"><i class="fas fa-hand-sparkles mr-2 ml-2"></i> Crear Votación</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Votaciones</h3>
                        </div>

                        <div class="card-body table-responsive no-padding">
                            <table id="tabla_votacion" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Pregunta</th>
                                        <th>Participantes</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                    </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script src="{!! asset('js/votaciones.js') !!}"></script>
@endsection
