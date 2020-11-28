@extends('layouts.admin')

@section('title', 'Admin')

@section('content')
<div>
    <h1>Agregar Redes Sociales</h1>
    <div class="md-form mt-0">
      <div class="row"> 
            <div class="col-md-4">
                <input class="form-control" type="text" placeholder="URL" >
            </div>
            <div class="col-md-4">
                <input class="form-control" type="text" placeholder="Nombre" >
            </div>
            <div class="col-md-4">
            <input type="file" name="adjunto" accept=".pdf,.jpg,.png" multiple />
            </div>
       </div>
    </div>
    <br>
</div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">URL</th>
      <th scope="col">Imagen</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Facebook</td>
      <td>https://www.facebook.com/romasolutionsSV</td>
      <td>roma.png</td>
      <td>
        <button type="button" class="btn btn-primary">Editar</button>
        <button type="button" class="btn btn-danger">Eliminar</button>

      </td>
    </tr>

  </tbody>
</table>
</div>
@endsection