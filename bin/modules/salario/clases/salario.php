<?php
include '../../../../core.php';
include_once Config::$home_bin.Config::$ds.'db'.Config::$ds.'active_table.php';
 class Salario extends ADOdb_Active_Record{}
class regSalario
{

public function reg_salario($descripcion,$valor,$transporte,$salud,$pension,$asociacion,
                                $cooperativa,$cesantias,$primas,$ahorro,$comisiones,$otros,$caja, $arl)

    {
      //var_dump($codigo,$identificacion,$primer_apellido,$segundo_apellido,$primer_nombre,$segundo_nombre,$direccion,$telefono,$email,$discapacidad,$fecha_nacimiento);

        $reg              = new Salario('salario');
        $reg->descripcion_salario              =$descripcion;
        $reg->valor_salario   =$valor;
        $reg->aux_transporte    = $transporte;
        $reg->desc_salud = $salud;
        $reg->desc_pension = $pension;
        $reg->desc_asociacion = $asociacion;
        $reg->desc_cooperativa = $cooperativa;
        $reg->cesantias = $cesantias;
        $reg->primas = $primas;
        $reg->ahorros = $ahorro;
        $reg->comisiones    =$comisiones;
        $reg->otros = $otros;
        $reg->caja_compensacion = $caja;
        $reg->arl = $arl;
        $reg->Save();
         //var_dump($reg);
        //return $reg->id_estudiante;
    }


public function listSalario()
{
	$con = App::$base;
    $sql = "SELECT
			  id_salario,
        descripcion_salario,
        CONCAT('$ ',FORMAT(valor_salario,0))AS valor_salario,
        CONCAT('$ ',FORMAT(aux_transporte,0)) as aux_transporte,
        CONCAT('$ ',FORMAT(desc_salud,0))as desc_salud,
        CONCAT('$ ',FORMAT(desc_pension,0)) as desc_pension,
        CONCAT('$ ',FORMAT(desc_asociacion,0)) as desc_asociacion,
        CONCAT('$ ',FORMAT(desc_cooperativa,0)) as desc_cooperativa,
        CONCAT('$ ',FORMAT(cesantias,0)) as cesantias,
        CONCAT('$ ',FORMAT(primas,0)) as primas,
        CONCAT('$ ',FORMAT(ahorros,0)) as ahorros,
        CONCAT('$ ',FORMAT(comisiones,0)) as comisiones,
        CONCAT('$ ',FORMAT(otros,0)) as otros,
        CONCAT('$ ',FORMAT(caja_compensacion,0)) as caja_compensacion,
        CONCAT('$ ',FORMAT(arl,0)) as arl,
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
            `salario`
            order by
            id_salario ASC
            ";

		$rs = $con->dosql($sql, array());
        $tabla = '<table id="myTable" class="table table-hover table-striped table-bordered table-condensed" cellpadding="0" cellspacing="0" border="1" class="display" >
                        <thead>
                        <tr>
                        <th id="yw9_c0">#</th>
                        <th id="yw9_c3">Descripcion</th>
                        <th id="yw9_c4">Valor Salario</th>
                        <th id="yw9_c3">Pago Salud</th>
                        <th id="yw9_c6">Pago Pension</th>
                        <th id="yw9_c6">Cuota Asociacion</th>
                        <th id="yw9_c7">Editar</th>
                        <th id="yw9_c7">Eliminar</th>
                        </tr>
                        </thead>
                        <tbody>';
		          while (!$rs->EOF)
                   {

                   	$tabla.='<tr >
                            <td>
                                '.utf8_encode($rs->fields['id_salario']).'
                            </td>

                            <td>
                                '.utf8_encode($rs->fields['descripcion_salario']).'
                            </td>
                            <td>
                                '.$rs->fields['valor_salario'].'
                            </td>
                             <td>
                                '.utf8_encode($rs->fields['desc_salud']).'
                            </td>
                            <td>
                                '.utf8_encode($rs->fields['desc_pension']).'
                            </td>
                            <td>
                                '.utf8_encode($rs->fields['desc_asociacion']).'
                            </td>
                            <td align="center" width= "30" onclick="editar('.$rs->fields['id_salario'].')">
                                '.utf8_encode($rs->fields['editar']).'
                            </td>
                            <td align="center" width= "30" onclick="eliminar('.$rs->fields['id_salario'].')">
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
    $reg              = new Salario('salario');
    $reg->load("id_salario = {$id}");
    $reg->Delete();
}

public function editar($id,$descripcion,$valor,$transporte,$salud,$pension,$asociacion,
                       $cooperativa,$cesantias,$primas,$ahorro,$comisiones,$otros,$caja, $arl)
    {
        $reg              = new Salario('salario');
        $reg->load("id_salario = {$id}");
        $reg->descripcion_salario              =$descripcion;
        $reg->valor_salario   =$valor;
        $reg->aux_transporte    = $transporte;
        $reg->desc_salud = $salud;
        $reg->desc_pension = $pension;
        $reg->desc_asociacion = $asociacion;
        $reg->desc_cooperativa = $cooperativa;
        $reg->cesantias = $cesantias;
        $reg->primas = $primas;
        $reg->ahorros = $ahorro;
        $reg->comisiones    =$comisiones;
        $reg->otros = $otros;
        $reg->caja_compensacion = $caja;
        $reg->arl = $arl;
        $reg->Save();
        //return $reg->id_estudiante;
    }

  public function buscar($id)
  {
    $db = App::$base;
        $sql = "SELECT
        id_salario,
        descripcion_salario,
        valor_salario,
        aux_transporte,
        desc_salud,
        desc_pension,
        desc_asociacion,
        desc_cooperativa,
        cesantias,
        primas,
        ahorros,
        comisiones,
        otros,
        caja_compensacion,
        arl
              FROM
                salario
               WHERE `id_salario`= ?";
    $rs = $db->dosql($sql, array($id));

    while (!$rs->EOF)
                   {

                    $res = array(
                      "id_salario"  => $id,//$rs->fields['id_estudiante'],
                      "descripcion_salario"  => $rs->fields['descripcion_salario'],
                      "valor_salario"      => $rs->fields['valor_salario'],
                      "aux_transporte" => $rs->fields['aux_transporte'],
                      "desc_salud" => $rs->fields['desc_salud'],
                      "desc_pension" => $rs->fields['desc_pension'],
                      "desc_asociacion" => $rs->fields['desc_asociacion'],
                      "desc_cooperativa" => $rs->fields['desc_cooperativa'],
                      "cesantias" => $rs->fields['cesantias'],
                      "primas" => $rs->fields['primas'],
                      "ahorros" => $rs->fields['ahorros'],
                      "comisiones" => $rs->fields['comisiones'],
                      "ahorros" => $rs->fields['ahorros'],
                      "comisiones" => $rs->fields['comisiones'],
                      "otros" => $rs->fields['otros'],
                      "caja_compensacion" => $rs->fields['caja_compensacion'],
                      "arl" => $rs->fields['arl']
                      );

                    $rs->MoveNext();
                   }
                   return $res;

  }

}

?>
