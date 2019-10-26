<?php 
require_once "Funciones.php";
class Contacto extends Funciones
{
	public function registrocontacto($idUsuario, $register_seccion, $nombreapellido, $correocontacto, $telefonocontacto, $datos){
		$sessData = array(); 
		if (!filter_var($correocontacto, FILTER_VALIDATE_EMAIL)) 
		{
			$sessData['estado']['type'] = 'error';
			$sessData['estado']['msg'] = 'El correo no es valido'; 
		}else{
// Aqui verifico de que el correo no este dentro del sistema
			$sqlcorreo = "SELECT con_correo FROM contacto WHERE con_correo='$correocontacto' LIMIT 1";
			$prevUser = self::ejecutarConsultaSimpleFila($sqlcorreo,$datos);
			if($prevUser){
				$sessData['estado']['type'] = 'error';
				$sessData['estado']['msg'] = 'Ya hat un contacto con este email, Por favor ingrese otro email.';
			}else{

// Aqui verifico de que el correo no este dentro del sistema
				$sqlcorreo2 = "SELECT usu_correo FROM usuario WHERE usu_correo='$correocontacto' LIMIT 1";
				$prevUser2 = self::ejecutarConsultaSimpleFila($sqlcorreo2,$datos);
				if($prevUser2){
					$sessData['estado']['type'] = 'error';
					$sessData['estado']['msg'] = 'Ya hay un usuario con este email, Por favor ingrese otro email.';
				}else{
					$sql = "INSERT INTO contacto (idcontacto, usu_idusuario,sec_idseccion, con_nombre_apellido, con_correo, con_telefono) VALUES (NULL, '$idUsuario', '$register_seccion', '$nombreapellido', '$correocontacto', '$telefonocontacto')";
					$consulta = self::ejecutarConsulta($sql,$datos);
					if ($consulta) {
						$sessData['estado']['type'] = 'success';
						$sessData['estado']['msg'] = 'El contacto se guardo correctamente'; 
					}else{
						$sessData['estado']['type'] = 'error';
						$sessData['estado']['msg'] = 'El contacto no se pudo guardar'; 
					} 
				}
			}
		}
		echo json_encode($sessData);
	}

	public function eliminarcontacto($idcontacto, $datos){
		$sql2 = "DELETE FROM mensaje WHERE contacto_mensaje = '$idcontacto'";
		$consulta2 = self::ejecutarConsulta($sql2,$datos);

		$sql = "DELETE FROM contacto WHERE idcontacto = '$idcontacto'";
		$consulta = self::ejecutarConsulta($sql,$datos);

		if ($consulta && $consulta2) {
			$sessData['estado']['type'] = 'success';
			$sessData['estado']['msg'] = 'El contacto se elimino correctamente'; 
		}else{
			$sessData['estado']['type'] = 'error';
			$sessData['estado']['msg'] = 'El contacto no se pudo eliminar'; 
		} 
		echo json_encode($sessData);
	}

public function mostrarcontactosdeusuario($idUsuario, $datos){
$requestData = $_POST;
        $columns = array( 
            0 =>'cont.con_nombre_apellido',
            1 =>'cont.con_correo',
            2 =>'cont.con_telefono',
            3 =>'sec.sec_descripcion',
            4 =>'añ.año_numero'
        );

       // SELECT cont.idcontacto, cont.con_nombre_apellido, cont.con_correo, cont.con_telefono FROM contacto cont WHERE cont.usu_idusuario = '3' 
        // SELECT COUNT(cont.idcontacto) AS totalmensaje FROM contacto cont WHERE cont.usu_idusuario = '3' 
// inv_iden, usu_iden, inv_nomb, inv_desc, inv_prec, inv_fech, inv_foto, inv_cant, inv_esta
// getting total number records without any search
        $sql1 = "SELECT COUNT(cont.idcontacto) AS totalmensaje FROM contacto cont WHERE cont.usu_idusuario = '$idUsuario'";
        $query=self::ejecutarConsultaSimpleFila($sql1,$datos);

// Revisar desde aqui
        if ($query) {
            $totalData = $query->totalmensaje;
        }
        $sql = "SELECT cont.idcontacto, cont.con_nombre_apellido, cont.con_correo, cont.con_telefono, sec.sec_descripcion, añ.año_numero FROM contacto cont INNER JOIN seccion sec ON sec.idseccion = cont.sec_idseccion INNER JOIN año añ ON añ.idaño = sec.año_idaño WHERE cont.usu_idusuario = '$idUsuario'";
// getting records as per search parameters
if( isset($requestData['search']) && $requestData['search'] !== "" ){   //name
    $sql.=" AND cont.con_nombre_apellido LIKE '%".addslashes($requestData['search']['value'])."%' ";
}
// Revisar esto
$query=self::ejecutarConsultaCantidadRow($sql,$datos);
$totalFiltered = $query;

$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";  // adding length
$query=self::ejecutarConsultaTodasFilas($sql,$datos);
$data=array();
if ($query) {
    foreach ($query as $row) {
        // $fechaOriginal = $row->inv_fech;
        // $fechaFormateada = date("d-m-Y", strtotime($fechaOriginal));
        // $foto = empty($row->inv_foto)?'indice.png':$row->inv_foto;
        $data[]=array(  "0"=>$row->con_nombre_apellido,
            "1"=>$row->con_correo,
            '2'=>$row->con_telefono,
            '3'=>$row->sec_descripcion,
            '4'=>$row->año_numero,           
            '5'=>'
            <button type="button" class="btn btn-danger" title="Eliminar contacto" onclick="eliminarcontacto(\''.$row->idcontacto.'\');"><i class="fa fa-trash"></i></button>
            <button type="button" class="btn btn-success" title="Editar contacto" onclick="editarcontacto(\''.$row->idcontacto.'\');" href="#modal-editar-contacto" data-toggle="modal"><i class="fa fa-edit"></i></button>'
        );
    }
}else{
    $data[]=array(  "0"=>'',
                    "1"=>'No hay',
                    "2"=>'ningún contacto',
                    "3"=>'',"4"=>'',"5"=>'',);
}

$json_data = array(
    "sEcho"=>intval( $requestData['draw'] ),  //Informacion para el datatables
    "iTotalRecords"=>intval( $totalData ),//enviamos el total de registros al datatable 
    "iTotalDisplayRecords"=>intval( $totalFiltered ),//enviamos el total registros a visualizar 
    "aaData"=>$data
);
echo json_encode($json_data);  // send data as json format      
}
}
?>