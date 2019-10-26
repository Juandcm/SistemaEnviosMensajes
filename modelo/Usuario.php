<?php 
require_once "Funciones.php";

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer();
//Este bloque es importante
$mail->IsSMTP();
$mail->SMTPAuth = true;
// $mail->SMTPSecure = "ssl";
$mail->CharSet="UTF-8";
$mail->IsHTML(true); // El correo se envía como HTML
$mail->Port = 25; // Puerto a utilizar
$mail->Host = 'smtp.gmail.com'; // SMTP a utilizar. Por ej. smtp.elserver.com


class Usuario extends Funciones
{
	public function EntrarUsuario($login_email,$login_password){
		if (!filter_var($login_email, FILTER_VALIDATE_EMAIL)) 
		{
			$sessData['estado']['type'] = 'error';
			$sessData['estado']['msg'] = 'El correo no es valido'; 
		}else{
    // Aqui verifico si el usuario esta activo en el sistema
			$sql = "SELECT * FROM usuario WHERE usu_correo='$login_email' AND usu_estado='1' LIMIT 1 ";
			$datos1='';
			$prevUser = self::ejecutarConsultaSimpleFila($sql,$datos1);

    // Aqui verifico si el usuario esta inactivo en el sistema
			$sql2 = "SELECT usu_correo FROM usuario WHERE usu_correo='$login_email' AND usu_estado='0' LIMIT 1";
			$datos2='';
			$prevUser2 = self::ejecutarConsultaSimpleFila($sql2,$datos2);

    //Aqui verifico solo el correo
			$sql3 = "SELECT usu_correo FROM usuario WHERE usu_correo='$login_email' LIMIT 1";
			$datos='';
			$prevUser3 = self::ejecutarConsultaSimpleFila($sql3,$datos);

 // Textos completos	idusuario 	sec_idseccion 	usu_cedula 	usu_nombre_apellido 	usu_telefono 	usu_correo 	usu_contrasena 	usu_olvido_contrasena 	usu_foto 	usu_cargo 	usu_fecha_registro 	usu_estado 
			if($prevUser){

				if (password_verify($login_password, $prevUser->usu_contrasena)) {
					$sessData['estado']['type'] = 'success';
					$sessData['estado']['msg'] = 'Bienvenido '.$prevUser->usu_nombre_apellido;
    // // Aqui asigno la id del usuario a la session
					$sessionUsuario['usuario']['id'] = $prevUser->idusuario;
					$sessionUsuario['usuario']['nombre'] = $prevUser->usu_nombre_apellido;
					$sessionUsuario['usuario']['email'] = $prevUser->usu_correo; 
					$sessionUsuario['usuario']['telefono'] = $prevUser->usu_telefono;
					$sessionUsuario['usuario']['foto_usuario']=$prevUser->usu_foto;
					$sessionUsuario['usuario']['permiso']=$prevUser->usu_cargo;
					$sessionUsuario['usuario']['creado']=$prevUser->usu_fecha_registro;
					$_SESSION['DatosUsuario'] = $sessionUsuario;

				}else{
					$sessData['estado']['type'] = 'error';
					$sessData['estado']['msg'] = 'El email es correcto pero la contraseña no lo es, intenta de nuevo con otra contraseña';
				}
			}elseif($prevUser2>0) {
				$sessData['estado']['type'] = 'error';
				$sessData['estado']['msg'] = 'No puedes entrar ya que estas desactivado, revisa tu correo para poder entrar a la página web';
			}else{
				if ($prevUser3>0) {}else{
					$sessData['estado']['type'] = 'error';
					$sessData['estado']['msg'] = 'El Email que ingreso no se encuentra en el sistema, por favor ingrese el correo correctamente'; 
				}
			}
		}
		echo json_encode($sessData);
	}

	public function mostraraño(){
		$sql = "SELECT idaño, año_numero FROM año";
		$idvalue = 'idaño';
		$nombreoption = 'año_numero';
		self::combosSelect($sql,$idvalue,$nombreoption);
	}
	public function mostrarseccion($register_año){
		$sql = "SELECT se.idseccion, se.sec_descripcion FROM año an INNER JOIN seccion se ON se.año_idaño = an.idaño WHERE an.idaño = '$register_año'";
		$idvalue = 'idseccion';
		$nombreoption = 'sec_descripcion';
		self::combosSelect($sql,$idvalue,$nombreoption);
	}

	public function mostrarcontacto($idUsuario){
		$sql = "SELECT idcontacto, con_nombre_apellido, con_correo FROM contacto WHERE usu_idusuario = '$idUsuario'";
		$idvalue = 'idcontacto';
		$nombreoption = 'con_correo';
		$sessData['estado']['type'] .= self::combosSelect($sql,$idvalue,$nombreoption);
		echo json_decode($sessData);
	}




	public function registrar($register_cedula, $register_username, $register_telefono, $register_email, $register_password, $creado, $register_pregunta_segura, $register_respuesta_segura,$datos){
		$direccionfile = dirname(__FILE__); 
		$ubicacionsubida = '/Archivos/';
		$archivoTemporal = isset($_FILES['register_foto']['tmp_name'])?$_FILES['register_foto']['tmp_name']:'';
		$name = $_FILES['register_foto']['name']; 
		$datos = self::subirArchivo($direccionfile,$archivoTemporal,$name,$ubicacionsubida);

		foreach ($datos as $key=>$valor) {
			if ($key =='0') {
				$boolean = $valor;
			}elseif ($key=='1') {
				$direcccionCompleta1 = $valor;
			}else{

			}
		}

		if ($boolean=='false') {
			$sessData['estado']['type'] = 'error';
			$sessData['estado']['msg'] = 'Hubo un error al subir la imagen';
		}else{
			if (!filter_var($register_email, FILTER_VALIDATE_EMAIL)) 
			{
				$sessData['estado']['type'] = 'error';
				$sessData['estado']['msg'] = 'El correo no es valido'; 
			}else{
// Aqui verifico de que el correo no este dentro del sistema
				$sqlcorreo = "SELECT usu_correo FROM usuario WHERE usu_correo='$register_email' LIMIT 1";
				$prevUser = self::ejecutarConsultaSimpleFila($sqlcorreo,$datos);
				if($prevUser){
					$sessData['estado']['type'] = 'error';
					$sessData['estado']['msg'] = 'Email existe, Por favor ingrese otro email.';
				}else{

// En este caso, queremos aumentar el coste predeterminado de BCRYPT a 12.
// Observe que también cambiamos a BCRYPT, que tendrá siempre 60 caracteres.
					$opciones = ['cost' => 12];
					$contrasenaFinal = password_hash($register_password, PASSWORD_BCRYPT,$opciones);
// // Los datos que queremos insertar
// //Esto sirve para guardar datos en la BD y devolver el id de ese registro al mismo tiempo
					$sql = "INSERT INTO usuario (idusuario, usu_cedula, usu_nombre_apellido, usu_telefono, usu_correo, usu_contrasena, usu_olvido_contrasena, usu_foto, usu_cargo, usu_fecha_registro, usu_estado) VALUES (NULL, '$register_cedula', '$register_username', '$register_telefono', '$register_email', '$contrasenaFinal', NULL, '$direcccionCompleta1', NULL, '$creado', '1')";
					$retorno = self::ejecutarConsulta_retornrID($sql,$datos);

					$sql2 = "INSERT INTO verificacion_usuario (idverificacion_usuario, usu_idusuario, pregunta_seguridad, respuesta_seguridad) VALUES (NULL, '$retorno', '$register_pregunta_segura', '$register_respuesta_segura')";
					$consulta = self::ejecutarConsulta($sql2,$datos);


// // Envio del correo
// $mail->Username = '97juandcm11@gmail.com'; // Correo completo a utilizar
// $mail->Password = 'Juandcm1197*'; // Contraseña
// $mail->From = '97juandcm11@gmail.com'; // Desde donde enviamos (Para mostrar)
// $mail->FromName = 'Juan Colmenares';

// $mensaje  = 'Te registraste exitosamente';
// //Agregar destinatario
// $mail->AddAddress('97juandcm11@gmail.com');
// $mail->Subject = 'Registro del correo';
// $mail->Body = $mensaje;
// //Para adjuntar archivo
// // $mail->AddAttachment($archivo['tmp_name'], $archivo['name']);
// $mail->MsgHTML($mensaje);

//Avisar si fue enviado o no y dirigir al index
// if($mail->Send() && $consulta)
if ($consulta)
{
	$sessData['estado']['type'] = 'success';
	$sessData['estado']['msg'] = 'Te registraste correctamente ';
}
else{
	$sessData['estado']['type'] = 'error';
	$sessData['estado']['msg'] = 'Error al guardar los datos.';
}   

}
}
		}
		echo json_encode($sessData);
	}



public function actualizardatos($idUsuario, $side_name, $side_email, $side_telefono, $side_pregunta, $side_respuesta,$foto_usuario, $datos){
$direccionfile = dirname(__FILE__); 
    $ubicacionsubida = '/Archivos/';
    $archivoTemporal = isset($_FILES['side-profile-file']['tmp_name'])?$_FILES['side-profile-file']['tmp_name']:'';
    $name = $_FILES['side-profile-file']['name']; 
    $datos = self::subirArchivo($direccionfile,$archivoTemporal,$name,$ubicacionsubida);

    foreach ($datos as $key=>$valor) {
      if ($key =='0') {
        $boolean = $valor;
      }elseif ($key=='1') {
        $direcccionCompleta1 = $valor;
      }else{
      }
    }


    if ($boolean=='false') {
      $sessData['estado']['type'] = 'error';
      $sessData['estado']['msg'] = 'Hubo un error al subir la imagen';
    }else{

$sql2 = "UPDATE verificacion_usuario SET pregunta_seguridad = '$side_pregunta', respuesta_seguridad = '$side_respuesta' WHERE usu_idusuario = '$idUsuario'";
$consulta2 = self::ejecutarConsulta($sql2,$datos);


if ($direcccionCompleta1=='') {
$sql = "UPDATE usuario SET usu_nombre_apellido = '$side_name', usu_telefono = '$side_telefono', usu_correo='$side_email' WHERE idusuario = '$idUsuario'";
}else{
        $sql = "UPDATE usuario SET usu_nombre_apellido = '$side_name', usu_telefono = '$side_telefono', usu_correo='$side_email', usu_foto='$direcccionCompleta1' WHERE idusuario = '$idUsuario'";
}
        $consulta = self::ejecutarConsulta($sql,$datos);

        if ($consulta && $consulta2) {
            $sessData['estado']['type'] = 'success';
            $sessData['estado']['msg'] = 'Se actualizaron los datos correctamente.';

if ($direcccionCompleta1=='') {

// $foto_usuario = !empty($DataUsuario['usuario']['foto_usuario'])?$DataUsuario['usuario']['foto_usuario']:'';

$fotofinal = $foto_usuario;
}else{
$fotofinal = str_replace('C:\xampp\htdocs\SistemaEnvioCorreos\modelo/Archivos/', 'C:xampphtdocsSistemaEnvioCorreosmodelo/Archivos/',$direcccionCompleta1);

}
    // // Aqui asigno la id del usuario a la session
          $sessionUsuario['usuario']['id'] = $idUsuario;
          $sessionUsuario['usuario']['nombre'] = $side_name;
          $sessionUsuario['usuario']['email'] = $side_email; 
          $sessionUsuario['usuario']['telefono'] = $side_telefono;
          $sessionUsuario['usuario']['foto_usuario']=$fotofinal;
          $sessionUsuario['usuario']['permiso']='';
          $sessionUsuario['usuario']['creado']=$creadoUsuario;
          $_SESSION['DatosUsuario'] = $sessionUsuario;

        }else{
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'Error al actualizar los datos.';

        } 
      }
        echo json_encode($sessData);
}



}



?>