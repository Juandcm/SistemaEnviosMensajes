<?php session_start();
error_reporting(-1);
require_once "../modelo/Contacto.php";

$Limpiarvar = new Funciones();
$cont_normal = new Contacto();

// $nombreapellido= isset($_POST['nombreapellido'])?$Limpiarvar->limpiar($_POST['nombreapellido'],'0'):'';
$idcontacto = isset($_POST['idcontacto'])?$_POST['idcontacto']:'';

// Sesion del usuario
$DataUsuario = isset($_SESSION['DatosUsuario'])?$_SESSION['DatosUsuario']:'';
$idUsuario = !empty($DataUsuario['usuario']['id'])?$DataUsuario['usuario']['id']:'';

// Registrar contacto
// nombreapellido telefonocontacto correocontacto
$nombreapellido= isset($_POST['nombreapellido'])?$Limpiarvar->limpiar($_POST['nombreapellido'],'0'):'';
$telefonocontacto= isset($_POST['telefonocontacto'])?$Limpiarvar->limpiar($_POST['telefonocontacto'],'0'):'';
$correocontacto= isset($_POST['correocontacto'])?$Limpiarvar->limpiar($_POST['correocontacto'],'0'):'';
$register_año = isset($_POST['register_año'])?$Limpiarvar->limpiar($_POST['register_año'],'0'):'';
$register_seccion = isset($_POST['register_seccion'])?$Limpiarvar->limpiar($_POST['register_seccion'],'0'):'';
$datos ='';


$nombrecontacto= isset($_POST['nombrecontacto'])?$Limpiarvar->limpiar($_POST['nombrecontacto'],'0'):'';
$telefonocont= isset($_POST['telefonocont'])?$Limpiarvar->limpiar($_POST['telefonocont'],'0'):'';
$correocontac= isset($_POST['correocontac'])?$Limpiarvar->limpiar($_POST['correocontac'],'0'):'';
$register_seccion1= isset($_POST['register_seccion1'])?$Limpiarvar->limpiar($_POST['register_seccion1'],'0'):'';
// idcontacto nombrecontacto telefonocont correocontac register_seccion1
$op = isset($_GET['op'])?$Limpiarvar->limpiar($_GET['op'],'0'):'No';

switch ($op) {
// Revisar esto aqui

    case 'eliminarcontacto':

    $cont_normal->eliminarcontacto($idcontacto, $datos);
    break;

    case 'mostrarcontactosdeusuario':
    $cont_normal->mostrarcontactosdeusuario($idUsuario, $datos);
    break;

    case 'registrocontacto':
    $cont_normal->registrocontacto($idUsuario,$register_seccion, $nombreapellido, $correocontacto, $telefonocontacto, $datos);
    break;

    case 'vercontacto':
    $sql1 = "SELECT cont.idcontacto, cont.con_nombre_apellido, cont.con_correo, cont.con_telefono, sec.idseccion, añ.idaño FROM contacto cont INNER JOIN seccion sec ON sec.idseccion = cont.sec_idseccion INNER JOIN año añ ON añ.idaño = sec.año_idaño WHERE cont.idcontacto = '$idcontacto' LIMIT 1 ";
    $query=$cont_normal->ejecutarConsultaSimpleFila($sql1,$datos);
    if ($query) {
       $data[]=array( "0"=>$query->con_nombre_apellido,
        "1"=>$query->con_correo,
        '2'=>$query->con_telefono,
        '3'=>$query->idseccion,
        '4'=>$query->idaño,           
    );
   }
   echo json_encode($data);
   break;

   case 'editarcontacto':
// idcontacto nombrecontacto telefonocont con_correo register_seccion1
        $sql1 = "UPDATE contacto SET con_nombre_apellido = '$nombrecontacto', con_correo='$correocontac', con_telefono='$telefonocont', sec_idseccion='$register_seccion1'  WHERE idcontacto = '$idcontacto';";
        $consulta = $cont_normal->ejecutarConsulta($sql1,$datos);
        if ($consulta) {
            $sessData['estado']['type'] = 'success';
            $sessData['estado']['msg'] = 'Se actualizo el contacto';
        }else{
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'Error al actualizar el contacto.';

        } 
    echo json_encode($sessData);
       break;


       case 'cantidadcontactos':
    $sql1 = "SELECT COUNT(idcontacto) as total FROM contacto WHERE usu_idusuario = '$idUsuario'";
    $query=$cont_normal->ejecutarConsultaSimpleFila($sql1,$datos);
    if ($query) {
       $valor = $query->total;
   }else{
 $valor = '';
   }
   echo $valor;
       	break;

   default:
   break;

}
?>