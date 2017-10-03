	<?php
		if (isset($title))
		{
	?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Inicio</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav">
         <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-cog"></i> Administración <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="../discapacidad/registro_discapacidad.php"><i class="glyphicon glyphicon-list"></i> Discapacidad</a></li>
                <li><a href="../materia/registro_materia.php"><i class="glyphicon glyphicon-book"></i> Materias</a></li>
                <li><a href="../docente/registro_docente.php"><i class="glyphicon glyphicon-user"></i> Docentes</a></li>
                <li><a href="../estudiante/registro_estudiante.php"><i class="glyphicon glyphicon-user"></i> Estudiantes</a></li>
                <li><a href="../grados/registro_grado.php"><i class="glyphicon glyphicon-book"></i> Grados</a></li>
                 <!-- <li><a href="#"><i class="glyphicon glyphicon-off"></i> Cerrar sesión</a></li>-->
              </ul>
          </li>

           <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-cog"></i> Matriculas <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="<?php echo $active_1;?>"><a href="../matricula/registro_matricula.php"><i class='glyphicon glyphicon-list-alt'></i> Matriculas Estudiantes <span class="sr-only">(current)</span></a></li>
                <li><a href="#"><i class="glyphicon glyphicon-book"></i> Carga Academica Docentes</a></li>
                <!-- <li><a href="#"><i class="glyphicon glyphicon-off"></i> Cerrar sesión</a></li>-->
              </ul>
          </li>

       <!-- <li class="<?php echo $active_1;?>"><a href="../matricula/registro_matricula.php"><i class='glyphicon glyphicon-list-alt'></i> Matriculas <span class="sr-only">(current)</span></a></li>-->
        <li class="<?php echo $active_2;?>"><a href="../notas/registrar_notas.php"><i class='glyphicon glyphicon-barcode'></i> Registrar Notas</a></li>
		<li class="<?php echo $active_3;?>"><a href="#"><i class='glyphicon glyphicon-user'></i> Generar Boletines</a></li>
		<li class="<?php echo $active_4;?>"><a href="usuarios.php"><i  class='glyphicon glyphicon-lock'></i> Usuarios</a></li>
       </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" target='_blank'><i class='glyphicon glyphicon-envelope'></i> Soporte</a></li>
		<li><a href="../../../login.php?logout"><i class='glyphicon glyphicon-off'></i> Salir</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
	<?php
		}
	?>