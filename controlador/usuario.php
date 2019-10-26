<?php session_start();
error_reporting(0);
require_once "../modelo/Usuario.php";

$Limpiarvar = new Funciones();
$usu_normal = new Usuario();

$creado = date("Y-m-d H:i:s");

// Restaurar
// reminder_email

// Entrar
$login_email = isset($_POST['login_email'])?$Limpiarvar->limpiar($_POST['login_email'],'0'):'';
$login_password = isset($_POST['login_password'])?$Limpiarvar->limpiar($_POST['login_password'],'0'):'';

// Registrar
$register_cedula =  isset($_POST['register_cedula'])?$Limpiarvar->limpiar($_POST['register_cedula'],'1'):'';
$register_username = isset($_POST['register_username'])?$Limpiarvar->limpiar($_POST['register_username'],'0'):'';
$register_email = isset($_POST['register_email'])?$Limpiarvar->limpiar($_POST['register_email'],'1'):'';
$register_telefono = isset($_POST['register_telefono'])?$Limpiarvar->limpiar($_POST['register_telefono'],'1'):'';
$register_password = isset($_POST['register_password'])?$Limpiarvar->limpiar($_POST['register_password'],'0'):'';
$register_pregunta_segura = isset($_POST['register_pregunta_segura'])?$Limpiarvar->limpiar($_POST['register_pregunta_segura'],'0'):'';
$register_respuesta_segura = isset($_POST['register_respuesta_segura'])?$Limpiarvar->limpiar($_POST['register_respuesta_segura'],'0'):'';
// Revisar aqui el archivo
// $foto_usuario = isset($_POST['foto_usuario'])?$Limpiarvar->limpiar($_POST['foto_usuario'],'0'):'user-default.jpg';
$register_año = isset($_POST['register_año'])?$Limpiarvar->limpiar($_POST['register_año'],'0'):'';


//cambio de contraseña
$side_password = isset($_POST['side-profile-password'])?$Limpiarvar->limpiar($_POST['side-profile-password'],'0'):'';

//cambio de datos del usuario
$side_name =isset($_POST['side-profile-name'])?$Limpiarvar->limpiar($_POST['side-profile-name'],'0'):'';
$side_email =isset($_POST['side-profile-email'])?$Limpiarvar->limpiar($_POST['side-profile-email'],'0'):'';
$side_telefono =isset($_POST['side-profile-telefono'])?$Limpiarvar->limpiar($_POST['side-profile-telefono'],'0'):'';
$side_pregunta =isset($_POST['side-profile-pregunta'])?$Limpiarvar->limpiar($_POST['side-profile-pregunta'],'0'):'';
$side_respuesta =isset($_POST['side-profile-respuesta'])?$Limpiarvar->limpiar($_POST['side-profile-respuesta'],'0'):'';

// side-profile-file =isset($_POST['side-profile-file'])?$Limpiarvar->limpiar($_POST['side-profile-file'],'0'):'';

// Sesion del usuario
$DataUsuario = isset($_SESSION['DatosUsuario'])?$_SESSION['DatosUsuario']:'';
$idUsuario = !empty($DataUsuario['usuario']['id'])?$DataUsuario['usuario']['id']:'';
$creadoUsuario = !empty($DataUsuario['usuario']['creado'])?$DataUsuario['usuario']['creado']:'';
$foto_usuario = !empty($DataUsuario['usuario']['foto_usuario'])?$DataUsuario['usuario']['foto_usuario']:'';
// $idUsuario2 = isset($_POST['idUsuario'])?$Limpiarvar->limpiar($_POST['idUsuario'],'1'):'';

//Resaturar contraseña
$reminder_email =isset($_POST['reminder_email'])?$Limpiarvar->limpiar($_POST['reminder_email'],'0'):'';

//Revisar email o cedula
$email_cedula =isset($_POST['email_cedula'])?$Limpiarvar->limpiar($_POST['email_cedula'],'0'):'';

//Restaurar solo con la pregunta de seguridad
$reminder_email_cedula =isset($_POST['reminder_email_cedula'])?$Limpiarvar->limpiar($_POST['reminder_email_cedula'],'0'):'';
$pregunta =isset($_POST['pregunta'])?$Limpiarvar->limpiar($_POST['pregunta'],'0'):'';
$respuesta =isset($_POST['respuesta'])?$Limpiarvar->limpiar($_POST['respuesta'],'0'):'';

//Restaurar contraseña final
$fp_code =isset($_POST['fp_code'])?$Limpiarvar->limpiar($_POST['fp_code'],'0'):'';
$res_contraseña =isset($_POST['res_contraseña'])?$Limpiarvar->limpiar($_POST['res_contraseña'],'0'):'';
$res_repite_contraseña =isset($_POST['res_repite_contraseña'])?$Limpiarvar->limpiar($_POST['res_repite_contraseña'],'0'):'';

 
 



$op = isset($_GET['op'])?$Limpiarvar->limpiar($_GET['op'],'0'):'No';
$datos = '';
switch ($op) {

	case 'recordarcontrasena':
// Revisar esto aqui
$mail->Username = '97juandcm11@gmail.com'; // Correo completo a utilizar
$mail->Password = 'Revisar'; // Contraseña
$mail->From = '97juandcm11@gmail.com'; // Desde donde enviamos (Para mostrar)
$mail->FromName = 'Juan Colmenares';

$mensaje  = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Activaste la cuenta</title>
<meta name="viewport" content="width=device-width" />
<style type="text/css">
@media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
    body[yahoo] .buttonwrapper { background-color: transparent !important; }
    body[yahoo] .button { padding: 0 !important; }
    body[yahoo] .button a { background-color: #45a7b9; padding: 15px 25px !important; }
}

@media only screen and (min-device-width: 601px) {
    .content { width: 600px !important; }
    .col387 { width: 387px !important; }
}
</style>
</head>
<body bgcolor="#374249" style="margin: 0; padding: 0;" yahoo="fix">
<!--[if (gte mso 9)|(IE)]>
<table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
<tr>
<td>
<![endif]-->
<table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 600px;" class="content">
<tr>
<td align="center" style="padding: 20px 20px 20px 20px; color: #ffffff; font-family: Arial, sans-serif; font-size: 36px; font-weight: bold;">
<img src="img/appui_logo.png" alt="AppUI Logo" width="80" height="80" style="display:block;" />
</td>
</tr>
<tr>
<td align="center" bgcolor="#ffffff" style="padding: 40px 20px 0 20px; color: #555555; font-family: Arial, sans-serif; font-size: 20px; line-height: 30px;">
<b>Ya has activado tu cuenta</b>
</td>
</tr>
<tr>
<td align="center" bgcolor="#ffffff" style="padding: 0 20px 40px 20px; color: #777777; font-family: Arial, sans-serif; font-size: 18px; line-height: 30px; border-bottom: 1px solid #f6f6f6;">
Bienvenido juan colmenares
</td>
</tr>
<tr>
<td align="center" bgcolor="#f9f9f9" style="padding: 30px 20px 30px 20px; font-family: Arial, sans-serif;">
<table bgcolor="#45a7b9" border="0" cellspacing="0" cellpadding="0" class="buttonwrapper">
<tr>
<td align="center" height="55" style=" padding: 0 35px 0 35px; font-family: Arial, sans-serif; font-size: 22px;" class="button">
<a href="#" style="color: #ffffff; text-align: center; text-decoration: none;"> Dirigete a la página web del sistema de correos</a>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="center" bgcolor="#e9e9e9" style="padding: 12px 10px 12px 10px; color: #888888; font-family: Arial, sans-serif; font-size: 12px; line-height: 18px;">
<b>Desarrollador(es) del sitio web.</b> | Juan. &bull; David &bull; Colmenares
</td>
</tr>
<tr>
<td style="padding: 15px 10px 15px 10px;">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td align="center" width="100%" style="color: #999999; font-family: Arial, sans-serif; font-size: 12px;">
2018 &copy; <a href="http://goo.gl/TDOSuC" style="color: #45a7b9;">Página Correo</a>
</td>
</tr>
</table>
</td>
</tr>
</table>
<!--[if (gte mso 9)|(IE)]>
</td>
</tr>
</table>
<![endif]-->
</body>
</html>';
//Agregar destinatario
$mail->AddAddress('97juandcm11@gmail.com');
$mail->Subject = 'asunto';
$mail->Body = $mensaje;
//Para adjuntar archivo
// $mail->AddAttachment($archivo['tmp_name'], $archivo['name']);
$mail->MsgHTML($mensaje);

//Avisar si fue enviado o no y dirigir al index
if($mail->Send())
{
	echo'si se pudo enviar';
}
else{
	echo 'no se pudo enviar debido a: '. $mail->ErrorInfo; ;
}	
break;

case 'registrar':
// echo "hola";
$usu_normal->registrar($register_cedula, $register_username, $register_telefono, $register_email, $register_password, $creado, $register_pregunta_segura, $register_respuesta_segura,$datos);
break;

case 'entrar':
$usu_normal->EntrarUsuario($login_email,$login_password);
break;

case 'editar':
	// $usu_normal->EditarUsuario($idUsuario,$nombre,$apellido,$email,$telefono,$password,$foto_usuario);	
break;

case 'salir':
if(!empty($_REQUEST['op'])){
  unset($_SESSION['DatosUsuario']);
  session_destroy();
}
break;

case 'mostraraño':
$usu_normal->mostraraño();
break;

case 'mostrarcontacto':
$usu_normal->mostrarcontacto($idUsuario);
break;

case 'mostrarseccion':
$usu_normal->mostrarseccion($register_año);
    // echo $register_año;
break;

case 'cambiocontrasena':
          $opciones = ['cost' => 12];
          $contrasenaFinal = password_hash($side_password, PASSWORD_BCRYPT,$opciones);

        $sql = "UPDATE usuario SET usu_contrasena = '$contrasenaFinal' WHERE idusuario = '$idUsuario'";


        $consulta = $usu_normal->ejecutarConsulta($sql,$datos);

        if ($consulta) {
            $sessData['estado']['type'] = 'success';
            $sessData['estado']['msg'] = 'Se actualizo la contraseña.';
        }else{
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'Error al actualizar la contraseña.';

        } 
        echo json_encode($sessData);
  break;

case 'actualizardatos':
$usu_normal->actualizardatos($idUsuario, $side_name, $side_email, $side_telefono, $side_pregunta, $side_respuesta, $foto_usuario, $datos);
    
  break;


case 'revisaremailcedula':

$sql1 = "SELECT * FROM usuario usu INNER JOIN verificacion_usuario verusu ON usu.idusuario = verusu.usu_idusuario WHERE usu.usu_cedula = '$email_cedula' OR usu.usu_correo = '$email_cedula'";


// idusuario idverificacion_usuario  usu_idusuario   pregunta_seguridad  respuesta_seguridad   

$query=$usu_normal->ejecutarConsultaSimpleFila($sql1,$datos);

// Revisar desde aqui
        if ($query) {
    // $totalData = $query->totalmensaje;
            $sessData['estado']['type'] = 'success';
            $sessData['estado']['msg'] = 'Se actualizo la contraseña.';
            $sessData['estado']['pregunta_seguridad'] =  $query->pregunta_seguridad;
        }else{
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'Error al actualizar la contraseña.';

        } 
echo json_encode($sessData);

  break;


case 'restuararconpregunta':
  
$sql1 = "SELECT * FROM usuario usu INNER JOIN verificacion_usuario verusu ON usu.idusuario = verusu.usu_idusuario WHERE usu.usu_cedula = '$reminder_email_cedula' OR usu.usu_correo = '$reminder_email_cedula' AND verusu.pregunta_seguridad = '$pregunta' AND verusu.respuesta_seguridad ='$respuesta'";

// idusuario idverificacion_usuario  usu_idusuario   pregunta_seguridad  respuesta_seguridad   

$query=$usu_normal->ejecutarConsultaSimpleFila($sql1,$datos);

// Revisar desde aqui
        if ($query) {
    $idelusuario = $query->idusuario;

    $unico = md5(uniqid(mt_rand()));
    $olvidocontraseña = $unico;


        $sql = "UPDATE usuario SET usu_olvido_contrasena = '$olvidocontraseña', usu_estado='0' WHERE idusuario = '$idelusuario'";
        $consulta = $usu_normal->ejecutarConsulta($sql,$datos);
// echo $sql;

if ($consulta) {
            $sessData['estado']['type'] = 'success';
            $sessData['estado']['msg'] = 'La respuesta es correcta, espera un poco para el cambio de contraseña';
            $sessData['estado']['recargar'] = $olvidocontraseña;
}else{
              $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'Hay un error al restaurar la contraseña.';
}

        }else{
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'Hay un error en la respuesta.';

        } 
echo json_encode($sessData);
  break;

case 'recuperarcontraseña':
 // echo  $fp_code." ".$res_contraseña." ".$res_repite_contraseña;


// public function enviarContrasena($password,$confirm_password,$fp_code,$datos){
    if(!empty($res_contraseña) && !empty($res_repite_contraseña) && !empty($fp_code)){
        //password and confirm password comparison
        if($res_contraseña != $res_repite_contraseña){
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'Confirmar que las contraseñas deban coincidir.'; 
        }else{

            $sql5 = "SELECT usu_olvido_contrasena FROM usuario WHERE usu_olvido_contrasena='$fp_code'";
            $prevUser = $usu_normal->ejecutarConsultaSimpleFila($sql5,$datos);

            if($prevUser){
        $opciones = ['cost' => 12];
          $contraseNew = password_hash($res_repite_contraseña, PASSWORD_BCRYPT,$opciones);

                $sql6 = "UPDATE usuario SET usu_contrasena = '$contraseNew', usu_olvido_contrasena='', usu_estado='1' WHERE usu_olvido_contrasena = '$fp_code'";
                $update = $usu_normal->ejecutarConsulta($sql6,$datos);
                if($update){
                    $sessData['estado']['type'] = 'success';
                    $sessData['estado']['msg'] = 'La contraseña de su cuenta se ha restablecido con éxito. Por favor inicie sesión con su nueva contraseña.';
                }else{
                    $sessData['estado']['type'] = 'error';
                    $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
                }

            }else{
                $sessData['estado']['type'] = 'error';
                $sessData['estado']['msg'] = 'No está autorizado a restablecer una nueva contraseña de esta cuenta.';
            }
        }
    }else{
        $sessData['estado']['type'] = 'error';
        $sessData['estado']['msg'] = 'Todos los campos son obligatorios, por favor complete todos los campos.'; 
    }

    echo json_encode($sessData);
// }
  break;

  case 'mostrarpreguntarespuesta':

$sql1 = "SELECT * FROM verificacion_usuario WHERE usu_idusuario = '$idUsuario'";
$query=$usu_normal->ejecutarConsultaSimpleFila($sql1,$datos);

// Revisar desde aqui
        if ($query) {
    // $totalData = $query->totalmensaje;
        $sessData['estado']['pregunta_seguridad'] = $query->pregunta_seguridad;
        $sessData['estado']['respuesta_seguridad'] = $query->respuesta_seguridad;
        }
echo json_encode($sessData);
    break;

default:
break;
}

?>
