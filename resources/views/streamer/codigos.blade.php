@extends('layouts.streamer')

@section('title', 'Streamer')

@section('panel_actual')
	<i class="fas fa-barcode mr-2 ml-2"></i>Panel de códigos
@endsection
		
@section('page_actual', 'Códigos')

@section('content')
	<div class="container-fluid">
        <div class="alert-info p-2 pl-3 row rounded">
        	<div class="col-lg-1 text-center"><h1><i class="nav-icon fas fa-exclamation-circle"></i></h1></div>
        	<div class="col-lg-10">texto</div>
        </div>
        <div class="mt-3 text-right">
        	<button class="btn bg-gradient-primary"><i class="fas fa-hand-sparkles mr-2 ml-2"></i> Generar código</button>
        </div>
        <div class="mt-3 table-responsive">
        	<table id="codigo_lista" class="table table-bordered">
        		<thead>
        			<tr>
        				<th>código</th>
        				<th>Premio</th>
        				<th>Maximo ganadores</th>
        				<th>Estado</th>
        				<th>Fecha de cracion</th>
        				<!-- <th>Acciones</th> -->
        			</tr>
        		</thead>
        		<tbody>
        			
        		</tbody>
        	</table>
        </div>
	</div>
	<!-- @push('scripts') -->
		<!-- <script type="text/javascript">
			$(document).ready(function(){
			    var table = $('#codigo_lista').DataTable({
			        processing: true,
			        serverSide: true,
			        ajax: "{{ route('streamer.codigos') }}",
			        columns: [
			            {data: 'codigo', name: 'codigo'},
			            {data: 'premio', name: 'premio'},
			            {data: 'max_gans', name: 'max_gans'},
			            {data: 'estado', name: 'estado'},
			            {data: 'fecha_creacion', name: 'fecha_creacion'}
			        ]
			    });
			    alert('table')
			  });
		</script> -->
	<!-- @endpush -->
@endsection