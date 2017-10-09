<?php
session_start();
  if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../../../login.php");
    exit;
        }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
  <head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <title>Salario</title>

   <script src="../../../lib/js/jquery.js?v=<?php echo str_replace('.', '', microtime(true)); ?>"></script>
   <script src="../plantilla2/plugins/jQuery/jquery-2.2.3.min.js"></script>
   <script src="../../../lib/js/jquery.dataTables.min.js?v=<?php echo str_replace('.', '', microtime(true)); ?>"></script>

   <!--<script src="../../../lib/bootstrap-3.3.2/js/bootstrap.min.js"></script>-->
   <script src="../../../lib/bootbox.min.js"></script>
   <script src="../../../lib/bootstrap.min.js" data-semver="3.1.1" data-require="bootstrap"></script>
  <script src='js/salario.js?v=<?php echo str_replace('.', '', microtime(true)); ?>'></script>
  <!--<script src='js/modal_editar_trabajador.js?v=<?php //echo str_replace('.', '', microtime(true)); ?>'></script>-->
  <link href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" />

  <link rel="stylesheet" href="../plantilla2/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../plantilla2/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../plantilla2/dist/css/skins/skin-blue.min.css">
  <script src="../plantilla2/dist/js/app.min.js"></script>
  <style>


            .dataTables_filter label{
                display:block !important;
            }
            #myTable_paginate{
                text-align: -webkit-center;
            }
            #myTable_info{
                font-weight: bold;
            }
           /* .panel-body {
            height: 500px;
            }*/
        </style>
   </head>
<body class="hold-transition skin-blue sidebar-mini">
   <?php
     //include '../plantilla/navbar.php';
   include '../plantilla2/starter.php';

  ?>

<div class="container-fluid">
  <div class="alert alert-success alert-dismissable fade in" id="alerta">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Registro Exitoso!</strong> Se han registrado con exito los datos del trabajador.
  </div>
  <div class="alert alert-danger alert-dismissable fade in" id="alerta_error">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Danger!</strong> This alert box could indicate a dangerous or potentially negative action.
  </div>
<form id="form_salario" action="clases/control_salario.php">
            <!--Panel 1-->
             <div class="col-md-6">
               <!--Panel Salario-->
                <div class="panel panel-primary">
                    <div class="panel-heading">Datos Salario</div>
                      <div class="panel-body">
                        <div class="col-md-12">
                          <label class="control-label " for="descripcion_salario">
                            Descripciòn Salario
                          </label>
                            <input class="form-control" id="descripcion_salario" name="descripcion_salario"  placeholder="Digite el Tipo de salario" type="text" required><br>
                        </div>
                        <div class="col-md-12">
                          <label class="control-label " for="valor_salario">
                            Valor Salario
                          </label>
                          <input class="form-control" id="valor_salario" name="valor_salario" value="0" type="number" step="any" ><br>
                      </div>
                    </div>
                </div>
                <!--Fin Panel salario-->
                <!--Panel Prestaciones Sociales-->
                <div class="panel panel-primary">
                    <div class="panel-heading">Prestaciones Sociales</div>
                      <div class="panel-body">
                        <div class="col-md-6">
                          <label class="control-label " for="Primas">
                            Primas
                          </label>
                            <input class="form-control" id="primas" name="primas" value="0" type="number" step="any" required><br>
                        </div>
                        <div class="col-md-6">
                          <label class="control-label " for="cesantias">
                            Cesantias
                          </label>
                          <input class="form-control" id="cesantias" name="cesantias" value="0" type="number" step="any" ><br>
                      </div>
                      <div class="col-md-6">
                        <label class="control-label " for="comisiones">
                          Comisiones
                        </label>
                        <input class="form-control" id="comisiones" name="comisiones" value="0" type="number" step="any" ><br>
                    </div>
                    <div class="col-md-6">
                      <label class="control-label " for="caja_compensacion">
                        Caja de Compensaciòn
                      </label>
                      <input class="form-control" id="caja_compensacion" name="caja_compensacion" value="0" type="number" step="any" ><br>
                  </div>
                  <div class="col-md-6">
                    <label class="control-label " for="aux_transporte">
                      Auxilio de Transporte
                    </label>
                    <input class="form-control" id="aux_transporte" name="aux_transporte" value="0" type="number" step="any" ><br>
                  </div>
                  <div class="col-md-6">
                    <label class="control-label " for="arl">
                      ARL
                    </label>
                    <input class="form-control" id="arl" name="arl" value="0" type="number" step="any" ><br>
                </div>
                </div>
              </div>
              <!--Fin Panel salario-->
            </div>
          <!--Fin Panel 1-->
          <!-- Panel 2-->
            <div class="col-md-6">
              <!-- Panel Descuentos-->
              <div class="panel panel-primary">
                <div class="panel-heading">Descuentos</div>
                  <div class="panel-body">
                    <div class="col-md-6">
                      <label class="control-label " for="desc_salud">
                        Seguridad Social
                      </label>
                      <input class="form-control" id="desc_salud" name="desc_salud" value="0" type="number" step="any" ><br>
                    </div>
                    <div class="col-md-6">
                      <label class="control-label " for="desc_pension">
                        Pensiòn
                      </label>
                        <input class="form-control" id="desc_pension" name="desc_pension" value="0" type="number" step="any" ><br>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label " for="desc_cooperativa">
                            Aporte Cooperativa
                        </label>
                        <input class="form-control" id="desc_cooperativa" name="desc_cooperativa" value="0" type="number" step="any" ><br>
                    </div>
                    <div class="col-md-6">
                      <label class="control-label " for="desc-asociacion">
                        Aporte Asociaciòn
                      </label>
                      <input class="form-control" id="desc_asociacion" name="desc_asociacion" value="0" type="number" step="any" ><br>
                    </div>
                    <div class="col-md-6">
                      <label class="control-label " for="ahorro">
                        Ahorro
                      </label>
                      <input class="form-control" id="ahorros" name="ahorros" value="0" type="number" step="any" ><br>
                    </div>
                    <div class="col-md-6">
                      <label class="control-label " for="otros">
                        Otros
                      </label>
                      <input class="form-control" id="otros" name="otros" value="0" type="number" step="any" ><br>
                    </div>
                    <div class="col-md-12">
                      <hr>
                    </div>
                    <div class="col-md-12">
                      <center> <button type="submit" class="btn btn-primary" id="btn_guardar"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar Datos</button>
                      </center>
                    </div>
                  </div>
                </div>

                  <!--Fin Panel Descuentos-->


</div>
</form>
<?php
  //include 'modal_editar_trabajador.php';
?>
 <?php

   include '../plantilla2/fin.php';
  ?>



</body>
</html>
