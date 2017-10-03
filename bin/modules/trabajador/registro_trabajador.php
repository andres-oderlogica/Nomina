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
   <title>Trabajador</title>

   <script src="../../../lib/js/jquery.js?v=<?php echo str_replace('.', '', microtime(true)); ?>"></script>
   <script src="../plantilla2/plugins/jQuery/jquery-2.2.3.min.js"></script>
   <script src="../../../lib/js/jquery.dataTables.min.js?v=<?php echo str_replace('.', '', microtime(true)); ?>"></script>

   <!--<script src="../../../lib/bootstrap-3.3.2/js/bootstrap.min.js"></script>-->
   <script src="../../../lib/bootbox.min.js"></script>
   <script src="../../../lib/bootstrap.min.js" data-semver="3.1.1" data-require="bootstrap"></script>
  <script src='js/trabajador.js?v=<?php echo str_replace('.', '', microtime(true)); ?>'></script>
  <script src='js/modal_editar_trabajador.js?v=<?php echo str_replace('.', '', microtime(true)); ?>'></script>
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
<form id="form_trabajador" action="clases/control_trabajador.php">
             <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">Registrar Trabajador</div>
                    <div class="panel-body">

                             <div class="col-md-12">
                                 <label>Tipo Documento</label>
                               <select class="form-control" name="id_tipodocumento">
                                <option value ="1">CEDULA DE CIUDADANIA</option>
                                <option value ="2">TARJETA DE IDENTIDAD</option>
                                <option value ="3">CEDULA EXTRANJERO</option>
                                <option value ="4">NIT</option>
                                <option value ="5">RUT</option>
                               </select><br>
                             </div>

                              <div class="col-md-12">

                              <input class="form-control" id="documento" name="documento" placeholder="Documento" type="text" required><br>
                              </div>
                              <div class="col-md-12">
                               <input class="form-control" id="codigo" name="codigo" placeholder="Digita el codigo" type="text" ><br>
                             </div>

                                  <div class="col-md-6">
                              <input class="form-control" required="true" id="primer_nombre" name="primer_nombre" placeholder="1er Nombre" type="text" ><br>
                              </div>

                              <div class="col-md-6">
                              <input class="form-control" id="segundo_nombre" name="segundo_nombre" placeholder="2do Nombre" type="text" ><br>
                              </div>

                              <div class="col-md-6">
                              <input class="form-control" required="true" id="primer_apellido" name="primer_apellido" placeholder="1er Apellido" type="text" ><br>
                              </div>

                              <div class="col-md-6">
                              <input class="form-control" id="segundo_apellido" name="segundo_apellido" placeholder="2do Apellido" type="text" ><br>
                              </div>


                              <div class="col-md-6">
                              <input class="form-control" id="barrio" name="barrio" placeholder="Barrio" type="text" ><br>
                              </div>
                              <div class="col-md-6">
                                <input class="form-control" id="direccion" name="direccion" placeholder="Direccion" type="text" ><br>
                                </div>

                                <div class="col-md-6">
                                <input class="form-control" id="telefono_fijo" name="telefono_fijo" placeholder="Telefono Fijo" type="text" ><br>
                                </div>

                                <div class="col-md-6">
                                <input class="form-control" id="celular" name="celular" placeholder="Celular" type="text" ><br>
                                </div>

                                 <div class="col-md-12">
                                <input class="form-control" id="email" name="email" placeholder="Correo" type="email" ><br>
                                </div>

                            <div class="col-md-12">
                              <center>  <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button></center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
               <div class="col-md-8">
                <div class="panel panel-primary">
                    <div class="panel-heading">Listado Trabajadores</div>
                    <div class="panel-body">

                              <span id="loader"></span>

                        <div id="ver_cargas"></div>

                    </div>
                </div>
            </div>

</div>
<?php
  include 'modal_editar_trabajador.php';
?>
 <?php

   include '../plantilla2/fin.php';
  ?>



</body>
</html>
