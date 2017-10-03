<?php
include_once 'estudiante.php';
$disc       = new regEstudiante();
$id = $_POST['grado'];
echo $disc->listBloquear($id);
?>