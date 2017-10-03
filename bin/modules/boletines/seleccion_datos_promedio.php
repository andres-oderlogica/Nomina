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
  <script src='js/seleccion.js?v=<?php echo str_replace('.', '', microtime(true)); ?>'></script>
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
    
                
              
              

              <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">Seleccione el <b>corte</b> para el cual desea ver los promedios:</div>
                      <div class="panel-body">

                                                        
                                
                                <input name="corte" type="radio" id="cunoI" value="1" checked /><label for="cunoI">Corte1 / SemestreI</label>
                                <input name="corte" type="radio" id="cdosI" value="2" /><label for="cdosI">Corte2 / SemestreI</label><br>
                                <input name="corte" type="radio" id="cunoII" value="3" /><label for="cunoII">Corte 1 / SemestreII</label>
                                <input name="corte" type="radio" id="cdosII" value="4" /><label for="cdosII">Corte 2 / SemestreII</label>


                                <div id="boton"></div>              

                      

                      </div>
                  </div>
              </div>   


                           <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">Seleccione el <b>semestre</b> para el cual desea ver los promedios:</div>
                      <div class="panel-body">

                                                        
                                
                                <input name="semestre" type="radio" id="sI" value="1" checked /><label for="sI">SemestreI</label>
                                <input name="semestre" type="radio" id="sII" value="2" /><label for="sII">Semestre II</label><br>
                                <input name="semestre" type="radio" id="final" value="3" /><label for="final">Nota final del año</label>
                                


                                <div id="boton2"></div>              

                      

                      </div>
                  </div>
              </div>
                 

<div class="col-md-12">
<div class="panel panel-primary">
                    <div class="panel-heading">Grados</div>
                      <div class="panel-body">
              
                              <select id="comboGrado" name="comboGrado" class="form-control">
                                <option value="0">--Elija una Opcion</option>
                                </select>
<br>
</div>
                  </div>
              </div>
            

           

        
  </div>



<?php
include '../plantilla2/fin.php';

?>

</body>
</html>


