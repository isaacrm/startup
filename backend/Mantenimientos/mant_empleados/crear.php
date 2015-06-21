<?php
//creamos la sesion
session_start();
//validamos si se ha hecho o no el inicio de sesion correctamente
//si no se ha hecho la sesion nos regresará a login.php
if(!isset($_SESSION['alias']))
{
    header('Location: ../../Login.php');
    exit();
}
?>

<?php
require("../../bd.php");
if(!empty($_POST)) {
    error_reporting(E_ALL ^ E_NOTICE);

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
    $fecha_nacimiento = date('Y-m-d', strtotime($_POST['fecha_nacimiento']));
    $contra = sha1($_POST['contra']);
    $tipo = $_POST['tipo'];
    // validate input
    $valid = true;

    // $regex = '/(^\d{8})-(\d$)/';
    //if (!preg_match($regex, $identificador)) {
    // echo 'El DUI NO es válido';
    //}

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

    // insert data
    if ($_POST['contra'] != $_POST['confirmar']) {
        echo"<script type=\"text/javascript\">alert('Las contraseñas no coinciden');</script>";
        $_POST['contra']="";
        $_POST['confirmar']="";
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
    else if (strlen(trim($contra, ' ')) <= 3)
    {
        echo"<script type=\"text/javascript\">alert('El apellido debe de tener al menos cuatro caracteres');</script>";
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
            }
            else {
                $nombre = $_FILES['archivo']['name'];
                $nombre_tmp = $_FILES['archivo']['tmp_name'];
                $tipo = $_FILES['archivo']['type'];
                $tamano = $_FILES['archivo']['size'];

                $ext_permitidas = array('jpg', 'jpeg', 'gif', 'png');
                $partes_nombre = explode('.', $nombre);
                $extension = end($partes_nombre);
                $ext_correcta = in_array($extension, $ext_permitidas);
                $tipo_correcto = preg_match('/^image\/(pjpeg|jpeg|gif|png)$/', $tipo);
                $limite = 2000 * 1024;

                if ($ext_correcta && $tipo_correcto && $tamano <= $limite) {
                    if ($_FILES['archivo']['error'] > 0) {
                        echo 'Error: ' . $_FILES['archivo']['error'] . '<br/>';
                    } else {
                        echo 'Nombre: ' . $nombre . '<br/>';
                        echo 'Tipo: ' . $tipo . '<br/>';
                        echo 'Tamaño: ' . ($tamano / 1024) . ' Kb<br/>';
                        echo 'Guardado en: ' . $nombre_tmp;

                        if (file_exists('../img_empleados/' . $nombre)) {
                            echo '<br/>El archivo ya existe: ' . $nombre;
                        } else {
                            move_uploaded_file($nombre_tmp, "../img_empleados/" . $identificador . ".jpg");
                            $url = "img_empleados/" . $identificador . ".jpg";
                            echo "<br/>Guardado en: " . "../img_empleados/" . $identificador. ".jpg";

                            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $sql = "INSERT INTO empleados(nombres, apellidos, identificador, telefono, correo, sexo, fecha_nacimiento, foto) values(?, ?, ?, ?, ?, ?, ?,?)";
                            $stmt = $PDO->prepare($sql);
                            $stmt->execute(array($nombres, $apellidos, $identificador, $telefono, $correo, $sexo, $fecha_nacimiento, $url));

                            /*SELECCIONAR EL ID DEL ULTIMO EMPLEADO INGRESADO*/
                            $sql= "SELECT MAX(id_empleado) as id_emp FROM empleados";
                            foreach($PDO->query($sql) as $row) {
                                $idemp = "$row[id_emp]";
                            }
                            /*SELECCIONAR EL ID DEL TIPO DE USUARIO DONDE EL NOMBRE SEA el tipo seleccionado*/
                            $sql2 = "SELECT id_tipo_usuario FROM tipos_usuarios  WHERE nombre='".$_POST['tipo']."'";
                            foreach($PDO->query($sql2) as $row2) {
                                $idtip = "$row2[id_tipo_usuario]";
                            }
                            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $sql = "INSERT INTO usuarios(alias,contrasena, estado, id_empleado, id_tipo_usuario) values(?, ?, ?, ?, ?)";
                            $stmt = $PDO->prepare($sql);
                            $stmt->execute(array($alias, $contra, 1, $idemp, $idtip));
                            header("Location: empleados.php");
                        }
                    }
                } else {
                    echo"<script type=\"text/javascript\">alert('La imagen pesa mas de 2 MB');</script>";
                }
            }
        }

    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Mantenimiento | Empleados-Usuarios</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--SCRIPT DE DATETIMEPICKER -->

    <!--Loading bootstrap css-->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js" type="text/javascript"></script>
    <!--SCRIPT DE VALIDACIONES-->
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <link type="text/css" rel="stylesheet" href="../styles/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="../styles/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../styles/main.css">
    <link type="text/css" rel="stylesheet" href="../styles/style-responsive.css">
    <link type="text/css" rel="stylesheet" href="../styles/pace.css">
    <link type="text/css" rel="stylesheet" href="../../css/estilos.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript"  src="../../js/validaciones.js"></script>
</head>
<body>
<div>
    <!--BEGIN THEME SETTING--><!--END THEME SETTING-->
    <!--BEGIN BACK TO TOP-->
    <a id="totop" href="#"><i class="fa fa-angle-up"></i></a>
    <!--END BACK TO TOP-->
    <?php include '../topbar.php';?>
    <div id="wrapper">
        <?php include '../sidebar.php';?>
        <!--BEGIN PAGE WRAPPER-->
        <div id="page-wrapper">
            <!--BEGIN TITLE & BREADCRUMB PAGE-->
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">
                        Crear Empleados-Usuarios</div>
                </div>
                <div class="clearfix">

                </div>
                <div class='row'>
                    <form action="#" method="post" class="form" role="form" enctype="multipart/form-data">
                        <div class='form-group <?php print(!empty($nombresError)?"has-error":""); ?>'>
                            <input class="form-control" name="nombres" placeholder="Nombres" required='required' id='nombres' type="text" autofocus autocomplete="off" maxlength="45" value='<?php print(!empty($nombres)?$nombres:""); ?>'  />
                            <?php print(!empty($nombresError)?"<span class='help-block'>$nombresError</span>":""); ?>
                        </div>
                        <div class='form-group <?php print(!empty($apellidosError)?"has-error":""); ?>'>
                            <input class="form-control" name="apellidos" placeholder="Apellidos" type="text" required='required' id='apellidos' autocomplete="off" maxlength="60" value='<?php print(!empty($apellidos)?$apellidos:""); ?>' />
                            <?php print(!empty($apellidosError)?"<span class='help-block'>$apellidosError</span>":""); ?>
                        </div>
                        <div class='form-group <?php print(!empty($identificadorError)?"has-error":""); ?>'>
                            <input class="form-control" name="identificador" placeholder="DUI" type="text" required="required" id='identificador' autocomplete="off" maxlength="10" value='<?php print(!empty($identificador)?$identificador:""); ?>' />
                            <?php print(!empty($identificadorError)?"<span class='help-block'>$identificadorError</span>":""); ?>
                        </div>
                        <div class='form-group <?php print(!empty($telefonosError)?"has-error":""); ?>'>
                            <input class="form-control" name="telefono" placeholder="Telefono" type="text" required='required' id='telefono' autocomplete="off" maxlength="9" value='<?php print(!empty($telefono)?$telefono:""); ?>'/>
                            <?php print(!empty($telefonosError)?"<span class='help-block'>$telefonosError</span>":""); ?>
                        </div>
                        <div class='form-group <?php print(!empty($correoError)?"has-error":""); ?>'>
                            <input class="form-control" name="correo" placeholder="Correo" type="email" required='required' id='correo' autocomplete="off" maxlength="75" value='<?php print(!empty($correo)?$correo:""); ?>' />
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
                                <option><?php print(!empty($tipo)?$tipo:""); ?></option>
                                <option value='Masculino' <?php print(isset($sexo) && $sexo == "Masculino"?"selected":""); ?>>Masculino</option>
                                <option value='Femenino' <?php print(isset($sexo) && $sexo == "Femenino"?"selected":""); ?>>Femenino</option>
                            </select>
                            <?php print(!empty($generoError)?"<span class='help-block'>$generoError</span>":""); ?>
                        </div>
                        <div class='form-group'>
                            <input type="file" name="archivo" id="archivo" accept="image/png, image/jpeg, image/gif"/>
                        </div>
                        <div class='form-group <?php print(!empty($aliasError)?"has-error":""); ?>'>
                            <input class="form-control" name="alias" placeholder="Alias" type="text" required='required' id='alias' autocomplete="off" maxlength="15" value='<?php print(!empty($alias)?$alias:""); ?>'/>
                            <?php print(!empty($aliasError)?"<span class='help-block'>$nombresError</span>":""); ?>
                        </div>
                        <div class='form-group <?php print(!empty($contraseñaError)?"has-error":""); ?>'>
                            <input class="form-control" name="contra" placeholder="Contraseña" type="password" required='required' id='contra' autocomplete="off" maxlength="15" autofocus />
                        </div>
                        <div class='form-group <?php print(!empty($confirmarError)?"has-error":""); ?>'>
                            <input class="form-control" name="confirmar" placeholder="Confirmar Contraseña" type="password" required='required' id='nombres' autocomplete="off" maxlength="15" autofocus />
                            <?php print(!empty($confirmarError)?"<span class='help-block'>$confirmarError</span>":""); ?>
                        </div>
                        <div class='form-group'>
                            <label for='genero'>Tipo de usuario</label>
                            <select name='tipo' required='required' id='tipo' class='form-control'>
                                <option ></option>
                                <?php
                                $sql = "SELECT nombre FROM tipos_usuarios ORDER BY id_tipo_usuario ASC ";
                                $data = "";
                                foreach($PDO->query($sql) as $row) {
                                    $data .= "<option value= '$row[nombre]'>$row[nombre]</option>";
                                }
                                print($data);
                                $PDO = null;
                                ?>
                            </select>
                        </div>
                        <div class='form-actions'>
                            <button type='submit' class='btn btn-success'>Crear</button>
                            <a class='btn btn btn-default' href='empleados.php'>Regresar</a>
                        </div>

                    </form>
                </div> <!-- /row -->
            </div>
            <!--END TITLE & BREADCRUMB PAGE-->
            <!--BEGIN CONTENT-->
            <div class="page-content"></div>
            <!--END CONTENT-->
        </div>
        <!--END PAGE WRAPPER-->
    </div>
</div>
</body>
</html>