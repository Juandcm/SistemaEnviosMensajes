<?php 
$DataUsuario = isset($_SESSION['DatosUsuario'])?$_SESSION['DatosUsuario']:'';
$nombre = !empty($DataUsuario['usuario']['nombre'])?$DataUsuario['usuario']['nombre']:'';
$email = !empty($DataUsuario['usuario']['email'])?$DataUsuario['usuario']['email']:'';
$telefono = !empty($DataUsuario['usuario']['telefono'])?$DataUsuario['usuario']['telefono']:'';
$foto_usuario = !empty($DataUsuario['usuario']['foto_usuario'])?$DataUsuario['usuario']['foto_usuario']:'';
$creado = !empty($DataUsuario['usuario']['creado'])?$DataUsuario['usuario']['creado']:'';
/**
 * page_sidebar_alt.php
 *
 * Author: pixelcave
 *
 * The alternative sidebar of each page
 *
 */
?>
<!-- Alternative Sidebar -->
<div id="sidebar-alt" tabindex="-1" aria-hidden="true">
    <!-- Toggle Alternative Sidebar Button (visible only in static layout) -->
    <a href="javascript:void(0)" id="sidebar-alt-close" onclick="App.sidebar('toggle-sidebar-alt');"><i class="fa fa-times"></i></a>

    <!-- Wrapper for scrolling functionality -->
    <div id="sidebar-scroll-alt">
        <!-- Sidebar Content -->
        <div class="sidebar-content">
            <!-- Profile -->
            <div class="sidebar-section">

                <h2 class="text-light">Perfil <button type="button" class="close" onclick="App.sidebar('close-sidebar-alt');">&times;</button></h2>
                <form class="form-control-borderless" id="cambiodatosusuario">
                    <hr>
                    <div class="form-group">
                        <label for="side-profile-name">Nombre y Apellido</label>
                        <input type="text" id="side-profile-name" name="side-profile-name" class="form-control" value="<?= $nombre; ?>">
                    </div>
                    <div class="form-group">
                        <label for="side-profile-email">Correo</label>
                        <input type="email" id="side-profile-email" name="side-profile-email" class="form-control" value="<?= $email; ?>">
                    </div>
                    <div class="form-group">
                        <label for="side-profile-telefono">Telefono</label>
                        <input type="tel" id="side-profile-telefono" name="side-profile-telefono" class="form-control" value="<?= $telefono; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="side-profile-pregunta">Pregunta de seguridad</label>
                        <input type="tel" id="side-profile-pregunta" name="side-profile-pregunta" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="side-profile-respuesta">Respuesta de seguridad</label>
                        <input type="tel" id="side-profile-respuesta" name="side-profile-respuesta" class="form-control">
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="side-profile-file">Sube una foto nueva</label>
                        <input type="file" id="side-profile-file" name="side-profile-file" class="form-control">
                    </div>
                    <hr>
                    <div class="form-group remove-margin">
                        <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar Datos</button>

                    </div>
                </form>
            </div>
            <!-- END Profile -->
        </div>
        <!-- END Sidebar Content -->
    </div>
    <!-- END Wrapper for scrolling functionality -->
</div>
<!-- END Alternative Sidebar -->


<!-- ////////////////////////////////////////////////////////////////////// -->

<!-- Alternative Sidebar -->
<div id="sidebar-alt2" tabindex="-1" aria-hidden="true">
    <!-- Toggle Alternative Sidebar Button (visible only in static layout) -->
    <a href="javascript:void(0)" id="sidebar-alt-close2" onclick="App.sidebar('toggle-sidebar-alt2');"><i class="fa fa-times"></i></a>

    <!-- Wrapper for scrolling functionality -->
    <div id="sidebar-scroll-alt2">
        <!-- Sidebar Content -->
        <div class="sidebar-content">
            <!-- Profile -->
            <div class="sidebar-section">

                <h2 class="text-light">Cambio de contraseña <button type="button" class="close" onclick="App.sidebar('close-sidebar-alt2');">&times;</button></h2>
                <form id="cambioContraseña" class="form-control-borderless">
                    <hr>
                    <div class="form-group">
                        <label for="side-profile-password">Nueva contraseña</label>
                        <input type="password" id="side-profile-password" name="side-profile-password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="side-profile-password-confirm">Confirmar nueva contraseña</label>
                        <input type="password" id="side-profile-password-confirm" name="side-profile-password-confirm" class="form-control">
                    </div>
                    <hr>
                    <div class="form-group remove-margin">
                        <button type="button" id="btncambiocontraseña" class="btn btn-effect-ripple btn-primary">Guardar Datos</button>

                    </div>
                </form>
            </div>
            <!-- END Profile -->
        </div>
        <!-- END Sidebar Content -->
    </div>
    <!-- END Wrapper for scrolling functionality -->
</div>
<!-- END Alternative Sidebar -->