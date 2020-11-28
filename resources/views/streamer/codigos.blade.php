@extends('layouts.streamer')

@section('title', 'Streamer')

@section('panel_actual')
	<i class="fas fa-barcode mr-2 ml-2"></i>Panel de códigos
@endsection
		
@section('page_actual', 'Códigos')

@section('content')
        @include('streamer.modales.modal_codigos')
	<div class="container-fluid">
                <div class="alert-info p-2 pl-3 row rounded">
                	<div class="col-lg-1 text-center"><h1><i class="nav-icon fas fa-exclamation-circle"></i></h1></div>
                	<div class="col-lg-10" id="h">
                                <p>
                                        Hey Streamer!<br>
                                        Texto personalizado.
                                </p>       
                        </div>
                </div>
                <div class="mt-3 text-right">
                	<button class="btn bg-gradient-primary" data-toggle="modal" data-target="#crear_codigos"><i class="fas fa-hand-sparkles mr-2 ml-2"></i> Generar código</button>
                </div>
                <div class="card card-success mt-3 card-outline">
                        <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-list mr-1"></i> Lista de codigos generados</h3>
                        </div>
                        <div class="card-body">
                                <div class="mt-3 table-responsive">
                                	<table id="codigo_lista" class="table table-bordered table-striped table-hover">
                                		<thead>
                                			<tr>
                                				<th>código</th>
                                				<th>Premio</th>
                                                                <th>Maximo ganadores</th>
                                                                <th>Estado</th>
                                                                <th>Fecha de creacion</th>
                                				<th>Acciones</th>
                                			</tr>
                                		</thead>
                                		
                                	</table>
                                </div>
                        </div>
                </div>
	</div>
@endsection

@section('scripts')
        <script type="text/javascript">
                $(document).ready(function(){
                        $('#codigo_lista').DataTable({
                                processing: true,
                                serverSide:true,  
                                ajax: "{!! route('streamer.getcodigos') !!}",
                                columns: [
                                        { data: 'id', name: 'id' },
                                        { data: 'name', name: 'name' },
                                        { data: 'email', name: 'email' },
                                        { data: 'email', name: 'email' },
                                        { data: 'email', name: 'email' },
                                        { data: 'email', name: 'email' },
                                ]
                        })
                });
        </script>
@endsection