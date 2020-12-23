<!--{!! Form::open(['route' => 'streamer.roulette.createroulette']) !!}
{{ Form::token() }}-->
    <div class="modal fade" id="createSpinWheelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="card-info">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fab fa-superpowers mr-1"></i> Crear Ruleta</h3>
                            <button class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-success text-center" id="add" style="display:none">
                                <span><i class="fas fa-check m-1"></i>Se genero correctamente</span>
                            </div>
                            <div class="alert alert-danger text-center" id="noadd" style="display:none">
                                <span><i class="fas fa-times m-1"></i>La ruleta generada ya existe</span>
                            </div>
                            <div class="alert alert-danger text-center" id="noadd-emp" style="display:none">
                                <span><i class="fas fa-times m-1"></i>Debe completar todos los campos</span>
                            </div>
                            <form id="form-generar">
                                <div class="form-group">
                                    <label for="reward">¿Cúal es la recompensa?</label>
                                    <input id="reward" name="reward" type="text" class="form-control" placeholder="¿Qué quieres regalar?">
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn bg-gradient-primary float-right m-1"><i class="fas fa-save mr-1"></i> Guardar</button>
                                    <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1"><i class="fas fa-window-close mr-1"></i> Cerrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!--{!! Form::close() !!}-->
