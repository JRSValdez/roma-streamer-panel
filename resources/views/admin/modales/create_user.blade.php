{!! Form::open(['route' => route('register')]) !!}
{{ Form::token() }}
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-rocket mr-1"></i> Crea un usuario administrador</h3>
                    <button class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="alert alert-success text-center" id="add" style="display:none">
                        <span><i class="fas fa-check m-1"></i>Se creó correctamente</span>
                    </div>
                    <div class="alert alert-danger text-center" id="noadd" style="display:none">
                        <span><i class="fas fa-times m-1"></i>El usuario ya existe</span>
                    </div>
                    <div class="alert alert-danger text-center" id="noadd-emp" style="display:none">
                        <span><i class="fas fa-times m-1"></i>Debe completar todos los campos</span>
                    </div>
                    <form id="create-votation-form">
                        <input type="hidden" id="isAdmin" name="isAdmin" value="yes">

                        <div class="form-group">
                            <label for="question">Usuario</label>
                            <input type="text" id="name" name="name" value="" class="form-control" placeholder="Usuario"
                                   required autocomplete="false">
                        </div>
                        <div class="form-group">
                            <label for="question">Correo:</label>
                            <input type="email" id="email" name="email" value="" class="form-control"
                                   placeholder="Correo" required>
                        </div>
                        <div class="form-group">
                            <label for="question">Contraseña:</label>
                            <input type="password" id="password" name="password" value="" class="form-control"
                                   placeholder="Contraseña" required autocomplete="new-password">
                        </div>
                        <div class="form-group">
                            <label for="question">Confirmar contraseña:</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" value=""
                                   class="form-control" placeholder="Contraseña" required autocomplete="new-password">
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn bg-gradient-primary float-right m-1"><i
                                    class="fas fa-save mr-1"></i> Guardar
                            </button>
                            <button type="button" data-dismiss="modal"
                                    class="btn btn-outline-secondary float-right m-1"><i
                                    class="fas fa-window-close mr-1"></i> Cerrar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
