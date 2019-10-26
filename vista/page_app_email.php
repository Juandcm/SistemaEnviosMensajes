<?php
include 'inc/config.php';  
include 'inc/template_start.php'; 
include 'inc/page_head.php'; 
$vista = isset($_GET['vista'])?$_GET['vista']:'';
 
switch ($vista) {
    case 'vercorreo':
?>
<!-- Page content -->
<!--
    Available classes when #page-content-sidebar is used:

    'inner-sidebar-left'      for a left inner sidebar
    'inner-sidebar-right'     for a right inner sidebar
-->
<div id="page-content" class="inner-sidebar-left">
    <!-- Inner Sidebar -->
    <div id="page-content-sidebar">
        <!-- Compose Message (Modal markup is at the bottom of this page before including JS scripts) -->
        <div class="block-section">
            <a href="#modal-compose" class="btn btn-effect-ripple btn-block btn-success" data-toggle="modal"><i class="fa fa-pencil"></i> Mensaje Nuevo</a>
            <a href="#modal-compose2" class="btn btn-effect-ripple btn-block btn-warning" data-toggle="modal"><i class="fa fa-pencil"></i> Agregar contacto</a>
        </div>
        <!-- END Compose Message -->

        <!-- Collapsible Navigation -->
        <a href="javascript:void(0)" class="btn btn-block btn-effect-ripple btn-default visible-xs" data-toggle="collapse" data-target="#email-nav">Menú</a>
        <div id="email-nav" class="collapse navbar-collapse remove-padding">
            <!-- Menu -->
            <div class="block-section">
                <ul class="nav nav-pills nav-stacked">
                    <li class="active" id="activerecibidos">
                        <a href="javascript:void(0)" id="recibidos">
                            <i class="fa fa-fw fa-send icon-push"></i> <strong>Mensajes enviados</strong>
                        </a>
                    </li>
                    <!-- <li id="activeenviados">
                        <a href="javascript:void(0)" id="enviados">
                            <i class="fa fa-fw fa-send icon-push"></i> <strong>Mensajes enviados</strong>
                        </a>
                    </li> -->
                    <li id="activeeliminado">
                        <a href="javascript:void(0)" id="eliminado">
                            <i class="fa fa-fw fa-trash-o icon-push"></i> <strong>Papelera de reciclaje</strong>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- END Menu -->
        </div>
        <!-- END Collapsible Navigation -->
    </div>
    <!-- END Inner Sidebar -->
<?php 
include 'vista/pageemail/recibidos.php';
include 'vista/pageemail/enviados.php';
include 'vista/pageemail/eliminados.php';

include 'vista/pageemail/enviarmensajemodal.php';
include 'vista/pageemail/modalregistrocontacto.php';
 ?>
</div>
<!-- END Page Content -->
<?php     
    break;
    case 'vercontacto':
?>
<div id="page-content" class="inner-sidebar-left">
    <!-- Inner Sidebar -->
    <div id="page-content-sidebar">
        <!-- Compose Message (Modal markup is at the bottom of this page before including JS scripts) -->
        <div class="block-section">
            <a href="#modal-compose" class="btn btn-effect-ripple btn-block btn-success" data-toggle="modal"><i class="fa fa-pencil"></i> Mensaje Nuevo</a>
            <a href="#modal-compose2" class="btn btn-effect-ripple btn-block btn-warning" data-toggle="modal"><i class="fa fa-pencil"></i> Agregar contacto</a>
        </div>
        <!-- END Compose Message -->

        <!-- Collapsible Navigation -->
        <a href="javascript:void(0)" class="btn btn-block btn-effect-ripple btn-default visible-xs" data-toggle="collapse" data-target="#email-nav">Menú</a>
        <div id="email-nav" class="collapse navbar-collapse remove-padding">
            <!-- Menu -->
            <div class="block-section">
                <ul class="nav nav-pills nav-stacked">
                    <li id="contactosli" class="active">
                        <a href="javascript:void(0)" id="contacto">
                            <i class="fa fa-fw fa-user icon-push"></i> <strong>Contactos</strong>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- END Menu -->
        </div>
        <!-- END Collapsible Navigation -->
    </div>
<?php 
include 'vista/pageemail/enviarmensajemodal.php';
include 'vista/pageemail/modalregistrocontacto.php';
include 'vista/pageemail/mostrarcontactos.php';
include 'vista/pageemail/modaleditarcontacto.php';
 ?>
</div>
<?php   
    break;

    default:
?>
<div id="page-content" class="inner-sidebar-center">

<h1 class="text-center">Estadísticas del sistema </h1>

<div class="row espacio">
<div class="col-lg-12 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner text-center">
                <h3 id="cantidadmensajestotal"></h3>
                <p>Todos los mensajes</p>
              </div>
              <div class="icon"><i class="ion ion-stats-bars"></i></div>
              <a href="index.php?vista=vercorreo" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
</div>

<div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner text-center">
                <h3 id="cantidadcontactos"></h3><p>Contactos</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="index.php?vista=vercontacto" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner text-center">
                <h3 id="cantidadmensajesen1"></h3>
                <p>Mensajes sin mover a la papelera</p>
              </div>
              <div class="icon"><i class="ion ion-stats-bars"></i></div>
              <a href="index.php?vista=vercorreo" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner text-center">
                <h3 id="cantidadmensajesen0"></h3>
                <p>Mensajes en la papelera</p>
              </div>
              <div class="icon"><i class="ion ion-stats-bars"></i></div>
              <a href="index.php?vista=vercorreo" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>

</div>
<?php 

    break;
}
 ?>

<?php include 'inc/page_footer.php'; ?>



<?php include 'inc/template_scripts.php'; ?>

<!-- Load and execute javascript code used only in this page -->
<script src="js/pages/appEmail.js"></script>
<script>$(function(){ AppEmail.init(); });</script>

<?php include 'inc/template_end.php'; ?>