<!-- Compose Modal -->
<div id="modal-compose2" class="modal fade effect-flip-vertical" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title text-center"><strong>Registrar Contacto</strong></h3>
            </div>
            <div class="modal-body">
                <form id="registrocontacto" class="form-horizontal form-bordered" onsubmit="return false;">
                    <div class="form-group">
                        <div class="col-12">
                            <p class="text-center"><label>Ingresa el nombre y apellido del contacto</label></p>
                            <input type="text" name="nombreapellido" id="nombreapellido" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <p class="text-center"><label>Ingresa el telefono del contacto</label></p>
                            <input type="text" name="telefonocontacto" id="telefonocontacto" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <p class="text-center"><label>Ingresa el correo del contacto</label></p>
                            <input type="text" name="correocontacto" id="correocontacto" class="form-control" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-6">
                            <div class="text-center"> 
                                <label for="register_año">Año de estudio</label>
                            </div>
                            <select name="register_año" id="register_año" class="form-control">
                            </select>
                        </div>
                        <div class="col-xs-6"> 
                            <div class="text-center"> 
                                <label for="register_seccion">Selecciona la sección</label>
                            </div>
                            <select name="register_seccion" id="register_seccion" class="form-control">
                            </select>
                        </div>
                    </div>


                    <div class="form-group form-actions">
                        <div class="col-xs-12 text-center">
                            <button type="submit" class="btn btn-effect-ripple btn-primary">Enviar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Compose Modal -->