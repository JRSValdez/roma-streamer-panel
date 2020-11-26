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
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Gustavo Benavides</td>
      <td>tavito@gmail.com</td>
      <td>Streamer</td>
      <td>
        <button type="button" class="btn btn-primary">Editar</button>
        <button type="button" class="btn btn-warning">Cambiar Contraseña</button>
        <button type="button" class="btn btn-danger">Eliminar</button>

      </td>
    </tr>

  </tbody>
</table>
</div>
@endsection