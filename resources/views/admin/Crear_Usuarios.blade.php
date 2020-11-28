@extends('layouts.admin')

@section('title', 'Admin')

@section('content')
<div>
    <h1>Crear Usuarios</h1>
    <div class="container"> 
            <form>
                <div class="form-group">
                    <label >Nombre Usuario</label>
                    <input type="text" class="form-control" placeholder="Usuario">

                    <label >E-mail</label>
                    <input type="text" class="form-control" placeholder="E-mail">

                    <label >Tipo Usuario</label>
                    <input type="text" class="form-control" placeholder="Tipo Usuario">

                    <label >Contraseña</label>
                    <input type="text" class="form-control" placeholder="Contraseña">
                    </br>
                    <button type="button" class="btn btn-primary agregar_usuario">Guardar Usuario</button>
                </div>
            </form>
    </div>

   
</div>
 
</div>
@endsection