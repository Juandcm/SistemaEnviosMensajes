<!-- Compose Modal -->
<div id="modal-compose" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title"><strong>Enviar Mensaje</strong></h3>
            </div>
            <div class="modal-body">
                <div id="errorcontacto"></div>
                <form id="enviarmensaje" class="form-horizontal form-bordered" onsubmit="return false;">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <span for="fcompose_users">Para:
                            </span>
                            <select id="fcompose_users" name="fcompose_users[]" class="form-control" multiple style="width: 100%;">
                            </select>



                             <!-- multiple="multiple" id="my-select" name="my-select[]" -->
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-xs-12">
                            Asunto: <input type="text" id="asunto" name="asunto" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            Descripción del correo: <textarea id="fcompose_message" name="fcompose_message" rows="7" class="form-control" placeholder="Escribe tu mensaje"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            Subir archivo: <input type="file" id="archivomensaje" name="archivomensaje" class="form-control" value="">
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



          