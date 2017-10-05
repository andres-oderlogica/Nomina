<?php
include '../../../../core.php';
include_once Config::$home_bin.Config::$ds.'db'.Config::$ds.'active_table.php';
 class Entidad extends ADOdb_Active_Record{}
class regEntidad
{

public function reg_entidad($codigo,$nombre_entidad)
    {
        $reg              = new Entidad('entidad');
        $reg->codigo      = $codigo;
        $reg->nombre_entidad = $nombre_entidad;
        $reg->estado_entidad = 1;
        $reg->Save();

        //return $reg->id_materia;
    }


public function listEntidad()
{
	$con = App::$base;
    $sql = "SELECT
			  id_entidad,
        codigo,
			  nombre_entidad,
        estado_entidad,
        case estado_entidad when 1 then 'ACTIVA'
        WHEN 2 THEN 'INACTIVA' end AS estado,
               \"
              <button type=\'button\' class=\'btn btn-primary btn-sm btn_edit\' data-title=\'Edit\' data-toggle=\'modal\' data-target=\'#myModal\' >
               <span class=\'glyphicon glyphicon-pencil\'></span></button>
               </div>
                \"
               as editar,
               \"
               <button type=\'button\' class=\'btn btn-success btn-sm btn_delete\' data-title=\'Edit\'>
                <span class=\'glyphicon glyphicon-plus\'></span></button>
                </div>
                \"
               as activar,
               \"
               <button type=\'button\' class=\'btn btn-warning btn-sm btn_delete\' data-title=\'Edit\'>
                <span class=\'glyphicon glyphicon-minus\'></span></button>
                </div>
                \"
               as inactivar,
               \"
              <button type=\'button\' class=\'btn btn-danger btn-sm btn_delete\' data-title=\'Edit\'>
               <span class=\'glyphicon glyphicon-trash\'></span></button>
               </div>
                \"
                 as borrar
            FROM
            `entidad`
            order by
            nombre_entidad ASC
            ";

		$rs = $con->dosql($sql, array());
        $tabla = '<table id="myTable" class="table table-hover table-striped table-bordered table-condensed" cellpadding="0" cellspacing="0" border="1" class="display" >
                        <thead>
                        <tr>
                        <th id="yw9_c0">#</th>
                        <th id="yw9_c1">Codigo</th>
                        <th id="yw9_c2">Nombre Entidad</th>
                        <th id="yw9_c3">Estado Entidad</th>
                        <th id="yw9_c4">Editar</th>
                        <th id="yw9_c5">Act/Desc</th>
                        <th id="yw9_c6">Eliminar</th>
                        </tr>
                        </thead>
                        <tbody>';
		          while (!$rs->EOF)
                   {
                     if($rs->fields['estado_entidad'] == 1){
                       $est = $rs->fields['inactivar'];
                     }
                     if($rs->fields['estado_entidad'] == 2){
                       $est = $rs->fields['activar'];
                     }
                   	$tabla.='<tr >
                            <td>
                                '.utf8_encode($rs->fields['id_entidad']).'
                            </td>
                            <td>
                                '.utf8_encode($rs->fields['codigo']).'
                            </td>
                            <td>
                                '.utf8_encode($rs->fields['nombre_entidad']).'
                            </td>
                            <td>
                                '.utf8_encode($rs->fields['estado']).'
                            </td>

                            <td width= "30" align= "center" onclick="editar('.$rs->fields['id_entidad'].')">
                                '.utf8_encode($rs->fields['editar']).'
                            </td>
                            <td width= "30" align= "center" onclick="editar_estado('.$rs->fields['id_entidad'].','.$rs->fields['estado_entidad'].')">
                                '.$est.'
                            </td>
                            <td width= "30" align= "center" onclick="eliminar('.$rs->fields['id_entidad'].')">
                                '.utf8_encode($rs->fields['borrar']).'
                            </td>' ;

            $tabla.= '</tr>';

	               $rs->MoveNext();
                   }

        $tabla.="</tbody></table>";
        return $tabla;

}

public function eliminar($id)
  {
      $reg              = new Entidad('entidad');
      $reg->load("id_entidad = {$id}");
      $reg->Delete();
      //return $reg->id_materia;
  }

  public function editar($id,$cod, $nom)
    {
        $reg              = new Entidad('entidad');
        $reg->load("id_entidad = {$id}");
        $reg->codigo      = $cod;
        $reg->nombre_entidad = $nom;
        $reg->Save();
        //return $reg->id_materia;
    }

    public function editarEstado($id,$estado)
      {
          $reg              = new Entidad('entidad');
          $reg->load("id_entidad = {$id}");
          $reg->estado_entidad = $estado;
          $reg->Save();
          //return $reg->id_materia;
      }


  public function buscar($id)
  {
    $db = App::$base;
        $sql = "SELECT
  id_entidad, codigo, nombre_entidad
FROM
  entidad
 WHERE `id_entidad`= ?";
    $rs = $db->dosql($sql, array($id));

    while (!$rs->EOF)
                   {

                    $res = array(
                      "id_entidad"  => $rs->fields['id_entidad'],
                      "codigo"      => $rs->fields['codigo'],
                      "nombre_entidad" => $rs->fields['nombre_entidad']
                      );

                    $rs->MoveNext();
                   }
                   return $res;

  }

}

?>
