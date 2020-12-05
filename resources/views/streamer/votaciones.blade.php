@extends('layouts.streamer')

@section('title', 'Streamer')

@section('panel_actual')
    <i class="fas fa-rocket mr-2 ml-2"></i>Panel de votaciones
@endsection

@section('page_actual', 'Votaciones')

@section('content')
    @include('streamer.modales.modal_votaciones')
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
        <script type="text/javascript">
                $(document).ready(function(){
                        $('#tabla_votacion').DataTable({
                            processing: true,
                            serverSide:true,
                            ajax: "{!! route('streamer.getvotaciones') !!}",
                            columns: [
                                // { data: 'id', name: 'id' },
                                { data: 'question', name: 'question' },
                                { data: 'participants_number', name: 'participants_number' },
                                { data: 'status', name: 'status' },
                                { data:'action', name: 'action', searchable : false, orderable : false, className: 'text-center btn-lg'},
                            ]
                        });
                });
        </script>
@endsection
