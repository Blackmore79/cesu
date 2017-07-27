<?include_once('includes/conectionDB.php');?>
<?include_once('includes/MyPDO.php');?>
<?php
    session_start();

    $status = 0;
    //// VERIFICAMOS QUE EL SEED ENVIA SEA EL MISMO DE LA SESSIÓN
    if (isset($_SESSION['seed']) && isset($_POST["enviado"]) && $_SESSION['seed']==$_POST["enviado"])
    {
        $db = new MyPDO(array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

        $data = $_POST;

        array_splice($data, count($data)-1, count($data));

        $que = "";
        $fields = "";
        $values = array();
        foreach ($data as $key => $value) {
            if($que===""){
                $fields = str_replace("-", "_", $key);
                $que = "?";//"'".$value."'";
            } else {
                $fields .= ",".str_replace("-", "_", $key);
                $que .= ",?"; //",'".$value."'";
            }
            if($key=='nacimiento-fecha'){
                $values[] = implode("-", array_reverse(explode("/", $value)));
            } else {
                $values[] = $value;
            }
        }

        $sql ="INSERT INTO inscriptions (".$fields.") VALUES (".$que.")";

        $stmt = $db->prepare($sql);
        $stmt->execute( $values );

        if($stmt->rowCount()>0){
            $_SESSION['form_status'] = 1;
        } else {
            $_SESSION['form_status'] = 2;
        }
	
        header('Location: http://cesu.edu.ar/new/formulario.php');
        exit;
    } else {
        // generate the random number
        $rand = rand();
        // We save the seed
        $_SESSION['seed'] = $rand;
        if (isset($_SESSION['form_status'])){
             $status = $_SESSION['form_status'];
        }

        unset($_SESSION['form_status']);
    }
?>
<!DOCTYPE html>
<html>
<?include_once('includes/head.php');?>

<link rel="stylesheet" href="/new/assets/forms/bootstrap-switch.min.css" type="text/css">
<style>
input:not([type=submit]):invalid, textarea:invalid {
    background-color: #ffdddd;
}

input:not([type=submit]):valid, textarea:valid {
    background-color: #ddffdd;
}

input:not([type=submit]):invalid:required, textarea:invalid:required {
    background: #ffdddd url('/new/assets/forms/asterisk1.png') no-repeat right top; 
}

input:not([type=submit]):valid:required, textarea:valid:required {
    background: #ddffdd url('/new/assets/forms/asterisk2.png') no-repeat right top; 
}

input:not([type=submit]):optional, textarea:optional {
    background-color: #e7f4ff;
}
</style>
<body>

<div class="wrapper">
<? include_once('includes/header.php');?>
    <div class="pg-opt pin">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>Inscripción</h2>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb">
                        <li><a href="index.php">Home</a></li>
                        <li class="active">Formulario de Inscripción</li>
                    </ol>
                </div>
                
            </div>
        </div>
    </div>
    
    <section class="slice bg-3">
        <div class="w-section inverse">
            <div class="container">
                <div class="row">
                    <div class="col-md-10">
                        <h3 class="section-title">Ficha de inscripcíon</h3>
                        <p>
                        Para más información no dudes en escribirnos un mensaje. 
                        </p>
                        <?php if( $status==0 || $status==2 ) { ?>
                        <?php if($status==2) {?>
                            <p class="alert alert-warning"> Se produjo un error, vuelva a intertar enviar el formulario o pongase en contacto con nosotros. </p>
                        <?php } ?>
                        <form class="form-light mt-20" role="form" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Apellido</label>
                                        <input type="text" class="form-control" placeholder="Apellido" name="apellido" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" class="form-control" placeholder="Nombre" name="nombre" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Domicilio</label>
                                        <input type="text" class="form-control" placeholder="Domicilio" name="domicilio" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Número</label>
                                        <input type="text" class="form-control" placeholder="Número" name="numero" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Piso</label>
                                        <input type="text" class="form-control" placeholder="Piso" name="piso">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Dto.</label>
                                        <input type="text" class="form-control" placeholder="Dto" name="dto">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Localidad</label>
                                        <input type="text" class="form-control" placeholder="Localidad" name="localidad" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Cod. Postal</label>
                                        <input type="text" class="form-control" placeholder="Cod. Postal" name="codpostal" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Teléfono</label>
                                        <input type="text" class="form-control h5-telefono" placeholder="011-4111-1111" name="telefono" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Celular</label>
                                        <input type="text" class="form-control h5-celu" placeholder="15-4111-1111" name="celular" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Lugar de Nacimiento</label>
                                        <input type="text" class="form-control" placeholder="Lugar de Nacimiento" name="nacimiento-lugar" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Fecha de Nacimiento</label>
                                        <input type="date" class="form-control h5-date" placeholder="dd/mm/yyyy" name="nacimiento-fecha" required pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Edad</label>
                                        <input type="number" class="form-control" placeholder="Edad" name="edad" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nacionalidad</label>
                                        <input type="text" class="form-control" placeholder="Nacionalidad" name="nacinalidad" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>DNI</label>
                                        <input type="text" class="form-control" placeholder="DNI" name="dni" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Correo Electrónico</label>
                                        <input type="email" class="form-control h5-email" placeholder="Correo Electrónico" name="email" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Trabaja</label><br/>
                                        <input type="checkbox" class="form-control" name="trabaja" data-on-text="SI" data-off-text="NO" size="large" value="SI">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Donde</label>
                                        <input type="text" class="form-control" placeholder="Donde" name="donde" disabled="disabled">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Estado civil</label>
                                        <input type="text" class="form-control" placeholder="Estado civil" name="estado-civil" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Hijos</label><br/>
                                        <input type="checkbox" class="form-control" name="hijos" data-on-text="SI" data-off-text="NO" size="large" value="SI">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Cantidad</label>
                                        <input type="text" class="form-control" placeholder="Cantidad" name="cantidad" disabled="disabled">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Edad-Edades</label>
                                        <input type="text" class="form-control" placeholder="Edad-Edades" name="edades" disabled="disabled">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Padre - Apellido y nombre</label>
                                        <input type="text" class="form-control" placeholder="Apellido y nombre" name="padre" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Vive</label>
                                        <br/>
                                        <input type="checkbox" class="form-control" name="padre-vive" data-on-text="SI" data-off-text="NO" size="large" value="SI">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Nacionalidad</label>
                                        <input type="text" class="form-control" placeholder="Nacionalidad" name="padre-nacionalidad" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Profesión</label>
                                        <input type="text" class="form-control" placeholder="Profesión" name="padre-profesion" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Madre - Apellido y nombre</label>
                                        <input type="text" class="form-control" placeholder="Apellido y nombre" name="madre" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Vive</label>
                                        <br/>
                                        <input type="checkbox" class="form-control" name="madre-vive" data-on-text="SI" data-off-text="NO" size="large" value="SI">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Nacionalidad</label>
                                        <input type="text" class="form-control" placeholder="Nacionalidad" name="madre-nacionalidad" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Profesión</label>
                                        <input type="text" class="form-control" placeholder="Profesión" name="madre-profesion" required>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label>Persona Allegada - Apellido y Nombre</label>
                                        <input type="text" class="form-control" placeholder="Apellido y nombre" name="allegado" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Domicilio (Si recide en el interior) calle</label>
                                        <input type="text" class="form-control" placeholder="Domicilio" name="interior-calle" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Número</label>
                                        <input type="text" class="form-control" placeholder="numero" name="interior-numero" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Piso</label>
                                        <input type="text" class="form-control" placeholder="Profesión" name="interior-piso">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Dto.</label>
                                        <input type="text" class="form-control" placeholder="Dto." name="interior-dto">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Localidad</label>
                                        <input type="text" class="form-control" placeholder="Localidad" name="interior-localidad" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Cod. Postal</label>
                                        <input type="text" class="form-control" placeholder="Cod. Postal" name="interior-codpostal" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Teléfono</label>
                                        <input type="text" class="form-control h5-telefono" placeholder="011-4111-1111" name="interior-telefono" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Teléfono Celular</label>
                                        <input type="text" class="form-control h5-celu" placeholder="15-1111-1111" name="interior-celular" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Declara haber obtenido el Título de:</label>
                                        <input type="text" class="form-control" placeholder="............................." name="titulo" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Adeuda las asignaturas:</label>
                                        <textarea class="form-control" placeholder="............................." style="height:100px;" name="adeuda" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Establecimiento donde cursó:</label>
                                        <input type="text" class="form-control" placeholder="............................." name="establecimiento" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Localidad:</label>
                                        <input type="text" class="form-control" placeholder="............................." name="establecimiento-localidad" required>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="enviado" value="<?php echo $_SESSION['seed']; ?>">
                            <button type="submit" class="btn btn-two btn-iscripcion">Enviar Formulario</button>
                        </form>
                        <?php } else if( $status==1 ) { ?>
                            <p class="alert alert-info"> Sus datos fueron enviados correctamente, nos ponderemos en contacto a la brevedad. </p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    
    </section>
    
    <?include_once('includes/footer.php');?>
    </div>

<!-- JavaScript -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/modernizr.custom.js"></script>
<script type="text/javascript" src="js/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/jquery.easing.js"></script>

<!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
<![endif]-->

<!-- Plugins -->
<script type="text/javascript" src="assets/hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
<script type="text/javascript" src="assets/masonry/masonry.js"></script>
<script type="text/javascript" src="assets/page-scroller/jquery.ui.totop.min.js"></script>
<script type="text/javascript" src="assets/mixitup/jquery.mixitup.js"></script>
<script type="text/javascript" src="assets/mixitup/jquery.mixitup.init.js"></script>
<script type="text/javascript" src="assets/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
<script type="text/javascript" src="assets/easy-pie-chart/jquery.easypiechart.js"></script>
<script type="text/javascript" src="assets/waypoints/waypoints.min.js"></script>
<script type="text/javascript" src="assets/sticky/jquery.sticky.js"></script>
<script type="text/javascript" src="js/jquery.wp.custom.js"></script>
<script type="text/javascript" src="js/jquery.wp.switcher.js"></script>
<script type="text/javascript" src="/new/assets/forms/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="/new/assets/forms/jquery.h5validate.js"></script>
<script type="text/javascript" src="/new/assets/forms/main.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-61240167-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>
