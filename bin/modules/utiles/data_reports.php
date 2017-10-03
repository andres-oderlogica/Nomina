<?php
 /***********************************************************
 * Clase para reportes
 *
 * @author     Jimmy Andrés campo Bravo  <info@oderlogica.com>
 * @copyright  1996-2015 Oderlogica - Todos los derechos reservados - http://www.oderlogica.com
 * @license    Este código y sus derivados son propiedad de Oderlogica
 * @version    1.0
 ************************************************************/

/*-------------Inicio librerías y configuración --------------*/
include_once '../../../core.php';
include_once 'html_tools.php';
include_once 'ajax_response.php';
/*-------------Inicio librerías y configuración --------------*/

 class ReportData
 {
  private $sql = array();  
  private $result = null;
  private $status = 1;
  private $data;

  private function setup()
  {
      $this->sql['factura_cab'] = 
    	"SELECT 
  `tbl_factura`.`id_factura`,
  `tbl_factura`.`nombre`,
  `tbl_factura`.`nit`,
  `tbl_factura`.`direccion`,
  `tbl_factura`.`barrio`,
  `tbl_factura`.`localidad`,
  `tbl_factura`.`suscripcion`,
  `tbl_factura`.`cliente`,
  `tbl_factura`.`categoiria`,
  `tbl_factura`.`estrato`,
  `tbl_factura`.`ruta`,
  `tbl_factura`.`fecha_expedicion`,
  `tbl_factura`.`factura_numero`,
  `tbl_factura`.`periodo_telefonia`,
  `tbl_factura`.`periodo_tv`,
  `tbl_factura`.`fecha_corte`,
  `tbl_factura`.`fecha_pago`,
  `tbl_factura`.`fecha_ultimo_pago`,
  concat('$',`tbl_factura`.`valor_ultimo_pago`) as valor_ultimo_pago,
  `tbl_factura`.`facturas_con_saldo`,
  `tbl_factura`.`lectura_anterior_5`,
  `tbl_factura`.`lectura_actual_5`,
  `tbl_factura`.`consumo_mes_5`,
  `tbl_factura`.`valor_minuto_5`,
  `tbl_factura`.`consumo_mes5_5`,
  `tbl_factura`.`consumo_mes4_5`,
  `tbl_factura`.`consumo_mes3_5`,
  `tbl_factura`.`consumo_mes2_5`,
  `tbl_factura`.`consumo_mes1_5`,
  `tbl_factura`.`mes5_5`,
  `tbl_factura`.`mes4_5`,
  `tbl_factura`.`mes3_5`,
  `tbl_factura`.`mes2_5`,
  `tbl_factura`.`mes1_5`,
  `tbl_factura`.`consumo_promedio_5`,
  `tbl_factura`.`tasa_mora_8`,
  `tbl_factura`.`valor_iva_8`,
  `tbl_factura`.`mensaje_general_9`,
  `tbl_factura`.`mensaje_mensaje_localidad_9`,
  `tbl_factura`.`mensaje_facturas_9`,
  `tbl_factura`.`cupon_10`,
  concat('$ ', format(`tbl_factura`.`valor_apagar_10`, 0)) as valor_apagar_10,
  `tbl_factura`.`fecha_pago_10`,
  `tbl_factura`.`telefono_origen_11`
FROM
  `tbl_factura`
WHERE
  `tbl_factura`.`factura_numero` = ?
       ";

      $this->sql['factura_det'] = 
      "SELECT 
   `tbl_cargo_3`.`cargo`,
  `tbl_cargo_3`.`total`
  
FROM
  `tbl_plan_2`
  INNER JOIN `tbl_factura` ON (`tbl_plan_2`.`id_factura` = `tbl_factura`.`id_factura`)
  INNER JOIN `tbl_cargo_3` ON (`tbl_plan_2`.`id_plan` = `tbl_cargo_3`.`id_plan`)
WHERE
  `tbl_factura`.`factura_numero` = ?
       ";


  

  }

  




  private function get($idx)
  {
 	  return $this->sql[$idx];
  }

  function Autoexecute($option, $params)
  {
    $sql = $this->get($option);
    $this->result = null;

    if (!empty($sql))
      $rs = App::$base->dosql($sql, $params);

    if (!$rs) 
      $this->status = -1;
    else
      $this->result = $rs->GetRows();
    return $this->result;
  }

  function Execute($report, $params)
  { 
    $this->setup(); // inicializar SQLs
    return $this->AutoExecute($report, $params);
  }
 }
/*-------------Fin librerías y configuración --------------*/
?>
