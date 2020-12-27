<div class="modal fade" id="votaciones" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="card-info">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-rocket mr-1"></i> Votaciones</h3>
                            <button class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-success text-center" id="add-votacion" style="display:none">
                                <span><i class="fas fa-check m-1"></i>Se registro correctamente</span>
                            </div>
                            <div class="alert alert-danger text-center" id="noadd-votacion" style="display:none">
                                <span><i class="fas fa-times m-1"></i>Ya realizo la votacion</span>
                            </div>
                            <div class="alert alert-danger text-center" id="noadd-cod" style="display:none">
                                <span><i class="fas fa-times m-1"></i>Debe completar todos los campos</span>
                            </div>
                            <div id="registrado" class="alert alert-warning collapse text-center">
                                <span><i class="fas fa-check m-1"></i>Ya esta registrado para esta votación</span>
                            </div>
                            <!-- <form id="form-question">                                 -->
                                <div class="form-group alert alert-info">
                                    <label for="codigo">{!! $question !!}</label>
                                </div>
                                @if($question != '')
                                    @foreach($vot_ans as $vt)
                                        <div class="form-group">
                                            <button class="btn btn-info answer" onclick="ans('{!! $vt->id !!}')">{!! $vt->answer !!}</button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="alert alert-warning">No hay votaciones disponibles</div>
                                @endif
                                <div class="card-footer">
                                    <!-- <button type="submit" class="btn bg-gradient-primary float-right m-1"><i class="fas fa-save mr-1"></i> Guardar</button> -->
                                    <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1"><i class="fas fa-window-close mr-1"></i> Cerrar</button>
                                </div>
                            <!-- </form> -->
                        </div>                        
                    </div>   
                </div>
            </div>
        </div>