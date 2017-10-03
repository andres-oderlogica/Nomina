<?php
include '../clases/clientes.php';

$nombres = $_POST['nombres'];
$identificacion = $_POST['identificacion'];
$tipo = $_POST['tipo_cliente'];
$direccion = $_POST['direccion'];
$estado = $_POST['estado'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$data =$_POST['data'];
$id = $_POST['id'];
$action = $_POST['accion'];

//var_dump($desc);
$prod = new classClientes();

switch ($action) {
             case "registrar":
             $res = $prod->nuevoCliente($nombres, $identificacion, $tipo, $direccion, $telefono,$correo,$estado );
             
             break; 
             case "tabla":
             $res = $prod->tablaClientes($data);
             echo json_encode($res);
             
             break; 
             case "editar":
             $res = $prod->editClientes($nombres, $identificacion, $direccion, $telefono, $correo,$id);
             
             break; 
             case "borrar":
             $res = $prod->deleteClientes($id);
                 
             break; 

             case "buscar":
             $res = $prod->buscarClientes($id);
             echo json_encode($res);   
             break;
            
         }


?>