<?php
  session_start();
  header('Content-Type: text/html; charset=utf-8');

  include_once('includes/conectionDB.php');  
  include_once('includes/MyPDO.php');  

  if(!isset($_SESSION['administrador'])) {
    $_SESSION['url']=$_SERVER['REQUEST_URI'];
    header("Location: http://cesu.edu.ar/new/login.html");
    die();    
  }

  $db = new MyPDO(array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

  if( isset($_GET["delete"]) ) {

    $sql = "DELETE FROM inscriptions WHERE id=?";

    $rs = $db->query($sql, $_GET["delete"]);

    if($rs->rowCount()>0){
      echo "1";
    } else {
      echo "0";
    }

  } else if( isset($_GET["id"]) ) {

   	$sql = "SELECT * FROM inscriptions WHERE id=?";

    $rs = $db->query($sql, $_GET["id"]);

    if($rs->rowCount()>0){
      $insobj=$rs->fetchAll(PDO::FETCH_OBJ); $ins = $insobj[0]; ?>
<div class="row">
  <div class="col-md-6">
      <div class="form-group">
          <label>Apellido</label><div>          <?php echo $ins->apellido ?></div>
      </div>
  </div>
  <div class="col-md-6">
      <div class="form-group">
          <label>Nombre</label><div>          <?php echo $ins->nombre ?></div>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
      <div class="form-group">
          <label>Domicilio</label><div>          <?php echo $ins->domicilio ?></div>
      </div>
  </div>
  <div class="col-md-2">
      <div class="form-group">
          <label>Número</label><div>          <?php echo $ins->numero ?></div>
      </div>
  </div>
  <div class="col-md-2">
      <div class="form-group">
          <label>Piso</label><div>          <?php echo $ins->piso ?></div>
      </div>
  </div>
  <div class="col-md-2">
      <div class="form-group">
          <label>Dto.</label><div>          <?php echo $ins->dto ?></div>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-md-3">
      <div class="form-group">
          <label>Localidad</label><div>          <?php echo $ins->localidad ?></div>
      </div>
  </div>
  <div class="col-md-3">
      <div class="form-group">
          <label>Cod. Postal</label><div>          <?php echo $ins->codpostal ?></div>
      </div>
  </div>
  <div class="col-md-3">
      <div class="form-group">
          <label>Teléfono</label><div>          <?php echo $ins->telefono ?></div>
      </div>
  </div>
  <div class="col-md-3">
      <div class="form-group">
          <label>Celular</label><div>          <?php echo $ins->celular ?></div>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
      <div class="form-group">
          <label>Lugar de Nacimiento</label><div>          <?php echo $ins->nacimiento_lugar ?></div>
      </div>
  </div>
  <div class="col-md-2">
      <div class="form-group">
          <label>Fec. Nacimiento</label><div>          <?php echo date("d/m/Y", strtotime($ins->nacimiento_fecha)); ?></div>
      </div>
  </div>
  <div class="col-md-2">
      <div class="form-group">
          <label>Edad</label><div>          <?php echo $ins->edad ?></div>
      </div>
  </div>
  <div class="col-md-4">
      <div class="form-group">
          <label>Nacionalidad</label><div>          <?php echo $ins->nacinalidad ?></div>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
      <div class="form-group">
          <label>DNI</label><div>          <?php echo $ins->dni ?></div>
      </div>
  </div>
  <div class="col-md-6">
      <div class="form-group">
          <label>Correo Electrónico</label><div>          <?php echo $ins->email ?></div>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
      <div class="form-group">
          <label>Trabaja</label>
          <div><?php echo $ins->trabaja ?></div>
      </div>
  </div>
  <div class="col-md-6">
      <div class="form-group">
          <label>Donde</label><div>          <?php echo $ins->donde ?></div>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
      <div class="form-group">
          <label>Estado civil</label><div>          <?php echo $ins->estado_civil ?></div>
      </div>
  </div>
  <div class="col-md-2">
      <div class="form-group">
          <label>Hijos</label>
          <div><?php echo $ins->hijos ?></div>
      </div>
  </div>
  <div class="col-md-2">
      <div class="form-group">
          <label>Cantidad</label><div>          <?php echo $ins->cantidad ?></div>
      </div>
  </div>
  <div class="col-md-2">
      <div class="form-group">
          <label>Edad-Edades</label><div>          <?php echo $ins->edades ?></div>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
      <div class="form-group">
          <label>Padre - Apellido y nombre</label><div>          <?php echo $ins->padre ?></div>
      </div>
  </div>
  <div class="col-md-2">
      <div class="form-group">
          <label>Vive</label>
          <div>
          <?php echo $ins->padre_vive ?>
          </div>
      </div>
  </div>
  <div class="col-md-3">
      <div class="form-group">
          <label>Nacionalidad</label><div>          <?php echo $ins->padre_nacionalidad ?></div>
      </div>
  </div>
  <div class="col-md-3">
      <div class="form-group">
          <label>Profesión</label><div>          <?php echo $ins->padre_profesion ?></div>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
      <div class="form-group">
          <label>Madre - Apellido y nombre</label><div>          <?php echo $ins->madre ?></div>
      </div>
  </div>
  <div class="col-md-2">
      <div class="form-group">
          <label>Vive</label>
          <div>
          <?php echo $ins->madre_vive ?></div>
      </div>
  </div>
  <div class="col-md-3">
      <div class="form-group">
          <label>Nacionalidad</label><div>          <?php echo $ins->madre_nacionalidad ?></div>
      </div>
  </div>
  <div class="col-md-3">
      <div class="form-group">
          <label>Profesión</label><div>          <?php echo $ins->madre_profesion ?></div>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-md-7">
      <div class="form-group">
          <label>Persona Allegada - Apellido y Nombre</label><div>          <?php echo $ins->allegado ?></div>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
      <div class="form-group">
          <label>Domicilio (Si recide en el interior) calle</label><div>          <?php echo $ins->interior_calle ?></div>
      </div>
  </div>
  <div class="col-md-2">
      <div class="form-group">
          <label>Número</label><div>          <?php echo $ins->interior_numero ?></div>
  </div>
  <div class="col-md-2">
      <div class="form-group">
          <label>Piso</label><div>          <?php echo $ins->interior_piso ?></div>
      </div>
  </div>
  <div class="col-md-2">
      <div class="form-group">
          <label>Dto.</label><div>          <?php echo $ins->interior_dto ?></div>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-md-3">
      <div class="form-group">
          <label>Localidad</label><div>          <?php echo $ins->interior_localidad ?></div>
      </div>
  </div>
  <div class="col-md-3">
      <div class="form-group">
          <label>Cod. Postal</label><div>          <?php echo $ins->interior_codpostal ?></div>
      </div>
  </div>
  <div class="col-md-3">
      <div class="form-group">
          <label>Teléfono</label><div>          <?php echo $ins->interior_telefono ?></div>
      </div>
  </div>
  <div class="col-md-3">
      <div class="form-group">
          <label>Teléfono Celular</label><div>          <?php echo $ins->interior_celular ?></div>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
      <div class="form-group">
          <label>Declara haber obtenido el Título de:</label><div>          <?php echo $ins->titulo ?></div>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
      <div class="form-group">
          <label>Adeuda las asignaturas:</label><div>          <?php echo $ins->adeuda ?></div>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
      <div class="form-group">
          <label>Establecimiento donde cursó:</label><div>          <?php echo $ins->establecimiento ?></div>
      </div>
  </div>
  <div class="col-md-6">
      <div class="form-group">
          <label>Localidad:</label><div>          <?php echo $ins->establecimiento_localidad ?> </div>
      </div>
  </div>
</div>
<?php
    } else {
      echo '<p class="alert alert-info">No se pudo cargar la inscripción.</p>';
    }  
    
  } else {
  	echo '<p class="alert alert-info">No se pudo cargar la inscripción.</p>';
  }


