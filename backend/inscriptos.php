<style>
.modal-dialog {
    width: 750px;
    margin: 30px auto;
}  

.modal-dialog .form-group div {
  background-color: #f0f0f0;
  padding: 5px;
  min-height: 32px;
}

</style>
<div class="row">
  <div class="col-lg-12">
    <h4>Inscripciones</h4>
    <div class="wp-example clearfix">
      <?
      $sq = mysql_query("SELECT * FROM inscriptions ORDER by id DESC");
      ?>
        <table class="table">
          <thead>
            <tr>
              <th>Fecha</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>DNI</th>
              <th>Teléfono</th>
              <th>Email</th>
              <th style="width: 152px;"></th>
            </tr>
          </thead>
          <tbody>
          <?php while( $s = mysql_fetch_array($sq) ){ ?>
            <tr>
              <td><?php echo date("d-m-Y", strtotime($s["fecha"])); ?></td>
              <td><?php echo $s["nombre"] ?></td>
              <td><?php echo $s["apellido"] ?></td>
              <td><?php echo $s["dni"] ?></td>
              <td><?php echo $s["telefono"] ?></td>
              <td><?php echo $s["email"] ?></td>
              <td><a ref="#" class="btn btn-primary btn-ins" data-id="<?php echo $s["id"]; ?>">Detalle</a> <a ref="#" class="btn btn-warning btn-delete" data-id="<?php echo $s["id"]; ?>">Borrar</a></td>
            </tr>
          <?}?>
          </tbody>
        </table>
    </div>
  </div>  
</div>  

<div id="inscripto" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Inscripto</h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function(){
    $('.btn-ins').click(function(e) {
      e.preventDefault();
      id = $(this).data('id');
      $('.modal-body').load('detalle.php?id='+id);
      $('#inscripto').modal({show: true});
    });
    $('.btn-delete').click(function(e) {
      e.preventDefault();
      var t = $(this);
      var id = t.data('id');
      var url = 'detalle.php?delete='+id;
      if(confirm('Se borrar esta inscripción')) {
        $.ajax({url: url, success: function(result){
            if(result==1){
              alert('La inscripcíon fue borrada.');
              t.parent().parent().remove();
            } else {
              alert('No se pudo borrar la inscripcíon');
            }
        }});
      }
    });
  });
</script>