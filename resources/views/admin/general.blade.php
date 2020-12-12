@extends('layouts.admin')

@section('title', 'Admin - General')

@section('panel_actual')
    <i class="fas fa-cog mr-1 ml-2"></i>Panel de configuraciones
@endsection

@section('page_actual', 'Configuración')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6 offset-md-3">
                    <!-- general form elements -->
                    <div class="card card-info card-outline mt-4">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-info mr-1"></i> Información general del sitio
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{route('editGeneral')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group text-center">
                                    <img
                                        style="max-width: 200px"
                                        src="{{ asset('/storage/'.$configs['site_img']) }}"
                                        class="img-fluid"
                                        alt="site logo"/>
                                </div>
                                <div class="form-group">
                                    <label>Imagen del sitio:</label>
                                    <input
                                        class=" @error('site_img') is-invalid @enderror"
                                        type="file"
                                        name="site_img"
                                        accept=".pdf,.jpg,.png"
                                        required
                                    >
                                    @error('site_img')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name"><i class="fas fa-at mr-1"></i> Nombre del sitio</label>
                                    <input
                                        type="text"
                                        class="form-control @error('site_name') is-invalid @enderror"
                                        id="name"
                                        name="site_name"
                                        placeholder="Nombre"
                                        value="{{$configs['site_name']}}"
                                        required
                                    >
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="site_desc"><i class="fas fa-at mr-1"></i> Descripción del sitio</label>
                                    <input
                                        type="text"
                                        class="form-control @error('site_desc') is-invalid @enderror"
                                        id="site_desc"
                                        name="site_desc"
                                        placeholder="Descripcion"
                                        value="{{ $configs['site_desc'] }}"
                                        required
                                    >
                                    @error('site_desc')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>
                                    Guardar datos
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
