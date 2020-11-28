@extends('layouts.admin')

@section('title', 'Admin')

@section('content')
<div>
    <h1>Configuración Ruleta</h1>
    <div class="md-form mt-0">
      <div class="row"> 
            <div class="col-md-4">
                <input class="form-control" type="text" placeholder="Maximo de giros al día" >
            </div>
            <div class="col-md-4">
                <input class="form-control" type="text" placeholder="Minimo de giros al dia" >
            </div>
            <div class="col-md-4">
            <button type="button" class="btn btn-primary agregar_usuario">Guardar </button>
            </div>
       </div>
    </div>
    <br>

</div>
 
</div>
@endsection