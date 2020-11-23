@extends('layouts.streamer')

@section('title', 'Streamer')

@section('panel_actual')
	<i class="fas fa-cog mr-1 ml-2"></i>Panel de configuraciones
@endsection
		
@section('page_actual', 'Configuración')

@section('content')
	<div>
        <section class="content">
	      <div class="container-fluid">
	        <div class="row">
	          <!-- left column -->
	          <div class="col-md-6">
	            <!-- general form elements -->
	            <div class="card card-info card-outline">
	              <div class="card-header">
	                <h3 class="card-title"><i class="fas fa-info mr-1"></i> Información general</h3>
	              </div>
	              <!-- /.card-header -->
	              <!-- form start -->
	              <form role="form">
	                <div class="card-body">
	                  <div class="form-group">
	                    <label for="correo"><i class="fas fa-at mr-1"></i> E-mail</label>
	                    <input type="email" class="form-control" id="correo" placeholder="Ingresar correo">
	                  </div>
	                  <div class="form-group">
	                    <label for="user_name"><i class="fas fa-user mr-1"></i> Nombre de usuario</label>
	                    <input type="text" class="form-control" id="user_name" placeholder="Ingresar nombre de usuario">
	                  </div>
	                  <div class="form-group">
	                    <label for="impretion_name"><i class="fas fa-tag mr-1"></i> Nombre de impresión</label>
	                    <input type="text" class="form-control" id="impretion_name" placeholder="Ingresar nombre de impresión">
	                  </div>
	                </div>
	                <!-- /.card-body -->

	                <div class="card-footer">
	                  <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Guardar datos</button>
	                </div>
	              </form>
	            </div>
	            <!-- /.card -->
	          </div>
	          <!--/.col (left) -->
	          <!-- right column -->
	          <div class="col-md-6">
	            <!-- general form elements disabled -->
	            <div class="card card-warning card-outline">
	              <div class="card-header">
	                <h3 class="card-title"><i class="fas fa-wifi mr-1"></i> Conexiones</h3>
	              </div>
	              <!-- /.card-header -->
	              <!-- form start -->
	              <form role="form">
	                <div class="card-body">
	                  <div class="form-group">
	                    <label for="url_booyah"><i class="fab fa-bootstrap mr-1"></i> URL de canal de Booyah</label>
	                    <input type="text" class="form-control" id="url_booyah" placeholder="Ingresar url de Booyah">
	                  </div>
	                  <div class="form-group">
	                    <label for="url_youtube"><i class="fab fa-youtube mr-1"></i> URL de canal de Youtube</label>
	                    <input type="text" class="form-control" id="url_youtube" placeholder="Ingresar url de Youtube">
	                  </div>
	                  <div class="form-group">
	                    <label for="id_youtube"><i class="fab fa-youtube-square mr-1"></i>ID de canal de Youtube</label>
	                    <input type="text" class="form-control" id="id_youtube" placeholder="Ingresar ID de Youtube">
	                  </div>
	                  <div class="form-group">
	                    <label for="url_twitch"><i class="fab fa-twitch mr-1"></i> URL de canal de Twitch</label>
	                    <input type="text" class="form-control" id="url_twitch" placeholder="Ingresar url de Twitch">
	                  </div>
	                  <div class="form-group">
	                    <label for="url_facebook"><i class="fab fa-facebook mr-1"></i> URL de canal de Facebook</label>
	                    <input type="text" class="form-control" id="url_facebook" placeholder="Ingresar url de Facebook">
	                  </div>
	                </div>
	                <!-- /.card-body -->

	                <div class="card-footer">
	                  <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Guardar datos</button>
	                </div>
	              </form>
	            </div>
	            <!-- /.card -->
	          </div>
	          <!--/.col (right) -->
	        </div>
	        <!-- /.row -->
	      </div><!-- /.container-fluid -->
	    </section>
	</div>
@endsection