<?php 
require_once "Funciones.php";
class Mensaje extends Funciones
{
    public function enviarmensaje($asunto, $fcompose_message, $creado, $datos){
$direccionfile = dirname(__FILE__); 
    $ubicacionsubida = '/Archivos/';
    $archivoTemporal = isset($_FILES['archivomensaje']['tmp_name'])?$_FILES['archivomensaje']['tmp_name']:'';
    $name = $_FILES['archivomensaje']['name']; 
    $datos = self::subirArchivo($direccionfile,$archivoTemporal,$name,$ubicacionsubida);

    foreach ($datos as $key=>$valor) {
      if ($key =='0') {
        $boolean = $valor;
      }elseif ($key=='1') {
        $direcccionCompleta1 = $valor;
      }else{
      }
    }

if (isset($_POST['fcompose_users'])) {
    if (is_array($_POST['fcompose_users']) && !empty($_POST['fcompose_users'])) {
        $num_countries = count($_POST['fcompose_users']);

        foreach ($_POST['fcompose_users'] as $key =>$value) {
 $sql = "INSERT INTO mensaje (idmensaje, contacto_mensaje, men_asunto, men_descripcion, men_archivo, men_fecha_envio,men_estado) VALUES (NULL, '$value', '$asunto', '$fcompose_message', '$direcccionCompleta1', '$creado','1');";
        $consulta = self::ejecutarConsulta($sql,$datos);
        if ($consulta) {
            $sessData['estado']['type'] = 'success';
            $sessData['estado']['msg'] = 'Se envio el mensaje correctamente.';
        }else{
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'Error al enviar el mensaje.';

        }
        }
    }
}
        echo json_encode($sessData);
}

    public function moverpapelera($idmensaje,$datos){

// UPDATE mensaje SET men_estado = '0' WHERE idmensaje = '7';
// UPDATE mensaje SET men_estado = '0' WHERE idmensaje = '8';null
if (isset($_POST['idmensajes'])) {
    if (is_array($_POST['idmensajes']) && !empty($_POST['idmensajes'])) {
        $num_countries = count($_POST['idmensajes']);
        foreach ($_POST['idmensajes'] as $key =>$value) {
        $sql1 = "UPDATE mensaje SET men_estado = '0' WHERE idmensaje = '$value';";
        $consulta = self::ejecutarConsulta($sql1,$datos);
        if ($consulta) {
            $sessData['estado']['type'] = 'success';
            $sessData['estado']['msg'] = 'Se movio correctamente';
        }else{
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'Error al mover el mensaje.';

        } 
        }
    }
}else{
        $sql = "UPDATE mensaje SET men_estado = '0' WHERE idmensaje = '$idmensaje'";
        $consulta = self::ejecutarConsulta($sql,$datos);
        if ($consulta) {
            $sessData['estado']['type'] = 'success';
            $sessData['estado']['msg'] = 'Se movio correctamente';
        }else{
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'Error al mover el mensaje.';

        } 
}    


        echo json_encode($sessData);
    }

    public function eliminarmensaje($idmensaje,$datos){
        $sql = "DELETE FROM mensaje WHERE idmensaje = '$idmensaje'";
        $consulta = self::ejecutarConsulta($sql,$datos);
        if ($consulta) {
            $sessData['estado']['type'] = 'success';
            $sessData['estado']['msg'] = 'El mensaje se elimino correctamente'; 
        }else{
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'El mensaje no se pudo eliminar'; 
        } 
        echo json_encode($sessData);
    }

public function mostrarmensajesenviados($idUsuario, $datos){
$requestData = $_POST;
    $columns = array( 
        0 =>'men.men_asunto'
    );
// inv_iden, usu_iden, inv_nomb, inv_desc, inv_prec, inv_fech, inv_foto, inv_cant, inv_esta
// getting total number records without any search
    $sql1 = "SELECT COUNT(men.idmensaje) AS totalmensaje FROM mensaje men INNER JOIN contacto cont ON cont.idcontacto = men.contacto_mensaje WHERE cont.usu_idusuario = '$idUsuario' AND men.men_estado = '1'";
    $query=self::ejecutarConsultaSimpleFila($sql1,$datos);

// Revisar desde aqui
    if ($query) {
        $totalData = $query->totalmensaje;
    }
    $sql = "SELECT men.idmensaje, men.men_asunto , men.men_descripcion, men.men_archivo, men.men_fecha_envio, cont.con_nombre_apellido, cont.con_correo, cont.con_telefono FROM mensaje men INNER JOIN contacto cont ON cont.idcontacto = men.contacto_mensaje WHERE cont.usu_idusuario = '$idUsuario' AND men.men_estado = '1'";
// getting records as per search parameters
if( isset($requestData['search']) && $requestData['search'] !== "" ){   //name
    $sql.=" AND men.men_asunto  LIKE '%".addslashes($requestData['search']['value'])."%' ";
}
// Revisar esto
$query=self::ejecutarConsultaCantidadRow($sql,$datos);
$totalFiltered = $query;

$sql.=" ORDER BY men.men_asunto ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";  // adding length
$query=self::ejecutarConsultaTodasFilas($sql,$datos);
$data=array();
$tipodemensaje = '2';
if ($query) {
    foreach ($query as $row) {
        // $fechaOriginal = $row->inv_fech;
        // $fechaFormateada = date("d-m-Y", strtotime($fechaOriginal));
        // $foto = empty($row->inv_foto)?'indice.png':$row->inv_foto;
        $archivo = empty($row->men_archivo)?'':'<div class="text-center" style="width: 30px;">
        <i class="fa fa-paperclip fa-2x text-muted"></i>
        </div>';
        $data[]=array("0"=>$row->idmensaje,  
            "1"=>'
            <div class="container-fluid">
            <div class="row">
            <div class="col-xs-2">
            <div class="text-center" style="width: 7%;">
            <img src="img/placeholders/avatars/avatar1.jpg" alt="avatar" class="img-circle">
            </div>
            </div>
            <div class="col-xs-6">
            <div>
            <h4>
            <a href="javascript:void(0)" onclick="mostrardetallemensaje(\''.$row->idmensaje.'\',\''.$tipodemensaje.'\');" class="text-dark">
            <strong>'.$row->men_asunto .'</strong>
            </a>
            </h4>
            <span class="text-muted">'.self::cortarletras($row->men_descripcion).'</span>
            </div>
            </div>
            <div class="col-xs-1">
            '.$archivo.'
            </div>

            <div class="col-xs-2">
            <div class="text-center text-muted" style="width: 120px;">
            <em>'.$row->men_fecha_envio.'</em>
            </div>
            </div>
            </div>

            </div>
            '
        );

    }
}else{
    $data[]=array(  "0"=>'',"1"=>'<div class="text-center">
        No hay nada
    </div>');
}

$json_data = array(
    "sEcho"=>intval( $requestData['draw'] ),  //Informacion para el datatables
    "iTotalRecords"=>intval( $totalData ),//enviamos el total de registros al datatable 
    "iTotalDisplayRecords"=>intval( $totalFiltered ),//enviamos el total registros a visualizar 
    "aaData"=>$data
);
echo json_encode($json_data);  // send data as json format  
// echo $sql."<br>".$sql1;
}

public function mostrarmensajeseliminados($idUsuario, $datos){
$requestData = $_POST;
$columns = array( 
    0 =>'men.men_asunto '
);
// inv_iden, usu_iden, inv_nomb, inv_desc, inv_prec, inv_fech, inv_foto, inv_cant, inv_esta
// getting total number records without any search
$sql1 = "SELECT COUNT(men.idmensaje) AS totalmensaje FROM mensaje men INNER JOIN contacto cont ON cont.idcontacto = men.contacto_mensaje WHERE cont.usu_idusuario = '$idUsuario' AND men.men_estado = '0'";
        // $sql1 = "SELECT COUNT(men.idmensaje) AS totalmensaje FROM mensaje men INNER JOIN contacto cont ON cont.idcontacto = men.contacto_mensaje WHERE cont.usu_idusuario = '$idUsuario' AND men.men_estado = '0'";

$query=self::ejecutarConsultaSimpleFila($sql1,$datos);

// Revisar desde aqui
if ($query) {
    $totalData = $query->totalmensaje;
}
$sql = "SELECT men.idmensaje, men.men_asunto , men.men_descripcion, men.men_archivo, men.men_fecha_envio FROM mensaje men INNER JOIN contacto cont ON cont.idcontacto = men.contacto_mensaje WHERE cont.usu_idusuario = '$idUsuario' AND men.men_estado = '0'";
        // $sql = "SELECT men.idmensaje, men.men_asunto , men.men_descripcion, men.men_archivo, men.men_fecha_envio FROM mensaje men INNER JOIN contacto cont ON cont.idcontacto = men.contacto_mensaje WHERE cont.usu_idusuario = '$idUsuario' AND men.men_estado = '0' ";
// getting records as per search parameters
if( isset($requestData['search']) && $requestData['search'] !== "" ){   //name
    $sql.=" AND men.men_asunto LIKE '%".addslashes($requestData['search']['value'])."%' ";
}
// Revisar esto
$query=self::ejecutarConsultaCantidadRow($sql,$datos);
$totalFiltered = $query;

$sql.=" ORDER BY men.men_asunto ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";  // adding length
$query=self::ejecutarConsultaTodasFilas($sql,$datos);
$data=array();
$tipodemensaje = '0';
if ($query) {
    foreach ($query as $row) {
        // $fechaOriginal = $row->inv_fech;
        // $fechaFormateada = date("d-m-Y", strtotime($fechaOriginal));
        // $foto = empty($row->inv_foto)?'indice.png':$row->inv_foto;
        $archivo = empty($row->men_archivo)?'':'<div class="text-center" style="width: 30px;">
        <i class="fa fa-paperclip fa-2x text-muted"></i>
        </div>';
        $data[]=array(  
"0"=>$row->idmensaje,  
            "1"=>'
            <div class="container-fluid">
            <div class="row">
            <div class="col-xs-6">
            <div>
            <h4>
            <a href="javascript:void(0)" onclick="mostrardetallemensaje(\''.$row->idmensaje.'\',\''.$tipodemensaje.'\');" class="text-dark">
            <strong>'.$row->men_asunto .'</strong>
            </a>
            </h4>
            <span class="text-muted">'.self::cortarletras($row->men_descripcion).'</span>
            </div>
            </div>
            <div class="col-xs-1">
            '.$archivo.'
            </div>

            <div class="col-xs-2">
            <div class="text-center text-muted" style="width: 120px;">
            <em>'.$row->men_fecha_envio.'</em>
            </div>
            </div>
            </div>

            </div>
            '
        );

    }
}else{
    $data[]=array(  "0"=>'',"1"=>'<div class="text-center">
        No hay nada
    </div>');
}

$json_data = array(
    "sEcho"=>intval( $requestData['draw'] ),  //Informacion para el datatables
    "iTotalRecords"=>intval( $totalData ),//enviamos el total de registros al datatable 
    "iTotalDisplayRecords"=>intval( $totalFiltered ),//enviamos el total registros a visualizar 
    "aaData"=>$data
);
echo json_encode($json_data);  // send data as json format  

}


public function detallemensaje($tipomensaje, $idmensaje, $idUsuario, $nombre,$email, $datos){
   // tipo == '1' enviados 
    // tipo == '2' recibidos
    // tipo == '0' eliminados 
switch ($tipomensaje) {
    case '0':
// SELECT men.idmensaje FROM mensaje men WHERE men.idmensaje = '$idmensaje' AND men.usuario_envia_mensaje = '$idUsuario' 

 $sql3 = "SELECT men.idmensaje, men.men_asunto , men.men_descripcion, men.men_archivo, men.men_fecha_envio, cont.con_nombre_apellido, cont.con_correo, cont.con_telefono FROM mensaje men INNER JOIN contacto cont ON cont.idcontacto = men.contacto_mensaje WHERE cont.usu_idusuario = '$idUsuario' AND men.idmensaje='$idmensaje'";
    break;

    case '2':
    $sql3 = "SELECT men.idmensaje, men.men_asunto , men.men_descripcion, men.men_archivo, men.men_fecha_envio, cont.con_nombre_apellido, cont.con_correo, cont.con_telefono FROM mensaje men INNER JOIN contacto cont ON cont.idcontacto = men.contacto_mensaje WHERE cont.usu_idusuario = '$idUsuario' AND men.idmensaje='$idmensaje' ";
    break;

    default:
    break;
}
$resultado = self::ejecutarConsultaSimpleFila($sql3,$datos);
// <a href="javascript:void(0)" class="btn btn-effect-ripple btn-default" id="message-view-back1"><i class="fa fa-chevron-left"></i> Regresar</a>
if ($resultado) {
    switch ($tipomensaje) {
    // Revisar aqui esto
        case '0':
        $mostrarusuario = '<p>De 
        <a href="javascript:void(0)"><strong>'.$nombre.'</strong></a> 
        <strong>&lt;'.$email.'&gt;</strong>
        Para 
        <a href="javascript:void(0)"><strong>'.$resultado->con_nombre_apellido.'</strong></a> 
        <strong>&lt;'.$resultado->con_correo.'&gt;</strong> 
        </p>';
        break;

        case '2':
        $mostrarusuario = '<p>De 
        <a href="javascript:void(0)"><strong>'.$nombre.'</strong></a> 
        <strong>&lt;'.$email.'&gt;</strong>
        Para 
        <a href="javascript:void(0)"><strong>'.$resultado->con_nombre_apellido.'</strong></a> 
        <strong>&lt;'.$resultado->con_correo.'&gt;</strong> 
        </p>';
        break;

        default:
        break;
    }

    if ($tipomensaje=='0') {
        $valor = '';
        $valor2 = '<a href="javascript:void(0)" class="btn btn-effect-ripple btn-danger" data-toggle="tooltip" title="Eliminar mensaje" onclick="eliminarmensaje(\''.$resultado->idmensaje.'\');"><i class="fa fa-trash"></i></a>';
    }else{
        $valor = '<!-- Quick Reply Form -->
        <form action="page_app_email.php" method="post" onsubmit="return false;">
        <textarea name="message-quick-reply" rows="5" class="form-control push-bit" placeholder="Reenviar otro mensaje a este contacto"></textarea>
        <button class="btn btn-effect-ripple btn-primary"><i class="fa fa-share"></i> Enviar Mensaje</button>
        </form>
        <!-- END Quick Reply Form -->';
        $valor2 = '<a href="javascript:void(0)" class="btn btn-effect-ripple btn-danger" data-toggle="tooltip" title="Mover a la papelera" onclick="moverpapelera(\''.$resultado->idmensaje.'\',\''.$tipomensaje.'\');"><i class="fa fa-times"></i></a>';
    }

    $men_archivo = $resultado->men_archivo;
if ($men_archivo =='') {
    $fotofinal = '';
    $mostrarfinal = '';
}else{
$fotofinal = str_replace('C:xampphtdocsSistemaEnvioCorreosmodelo/Archivos/', 'modelo/Archivos/',$men_archivo);
$mostrarfinal = '<div class="col-xs-6 col-sm-6 col-lg-6 text-center">
<p><strong>Descargar archivo: </strong><a href="'.$fotofinal.'" download> <button class="btn btn-primary"><i class="fa fa-download"></i></button></a></p></div>';
}


    echo '<!-- Title -->
    <div class="block-title clearfix">
    <div class="block-options pull-right">
    '.$valor2.'
    </div>
    <div class="block-options pull-left">

    <button class="btn btn-effect-ripple btn-default" id="message-view-back1" onclick="regresarenviados(\''.$tipomensaje.'\')"><i class="fa fa-chevron-left"></i> Regresar</button>

    </div>
    </div>
    <!-- END Title -->

    <!-- Header -->
    <h3><strong>'.$resultado->men_asunto .' </strong></h3> <small>Fecha de envio: <em>'.$resultado->men_fecha_envio.'</em></small>
    '.$mostrarusuario.'
    <!-- END Header -->





    <!-- Message Body -->
    <hr>
    <p class="text-justify">'.$resultado->men_descripcion.'</p>
    <hr>
    <!-- END Message Body -->
    <!-- Attachments Row -->
    <div class="row block-section">

'.$mostrarfinal.'

    </div>
    <!-- END Attachments Row -->';
    // '.$valor.'';
}else{
   echo "no se encontro nada";
}

}



}
?>