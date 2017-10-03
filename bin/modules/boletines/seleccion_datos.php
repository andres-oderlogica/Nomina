<?php
session_start();
  if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../../../login.php");
    exit;
        }
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>    
   <?php //include("../plantilla/head.php");?>
  <title>Boletines</title>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> 
   <script src="../../../lib/js/jquery.js?v=<?php echo str_replace('.', '', microtime(true)); ?>"></script>
    <script src="../plantilla2/plugins/jQuery/jquery-2.2.3.min.js"></script>
   <script src="../../../lib/js/jquery.dataTables.min.js?v=<?php echo str_replace('.', '', microtime(true)); ?>"></script>
   <!--<script src="../../../lib/bootstrap-3.3.2/js/bootstrap.min.js"></script>-->
   <script src="../../../lib/bootbox.min.js"></script>
   <script src="../../../lib/bootstrap.min.js" data-semver="3.1.1" data-require="bootstrap"></script>
  <script src='js/matricula.js?v=<?php echo str_replace('.', '', microtime(true)); ?>'></script>
 <!-- <script src='js/modal_editar_docente.js?v=<?php// echo str_replace('.', '', microtime(true)); ?>'></script>-->
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
            #myTable2_paginate{
                text-align: -webkit-center;
                float: right;
                 margin: 0;
            }
            #myTable_info{
                font-weight: bold;
            }
            #myTable2_info{
                font-weight: bold;
            }
          /*  .panel-body {
            height: 500px;
            }*/
   
        </style>
   </head>
<body class="hold-transition skin-blue sidebar-mini">
    <?php
    
   include '../plantilla2/starter.php';
      
  ?>  

  <div class="container-fluid">
             <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Crear boletines por grado</div>
                      <div class="panel-body">

                              <label>Grado</label>
                              <select id="comboGrado" name="comboGrado" class="form-control">
                                <option value="0">--Elija una Opcion</option>
                                </select>
                                <br><br>

                                <b>Seleccione hasta que corte se desea imprimir las notas:</b><br>
                                
                              <!--  <input name="corte" type="radio" id="cunoI" value="1" /><label for="cunoI">Corte1 / SemestreI</label>
                                <input name="corte" type="radio" id="cdosI" value="2" checked/><label for="cdosI">Corte2 / SemestreI</label><br>
                                <input name="corte" type="radio" id="cunoII" value="3" /><label for="cunoII">Corte 1 / SemestreII</label>
                                <input name="corte" type="radio" id="cdosII" value="4" /><label for="cdosII">Corte 2 / SemestreII</label>
                               -->
                                  <label for="cunoI" class="radio-inline"> <input name="corte" type="radio" id="cunoI" value="1" />Corte1 / SemestreI</label>
                               
                                
                                  <label for="cdosI" class="radio-inline"><input name="corte" type="radio" id="cdosI" value="2" checked/>Corte2 / SemestreI</label>
                               
                                
                                  <label for="cunoII" class="radio-inline"> <input name="corte" type="radio" id="cunoII" value="3" />Corte 1 / SemestreII</label>
                               
                               
                                  <label for="cdosII" class="radio-inline">  <input name="corte" type="radio" id="cdosII" value="4" />Corte 2 / SemestreII</label>
                              <br><br>

                                <div id="boton"></div>              

                      

                      </div>
                  </div>
              </div>

             <!--  <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">Crear boletines por estudiante</div>
                      <div class="panel-body">
                               <b>Proximamente</b>
                            <label>Grado</label>
                              <select id="comboGrado" name="comboGrado" class="form-control">
                                <option value="0">--Elija una Opcion</option>
                                </select>

                                <div id="boton"></div>

                      

                      

                      </div>

                </div>

              </div>-->
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
include '../plantilla2/fin.php';

?>

</body>
</html>


