<?php include 'controlador.php'?>
<?php
require("bd.php");
error_reporting(E_ALL ^ E_NOTICE);
if(!empty($_POST)) {
    // validation errors
    $nombresError = null;
    $apellidosError = null;
    $identificadorError = null;
    $telefonoError = null;
    $correoError = null;
    $generoError = null;
    $aliasError = null;
    $contraseñaError = null;
    $confirmarError = null;
    // post values
    $nombres = $_POST['nombres'];
    $alias= $_POST['alias'];
    $apellidos = $_POST['apellidos'];
    $identificador = $_POST['identificador'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $sexo = $_POST['sexo'];
    $alias = $_POST['alias'];
    $fecha_nacimiento = date('Y-m-d', strtotime($_POST['fecha_nacimiento']));
    $contra = sha1($_POST['contra']);
    // validate input
    $valid = true;

    if (empty($nombres)) {
        $nombresError = "Por favor ingrese los nombres.";
        $valid = false;
    }

    if (empty($apellidos)) {
        $apellidosError = "Por favor ingrese los apellidos.";
        $valid = false;
    }

    if (empty($identificador)) {
        $identificadorError = "Por favor ingrese la DUI.";
        $valid = false;
    }

    if (empty($telefono)) {
        $telefonosError = "Por favor ingrese el telefono.";
        $valid = false;
    }

    if (empty($correo)) {
        $correoError = "Por favor ingrese el correo.";
        $valid = false;
    }

    if (empty($sexo)) {
        $sexoError = "Por favor seleccione el sexo.";
        $valid = false;
    }

    if (empty($alias)) {
        $aliasError = "Por favor ingrese el alias.";
        $valid = false;
    }

    if (empty($contra)) {
        $contraseñaError = "Por favor ingrese la contraseña.";
        $valid = false;
    }
    $captcha = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6LeRCw4TAAAAAFouEDSJf1AkNXFx3Vc8Iurwf74S&response='.$_POST['g-recaptcha-response'].'&remoteip='.$_SERVER['REMOTE_ADDR']),TRUE);
    // insert data
    if ($_POST['contra'] != $_POST['confirmar']) {
        $_POST['contra']="";
        $_POST['confirmar']="";
    }
    else if($captcha['success']=== FALSE){
        echo"<script type=\"text/javascript\">alert('No se admiten robots');</script>";
    }
    else if (ctype_space($nombres) || ctype_space($apellidos) || ctype_space($identificador) || ctype_space($telefono) || ctype_space($correo)) {
        echo"<script type=\"text/javascript\">alert('No se puede dejar datos en blanco');</script>";
    } else if (!isset($fecha_nacimiento)) {
        echo"<script type=\"text/javascript\">alert('Debe seleccionar una fecha');</script>";
    }
    /*Comprueba si hay espacios que se puedan tomar como caracter al inicio o al final en nombres, apellidos, alias y contraseña*/
    else if (strlen(trim($nombres, ' ')) <= 1)
    {
        echo"<script type=\"text/javascript\">alert('El nombre debe de tener al menos dos caracteres');</script>";
    }
    else if (strlen(trim($apellidos, ' ')) <= 1)
    {
        echo"<script type=\"text/javascript\">alert('El apellido debe de tener al menos dos caracteres');</script>";
    }
    else if (strlen(trim($alias, ' ')) <= 3)
    {
        echo"<script type=\"text/javascript\">alert('El nombre debe de tener al menos cuatro caracteres');</script>";
    }
    else if (!preg_match('/^.*(?=.{6,15})(?=.*\d)(?=.*[A-Z])(?=.*[a-z]).*$/', $contra)) {
        echo "<script type=\"text/javascript\">alert('La contraseña debe tener una minúscula, una mayúscula , un número y debe de ser de 6 a 15 caracteres');</script>";
    }
    else if ($contra=sha1($alias)){
        echo"<script type=\"text/javascript\">alert('No se puede poner como contraseña el mismo nombre de usuario');</script>";
    }
    /*VAlida solo letras en nombre y apellido*/
    else if(!preg_match('/^([a-z A-Z ñáéíóú ÑÁÉÍÓÚ Üü ]{2,60})$/i',$nombres)){
        echo"<script type=\"text/javascript\">alert('Los nombres no tienen números');</script>";
    }
    else if(!preg_match('/^([a-z A-Z ñáéíóú ÑÁÉÍÓÚ Üü ]{2,60})$/i',$apellidos)){
        echo"<script type=\"text/javascript\">alert('Los apellidos no tienen números');</script>";
    }
    /*Valida DUI*/
    else if (!preg_match('/^\d{8}-\d{1}$/', $identificador)){
        echo"<script type=\"text/javascript\">alert('Formato de DUI incorrecto. Ej. XXXXXXXX-X');</script>";
    }
    /*Valida numero de telefono formato El Salvador*/
    else if (!preg_match('/^[2|6|7]{1}\d{3}-\d{4}$/', $telefono)){
        echo"<script type=\"text/javascript\">alert('Formato de Teléfono incorrecto. Ej. (2,6 o 7)XXX-XXXX');</script>";
    }
    /*Valida correo electronico*/
    else if (!preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $correo)){
        echo"<script type=\"text/javascript\">alert('Formato de Correo Electrónico erróneo. Ej. hola.mundo@algo.algo');</script>";
    }

    else {
        if ($valid) {
            //SUBIR IMAGEN URL
            if ($_FILES['archivo']['name']=="") {
                echo"<script type=\"text/javascript\">alert('Tienes que subir una imagen');</script>";
            }else {

                $nombre = $_FILES['archivo']['name'];
                $nombre_tmp = $_FILES['archivo']['tmp_name'];
                $tipo = $_FILES['archivo']['type'];
                $tamano = $_FILES['archivo']['size'];

                $ext_permitidas = array('jpg', 'jpeg', 'gif', 'png');
                $partes_nombre = explode('.', $nombre);
                $extension = end($partes_nombre);
                $ext_correcta = in_array($extension, $ext_permitidas);
                $tipo_correcto = preg_match('/^image\/(pjpeg|jpeg|gif|png)$/', $tipo);
                $limite = 2048 * 1024;
                /*Toma el tamaño de la imagen subida*/
                $dimensiones = getimagesize($nombre_tmp);
                $ancho = $dimensiones[0];
                $alto = $dimensiones[1];
                /*Compara el tamaño con el que debe de ser*/
                if ($ancho == 150 && $alto == 195) {
                    /*Compara el peso de la imagen, debe ser menor a 2 MB  (Esto es mas codigo de validacion [extension y tipo])$ext_correcta && $tipo_correcto*/
                    if ($tamano <= $limite) {
                    if ($_FILES['archivo']['error'] > 0) {
                        echo 'Error: ' . $_FILES['archivo']['error'] . '<br/>';
                    } else {
                        echo 'Nombre: ' . $nombre . '<br/>';
                        echo 'Tipo: ' . $tipo . '<br/>';
                        echo 'Tamaño: ' . ($tamano / 1024) . ' Kb<br/>';
                        echo 'Guardado en: ' . $nombre_tmp;

                        if (file_exists('Mantenimients/img_empleados/' . $nombre)) {
                            echo '<br/>El archivo ya existe: ' . $nombre;
                        } else {
                            $sql = "SELECT MAX(id_empleado) as id_emp FROM empleados";
                            foreach ($PDO->query($sql) as $row) {
                                $idempleado = "$row[id_emp]";
                                $id= $idempleado+1;
                            }
                            move_uploaded_file($nombre_tmp, "Mantenimientos/img_empleados/" . $id . ".jpg");
                            $url = "img_empleados/" . $id. ".jpg";
                            echo "<br/>Guardado en: " . "Manteniminetos/img_empleados/" . $id. ".jpg";
                            /*INGRESA DATOS DE EMPLEADOS*/
                            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $sql = "INSERT INTO empleados(nombres, apellidos, identificador, telefono, correo, sexo, fecha_nacimiento, foto) values(?, ?, ?, ?, ?, ?, ?,?)";
                            $stmt = $PDO->prepare($sql);
                            $stmt->execute(array($nombres, $apellidos, $identificador, $telefono, $correo, $sexo, $fecha_nacimiento, $url));

                            /*GUARDAR TIPOS DE USUARIOS*/
                            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $sql = "INSERT INTO tipos_usuarios(nombre,descripcion, agregar, modificar, eliminar, consultar) values(?, ?, ?, ?, ?, ?)";
                            $stmt = $PDO->prepare($sql);
                            $stmt->execute(array('Administrador', 'El que controla todo',1 ,1 ,1 ,1));


                            /*SELECCIONAR EL ID DEL ULTIMO EMPLEADO INGRESADO*/
                            $sql= "SELECT MAX(id_empleado) as id_emp FROM empleados";
                            foreach($PDO->query($sql) as $row) {
                                $idemp = "$row[id_emp]";
                            }

                            /*SELECCIONAR EL ID DEL TIPO DE USUARIO DONDE EL NOMBRE SEA ADMINISTRADOR*/
                            $sql2 = "SELECT id_tipo_usuario FROM tipos_usuarios  WHERE nombre='Administrador'";
                            foreach($PDO->query($sql2) as $row2) {
                                $idtip = "$row2[id_tipo_usuario]";
                            }
                            /*INGRESAR USUARIOS*/
                            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $sql = "INSERT INTO usuarios(alias,contrasena, estado, id_empleado, id_tipo_usuario) values(?, ?, ?, ?, ?)";
                            $stmt = $PDO->prepare($sql);
                            $stmt->execute(array($alias, $contra, 1, $idemp, $idtip));
                            $PDO = null;
                            header("Location: Login.php");
                        }
                    }
                } else {
                    echo"<script type=\"text/javascript\">alert('La imagen pesa mas de 2 MB');</script>";
                }
                }else {
                    echo "<script type=\"text/javascript\">alert('La imagen debe ser exactamende de 150px de alto x 195px de ancho');</script>";
                }
            }
        }

    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!--ESTILOLS Y FUNCIONESVARIOS -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="css/estilos.css">
    <!--SCRIPT Y ESTILOS DE BOOTSTRAP -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js" type="text/javascript"></script>
    <!--SCRIPT DE VALIDACIONES-->
    <script type="text/javascript"  src="js/validaciones.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/funciones.js"></script>
    <!--SCRIPT DE DATETIMEPICKER -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
    <link type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,800italic,400,700,800">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <link type="text/css" rel="stylesheet" href="Mantenimientos/styles/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="Mantenimientos/styles/main.css">
    <link type="text/css" rel="stylesheet" href="Mantenimientos/styles/style-responsive.css">
</head>

<body class="img-responsive" style="background: url('Mantenimientos/images/bg/bg.jpg') center center fixed;">
<div class="page-form">
    <div class="panel panel-blue">
        <div class="panel-body pan">
            <form action="#" method="post" class="form" role="form" enctype="multipart/form-data">
                <div class='form-group <?php print(!empty($nombresError)?"has-error":""); ?>'>
                    <input class="form-control" name="nombres" placeholder="Nombres" required='required' id='nombres' type="text" autofocus value='<?php print(!empty($nombres)?$nombres:""); ?>'  />
                    <?php print(!empty($nombresError)?"<span class='help-block'>$nombresError</span>":""); ?>
                </div>
                <div class='form-group <?php print(!empty($apellidosError)?"has-error":""); ?>'>
                    <input class="form-control" name="apellidos" placeholder="Apellidos" type="text" required='required' id='apellidos'  value='<?php print(!empty($apellidos)?$apellidos:""); ?>' />
                    <?php print(!empty($apellidosError)?"<span class='help-block'>$apellidosError</span>":""); ?>
                </div>
                <div class='form-group <?php print(!empty($identificadorError)?"has-error":""); ?>'>
                    <input class="form-control" name="identificador" placeholder="DUI" type="text" required='required' id='identificador'  value='<?php print(!empty($identificador)?$identificador:""); ?>' />
                    <?php print(!empty($identificadorError)?"<span class='help-block'>$identificadorError</span>":""); ?>
                </div>
                <div class='form-group <?php print(!empty($telefonosError)?"has-error":""); ?>'>
                    <input class="form-control" name="telefono" placeholder="Telefono" type="text" required='required' id='telefono'   value='<?php print(!empty($telefono)?$telefono:""); ?>'/>
                    <?php print(!empty($telefonosError)?"<span class='help-block'>$telefonosError</span>":""); ?>
                </div>
                <div class='form-group <?php print(!empty($correoError)?"has-error":""); ?>'>
                    <input class="form-control" name="correo" placeholder="Correo" type="email" required='required' id='correo'  value='<?php print(!empty($correo)?$correo:""); ?>' />
                    <?php print(!empty($correoError)?"<span class='help-block'>$correoError</span>":""); ?>
                </div>
                <div class="form-group">
                    <div class="input-group input-append date" id="dateRangePicker">
                        <input type="text" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" readonly  value='<?php print(!empty($fecha_nacimiento)?$fecha_nacimiento:""); ?>'/>
                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                </div>
                <div class='form-group <?php print(!empty($generoError)?"has-error":""); ?>'>
                    <select name='sexo' required='required' id='sexo' class='form-control'>
                        <option></option>
                        <option value='Masculino' <?php print(isset($sexo) && $sexo == "Masculino"?"selected":""); ?>>Masculino</option>
                        <option value='Femenino' <?php print(isset($sexo) && $sexo == "Femenino"?"selected":""); ?>>Femenino</option>
                    </select>
                    <?php print(!empty($generoError)?"<span class='help-block'>$generoError</span>":""); ?>
                </div>
                <div class='form-group'>
                    <input type="file" name="archivo" id="archivo" accept="image/png, image/jpeg, image/gif"/>
                </div>
                <div class='form-group <?php print(!empty($aliasError)?"has-error":""); ?>'>
                    <input class="form-control" name="alias" placeholder="Alias" type="text" required='required' id='alias'  value='<?php print(!empty($alias)?$alias:""); ?>'/>
                    <?php print(!empty($aliasError)?"<span class='help-block'>$nombresError</span>":""); ?>
                </div>
                <div class='form-group <?php print(!empty($contraseñaError)?"has-error":""); ?>'>
                    <input class="form-control" name="contra" placeholder="Contraseña" type="password" required='required' id='contra' autofocus />
                </div>
                <div class='form-group <?php print(!empty($confirmarError)?"has-error":""); ?>'>
                    <input class="form-control" name="confirmar" placeholder="Confirmar Contraseña" type="password" required='required' id='nombres' autofocus />
                    <?php print(!empty($confirmarError)?"<span class='help-block'>$confirmarError</span>":""); ?>
                </div>
                <div class="form-group ">
                    <div class="g-recaptcha" data-sitekey="6LeRCw4TAAAAAOoQcioyh5jn-G2aP0A_WyVdgCfC"></div>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit" value="Enviar"">
                Registrarse</button>
            </form>
        </div>
    </div>
    <div class="col-lg-12 text-center">
        <p>&nbsp;</p>
    </div>
</div>
</body>
</html>