

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header"> 
 
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar Productos</h4>
<br>
<div class="bootstrap-iso">
 <div class="container-fluid">
  <div class="row">
     <div class="form-group ">
      <label class="control-label " for="codigo">
       Codigo
      </label>
      <input class="form-control" id="modal_codigo" name="codigo" type="text"/>
     </div>
     
     <input class="form-control" id="modal_id" name="id" type="hidden"/>
     <div class="form-group ">
      <label class="control-label " for="descripcion">
       Descripcion
      </label>
      <input class="form-control" id="modal_descripcion" name="descripcion" type="text"/>
     </div>
    

  
     <div class="form-group ">
      <label class="control-label " for="precio">
       Precio
      </label>
      <input class="form-control" id="modal_precio" name="precio" value="0" type="text"/>
     </div>
   

   
     <div class="form-group ">
      <label class="control-label " for="existencias">
       Existencias
      </label>
      <input class="form-control" id="modal_existencias" name="existencias" value="1" type="text"/>
     </div>  

 
     <div class="form-group ">
      <label class="control-label " for="iva">
       P. Iva
      </label>
      <input class="form-control" id="modal_iva" name="iva" value="0" type="text"/>
     </div>  
    </div>


        <div class="modal-footer">
          <button class="btn btn-primary " id= "btn_save" name="save" type="submit">Guardar Cambios</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
</div>

  </div>
