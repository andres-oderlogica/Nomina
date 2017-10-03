<?php
include_once 'envioCorreos.php';
$id = $_POST['id'];
$disc       = new listCorreo();
//var_dump($id);
echo $disc->listarDocentesCorreo($id);
?>