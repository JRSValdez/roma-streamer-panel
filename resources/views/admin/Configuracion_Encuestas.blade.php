@extends('layouts.admin')

@section('title', 'Admin')

@section('content')
<div>
    <h1>Configuración Encuestas</h1>
    <div class="md-form mt-0">
      <div class="row"> 
            <div class="col-md-3">
                <input class="form-control" type="text" placeholder="Limite de personas por encuesta" >
            </div>
            <div class="col-md-3">
                <input class="form-control" type="text" placeholder="Maximo de encuestas al dia" >
            </div>
            <div class="col-md-3">
                <input class="form-control" type="text" placeholder="Minimo de encuestas al dia" >
            </div>
            <div class="col-md-3">
            <button type="button" class="btn btn-primary agregar_usuario">Guardar </button>
            </div>
       </div>
    </div>
    <br>

</div>
 
</div>
@endsection