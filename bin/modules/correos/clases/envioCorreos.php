<?php
include '../../../../core.php';
require '../PHPMailerAutoload.php';
include_once Config::$home_bin.Config::$ds.'db'.Config::$ds.'active_table.php'; 
 class Estudiante extends ADOdb_Active_Record{}
class listCorreo
{

public function reg_estudiante($codigo,$identificacion,$primer_apellido,$segundo_apellido,$primer_nombre,$segundo_nombre,$direccion,$telefono,$email,$discapacidad,$fecha_nacimiento, $usuario)  
     
    {
      //var_dump($codigo,$identificacion,$primer_apellido,$segundo_apellido,$primer_nombre,$segundo_nombre,$direccion,$telefono,$email,$discapacidad,$fecha_nacimiento);
       
        $reg              = new Estudiante('estudiante');
        $reg->codigo              =$codigo;       
        $reg->identificacion      = $identificacion;
        $reg->primer_apellido = $primer_apellido;
        $reg->segundo_apellido = $segundo_apellido;
        $reg->primer_nombre = $primer_nombre;
        $reg->segundo_nombre = $segundo_nombre;
        $reg->direccion = $direccion;
        $reg->telefono = $telefono;
        $reg->email = $email;
        $reg->discapacidad = $discapacidad;
        $reg->fecha_nacimiento = $fecha_nacimiento;        
        $reg->id_estado = 2;  
        $reg->usuario = $usuario;      
        $reg->Save();
         //var_dump($reg);
        //return $reg->id_estudiante;
    }

public function buscarGrado($idestudiante){
        $db = App::$base;
        $sql = "SELECT 
                  `estudiantexgrado`.`id_grado`,
                  `estudiantexgrado`.`id_estudiante`,
                  `estudiantexgrado`.`desde`,
                  `estudiantexgrado`.`hasta`,
                  `estudiantexgrado`.`estado_grado`
                FROM
                  `estudiantexgrado`
                  INNER JOIN `grado` ON (`estudiantexgrado`.`id_grado` = `grado`.`id_grado`)
                  INNER JOIN `estudiante` ON (`estudiantexgrado`.`id_estudiante` = `estudiante`.`id_estudiante`)
                WHERE
                  `estudiantexgrado`.`id_estudiante` = ? AND 
                  `estudiantexgrado`.`estado_grado` = 1
                LIMIT 1";
                $rs = $db->dosql($sql, array($idestudiante));

                return $rs->fields['id_grado'];
}


public function listarDocentesCorreo($id)
{
	$con = App::$base;
    $sql = "SELECT 
              `docente`.`nombre_completo`,
              `docente`.`user_email` as mail,
              CONCAT(`grado`.`descripcion`,' ',
              `grado`.`letra`) as grado,
              `materia`.`descripcion` as materia,
              `grado`.`id_grado`,
              `materia_organizada`.`cod_docente`,
              
               \"
              <button type=\'button\' class=\'btn btn-info btn-sm btn_edit\' data-title=\'Edit\' data-toggle=\'modal\' data-target=\'#myModal\' >
               <span class=\'glyphicon glyphicon-envelope\'></span></button>
               </div>
                \" 
               as editar,
               \"
              <button type=\'button\' class=\'btn btn-danger btn-sm btn_delete\' data-title=\'Edit\'>
               <span class=\'glyphicon glyphicon-trash\'></span></button>
               </div>
                \"
                 as borrar                    
            FROM
          `docente`
          INNER JOIN `materia_organizada` ON (`docente`.`id_docente` = `materia_organizada`.`cod_docente`)
          INNER JOIN `materiaxgrado` ON (`materia_organizada`.`cod_mxg` = `materiaxgrado`.`id_mxg`)
          INNER JOIN `materia` ON (`materiaxgrado`.`cod_materia` = `materia`.`id_materia`)
          INNER JOIN `grado` ON (`materiaxgrado`.`cod_grado` = `grado`.`id_grado`)
          INNER JOIN `estudiantexgrado` ON (`estudiantexgrado`.`id_grado` = `grado`.`id_grado`)
          INNER JOIN `estudiante` ON (`estudiantexgrado`.`id_estudiante` = `estudiante`.`id_estudiante`)
        WHERE
          `grado`.`id_grado` = ?
        GROUP BY
          materia.descripcion
            ";

		$rs = $con->dosql($sql, array($this->buscarGrado($id)));
        $tabla = '<table id="myTable" class="table table-hover table-striped table-bordered table-condensed" cellpadding="0" cellspacing="0" border="1" class="display" >
                        <thead>
                        <tr>
                        <th id="yw9_c0">Nombre Docente</th>
                        <th id="yw9_c1">Grado</th>
                        <th id="yw9_c2">Materia</th>
                        <th id="yw9_c2">Mail</th>
                        <th id="yw9_c7">Redactar</th>
                        
                        </tr>
                        </thead>
                        <tbody>';
		          while (!$rs->EOF) 
                   {
                   	$tabla.='<tr >  
                            <td>                            
                                '.utf8_encode($rs->fields['nombre_completo']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['grado']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['materia']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['mail']).'
                            </td>
                                                      
                                                    
                            <td align="center" width= "30" onclick="editar('.$rs->fields['cod_docente'].')">                            
                                '.utf8_encode($rs->fields['editar']).'
                            </td>
' ;                                                                               
                            
            $tabla.= '</tr>';                                     
	
	               $rs->MoveNext();	    
                   }  
            
        $tabla.="</tbody></table>";
        return $tabla;

}

 public function buscarCorreoDocente($id)
  {
    $db = App::$base;
        $sql = "SELECT
                 user_email
                 FROM
                 docente
                 WHERE id_docente = ?";
    $rs = $db->dosql($sql, array($id));

    return $rs->fields['user_email'];

  }

public function enviarCorreo($id, $asunto, $cuerpo, $padre, $alumno){
$correo = $this->buscarCorreoDocente($id);
//var_dump($correo);
//$curso = $this->buscar($id,1);
//$estudiante = $this->buscar($id,2);
//var_dump($curso);
$inicio = nl2br("Padre de familia del $alumno\nFavor responder este correo a $padre\n\n$cuerpo");
$mensaje = str_replace("<br />", "", $inicio);
//$correo = "juanandres1210@gmail.com";
if($correo == "" || $correo =="NULL" || $padre == "" || $padre == "NULL" ){
return -1;}
else{
$mail = new PHPMailer;
/*$mail->IsSMTP();                           // telling the class to use SMTP
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "smtp.gmail.com"; // set the SMTP server
$mail->Port       = 587;   */
$mail->IsSMTP();   
$mail ->SMTPSecure  =  'ssl' ;                         // telling the class to use SMTP
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "smtp.gmail.com"; // set the SMTP server
$mail->Port       = 465;                     // set the SMTP port
$mail->Username   = "boanergespadres@gmail.com"; // SMTP account username
$mail->Password   = "boanerges.2017";        // SMTP account password
//$mail->setFrom($correo, 'Padre de Familia');
$mail->setFrom($correo, "Pregunta Padre de Familia");
$mail->addAddress($correo, 'Recibe');
$mail->Subject  = $asunto;
//$mail->Body     = "$cuerpo <br>".$padre;
$mail->Body     = $mensaje;

if(!$mail->send()) {
 // echo 'Message was not sent.';
  //echo 'Mailer error: ' . $mail->ErrorInfo;
    return -2;
} else {
  //echo 'Message has been sent.';
    return 1;
}
}
}



  public function buscar($id,$r)
  {
    $db = App::$base;    
        $sql = "SELECT 
                   CONCAT(`grado`.`descripcion`,' ',
                  `grado`.`letra`) as curso
                FROM
                  `grado`
                  INNER JOIN `estudiantexgrado` ON (`grado`.`id_grado` = `estudiantexgrado`.`id_grado`)
                  INNER JOIN `estudiante` ON (`estudiantexgrado`.`id_estudiante` = `estudiante`.`id_estudiante`)
                WHERE
                  `estudiantexgrado`.`id_estudiante` = ? AND 
                  `estudiantexgrado`.`estado_grado` = 1
                LIMIT 1";
    $rs = $db->dosql($sql, array($id));
  /*  if($r == 1){
    return $rs->fields['nombres'];
        }
        else{
     return $rs->fields['curso'];
        }*/
return $rs->fields['curso'];
  }

}

?>