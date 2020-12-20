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
                        <!-- general form elements disabled -->
                        <div class="card card-warning card-outline">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-wifi mr-1"></i> Conexiones</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="POST" action="{{route('editStreamerUrls')}}">
                                @csrf
                                <div class="card-body">
                                    @foreach($social_networks as $sn)
                                        <div class="form-group">
                                            <label for="url_{{$sn->id}}">
                                                URL de {{$sn->name}}
                                            </label>
                                            <input type="text"
                                                   class="form-control @error('sn_'.$sn->id) is-invalid @enderror"
                                                   id="url_{{$sn->id}}"
                                                   name="sn_{{$sn->id}}"
                                                   placeholder="Ingresar url de {{$sn->name}}"
                                                   @if(isset($streamer_networks[$sn->id]) && old('sn_'.$sn->id) == null)
                                                       value="{{$streamer_networks[$sn->id]}}"
                                                   @else
                                                        value="{{ old('sn_'.$sn->id) }}"
                                                @endif
                                            >
                                            @error('sn_'.$sn->id)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    @endforeach
                                </div>
                                <!-- /.card-body -->

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

                    <!-- right column -->
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
                                        <input type="email" class="form-control" id="email"
                                               placeholder="Ingresar correo" value="{{Auth::user()->email}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="user_name"><i class="fas fa-user mr-1"></i> Nombre de
                                            usuario</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="Ingresar nombre de usuario" value="{{Auth::user()->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="impretion_name"><i class="fas fa-tag mr-1"></i> Nombre de impresión</label>
                                        <input type="text" class="form-control" id="impretion_name"
                                               placeholder="Ingresar nombre de impresión"
                                               value="{{Auth::user()->streamer_attributes->user}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="profile_image"><i class="fas fa-tag mr-1"></i> Imagen de perfil</label>
                                        <input type="file" class="form-control" id="profile_image"
                                               name="img_src"
                                        >
                                    </div>
                                    <div class="form-group">
                                        <label for="logo_image"><i class="fas fa-tag mr-1"></i> Logo del canal</label>
                                        <input type="file" class="form-control" id="logo_image"
                                               name="streamer_img"
                                        >
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>
                                        Guardar datos
                                    </button>
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
