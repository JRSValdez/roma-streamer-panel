{!! Form::open(['url' => 'streamer/nuevocodigo']) !!}
{{ Form::token() }}
<div class="modal fade" id="crear_codigos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="card-info">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-barcode mr-1"></i> Generar código</h3>
                            <button class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-success text-center" id="add" style="display:none">
                                <span><i class="fas fa-check m-1"></i>Se genero correctamente</span>
                            </div>
                            <div class="alert alert-danger text-center" id="noadd" style="display:none">
                                <span><i class="fas fa-times m-1"></i>El código generado ya existe</span>
                            </div>
                            <div class="alert alert-danger text-center" id="noadd-cod" style="display:none">
                                <span><i class="fas fa-times m-1"></i>Debe completar todos los campos</span>
                            </div>
                            <form id="form-generar-codigo">                                
                                <div class="form-group">
                                    <label for="regalo">Seleccionar regalo</label>
                                    <select name="regalo" id="regalo" class="form-control select2" style="width: 100%">
                                        <option selected disabled>-- Seleccionar regalo --</option>
                                        <option value="1">15 Diamantes</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="ganador">¿Como elegir ganador?</label>
                                    <select name="ganador" id="ganador" class="form-control select2" style="width: 100%">
                                        <option selected disabled>-- Seleccionar ganador --</option>
                                        <option value="2">Azar</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="max_reclamo">Maximo de reclamos</label>
                                    <input id="max_reclamo" name="max_reclamo" required type="number" class="form-control" placeholder="Ingrese maximo de reclamos">
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
{!! Form::close() !!} 