@extends('layouts.admin')

@section('title', 'Admin')

@section('content')
<div>
    <h1>Listado de Usuarios</h1>
    <div class="md-form mt-0">
      <div class="row">
        <div class="col-md-4">
          <input class="form-control" type="text" placeholder="Buscar Usuario" aria-label="Search">
        </div>
        <div class="col-md-4">
          <button type="button" class="btn btn-primary agregar_usuario">Nuevo Usuario</button>
        </div>
    </div>

    </div>
 <table class="table">
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
      @foreach ($users as $user)
          <tr>
              <td> {{ $user->name }} </td>
              <td> {{ $user->email }} </td>
              <td> {{ $user->type == 1 ? 'Streamer' : 'Viewer' }} </td>
              <td> {{ $user->created_at }} </td>
              <td>
                  <button type="button" class="btn btn-primary">Editar</button>
                  <button type="button" class="btn btn-danger">Desactivar</button>
              </td>
          </tr>
      @endforeach
  </tbody>
</table>
    {{$users->links()}}
</div>
@endsection
