<?php

  
  $active_1="";
  $active_2="";
  $active_3="";
  $active_4="";  
  $title="matricula";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>    
   <?php include("../plantilla/head.php");?>
   <script src="../../../lib/js/jquery.js?v=<?php echo str_replace('.', '', microtime(true)); ?>"></script>
   <script src="../../../lib/js/jquery.dataTables.min.js?v=<?php echo str_replace('.', '', microtime(true)); ?>"></script>
   <!--<script src="../../../lib/bootstrap-3.3.2/js/bootstrap.min.js"></script>-->
   <script src="../../../lib/bootbox.min.js"></script>
   <script src="../../../lib/bootstrap.min.js" data-semver="3.1.1" data-require="bootstrap"></script>
  <script src='js/matricula2.js'></script>
  <script src='js/visualizador.js'></script>
  <script src='js/modal_editar_docente.js'></script>
  <link href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" />
 <!-- <script src='js/tabla.js'></script>
  <script src='js/modalEditarClientes.js'></script>
  <script src='js/validar.js'></script>-->
  <style>
            
         
            .dataTables_filter label{
                display:block !important;
            }
            #myTable_paginate{
                text-align: -webkit-center;
            }
            #myTable2_paginate{
                text-align: -webkit-center;
            }
            #myTable_info{
                font-weight: bold;
            }
            #myTable2_info{
                font-weight: bold;
            }
            .panel-body {
            height: 500px;
            }
        </style>
   </head>
<body>
  

  <div class="container-fluid">
    <input type="hidden" id="cod_estudiante" value="<?php echo $_GET['id_estudiante'];?>">
    <br><br>
             <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Notas</div>
                      <div class="panel-body">

                                              <label>Parcial</label>
                              <select id="comboPeriodo" name="id_periodo" class="form-control">
                                <option value="0">--Elija una Opcion</option>
                                </select>             

                      <div id="ver_cargas2"></div>

                      </div>

                </div>

              </div>
  </div>

<!--<div class="container-fluid">
             <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">Ficha de Matricula</div>
                    <div class="panel-body">
                        
                            <div class="form form-group col-md-12">
                              <label>Grado</label>
                              <select id="comboGrado" name="id_grado" class="form-control">
                                <option value="0">--Elija una Opcion</option>
                                </select>
                                <input  id="grado" type="hidden" >
                                <br>
                                <label>Jornada</label>
                                <select id="comboJornada" name="id_jornada" class="form-control">
                                   <option value="0">--Elija una Opcion</option>
                                </select>
                                 <input  id="jornada" type="hidden" >
                                <br>
                                <label>Docente</label>
                                <select id="comboDocente" name="id_docente" class="form-control">
                                   <option value="0">--Elija una Opcion</option>
                                </select>
                                <input  id="docente" type="hidden" >
                                <br>
                                <label>Fecha Inicio</label>
                                <input class="form-control" required="true" id="desde" name="desde" type="date" ><br>
                                <label>Fecha Fin</label>
                                <input class="form-control" id="hasta" name="hasta" type="date" ><br>
                                                            
                            </div>                         
                            <div class="form form-group col-md-12">
                                <button type="submit" id="ocultar" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Cambiar Datos</button>
                            </div>
                        
                    </div>
                </div>
            </div>
               <div class="col-md-8">
                <div class="panel panel-primary">
                    <div class="panel-heading">Listado</div>
                    <div class="panel-body">
                        <div id="ver_cargas"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Matriculados</div>
                    <div class="panel-body">
                        <div id="ver_cargas2"></div>
                    </div>
                </div>
            </div>
</div>-->

<?php
include 'modal_editar_docente.php';
?>

</body>
</html>


