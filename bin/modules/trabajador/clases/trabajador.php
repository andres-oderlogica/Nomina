<?php
include '../../../../core.php';
include_once Config::$home_bin.Config::$ds.'db'.Config::$ds.'active_table.php';
 class Trabajador extends ADOdb_Active_Record{}
class regTrabajador
{

public function reg_estudiante($codigo,$id_tipodocumento,$documento,$primer_nombre,$segundo_nombre,$primer_apellido,
                                $segundo_apellido,$direccion,$barrio,$telefono_fijo,$celular,$email, $estado)

    {
      //var_dump($codigo,$identificacion,$primer_apellido,$segundo_apellido,$primer_nombre,$segundo_nombre,$direccion,$telefono,$email,$discapacidad,$fecha_nacimiento);

        $reg              = new Trabajador('trabajador');
        $reg->codigo              =$codigo;
        $reg->id_tipodocumento   =$id_tipodocumento;
        $reg->documento    = $documento;
        $reg->primer_nombre = $primer_nombre;
        $reg->segundo_nombre = $segundo_nombre;
        $reg->primer_apellido = $primer_apellido;
        $reg->segundo_apellido = $segundo_apellido;
        $reg->direccion = $direccion;
        $reg->barrio = $barrio;
        $reg->telefono_fijo = $telefono_fijo;
        $reg->celular    =$celular;
        $reg->email = $email;
        $reg->id_estado = 1;
        $reg->Save();
         //var_dump($reg);
        //return $reg->id_estudiante;
    }


public function listTrabajador()
{
	$con = App::$base;
    $sql = "SELECT
			  id_trabajador,
        codigo,
        documento,
        primer_apellido,
        segundo_apellido,
        primer_nombre,
        segundo_nombre,
        concat(
        ifnull(primer_apellido,' '),' ',
        ifnull(segundo_apellido,' '),' ',
        ifnull(primer_nombre,' '),' ',
        ifnull(segundo_nombre,' ')) as nombre_completo,
			  direccion,
        telefono_fijo,
        email,
        celular,
      \"
              <button type=\'button\' class=\'btn btn-primary btn-sm btn_edit\' data-title=\'Edit\' data-toggle=\'modal\' data-target=\'#myModal\' >
               <span class=\'glyphicon glyphicon-pencil\'></span></button>
               </div>
                \"
        barrio,
               \"
              <button type=\'button\' class=\'btn btn-primary btn-sm btn_edit\' data-title=\'Edit\' data-toggle=\'modal\' data-target=\'#myModal\' >
               <span class=\'glyphicon glyphicon-pencil\'></span></button>
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
            `trabajador`
            order by
            primer_apellido ASC
            ";

		$rs = $con->dosql($sql, array());
        $tabla = '<table id="myTable" class="table table-hover table-striped table-bordered table-condensed" cellpadding="0" cellspacing="0" border="1" class="display" >
                        <thead>
                        <tr>
                        <th id="yw9_c0">#</th>                        
                        <th id="yw9_c3">Identificacion</th>
                        <th id="yw9_c4">Nombres y Apellidos</th>
                        <th id="yw9_c3">Dirección</th>
                        <th id="yw9_c6">Celular</th>
                        <th id="yw9_c7">Editar</th>
                        <th id="yw9_c7">ELiminar</th>
                        
                        </tr>
                        </thead>
                        <tbody>';
		          while (!$rs->EOF)
                   {
                   	$tabla.='<tr >
                            <td>
                                '.utf8_encode($rs->fields['id_trabajador']).'
                            </td>

                            <td>
                                '.utf8_encode($rs->fields['documento']).'
                            </td>
                            <td>
                                '.$rs->fields['nombre_completo'].'
                            </td>
                             <td>
                                '.utf8_encode($rs->fields['direccion']).'
                            </td>
                            <td>
                                '.utf8_encode($rs->fields['celular']).'
                            </td>

                            <td align="center" width= "30" onclick="editar('.$rs->fields['id_trabajador'].')">
                                '.utf8_encode($rs->fields['editar']).'
                            </td>
                            <td align="center" width= "30" onclick="eliminar('.$rs->fields['id_trabajador'].')">
                                '.utf8_encode($rs->fields['borrar']).'
                            </td>

                          ' ;

            $tabla.= '</tr>';

	               $rs->MoveNext();
                   }

        $tabla.="</tbody></table>";
        return $tabla;

}


public function listBloquear($id)
{
  $con = App::$base;
    $sql = "SELECT
        estudiante.id_estudiante,
        codigo,
        identificacion,
        primer_apellido,
        segundo_apellido,
        primer_nombre,
        segundo_nombre,
        concat(
        ifnull(primer_apellido,' '),' ',
        ifnull(segundo_apellido,' '),' ',
        ifnull(primer_nombre,' '),' ',
        ifnull(segundo_nombre,' ')) as nombre_completo,
 CONCAT(`grado`.`descripcion`, ' ', `grado`.`letra`) AS `curso`,
 `grado`.`id_grado`,
        case when idestado_pago = 1   then 'PAGADO'
        when idestado_pago = 2 then 'DEBE' END AS estadopago,

                    \"
              <button type=\'button\' class=\'btn btn-danger btn-sm btn_delete\' data-title=\'Edit\'>
               <span class=\'glyphicon glyphicon-floppy-remove\'></span></button>
               </div>
                \" as bloquear,

              \"
              <button type=\'button\' class=\'btn btn-success btn-sm btn_delete\' data-title=\'Edit\'>
               <span class=\'glyphicon glyphicon-floppy-saved\'></span></button>
               </div>
                \"
                 as desbloquear
            FROM estudiante, grado, estudiantexgrado
            WHERE estudiante.id_estudiante = estudiantexgrado.id_estudiante
            AND grado.id_grado = estudiantexgrado.id_grado
            AND estudiantexgrado.id_grado = ?
            and `estudiantexgrado`.`estado_grado` = 1
                        ";

    $rs = $con->dosql($sql, array($id));
        $tabla = '<table id="myTable" class="table table-hover table-striped table-bordered table-condensed" cellpadding="0" cellspacing="0" border="1" class="display" >
                        <thead>
                        <tr>
                        <th id="yw9_c0">#</th>
                        <th id="yw9_c1">Codigo</th>
                        <th id="yw9_c3">Identificacion</th>
                        <th id="yw9_c4">Nombres y Apellidos</th>
                        <th id="yw9_c6">Grado</th>
                        <th id="yw9_c6">Estado de Pago</th>
                        <th id="yw9_c8">Bloquear</th>
                        <th id="yw9_c8">Desbloquear</th>
                        </tr>
                        </thead>
                        <tbody>';
              while (!$rs->EOF)
                   {
                    $tabla.='<tr >
                            <td>
                                '.utf8_encode($rs->fields['id_estudiante']).'
                            </td>
                            <td>
                                '.utf8_encode($rs->fields['codigo']).'
                            </td>

                            <td>
                                '.utf8_encode($rs->fields['identificacion']).'
                            </td>
                            <td>
                                '.utf8_encode($rs->fields['nombre_completo']).'
                            </td>
                            <td>
                                '.utf8_encode($rs->fields['curso']).'
                            </td>

                            <td align="center">
                                '.utf8_encode($rs->fields['estadopago']).'
                            </td>

                            <td align="center" width= "30" onclick="eliminar('.$rs->fields['id_estudiante'].','.$rs->fields['id_grado'].')">
                                '.utf8_encode($rs->fields['bloquear']).'
                            </td>
                            <td align="center" width= "30" onclick="desblock('.$rs->fields['id_estudiante'].','.$rs->fields['id_grado'].')">
                                '.utf8_encode($rs->fields['desbloquear']).'
                            </td>' ;

            $tabla.= '</tr>';

                 $rs->MoveNext();
                   }

        $tabla.="</tbody></table>";
        return $tabla;

}

/*public function listBloquear()
{
  $con = App::$base;
    $sql = "SELECT
        id_estudiante,
        codigo,
        identificacion,
        primer_apellido,
        segundo_apellido,
        primer_nombre,
        segundo_nombre,
        concat(
        ifnull(primer_apellido,' '),' ',
        ifnull(segundo_apellido,' '),' ',
        ifnull(primer_nombre,' '),' ',
        ifnull(segundo_nombre,' ')) as nombre_completo,
        telefono,
        case when idestado_pago = 1   then 'PAGADO'
        when idestado_pago = 2 then 'DEBE' END AS estadopago,

                    \"
              <button type=\'button\' class=\'btn btn-danger btn-sm btn_delete\' data-title=\'Edit\'>
               <span class=\'glyphicon glyphicon-floppy-remove\'></span></button>
               </div>
                \" as bloquear,

              \"
              <button type=\'button\' class=\'btn btn-success btn-sm btn_delete\' data-title=\'Edit\'>
               <span class=\'glyphicon glyphicon-floppy-saved\'></span></button>
               </div>
                \"
                 as desbloquear
            FROM
            `estudiante`
            order by
            primer_apellido ASC
            ";

    $rs = $con->dosql($sql, array());
        $tabla = '<table id="myTable" class="table table-hover table-striped table-bordered table-condensed" cellpadding="0" cellspacing="0" border="1" class="display" >
                        <thead>
                        <tr>
                        <th id="yw9_c0">#</th>
                        <th id="yw9_c1">Codigo</th>
                        <th id="yw9_c3">Identificacion</th>
                        <th id="yw9_c4">Nombres y Apellidos</th>
                        <th id="yw9_c6">Estado de Pago</th>
                        <th id="yw9_c8">Bloquear</th>
                        <th id="yw9_c8">Desbloquear</th>
                        </tr>
                        </thead>
                        <tbody>';
              while (!$rs->EOF)
                   {
                    $tabla.='<tr >
                            <td>
                                '.utf8_encode($rs->fields['id_estudiante']).'
                            </td>
                            <td>
                                '.utf8_encode($rs->fields['codigo']).'
                            </td>

                            <td>
                                '.utf8_encode($rs->fields['identificacion']).'
                            </td>
                            <td>
                                '.utf8_encode($rs->fields['nombre_completo']).'
                            </td>

                            <td>
                                '.utf8_encode($rs->fields['estadopago']).'
                            </td>


                            <td align="center" width= "30" onclick="eliminar('.$rs->fields['id_estudiante'].')">
                                '.utf8_encode($rs->fields['bloquear']).'
                            </td>
                            <td align="center" width= "30" onclick="desblock('.$rs->fields['id_estudiante'].')">
                                '.utf8_encode($rs->fields['desbloquear']).'
                            </td>' ;

            $tabla.= '</tr>';

                 $rs->MoveNext();
                   }

        $tabla.="</tbody></table>";
        return $tabla;

}*/

/*public function eliminar($id)
{
    $con = App::$base;
    $sql = "DELETE
    FROM `colegio`.`estudiante`
    WHERE `id_estudiante`= ?";
    $rs = $con->dosql($sql, array($id));
}*/

public function eliminar($id)
{
    $reg              = new Estudiante('estudiante');
    $reg->load("id_estudiante = {$id}");
    $reg->Delete();
}

/*public function editar($id,$codigo,$identificacion,$primer_apellido,$segundo_apellido,$primer_nombre,
                               $segundo_nombre,$direccion,$telefono,$email,$discapacidad)
  {

        $db = App::$base;
        $sql = "UPDATE `colegio`.`estudiante`
                SET codigo = ?,
                    identificacion = ?,
                    primer_apellido = ?,
                    segundo_apellido = ?,
                    primer_nombre = ?,
                    segundo_nombre = ?,
                    direccion = ?,
                    telefono = ?,
                    email  = ?,
                    discapacidad = ?
                WHERE `id_estudiante`= ?";
    $rs = $db->dosql($sql, array($codigo,$identificacion,$primer_apellido,$segundo_apellido,$primer_nombre,$segundo_nombre,$direccion,$telefono,$email,$discapacidad,$id));
       //var_dump($rs);
  }*/

  public function editar($id,$codigo,$identificacion,$primer_apellido,$segundo_apellido,$primer_nombre,$segundo_nombre,$direccion,$telefono,$email,$discapacidad, $fecha_nacimiento, $usuario)
    {
        $reg              = new Estudiante('estudiante');
        $reg->load("id_estudiante = {$id}");
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
        $reg->usuario = $usuario;
        $reg->Save();
        //return $reg->id_estudiante;
    }

public function editarEstadoPago($id, $estado)
{
        $reg              = new Estudiante('estudiante');
        $reg->load("id_estudiante = {$id}");
        $reg->idestado_pago = $estado;
        $reg->Save();

}

  public function buscar($id)
  {
    $db = App::$base;
        $sql = "SELECT
                id_estudiante,
                codigo,
                identificacion,
                primer_apellido,
                segundo_apellido,
                primer_nombre,
                segundo_nombre,
                concat(identificacion,' ',
                primer_apellido,' ',
                segundo_apellido,' ',
                primer_nombre,' ',
                segundo_nombre) as nombre_completo,
                direccion,
                telefono,
                email,
                discapacidad,
                fecha_nacimiento,
                usuario
              FROM
                estudiante
               WHERE `id_estudiante`= ?";
    $rs = $db->dosql($sql, array($id));

    while (!$rs->EOF)
                   {

                    $res = array(
                      "id_estudiante"  => $id,//$rs->fields['id_estudiante'],
                      "codigo"  => $rs->fields['codigo'],
                      "identificacion"      => $rs->fields['identificacion'],
                      "primer_apellido" => $rs->fields['primer_apellido'],
                      "segundo_apellido" => $rs->fields['segundo_apellido'],
                      "primer_nombre" => $rs->fields['primer_nombre'],
                      "segundo_nombre" => $rs->fields['segundo_nombre'],
                      "direccion" => $rs->fields['direccion'],
                      "telefono" => $rs->fields['telefono'],
                      "email" => $rs->fields['email'],
                      "discapacidad" => $rs->fields['discapacidad'],
                      "fecha_nacimiento" => $rs->fields['fecha_nacimiento'],
                      "usuario" => $rs->fields['usuario']
                      );

                    $rs->MoveNext();
                   }
                   return $res;

  }

}

?>
