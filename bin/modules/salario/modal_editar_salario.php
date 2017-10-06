

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header"> 
 
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar trabajador</h4>
<br>
<div class="bootstrap-iso">
 <div class="container-fluid">
  <div class="row">   
     <div class="form-group ">
      <div class='col-md-6'>
      <label class="control-label " for="codigo">
       Codigo
      </label>      
      <input class="form-control" id="modal_codigo" name="codigo" type="text"/>
    </div>
    <div class='col-md-6'>
      <label class="control-label " for="documento">
       No de Documento
      </label>      
      <input class="form-control" id="modal_documento" name="documento" type="text" required/>
    </div>
    <div class='col-md-6'>
       <label class="control-label " for="primer_nombre">
       Primer Nombre
      </label>
      <input class="form-control" id="modal_primer_nombre" name="primer-nombre" type="text" required/>
    </div>
    <div class='col-md-6'>
       <label class="control-label " for="segundo_nombre">
       Segundo Nombre
      </label>
      <input class="form-control" id="modal_segundo_nombre" name="segundo_nombre" type="text"/>
    </div>
     <div class='col-md-6'>
      <label class="control-label " for="primer_apellido">
       Primer Apellido
      </label>
      <input class="form-control" id="modal_primer_apellido" name="primer-apellido" type="text" required/>
    </div>
    <div class='col-md-6'>
       <label class="control-label " for="segundo_apellido">
       Segundo Apellido
      </label>
      <input class="form-control" id="modal_segundo_apellido" name="segundo-apellido" type="text"/>
    </div>
    <div class='col-md-6'>
    <label class="control-label " for="barrio">
       Barrio
      </label>
      <input class="form-control" id="modal_barrio" name="barrio" type="text"/>
    </div>
    <div class='col-md-6'>
     <label class="control-label " for="direccion">
       Direccion
      </label>
      <input class="form-control" id="modal_direccion" name="direccion" type="text"/>
       </div>
       <div class='col-md-6'>
      <label class="control-label " for="telefono">
       Telefono Fijo
      </label>
      <input class="form-control" id="modal_telefonofijo" name="telefonofijo" type="text"/>
      </div>
      <div class='col-md-6'>
       <label class="control-label " for="celular">
       Celular
      </label>
      <input class="form-control" id="modal_celular" name="celular" type="text"/>
    </div>
    <div class='col-md-12'>
      <label class="control-label " for="email">
       Correo
      </label>
      <input class="form-control" id="modal_email" name="email" type="email"/>
    </div>
      <input class="form-control" id="modal_id" name="id" type="hidden"/>
     </div>
<div class='col-md-12'>
        <div class="modal-footer">
          <button class="btn btn-primary " id= "btn_save" name="save" type="submit">Guardar Cambios</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
</div>

  </div>
