<?php session_start();
error_reporting(0);
require_once "../modelo/Mensaje.php";
$Limpiarvar = new Funciones();
$mens_normal = new Mensaje();

$creado = date("Y-m-d H:i:s");

// $fcompose_users  = isset($_POST['fcompose_users'])?$Limpiarvar->limpiar($_POST['fcompose_users'],'0'):'';
$asunto  = isset($_POST['asunto'])?$Limpiarvar->limpiar($_POST['asunto'],'0'):'';
// $titulo  = isset($_POST['titulo'])?$Limpiarvar->limpiar($_POST['titulo'],'0'):'';
$fcompose_message  = isset($_POST['fcompose_message'])?$Limpiarvar->limpiar($_POST['fcompose_message'],'0'):'';

$idmensaje = isset($_POST['idmensaje'])?$Limpiarvar->limpiar($_POST['idmensaje'],'0'):'';
$tipomensaje = isset($_POST['tipomensaje'])?$Limpiarvar->Limpiarvarpiar($_POST['tipomensaje'],'0'):'';

// $idmensajeget = isset($_GET['idmensaje'])?$Limpiarvar->limpiar($_GET['idmensaje'],'0'):'';
// $tipomensajeget = isset($_GET['tipomensaje'])?$Limpiarvar->Limpiarvarpiar($_GET['tipomensaje'],'0'):'';
// Revisar ahora
// $archivomensaje = isset($_POST['nombreapellido'])?$Limpiarvar->limpiar($_POST['nombreapellido'],'0'):'';

// Sesion del usuario
$DataUsuario = isset($_SESSION['DatosUsuario'])?$_SESSION['DatosUsuario']:'';
$idUsuario = !empty($DataUsuario['usuario']['id'])?$DataUsuario['usuario']['id']:'';
$nombre = !empty($DataUsuario['usuario']['nombre'])?$DataUsuario['usuario']['nombre']:'';
$email = !empty($DataUsuario['usuario']['email'])?$DataUsuario['usuario']['email']:'';

$datos='';
$op = isset($_GET['op'])?$Limpiarvar->limpiar($_GET['op'],'0'):'No';
$datos = '';
switch ($op) {

	case 'enviarmensaje':
    $mens_normal->enviarmensaje($asunto, $fcompose_message, $creado, $datos);
    break;
    case 'moverpapelera':
    $mens_normal->moverpapelera($idmensaje,$datos);
    break;

    case 'eliminarmensaje':

if (isset($_POST['idmensajes'])) {
    if (is_array($_POST['idmensajes']) && !empty($_POST['idmensajes'])) {
        $num_countries = count($_POST['idmensajes']);
        foreach ($_POST['idmensajes'] as $key =>$value) {
        $sql1 = "DELETE FROM mensaje WHERE idmensaje = '$value';";

        $consulta = $mens_normal->ejecutarConsulta($sql1,$datos);
        if ($consulta) {
            $sessData['estado']['type'] = 'success';
            $sessData['estado']['msg'] = 'Se eliminaron correctamente';
        }else{
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'Error al eliminar el mensaje.';

        } 
        }
    }
}else{
        $sql = "DELETE FROM mensaje WHERE idmensaje = '$idmensaje'";
        $consulta = $mens_normal->ejecutarConsulta($sql,$datos);
        if ($consulta) {
            $sessData['estado']['type'] = 'success';
            $sessData['estado']['msg'] = 'Se elimino correctamente';
        }else{
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'Error al eliminar el mensaje.';

        } 
}  

echo json_encode($sessData);
// }
    break;


    
    case 'mostrarmensajesenviados':
    $mens_normal->mostrarmensajesenviados($idUsuario, $datos); 
 
    break;

case 'mostrarmensajeseliminados':
    $mens_normal->mostrarmensajeseliminados($idUsuario, $datos);
break;



case 'detallemensaje':
        // echo "detalle=>".$_GET['tipomensaje']. " ".$_GET['idmensaje'];
$tipomensaje = $_GET['tipomensaje'];
$idmensaje = $_GET['idmensaje'];
$mens_normal->detallemensaje($tipomensaje, $idmensaje, $idUsuario, $nombre, $email, $datos);
break;


       case 'cantidadmensajesen1':
    $sql1 = "SELECT COUNT(men.idmensaje) AS totalmensaje FROM mensaje men INNER JOIN contacto cont ON cont.idcontacto = men.contacto_mensaje WHERE cont.usu_idusuario = '$idUsuario' AND men.men_estado = '1'";
    $query=$mens_normal->ejecutarConsultaSimpleFila($sql1,$datos);
    if ($query) {
       $valor = $query->totalmensaje;
   }else{
 $valor = '';
   }
   echo $valor;
       	break;

       case 'cantidadmensajesen0':
    $sql1 = "SELECT COUNT(men.idmensaje) AS totalmensaje FROM mensaje men INNER JOIN contacto cont ON cont.idcontacto = men.contacto_mensaje WHERE cont.usu_idusuario = '$idUsuario' AND men.men_estado = '0'";
    $query=$mens_normal->ejecutarConsultaSimpleFila($sql1,$datos);
    if ($query) {
       $valor = $query->totalmensaje;
   }else{
 $valor = '';
   }
   echo $valor;
       	break;

case 'cantidadmensajestotal':
 $sql1 = "SELECT COUNT(men.idmensaje) AS totalmensaje FROM mensaje men INNER JOIN contacto cont ON cont.idcontacto = men.contacto_mensaje WHERE cont.usu_idusuario = '$idUsuario'";
    $query=$mens_normal->ejecutarConsultaSimpleFila($sql1,$datos);
    if ($query) {
       $valor = $query->totalmensaje;
   }else{
 $valor = '';
   }
   echo $valor;
   	break;

default:
// echo "hola mundo default";
break;
}
?>
