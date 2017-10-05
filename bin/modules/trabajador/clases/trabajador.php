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
        id_estado,
        case id_estado when '1' then 'ACTIVO' when '2' then 'INACTIVO' END AS estado,
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
              <button type=\'button\' class=\'btn btn-warning btn-sm btn_delete\' data-title=\'Edit\'>
               <span class=\'glyphicon glyphicon-minus\'></span></button>
               </div>
                \"
                 as inactivar,
                 \"
                 <button type=\'button\' class=\'btn btn-success btn-sm btn_delete\' data-title=\'Edit\'>
                  <span class=\'glyphicon glyphicon-plus\'></span></button>
                  </div>
                   \"
                    as activar,

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
                        <th id="yw9_c6">Estado</th>
                        <th id="yw9_c7">Editar</th>
                        <th id="yw9_c7">Inac/Act</th>
                        <th id="yw9_c7">Eliminar</th>

                        </tr>
                        </thead>
                        <tbody>';
		          while (!$rs->EOF)
                   {

                     if($rs->fields['id_estado'] == 1)
                     {
                       $est = $rs->fields['inactivar'];
                     }
                     else{
                       $est = $rs->fields['activar'];
                     }
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
                            <td>
                                '.utf8_encode($rs->fields['estado']).'
                            </td>

                            <td align="center" width= "30" onclick="editar('.$rs->fields['id_trabajador'].')">
                                '.utf8_encode($rs->fields['editar']).'
                            </td>

                            <td align="center" width= "30" onclick="editar_estado('.$rs->fields['id_trabajador'].','.$rs->fields['id_estado'].')">
                                '.$est.'
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




public function eliminar($id)
{
    $reg              = new Trabajador('trabajador');
    $reg->load("id_trabajador = {$id}");
    $reg->Delete();
}

public function editar($id,$codigo,$documento,$primer_nombre,$segundo_nombre,$primer_apellido,$segundo_apellido,$direccion,$barrio,$telefono_fijo,$celular,$email)
    {
        $reg              = new Trabajador('trabajador');
        $reg->load("id_trabajador = {$id}");
        $reg->codigo              =$codigo;
        $reg->documento      = $documento;
        $reg->primer_nombre = $primer_nombre;
        $reg->segundo_nombre = $segundo_nombre;
        $reg->primer_apellido = $primer_apellido;
        $reg->segundo_apellido = $segundo_apellido;
        $reg->direccion = $direccion;
        $reg->barrio = $barrio;
        $reg->telefono_fijo = $telefono_fijo;
        $reg->celular      =$celular;
        $reg->email = $email;
        $reg->Save();
        //return $reg->id_estudiante;
    }

public function editarEstado($id, $estado)
{
        $reg              = new Trabajador('trabajador');
        $reg->load("id_trabajador = {$id}");
        $reg->id_estado = $estado;
        $reg->Save();

}

  public function buscar($id)
  {
    $db = App::$base;
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
        barrio
              FROM
                trabajador
               WHERE `id_trabajador`= ?";
    $rs = $db->dosql($sql, array($id));

    while (!$rs->EOF)
                   {

                    $res = array(
                      "id_trabajador"  => $id,//$rs->fields['id_estudiante'],
                      "codigo"  => $rs->fields['codigo'],
                      "documento"      => $rs->fields['documento'],
                      "primer_apellido" => $rs->fields['primer_apellido'],
                      "segundo_apellido" => $rs->fields['segundo_apellido'],
                      "primer_nombre" => $rs->fields['primer_nombre'],
                      "segundo_nombre" => $rs->fields['segundo_nombre'],
                      "direccion" => $rs->fields['direccion'],
                      "telefono_fijo" => $rs->fields['telefono_fijo'],
                      "celular" => $rs->fields['celular'],
                      "email" => $rs->fields['email'],
                      "barrio" => $rs->fields['barrio']
                      );

                    $rs->MoveNext();
                   }
                   return $res;

  }

}

?>
