

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar Salario</h4>
<br>
<div class="bootstrap-iso">
 <div class="container-fluid">
  <div class="row">
     <div class="form-group ">
      <div class='col-md-6'>
      <label class="control-label " for="descripcion_salario">
       Descripcion Salario
      </label>
    <input class="form-control" id="descripcion_salario" name="descripcion_salario"  type="text" required>
    </div>
    <div class='col-md-6'>
      <label class="control-label " for="valor_salario">
       Valor Salario
      </label>
      <input class="form-control" id="valor_salario" name="valor_salario" type="number" step="any" >
    </div>
    <div class='col-md-6'>
       <label class="control-label " for="primas">
       Primas
      </label>
      <input class="form-control" id="primas" name="primas" type="number" step="any" required>
    </div>
    <div class='col-md-6'>
       <label class="control-label " for="cesantias">
       Cesantias
      </label>
      <input class="form-control" id="cesantias" name="cesantias" type="number" step="any" >
    </div>
     <div class='col-md-6'>
      <label class="control-label " for="comisiones">
       Comisiones
      </label>
      <input class="form-control" id="comisiones" name="comisiones" type="number" step="any" >
    </div>
    <div class='col-md-6'>
       <label class="control-label " for="caja_compensacion">
       Caja de Compensacion
      </label>
      <input class="form-control" id="caja_compensacion" name="caja_compensacion" type="number" step="any" >
    </div>
    <div class='col-md-6'>
    <label class="control-label " for="aux_transporte">
       Auxilio de Transporte
      </label>
    <input class="form-control" id="aux_transporte" name="aux_transporte" type="number" step="any" >
    </div>
    <div class='col-md-6'>
     <label class="control-label " for="arl">
       ARL
      </label>
      <input class="form-control" id="arl" name="arl" type="number" step="any" >
       </div>
       <div class='col-md-6'>
      <label class="control-label " for="seguridad_social">
       Seguridad Social
      </label>
        <input class="form-control" id="desc_salud" name="desc_salud" type="number" step="any" >
      </div>
      <div class='col-md-6'>
       <label class="control-label " for="desc_pension">
       Pension
      </label>
      <input class="form-control" id="desc_pension" name="desc_pension" type="number" step="any" >
    </div>
    <div class='col-md-6'>
      <label class="control-label " for="desc_cooperativa">
       Cooperativa
      </label>
      <input class="form-control" id="desc_cooperativa" name="desc_cooperativa" type="number" step="any" >
    </div>
    <div class='col-md-6'>
      <label class="control-label " for="ahorro">
       Ahorro
      </label>
      <input class="form-control" id="ahorros" name="ahorros" type="number" step="any" >
    </div>
    <div class='col-md-6'>
      <label class="control-label " for="desc_asociacion">
       Aporte Asociacion
      </label>
        <input class="form-control" id="desc_asociacion" name="desc_asociacion" type="number" step="any" >
    </div>
    <div class='col-md-6'>
      <label class="control-label " for="otros">
       Otros
      </label>
        <input class="form-control" id="otros" name="otros" type="number" step="any" >
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
