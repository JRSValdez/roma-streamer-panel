<div class="modal fade" id="canjear_codigos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="card-info">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-barcode mr-1"></i> Canjear código</h3>
                            <button class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-success text-center" id="add" style="display:none">
                                <span><i class="fas fa-check m-1"></i>Se canjeo correctamente</span>
                            </div>
                            <div class="alert alert-danger text-center ocultar" id="noadd" style="display:none">
                                <span><i class="fas fa-times m-1"></i>El código no es correcto</span>
                                <span style="float: right; cursor: pointer;" class="cerrar" onclick="cerrar('noadd')">x</span>
                            </div>
                            <div class="alert alert-danger text-center ocultar" id="canjeado" style="display:none">
                                <span><i class="fas fa-times m-1"></i>El código ya fue registrado</span>
                                <span style="float: right; cursor: pointer;" class="cerrar" onclick="cerrar('canjeado')">x</span>
                            </div>
                            <div class="alert alert-danger text-center ocultar" id="noadd-cod" style="display:none">
                                <span><i class="fas fa-times m-1"></i>Debe completar todos los campos</span>
                                <span style="float: right; cursor: pointer;" class="cerrar" onclick="cerrar('noadd-cod')">x</span>
                            </div>
                            <form id="form-canjear-codigo">                                
                                <div class="form-group">
                                    <label for="codigo">Código</label>
                                    <input id="codigo" name="codigo" required type="text" class="form-control" placeholder="Ingresar código">
                                </div>
                                <div class="form-group">
                                    <label for="id_free_fire">ID Free Fire</label>
                                    <input id="id_free_fire" name="id_free_fire" required type="number" class="form-control" placeholder="Ejemplo: 34567890">
                                </div>
                                <div class="form-group">
                                    <label for="nombre_free_fire">Nombre en Free Fire</label>
                                    <input id="nombre_free_fire" name="nombre_free_fire" required type="text" class="form-control" placeholder="Nombre en Free Fire">
                                </div>
                                <div class="form-group">
                                    <label for="servidor">Seleccionar servidor</label>
                                    <select name="servidor" id="servidor" class="form-control select2" style="width: 100%">
                                        <option value="EEU">EEU</option>
                                        <option value="Norte">Norte</option>
                                        <option value="Sur">Sur</option>
                                        <option value="Otro">Otro</option>
                                    </select>
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