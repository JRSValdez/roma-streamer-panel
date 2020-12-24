<div class="modal fade" id="mensaje" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="card-info">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-envelope mr-1"></i> Mensaje</h3>
                            <button class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-success text-center" id="enviado" style="display:none">
                                <span><i class="fas fa-check m-1"></i>Mensaje enviado</span>
                            </div>
                            <div class="alert alert-danger text-center" id="noenviado" style="display:none">
                                <span><i class="fas fa-times m-1"></i>El mensaje no fue enviado</span>
                            </div>
                            <div class="alert alert-danger text-center" id="nosmj" style="display:none">
                                <span><i class="fas fa-times m-1"></i>Cantidad maxima de caracteres alcanzada</span>
                            </div>
                            <form id="form-mensaje">                                
                                <div class="form-group">
                                    <textarea rows="5" id="mensaje" name="mensaje" class="form-control" placeholder="Enviar mensaje" maxlength="200" minlength="0"></textarea>
                                    <span>Quedan <span id="cant_char">200</span> de 200 caracteres</span>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn bg-gradient-primary float-right m-1"><i class="fas fa-save mr-1"></i> Enviar</button>
                                    <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1"><i class="fas fa-window-close mr-1"></i> Cerrar</button>
                                </div>
                            </form>
                        </div>                        
                    </div>   
                </div>
            </div>
        </div>