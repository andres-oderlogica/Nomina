

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header"> 
 
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Redactar Correo</h4>
<br>
<div class="bootstrap-iso">
 <div class="container-fluid">
  <div class="row">   
     <div class="form-group ">
      <label class="control-label " for="asunto">
       Asunto
      </label>
      <input class="form-control" id="asunto" name="asunto" type="text" required = "true"/>

      <label class="control-label " for="correopadre">
       Correo de Respuesta
      </label>
      <input class="form-control" id="mail_padre" name="mail_padre" type="email" required = "true"/>
      
      <label class="control-label " for="alumno">
       Nombre del Alumno
      </label>
      <input class="form-control" id="mail_alumno" name="mail_alumno" type="text" required = "true"/>
     <div class="form-group">
       <label for="comment">Mensaje:</label>
         <textarea class="form-control" rows="7" id="correo" name="correo"></textarea>
    </div>
      <input class="form-control" id="modal_id" name="id" type="hidden"/>
     </div>
        <div class="modal-footer">
          <button class="btn btn-primary " id= "btn_save" name="save" type="submit">Enviar Mensaje</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>


        </div>
      </div>
</div>

  </div>
