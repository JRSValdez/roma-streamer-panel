@extends('layouts.admin')

@section('title', Auth::user()->site_name . ' - Admin Users')

@section('content')
    @include('admin.modales.create_user')
    <div >
        <div>
            <h1 class="text-center">Listado de Usuarios</h1>
            <button class="btn bg-gradient-primary" data-toggle="modal" data-target="#createUserModal"><i
                    class="fas fa-hand-sparkles mr-2 ml-2"></i> Nuevo Usuario
            </button>
        </div>
        <hr>
        <div class="table-responsive-sm">
            <table id="users_table" class="table table-bordered table-striped table-hover ">
                <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Tipo Usuario</th>
                    <th scope="col">Fecha registro</th>
                    <th scope="col">Acciones</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modalUserEdit">
        <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar Usuario</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" id="user_id" value="">

                        <div class="input-group mb-3">
                            <input
                                id="editName"
                                type="text"
                                class="form-control"
                                placeholder="Nombre de usuario"
                                name="name"
                                value=""
                                required
                                autofocus
                            >
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input
                                id="editEmail"
                                type="email"
                                class="form-control"
                                placeholder="Email"
                                name="email"
                                value=""
                                required
                            >
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
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
    <script src="{!! asset('js/usersAdministration.js') !!}"></script>
@endsection
