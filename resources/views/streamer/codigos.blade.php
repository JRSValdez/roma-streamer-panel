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
        	<div class="col-lg-10" id="h">texto</div>
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
        				<!-- <th>Estado</th> -->
        				<!-- <th>Fecha de cracion</th> -->
        				<!-- <th>Acciones</th> -->
        			</tr>
        		</thead>
        		<tbody>
			     <!-- @foreach($users as $user)
                                <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                                <button type="button" class="btn btn-secondary btn-sm"><i class="far fa-eye"></i></button>
                                                <button type="button" class="btn btn-primary btn-sm"><i class="far fa-edit"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                                        </td>
                                </tr>
                            @endforeach -->
        		</tbody>
        	</table>
        </div>
	</div>
	<!-- @push('scripts')

                <script type="text/javascript">
    $(document).ready( function () {
        $('#codigo_lista').DataTable()({
                processing: true,
                serverSide:true,
                ajax: "{{ route('streamer.codigos') }}",
                columns: [
                        { data: 'id', name: 'id' },
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' }
                ]
        });
    } );
</script>

        @endpush -->
@endsection