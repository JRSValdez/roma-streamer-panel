<div class="modal fade" id="ruleta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="card-info">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fab fa-superpowers mr-1"></i> Registrarse</h3>
                            <button class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-success text-center" id="add-rul" style="display:none">
                                <span><i class="fas fa-check m-1"></i>Se registro en la ruleta</span>
                            </div>
                            <div class="alert alert-danger text-center" id="noadd-ruls" style="display:none">
                                <span><i class="fas fa-times m-1"></i>Ya esta registrado en la ruleta</span>
                            </div>
                            <div class="alert alert-danger text-center" id="noadd-rul" style="display:none">
                                <span><i class="fas fa-times m-1"></i>No hay ruletas activas</span>
                            </div>
                            <form id="form-ruleta">                                
                                <div class="form-group">
                                    <label for="nombre">Nombre en la ruleta</label>
                                    <input id="nombre" name="nombre" required type="text" class="form-control" placeholder="Ingresar nombre" value="{{ Auth::user()->name }}" disabled="true">
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