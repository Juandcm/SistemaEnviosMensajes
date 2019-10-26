<?php
include 'inc/config.php';
include 'inc/template_start.php'; 
?>

<!-- Full Background -->
<!-- For best results use an image with a resolution of 1280x1280 pixels (prefer a blurred image for smaller file size) -->
<img src="img/placeholders/layout/login2_full_bg.jpg" alt="Full Background" class="full-bg animation-pulseSlow">
<!-- END Full Background -->

<!-- ////////////////////////////////////////////////////////////////////////////// -->

<!-- Login Container -->
<div id="login-container">
    <!-- Login Header -->
    <h1 class="h2 text-light text-center push-top-bottom animation-pullDown">
        <i class="fa fa-cube text-light-op"></i> <strong>SEMIR</strong>
        <p></p>
        <small>SISTEMA DE ENVIO DE MENSAJES INFORMATIVOS A REPRESANTANTES</small>
    </h1>
    <!-- END Login Header -->

    <!-- Login Block -->
    <div class="block animation-fadeInQuick">
        <!-- Login Title -->
        <div class="block-title">
            <div class="block-options pull-right">
                <a href="#restart-container" id="btn_restaurar" class="btn btn-effect-ripple btn-primary" data-toggle="tooltip" data-placement="left" title="¿Se te olvido la contraseña?"><i class="fa fa-exclamation-circle"></i></a>
                <a href="#register-container" id="btn_registrar" class="btn btn-effect-ripple btn-primary" data-toggle="tooltip" data-placement="left" title="Crear nueva cuenta"><i class="fa fa-plus"></i></a>
            </div>
            <h2>Entrar en la página</h2>
        </div>
        <!-- END Login Title -->

        <!-- Login Form -->
        <form id="form-login" action="index.php" method="post" class="form-horizontal">
            <div class="form-group">
                <label for="login_email" class="col-xs-12">Correo</label>
                <div class="col-xs-12">
                    <input type="text" id="login_email" name="login_email" class="form-control" placeholder="Ingresa tu correo...">
                </div>
            </div>
            <div class="form-group">
                <label for="login_password" class="col-xs-12">Contraseña</label>
                <div class="col-xs-12">
                    <input type="password" id="login_password" name="login_password" class="form-control" placeholder="Ingresa tu contraseña..">
                </div>
            </div>
            <div class="form-group form-actions">
                <div class="col-xs-4">
                </div>
                <div class="col-xs-4 text-center">
                    <button type="submit" class="btn btn-effect-ripple btn-sm btn-success">Entrar</button>
                </div>
            </div>
        </form>
        <!-- END Login Form -->
    </div>
    <!-- END Login Block -->

    <!-- Footer -->
    <footer class="text-muted text-center animation-pullUp">
        <small><span id="year-copy"></span> &copy; <a href="index.php"><?php echo $template['name'] . ' ' . $template['version']; ?></a></small>
    </footer>
    <!-- END Footer -->
</div>
<!-- END Login Container -->

<hr>

<!-- ////////////////////////////////////////////////////////////////////////////// -->

<!-- Restart Container -->
<div id="restart-container">
    <!-- Reminder Header -->
    <h1 class="h2 text-light text-center push-top-bottom animation-slideDown">
        <i class="fa fa-history"></i> <strong>Restaurar la contraseña</strong>
    </h1>
    <!-- END Reminder Header -->

    <!-- Reminder Block -->
    <div class="block animation-fadeInQuickInv">
        <!-- Reminder Title -->
        <div class="block-title">
            <div class="block-options pull-right">
                <a href="#login-container" class="btn_login" class="btn btn-effect-ripple btn-primary" data-toggle="tooltip" data-placement="left" title="Regresar a la entrada del sistema"><i class="fa fa-user"></i></a>
            </div>
            <h2>Restaurar</h2>
        </div>
        <!-- END Reminder Title -->

        <div class="box-wrapper">
            <ul id="myTab" class="nav clearfix nav-tabs centered">
                <li class="active"><a href="#area1" data-toggle="tab">Con correo</a></li>
                <li class=""><a href="#subarea1" data-toggle="tab" id="csc">Con pregunta de seguridad</a></li>
            </ul>

            <div id="myTabContent" class="tab-content">

                <div class="tab-pane fade active in" id="area1">
                    <div class="panel-group" id="tablaindividual1">
                        <!-- Reminder Form -->
                        <form id="form-reminder" class="form-horizontal espacio-tab">
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input type="text" id="reminder_email" name="reminder_email" class="form-control" placeholder="Ingresa tu correo...">
                                </div>
                            </div>
                            <div class="form-group form-actions">

                                <div class="col-xs-12 text-center">
                                    <button type="submit" class="btn btn-effect-ripple btn-sm btn-primary"><i class="fa fa-check"></i> Restaurar</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="tab-pane fade" id="subarea1">
                    <div class="panel-group" id="tablacsc1">

                        <!-- Reminder Form -->

                        <form id="form-reminder-pregunta" class="form-horizontal espacio-tab">
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input type="text" id="reminder_email_cedula" name="reminder_email_cedula" class="form-control" placeholder="Ingresa tu correo o cedula...">
                                </div>
                            
                            <div class="col-xs-12">
                                <div class="alert alert-success d-none alert-dismissible fade show" role="alert" id="alertsucces">
                                    Puedes cambiar la contraseña
                                    <button type="button" class="close" id="cerrarSucces" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>

                                <div class="alert alert-danger d-none alert-dismissible fade show" role="alert" id="alerterror">
                                    No puedes cambiar la contraseña
                                    <button type="button" class="close" id="cerrarError" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                            </div>

<!-- Formulario de pregunta y respuesta -->
                            <div class="col-xs-12 d-none espacio-tab" id="formFinal">
                                    <p class="text-center"><label>Pregunta del usuario</label></p>
                                    <input type="text" name="pregunta" id="pregunta" class="form-control" disabled>
                                    <p class="text-center"><label>Escribe tu respuesta</label></p>
                                    <input type="text" name="respuesta" id="respuesta" class="form-control">
                            </div>

                            </div>

                            <div class="form-group form-actions">

                                <div class="col-xs-12 text-center">
                                    <button type="submit" id="btn-recordar-pregunta" class="btn btn-effect-ripple btn-sm btn-primary" disabled><i class="fa fa-check"></i> Comprobar</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>











        <!-- END Reminder Form -->
    </div>
    <!-- END Reminder Block -->

    <!-- Footer -->
    <footer class="text-muted text-center animation-pullUp">
        <small><span></span> &copy; <a href="index.php"><?php echo $template['name'] . ' ' . $template['version']; ?></a></small>
    </footer>
    <!-- END Footer -->
</div>
<!-- END Restart Container -->

<!-- ////////////////////////////////////////////////////////////////////////////// -->


<!-- Register Container -->
<div id="register-container">
    <!-- Register Header -->
    <h1 class="h2 text-light text-center push-top-bottom animation-slideDown">
        <i class="fa fa-plus"></i> <strong>Crear cuenta</strong>
    </h1>
    <!-- END Register Header -->

    <!-- Register Form -->
    <div class="block animation-fadeInQuickInv">
        <!-- Register Title -->
        <div class="block-title">
            <div class="block-options pull-right">
                <a href="#login-container" class="btn_login" class="btn btn-effect-ripple btn-primary" data-toggle="tooltip" data-placement="left" title="Regresar a la entrada del sistema"><i class="fa fa-user"></i></a>
            </div>
            <h2>Registrar</h2>
        </div>
        <!-- END Register Title -->

        <!-- Register Form -->
        <form id="form-register" class="form-horizontal" enctype="multipart/form-data">
            <div class="form-group">
                <div class="col-xs-12">
                    <input type="text" id="register_cedula" name="register_cedula" class="form-control" placeholder="Cedula de Identidad">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <input type="text" id="register_username" name="register_username" class="form-control" placeholder="Nombre y apellido">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <input type="text" id="register_email" name="register_email" class="form-control" placeholder="Correo">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <input type="text" id="register_telefono" name="register_telefono" number="true" class="form-control" placeholder="Telefono">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <input type="password" id="register_password" name="register_password" class="form-control" placeholder="Contraseña">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <input type="password" id="register_password_verify" name="register_password_verify" class="form-control" placeholder="Verificar la contraseña">
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <input type="password" id="register_pregunta_segura" name="register_pregunta_segura" class="form-control" placeholder="Escribe una pregunta de seguridad">
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <input type="password" id="register_respuesta_segura" name="register_respuesta_segura" class="form-control" placeholder="Escribe una respuesta de seguridad">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="text-center"> 
                        <label for="register_foto">Subir foto del usuario</label>
                    </div>
                    <input type="file" id="register_foto" name="register_foto" class="form-control" placeholder="Foto del usuario">
                </div>
            </div>
            <div class="form-group form-actions">
                <div class="col-xs-6">
                    <label class="csscheckbox csscheckbox-primary" data-toggle="tooltip" title="Acepto los terminos de la licencia">
                        <input type="checkbox" id="register_terms" name="register_terms">
                        <span></span>
                    </label>
                    <a href="#modal-terms" data-toggle="modal">Terminos de la licencia</a>
                </div>
                <div class="col-xs-6 text-right">
                    <button type="submit" class="btn btn-effect-ripple btn-success" id="registrar"><i class="fa fa-plus"></i> Crear cuenta</button>
                </div>
            </div>
        </form>
        <!-- END Register Form -->
    </div>
    <!-- END Register Block -->

    <!-- Footer -->
    <footer class="text-muted text-center animation-pullUp">
        <small><span id="year-copy"></span> &copy; <a href="index.php"><?php echo $template['name'] . ' ' . $template['version']; ?></a></small>
    </footer>
    <!-- END Footer -->
</div>
<!-- END Login Container -->

<!-- Modal Terms -->
<div id="modal-terms" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-center"><strong>Terminos y condiciones de la cuenta</strong></h3>
            </div>
            <div class="modal-body">
                <h4 class="page-header">1. <strong>General</strong></h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida, urna ligula hendrerit nibh, ac cursus nibh sapien in purus. Mauris tincidunt tincidunt turpis in porta. Integer fermentum tincidunt auctor.</p>
                <h4 class="page-header">2. <strong>Cuenta</strong></h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida, urna ligula hendrerit nibh, ac cursus nibh sapien in purus. Mauris tincidunt tincidunt turpis in porta. Integer fermentum tincidunt auctor.</p>
                <h4 class="page-header">3. <strong>Servicios</strong></h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida, urna ligula hendrerit nibh, ac cursus nibh sapien in purus. Mauris tincidunt tincidunt turpis in porta. Integer fermentum tincidunt auctor.</p>
                <h4 class="page-header">4. <strong>Pagos</strong></h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida, urna ligula hendrerit nibh, ac cursus nibh sapien in purus. Mauris tincidunt tincidunt turpis in porta. Integer fermentum tincidunt auctor.</p>
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <button type="button" class="btn btn-effect-ripple btn-sm btn-primary" data-dismiss="modal">Ya he leido todo!</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Modal Terms -->

<!-- ////////////////////////////////////////////////////////////////////////////// -->


<?php include 'inc/template_scripts.php'; ?>

<!-- Load and execute javascript code used only in this page -->
<script src="js/pages/readyLogin.js"></script>

<script>





</script>



<?php include 'inc/template_end.php'; ?>