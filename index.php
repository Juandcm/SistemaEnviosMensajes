<?php session_start();
// $_SESSION['DatosUsuario'] = '1';
$sesion = isset($_SESSION['DatosUsuario'])?$_SESSION['DatosUsuario']:'';

// unset($_SESSION['DatosUsuario']);
// session_destroy();
$vista = isset($_GET['vista'])?$_GET['vista']:'';
if (empty($sesion)) {

	switch ($vista) {
    case 'recuperar_clave':
    include 'vista/recuperar_clave.php';
	break;

default:
	include 'vista/login.php';
break;
	}
}else{
	include 'vista/page_app_email.php';
}

 ?>

<!-- SISTEMA DE ENVIO DE MENSAJES INFORMATIVOS A REPRESANTANTES -->