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
  <title>Matriculas</title>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">  
   <script src="../../../lib/js/jquery.js?v=<?php echo str_replace('.', '', microtime(true)); ?>"></script>
   <script src="../plantilla2/plugins/jQuery/jquery-2.2.3.min.js"></script>
   <script src="../../../lib/js/jquery.dataTables.min.js?v=<?php echo str_replace('.', '', microtime(true)); ?>"></script>
   <!--<script src="../../../lib/bootstrap-3.3.2/js/bootstrap.min.js"></script>-->
   <script src="../../../lib/bootbox.min.js"></script>
   <script src="../../../lib/bootstrap.min.js" data-semver="3.1.1" data-require="bootstrap"></script>
    <script src='js/docentexgrado.js?v=<?php echo str_replace('.', '', microtime(true)); ?>'></script>
 
    <link href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" />

    <link rel="stylesheet" href="../plantilla2/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../plantilla2/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../plantilla2/dist/css/skins/skin-blue.min.css">
    <script src="../plantilla2/dist/js/app.min.js"></script>
     <link href="../../../lib/select2/dist/css/select2.min.css" rel="stylesheet" />
    <script src="../../../lib/select2/dist/js/select2.min.js"></script>
  <style>
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
                    <div class="panel-heading">Docentes x grado</div>
                    <div class="panel-body">
                        <form id="form_docentexgrado" action="clases/control_docentexgrado.php">
                            <div class="col-md-4">
                             <label>Elija la materia por Grado</label>
                                <select id="combodocente" name="id_docente" class="form-control">
                                   <option value="0">--Elija una Opcion</option>
                                </select>
                                <input  id="docente" type="hidden" >
                                <br>
                              </div>                              
                            <div class="col-md-3">
                              <label>Año</label>
                              <select id="anios" name="anio" class="form-control">
                                <option value="0">--Seleccione--</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                </select>
                                <input  id="anio" type="hidden" >
                                <br>
                              </div>                      
                            <!--<div class="col-md-2">
                                <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
                            </div>-->
                        </form>
                    </div>
                </div>
            </div>
               <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Listado</div>
                    <div class="panel-body">
                        <div id="ver_cargas"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Docentes Asignados</div>
                    <div class="panel-body">
                        <div id="ver_cargas2"></div>
                    </div>
                </div>
            </div>
</div>

<?php
include 'modal_editar_docente.php';
?>

<?php
include '../plantilla2/fin.php';

?>

</body>
</html>


