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

$id = null;
if(!empty($_GET['id_empleado'])) {
    $id = $_GET['id_empleado'];
}
if($id == null) {
    header("Location: empleados.php");
}
require("../../bd.php");
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
    $alias = $_POST['alias'];
    $apellidos = $_POST['apellidos'];
    $identificador = $_POST['identificador'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $sexo = $_POST['sexo'];
    $fecha_nacimiento = date('Y-m-d', strtotime($_POST['fecha_nacimiento']));
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

    if ($valid) {
        if (ctype_space($nombres) || ctype_space($apellidos) || ctype_space($identificador) || ctype_space($telefono) || ctype_space($correo)) {
            ?>
            <script language="JavaScript">
                alert("No se puede dejar datos en blanco");
            </script>
        <?php
        } else if (!isset($_POST['fecha_nacimiento'])) {
            ?>
            <script language="JavaScript">
                alert("Debe seleccionar una fecha");
            </script>
        <?php
        } else {
            //SUBIR IMAGEN URL
            if (!isset($_FILES['archivo'])) {
                $resultado2 = mysql_query("SELECT id_tipo_usuario FROM tipos_usuarios  WHERE nombre='" . $_POST['tipo'] . "'");
                if (!$resultado2) {
                    echo 'No se pudo ejecutar la consulta: ' . mysql_error();
                    exit;
                }
                $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "UPDATE empleados SET nombres=?, apellidos=?, identificador=?, telefono=?, correo=?, sexo=?, fecha_nacimiento=?, foto=? WHERE id_empleado='" . $id . "' ";
                $stmt = $PDO->prepare($sql);
                $stmt->execute(array($nombres, $apellidos, $identificador, $telefono, $correo, $sexo, $fecha_nacimiento, $url));
                $PDO = null;
                header("Location: empleados.php");
            } else {

                $nombre = $_FILES['archivo']['name'];
                $nombre_tmp = $_FILES['archivo']['tmp_name'];
                $tipo = $_FILES['archivo']['type'];
                $tamano = $_FILES['archivo']['size'];

                $ext_permitidas = array('jpg', 'jpeg', 'gif', 'png');
                $partes_nombre = explode('.', $nombre);
                $extension = end($partes_nombre);
                $ext_correcta = in_array($extension, $ext_permitidas);
                $tipo_correcto = preg_match('/^image\/(jpg|jpeg|gif|png)$/', $tipo);
                $limite = 5000 * 1024;

                if ($ext_correcta && $tipo_correcto && $tamano <= $limite) {
                    if ($_FILES['archivo']['error'] > 0) {
                        echo 'Error: ' . $_FILES['archivo']['error'] . '<br/>';
                    } else {
                        echo 'Nombre: ' . $nombre . '<br/>';
                        echo 'Tipo: ' . $tipo . '<br/>';
                        echo 'Tamaño: ' . ($tamano / 1024) . ' Kb<br/>';
                        echo 'Guardado en: ' . $nombre_tmp;
                        move_uploaded_file($nombre_tmp, "../img_empleados/" . $nombre);
                        $url = "img_empleados/" . $nombre;
                        echo "<br/>Guardado en: " . "../img_empleados/" . $nombre;
                        $resultado2 = mysql_query("SELECT id_tipo_usuario FROM tipos_usuarios  WHERE nombre='" . $_POST['tipo'] . "'");
                        if (!$resultado2) {
                            echo 'No se pudo ejecutar la consulta: ' . mysql_error();
                            exit;
                        }
                        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = "UPDATE empleados SET nombres=?, apellidos=?, identificador=?, telefono=?, correo=?, sexo=?, fecha_nacimiento=?, foto=? WHERE id_empleado='" . $id . "' ";
                        $stmt = $PDO->prepare($sql);
                        $stmt->execute(array($nombres, $apellidos, $identificador, $telefono, $correo, $sexo, $fecha_nacimiento, $url));
                        $PDO = null;
                        header("Location: empleados.php");
                    }
                } else {
                    echo 'Archivo inválido';
                }
            }
        }
    }
    } else {
        // read data
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT nombres, apellidos, identificador, telefono, correo,sexo,fecha_nacimiento,foto,alias,tipos_usuarios.nombre as tipo FROM empleados,usuarios,tipos_usuarios WHERE empleados.id_empleado = ? AND empleados.id_empleado=usuarios.id_empleado AND usuarios.id_tipo_usuario=tipos_usuarios.id_tipo_usuario ";
        $stmt = $PDO->prepare($sql);
        $stmt->execute(array($id));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $PDO = null;
        if (empty($data)) {
            header("Location: empleados.php");
        }
        $nombres = $data['nombres'];
        $apellidos = $data['apellidos'];
        $identificador = $data['identificador'];
        $telefono = $data['telefono'];
        $correo = $data['correo'];
        $fecha_nacimiento = $data['fecha_nacimiento'];
        $sexo = $data['sexo'];
        $alias = $data['alias'];
        $tipo = $data['tipo'];
        $foto = $data['foto'];
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
                        Modificar Empleados-Usuarios</div>
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
                            <input class="form-control" name="identificador" placeholder="DUI" type="text" required='required' id='identificador' autocomplete="off" maxlength="10" value='<?php print(!empty($identificador)?$identificador:""); ?>' />
                            <?php print(!empty($identificadorError)?"<span class='help-block'>$identificadorError</span>":""); ?>
                        </div>
                        <div class='form-group <?php print(!empty($telefonosError)?"has-error":""); ?>'>
                            <input class="form-control" name="telefono" placeholder="Telefono" type="text" required='required' id='telefono' autocomplete="off" maxlength="9"  value='<?php print(!empty($telefono)?$telefono:""); ?>'/>
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
                                <option></option>
                                <option value='Masculino' <?php print(isset($sexo) && $sexo == "Masculino"?"selected":""); ?>>Masculino</option>
                                <option value='Femenino' <?php print(isset($sexo) && $sexo == "Femenino"?"selected":""); ?>>Femenino</option>
                            </select>
                            <?php print(!empty($generoError)?"<span class='help-block'>$generoError</span>":""); ?>
                        </div>
                        <div class='form-group'>
                            <?php print "<img src='../".$data['foto']."'border='0' width='150' height='200'>";?>
                            <input type="file" name="archivo" id="archivo" accept="image/png, image/jpeg, image/gif"/>
                        </div>
                        <div class='form-group <?php print(!empty($aliasError)?"has-error":""); ?>'>
                            <input class="form-control" name="alias" placeholder="Alias" type="text" required='required' id='alias' maxlength="15" readonly value='<?php print(!empty($alias)?$alias:""); ?>'/>
                            <?php print(!empty($aliasError)?"<span class='help-block'>$aliasError</span>":""); ?>
                        </div>
                        <div class='form-group'>
                            <label for='genero'>Tipo de usuario</label>
                            <select name='tipo' required='required' id='tipo' class='form-control'>
                                <option value='<?php print(!empty($alias)?$alias:""); ?>></option>
                                <?php
                                require("../../bd.php");
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
                            <button type='submit' class='btn btn-success'>Modificar</button>
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
