@extends('layouts.admin')

@section('title', 'Admin')

@section('content')
<div>
    <h1>Crear Usuarios</h1>
    <div class="md-form mt-0">
      <div class="row"> 
            <div class="col-md-4">
                <input class="form-control" type="text" placeholder="Nombre Usuario" >
            </div>
            <div class="col-md-4">
                <input class="form-control" type="text" placeholder="Email" >
            </div>
            <div class="col-md-4">
                <input class="form-control" type="text" placeholder="Tipo Usuario" >
            </div>
       </div>
    </div>
    <br>
    <div class="row"> 
            <div class="col-md-4">
                <input class="form-control" type="text" placeholder="Contraseña" >
            </div>
            <div class="col-md-4">
            <button type="button" class="btn btn-primary agregar_usuario">Guardar Usuario</button>
            </div>

       </div>
</div>
 
</div>
@endsection