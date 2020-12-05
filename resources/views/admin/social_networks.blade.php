@extends('layouts.admin')

@section('title', 'Admin')

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
        @foreach($social_networks as $sn)
            <tr>
                <td>{{$sn->name}}</td>
                <td>{{$sn->url}}</td>
                <td>
                    <img
                        src="{{ asset('/storage/user_images/'.$sn->image) }}"
                        width="50px"
                        height="50px"
                    />
                </td>
                <td>
                    <button type="button" class="btn btn-primary">Editar</button>
                    <button type="button" class="btn btn-danger">Eliminar</button>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
@endsection
