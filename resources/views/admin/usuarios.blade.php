@extends('layouts.admin')

@section('title', 'Admin')

@section('content')
    @include('admin.modales.create_user')
    <div>
        <div>
            <h1 class="text-center">Listado de Usuarios</h1>
            <button class="btn bg-gradient-primary" data-toggle="modal" data-target="#createUserModal"><i
                    class="fas fa-hand-sparkles mr-2 ml-2"></i> Nuevo Usuario
            </button>
        </div>
        <hr>
        <table id="users_table" class="table table-bordered table-striped table-hover">
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
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#users_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! route('getUsers') !!}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'type', name: 'type'},
                    {data: 'created_at', name: 'created_at'},
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        orderable: false,
                        className: 'text-center btn-lg'
                    },
                ]
            });
        });
    </script>
@endsection
