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
<div id="restaurar_contraseña_container">
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
            <h2>Restaurar la contraseña</h2>
        </div>
        <!-- END Login Title -->

        <!-- Login Form -->
        <form id="form-recuperar-contraseña" action="index.php" method="post" class="form-horizontal">
            <div class="form-group">
                <label for="res_contraseña" class="col-xs-12">Contraseña</label>
                <div class="col-xs-12">
                	
                	<input type="hidden" name="fp_code" id="fp_code" value="<?php echo $_REQUEST['fp_code']; ?>">
                    <input type="password" id="res_contraseña" name="res_contraseña" class="form-control" placeholder="Ingresa tu contraseña">
                </div>
            </div>
            <div class="form-group">
                <label for="res_repite_contraseña" class="col-xs-12">Repite la Contraseña</label>
                <div class="col-xs-12">
                    <input type="password" id="res_repite_contraseña" name="res_repite_contraseña" class="form-control" placeholder="Repite tu contraseña">
                </div>
            </div>
            <div class="form-group form-actions">
                <div class="col-xs-4">
                </div>
                <div class="col-xs-4 text-center">
                    <button type="button" id="cambiarcontraseñafinal" class="btn btn-effect-ripple btn-sm btn-success">Restaurar</button>
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

<?php include 'inc/template_scripts.php'; ?>

<!-- Load and execute javascript code used only in this page -->
<script src="js/pages/readyLogin.js"></script>

<script>





</script>



<?php include 'inc/template_end.php'; ?>