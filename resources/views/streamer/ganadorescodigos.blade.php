<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Streamer | Ganadores Codigo</title>
	@include('layouts.styles')
</head>
<body style="background-color: #33C1FF">
	<div>
        <section class="content mt-5">
	      <div class="container-fluid">
	        <div class="row">
	          <!-- left column -->
	          <div class="col-md-8 text-center">
	          	<div>
	          		<div>
	          			<img src="{{asset('img/av1.png')}}" width="100px">
	          		</div>
	          		<div>
	          			<h3>{{ Auth::user()->name }}</h3>
	          		</div>
	          	</div>
	            <h1 class="mt-5">Buena suerte</h1>
	          </div>
	          <div class="col-md-4 text-center">
	            <h2>Lista de participantes</h2>
	            <h3>Total de participantes: 0</h3>
	            <button class="btn btn-primary">Obtener ganador</button>
	            <h3>Total de giros: 0</h3>
	          </div>
	          <!--/.col (right) -->
	        </div>
	        <!-- /.row -->
	      </div><!-- /.container-fluid -->
	    </section>
	</div>
	@include('layouts.js')
</body>
</html>