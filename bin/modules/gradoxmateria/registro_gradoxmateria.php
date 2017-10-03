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
 <!--  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> -->
   <meta name="viewport" content="width=device-width, initial-scale=1"> 
   <script src="../../../lib/js/jquery.js?v=<?php echo str_replace('.', '', microtime(true)); ?>"></script>
   <script src="../plantilla2/plugins/jQuery/jquery-2.2.3.min.js"></script>
   <script src="../../../lib/js/jquery.dataTables.min.js?v=<?php echo str_replace('.', '', microtime(true)); ?>"></script>
   <!--<script src="../../../lib/bootstrap-3.3.2/js/bootstrap.min.js"></script>-->
   <script src="../../../lib/bootbox.min.js"></script>
   <script src="../../../lib/bootstrap.min.js" data-semver="3.1.1" data-require="bootstrap"></script>
    <script src='js/gradoxmateria.js?v=<?php echo str_replace('.', '', microtime(true)); ?>'></script>
    <script src='js/modal_editar_gradoxmateria.js?v=<?php echo str_replace('.', '', microtime(true)); ?>'></script>
    <link href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" />

    <link rel="stylesheet" href="../plantilla2/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../plantilla2/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../plantilla2/dist/css/skins/skin-blue.min.css">
     <link rel="stylesheet" href="../css/check.css">
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
                    <div class="panel-heading">Asignar Materias a Grado</div>
                    <div class="panel-body">
                        <form id="form_materiaxgrado" action="clases/control_gradoxmateria.php">
                            <div class="col-md-12">
                              <label>Grado</label>
                              <select id="comboGrado" name="grado" class="form-control">
                                <option value="0">--Seleccione--</option>
                                </select>
                                <input  id="grado" name="cod_grado" type="hidden" >
                                <br>

                   <div class="checkbox">                               
                    <label class="col-md-3" style="font-size: 1.2em" >
                        <input type="checkbox" id ="copia" value="3" name="servicios[]">
                          <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                          Ciencias
                      </label>
                      <label class="col-md-3" style="font-size: 1.2em">
                         <input type="checkbox" value="4" name="servicios[]">
                           <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                          Fisica
                      </label>
                       <label class="col-md-3" style="font-size: 1.2em" >
                        <input type="checkbox" id ="copia" value="5" name="servicios[]">
                          <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                          Quimica
                      </label>
                      <label class="col-md-3" style="font-size: 1.2em">
                         <input type="checkbox" value="7" name="servicios[]">
                           <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                          Biblia                          
                      </label></div><br>
                    <div class="checkbox">   
                      <label class="col-md-3" style="font-size: 1.2em" >
                        <input type="checkbox" id ="copia" value="8" name="servicios[]">
                          <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                          Caligrafia
                      </label>
                      <label class="col-md-3" style="font-size: 1.2em">
                         <input type="checkbox" value="9" name="servicios[]">
                           <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                          Ciencias Naturales
                      </label>
                       <label class="col-md-3" style="font-size: 1.2em" >
                        <input type="checkbox" id ="copia" value="10" name="servicios[]">
                          <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                          Convivencia y Civismo
                      </label>
                      <label class="col-md-3" style="font-size: 1.2em">
                         <input type="checkbox" value="11" name="servicios[]">
                           <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                          ECA                          
                      </label>
                  </div><br>

                  <div class="checkbox">   
                      <label class="col-md-3" style="font-size: 1.2em" >
                        <input type="checkbox" id ="copia" value="12" name="servicios[]">
                          <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                          Educacion Ambiental
                      </label>
                      <label class="col-md-3" style="font-size: 1.2em">
                         <input type="checkbox" value="13" name="servicios[]">
                           <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                          Educacion Sexual
                      </label>
                       <label class="col-md-3" style="font-size: 1.2em" >
                        <input type="checkbox" id ="copia" value="14" name="servicios[]">
                          <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                          EE FF
                      </label>
                      <label class="col-md-3" style="font-size: 1.2em">
                         <input type="checkbox" value="15" name="servicios[]">
                           <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                          Geografia                         
                      </label>
                  </div><br>

                   <div class="checkbox">   
                      <label class="col-md-3" style="font-size: 1.2em" >
                        <input type="checkbox" id ="copia" value="17" name="servicios[]">
                          <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                          Historia
                      </label>
                      <label class="col-md-3" style="font-size: 1.2em">
                         <input type="checkbox" value="18" name="servicios[]">
                           <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                          Informatica
                      </label>
                       <label class="col-md-3" style="font-size: 1.2em" >
                        <input type="checkbox" id ="copia" value="19" name="servicios[]">
                          <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                         Lengua Extranjera
                      </label>
                      <label class="col-md-3" style="font-size: 1.2em">
                         <input type="checkbox" value="20" name="servicios[]">
                           <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                          Matematicas                          
                      </label>
                  </div><br>

                   <div class="checkbox">   
                      <label class="col-md-3" style="font-size: 1.2em" >
                        <input type="checkbox" id ="copia" value="21" name="servicios[]">
                          <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                          AEP
                      </label>
                      <label class="col-md-3" style="font-size: 1.2em">
                         <input type="checkbox" value="22" name="servicios[]">
                           <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                          Ortografia
                      </label>
                       <label class="col-md-3" style="font-size: 1.2em" >
                        <input type="checkbox" id ="copia" value="23" name="servicios[]">
                          <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                         Conducta
                      </label>
                      <label class="col-md-3" style="font-size: 1.2em" >
                        <input type="checkbox" id ="copia" value="24" name="servicios[]">
                          <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                         Biologia
                      </label>                      
                  </div><br>

                   <div class="checkbox">   
                      <label class="col-md-3" style="font-size: 1.2em" >
                        <input type="checkbox" id ="copia" value="2" name="servicios[]">
                          <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                          Lengua y Literatura
                      </label>
                      <label class="col-md-3" style="font-size: 1.2em">
                         <input type="checkbox" value="29" name="servicios[]">
                           <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                          Estudio Sociales
                          </label> 

                          <label class="col-md-3" style="font-size: 1.2em">
                         <input type="checkbox" value="27" name="servicios[]">
                           <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                          Filosofia
                          </label>                 
                 

                   <label class="col-md-3" style="font-size: 1.2em">
                         <input type="checkbox" value="26" name="servicios[]">
                           <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                          Sociologia
                          </label>                 
                  </div><br>

                   <div class="checkbox">   
                      <label class="col-md-3" style="font-size: 1.2em" >
                        <input type="checkbox" id ="copia" value="38" name="servicios[]">
                          <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                          Conociendo mi Mundo
                      </label>
                                  
                  </div><br>

                   <br>                             
                                                            
                         </div>                       
                            <div class="col-md-12">
                               <center> <button id="btn_saveg" type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button></center>
                            </div>
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
           
</div>

<?php
include 'modal_editar_gradoxmateria.php';
?>

<?php
include '../plantilla2/fin.php';

?>

</body>
</html>


