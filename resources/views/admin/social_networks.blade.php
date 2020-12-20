@extends('layouts.admin')

@section('title', Auth::user()->site_name . ' - Admin Social Network')

@section('content')
    <div>
        <h1>Redes Sociales</h1>
        <div class="md-form mt-0">
            <form method="POST" action="{{url('/admin/social_networks/add')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <input
                            class="form-control @error('name') is-invalid @enderror"
                            type="text"
                            placeholder="Nombre"
                            name="name"
                            value="{{old('name')}}"
                            required
                        >
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <input
                            class="form-control @error('url') is-invalid @enderror"
                            type="text"
                            placeholder="URL"
                            name="url"
                            value="{{old('url')}}"
                            required
                        >
                        @error('url')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label>Imagen:</label>
                        <input
                            class=" @error('image') is-invalid @enderror"
                            type="file"
                            name="image"
                            accept=".pdf,.jpg,.png"
                            required
                        >
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col mt-2">
                        <button type="submit" class="btn btn-success">
                            Agregar
                        </button>
                    </div>
                </div>
            </form>

        </div>
        <br>
        <div class="table-responsive-sm">
            <table id="sn_table" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">URL</th>
                    <th scope="col">Mostrar en registro</th>
                    <th scope="col">Fecha creación</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Acciones</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modalSNEdit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Red Social</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="sn_id" value="">

                    <div class="form-group text-center">
                        <img
                            style="max-width: 200px"
                            src=""
                            class="img-fluid"
                            alt="site logo"
                            id="currentImage"
                        />
                    </div>
                    <div class="input-group mb-3">
                        <label>Nueva imagen: </label>
                        <input
                            type="file"
                            name="image"
                            id="image"
                            accept="image/*"
                            required
                        >
                    </div>

                    <div class="input-group mb-3">
                        <input
                            id="editName"
                            type="text"
                            class="form-control"
                            placeholder="Nombre de la red social"
                            name="name"
                            value=""
                            required
                            autofocus
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-pen"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input
                            id="editUrl"
                            type="text"
                            class="form-control"
                            placeholder="www.example.com"
                            name="url"
                            value=""
                            required
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-globe"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <p class="text-danger" id="txtError"></p>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="btnSaveModal" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('js')
    <script src="{!! asset('js/socialNetworks.js') !!}"></script>
@endsection
