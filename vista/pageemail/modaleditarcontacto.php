<!-- Compose Modal -->
<div id="modal-editar-contacto" class="modal fade effect-flip-vertical" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title text-center"><strong>Editar Contacto</strong></h3>
            </div>
            <div class="modal-body">
                <form id="editarcontacto" class="form-horizontal form-bordered" onsubmit="return false;">
                    <input type="hidden" name="idcontacto" id="idcontacto" value="">
                    <div class="form-group">
                        <div class="col-12">
                            <p class="text-center"><label>Ingresa el nombre y apellido del contacto</label></p>
                            <input type="text" name="nombrecontacto" id="nombrecontacto" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <p class="text-center"><label>Ingresa el telefono del contacto</label></p>
                            <input type="text" name="telefonocont" id="telefonocont" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <p class="text-center"><label>Ingresa el correo del contacto</label></p>
                            <input type="text" name="correocontac" id="correocontac" class="form-control" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-6">
                            <div class="text-center"> 
                                <label for="register_año1">Año de estudio</label>
                            </div>
                            <select name="register_año1" id="register_año1" class="form-control">
                            </select>
                        </div>
                        <div class="col-xs-6"> 
                            <input type="hidden" name="seccionid" id="seccionid" value="">
                            <div class="text-center"> 
                                <label for="register_seccion1">Selecciona la sección</label>
                            </div>
                            <select name="register_seccion1" id="register_seccion1" class="form-control">
                            </select>
                        </div>
                    </div>


                    <div class="form-group form-actions">
                        <div class="col-xs-12 text-center">
                            <button type="submit" class="btn btn-effect-ripple btn-primary">Actualizar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Compose Modal -->

<!-- editarcontacto idcontacto nombrecontacto telefonocont correocontac register_año1 register_seccion1 -->