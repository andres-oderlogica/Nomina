<?php
include_once 'envioCorreos.php';

$id        = $_POST['id'];
$asunto    =$_POST['asunto'];
$correo    = $_POST['correo'];
$mpadre    = $_POST['mpadre'];
$malumno   = $_POST['malumno'];

$disc       = new listCorreo();
$res = $disc->enviarCorreo($id, $asunto, $correo, $mpadre, $malumno);
if($res == -1 || $res == -2){
	echo json_encode(-1);
}
else{
	echo json_encode(1);
}


?>