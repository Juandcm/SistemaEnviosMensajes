<?php 
// <br /><b>Notice</b>:  Undefined variable: nombre in <b>C:\xampp\htdocs\SistemaEnvioCorreos\inc\page_sidebar_alt.php</b> on line <b>26</b><br />
// Sesion del usuario
$DataUsuario = isset($_SESSION['DatosUsuario'])?$_SESSION['DatosUsuario']:'';
$nombre = !empty($DataUsuario['usuario']['nombre'])?$DataUsuario['usuario']['nombre']:'';
$creado = !empty($DataUsuario['usuario']['creado'])?$DataUsuario['usuario']['creado']:'';
$foto_usuario = !empty($DataUsuario['usuario']['foto_usuario'])?$DataUsuario['usuario']['foto_usuario']:'';

$valcreado = str_replace(' ',' a las ',$creado);

if ($foto_usuario =='') {
    $fotofinal = 'img/placeholders/avatars/avatar9.jpg';
}else{
$fotofinal = str_replace('C:xampphtdocsSistemaEnvioCorreosmodelo/Archivos/', 'modelo/Archivos/',$foto_usuario);

}
/**
 * page_header.php
 *
 * Author: pixelcave
 *
 * The header of each page
 *
 */
?>
<!-- Header -->
<!-- In the PHP version you can set the following options from inc/config file -->
<!--
    Available header.navbar classes:

    'navbar-default'            for the default light header
    'navbar-inverse'            for an alternative dark header

    'navbar-fixed-top'          for a top fixed header (fixed main sidebar with scroll will be auto initialized, functionality can be found in js/app.js - handleSidebar())
        'header-fixed-top'      has to be added on #page-container only if the class 'navbar-fixed-top' was added

    'navbar-fixed-bottom'       for a bottom fixed header (fixed main sidebar with scroll will be auto initialized, functionality can be found in js/app.js - handleSidebar()))
        'header-fixed-bottom'   has to be added on #page-container only if the class 'navbar-fixed-bottom' was added
-->
<header class="navbar<?php if ($template['header_navbar']) { echo ' ' . $template['header_navbar']; } ?><?php if ($template['header']) { echo ' '. $template['header']; } ?>">
    <!-- Left Header Navigation -->
    <ul class="nav navbar-nav-custom">
        <!-- Main Sidebar Toggle Button -->
        <li>
            <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();">
                <i class="fa fa-ellipsis-v fa-fw animation-fadeInRight" id="sidebar-toggle-mini"></i>
                <i class="fa fa-bars fa-fw animation-fadeInRight" id="sidebar-toggle-full"></i>
            </a>
        </li>
        <!-- END Main Sidebar Toggle Button -->

        <?php if ($template['header_link']) { ?>
        <!-- Header Link -->
        <li class="hidden-xs animation-fadeInQuick">
            <a href=""><strong><?php echo $template['header_link']; ?></strong></a>
        </li>
        <!-- END Header Link -->
        <?php } ?>
    </ul>
    <!-- END Left Header Navigation -->

    <!-- Right Header Navigation -->
    <ul class="nav navbar-nav-custom pull-right">
        <!-- User Dropdown -->
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?= $fotofinal; ?>" alt="avatar">
            </a>
            <ul class="dropdown-menu dropdown-menu-right">
                <li class="dropdown-header">
                    <strong><?= $nombre; ?></strong>
                </li>
                <li>
                    <strong> Registrado desde:<br> <?= $valcreado; ?></strong>
                </li>
                <li class="divider"><li>
                <li>
                    <a href="index.php?vista=vercorreo">
                        <i class="fa fa-inbox fa-fw pull-right"></i>
                        Mensajes
                    </a>
                </li>
                <li class="divider"><li>
                <li>
                    <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar-alt');">
                        <i class="gi gi-settings fa-fw pull-right"></i>
                        Editar Perfil
                    </a>
                </li>
                <li class="divider"><li>
                <li>
                    <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar-alt2');">
                        <i class="gi gi-settings fa-fw pull-right"></i>
                        Cambiar contraseña
                    </a>
                </li>
                <li class="divider"><li>
                <li>
                    <a href="#" id="salir">
                        <i class="fa fa-power-off fa-fw pull-right"></i>
                        Salir
                    </a>
                </li>
            </ul>
        </li>
        <!-- END User Dropdown -->
    </ul>
    <!-- END Right Header Navigation -->
</header>
<!-- END Header -->
