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
if(!empty($_GET['id_equipo'])) {
    $id = base64_decode ($_GET['id_equipo']);
}
if($id == null) {
    header("Location: equipos.php");
}
require("../../bd.php");
error_reporting(E_ALL ^ E_NOTICE);
if(!empty($_POST)) {
    // validation errors
    $nombreError = null;
    $apellidoError = null;
    $cargoError = null;
    $fraseError = null;
    $twitterError = null;
    $facebookError = null;
    // post values
    $nombres = strip_tags($_POST['nombre']);
    $apellido = strip_tags($_POST['apellido']);
    $cargo = strip_tags($_POST['cargo']);
    $frase = strip_tags($_POST['frase']);
    $twitter = strip_tags($_POST['twitter']);
    $facebook =strip_tags( $_POST['facebook']);
    $url=strip_tags($_POST['foto']);
    // validate input
    $valid = true;
    if(empty($nombres)) {
        $nombreError = "Por favor ingrese un nombre.";
        $valid = false;
    }

    if(empty($apellido)) {
        $apellidoError = "Por favor ingrese un apellido.";
        $valid = false;
    }

    if(empty($cargo)) {
        $cargoError = "Por favor ingrese el cargo.";
        $valid = false;
    }

    if(empty($frase)) {
        $fraseError = "Por favor ingrese la frase.";
        $valid = false;
    }

    // update data
    if (ctype_space($nombres) || ctype_space($apellido) || ctype_space($cargo) || ctype_space($frase) ) {
        echo "<script type=\"text/javascript\">alert('No se puede dejar datos en blanco');</script>";
    }/*Comprueba si hay espacios que se puedan tomar como caracter al inicio o al final en nombres, apellidos, alias y contraseña*/
    else if (strlen(trim($nombres, ' ')) <= 1)
    {
        echo"<script type=\"text/javascript\">alert('El nombre debe de tener al menos dos caracteres');</script>";
    }
    else if (strlen(trim($apellido, ' ')) <= 1)
    {
        echo"<script type=\"text/javascript\">alert('El apellido debe de tener al menos dos caracteres');</script>";
    }
    else if (strlen(trim($cargo, ' ')) <= 1)
    {
        echo"<script type=\"text/javascript\">alert('El nombre debe de tener al menos dos caracteres');</script>";
    }
    else if (strlen(trim($frase, ' ')) <= 1)
    {
        echo"<script type=\"text/javascript\">alert('El apellido debe de tener al menos dos caracteres');</script>";
    }
    else if(!preg_match('/^(https?:\/\/)?((w{3}\.)?)twitter\.com\/(#!\/)?[a-z0-9_]+$/',$twitter)){
       /* if ($twitter!=""){*/
        echo"<script type=\"text/javascript\">alert('URL de Twitter no válido. Ej.https://twitter.com/usuario  ');</script>";/*}*/
    }
    else if(!preg_match('/^(http\:\/\/|https\:\/\/)?((w{3}\.)?)facebook\.com\/(?:#!\/)?(?:pages\/)?(?:[\w\-\.]*\/)*([\w\-\.]*)+$/',$facebook)){
        /*if ($facebook!=""){*/
            echo"<script type=\"text/javascript\">alert('URL de Facebook no válido. Ej.https://www.facebook.com/username/');</script>";/*}*/
    }
    else if(!preg_match('/^([a-z A-Z ñáéíóú ÑÁÉÍÓÚ Üü ]{2,60})$/i',$nombres)){
        echo"<script type=\"text/javascript\">alert('Los nombres no tienen números');</script>";
    }
    else if(!preg_match('/^([a-z A-Z ñáéíóú ÑÁÉÍÓÚ Üü ]{2,60})$/i',$apellido)){
        echo"<script type=\"text/javascript\">alert('Los apellidos no tienen números');</script>";
    }
    else if(!preg_match('/^([a-z A-Z ñáéíóú ÑÁÉÍÓÚ Üü ]{2,60})$/i',$cargo)){
        echo"<script type=\"text/javascript\">alert('El cargo no tienen números');</script>";
    }
    else {
            if ($valid) {
                //SUBIR IMAGEN URL
                if ($_FILES['archivo']['name'] == "") {
                    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "UPDATE equipos SET nombre = ?, apellido = ?, cargo = ?, frase = ?, twitter = ?, facebook = ? WHERE id_equipo = ?";
                    $stmt = $PDO->prepare($sql);
                    $stmt->execute(array($nombres, $apellido, $cargo, $frase, $twitter, $facebook,  $id));
                    header("Location: equipos.php");
                } else {
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
                    if ($ancho == 214 && $alto == 238) {
                        /*Compara el peso de la imagen, debe ser menor a 2 MB  (Esto es mas codigo de validacion [extension y tipo])$ext_correcta && $tipo_correcto*/
                        if ($tamano <= $limite) {
                            if ($_FILES['archivo']['error'] > 0) {
                                echo 'Error: ' . $_FILES['archivo']['error'] . '<br/>';
                            } else {
                                echo 'Nombre: ' . $nombre . '<br/>';
                                echo 'Tipo: ' . $tipo . '<br/>';
                                echo 'Tamaño: ' . ($tamano / 1024) . ' Kb<br/>';
                                echo 'Guardado en: ' . $nombre_tmp;

                                move_uploaded_file($nombre_tmp, "../img_equipo/" . $id . ".jpg");
                                $url = "img_equipo/" . $id . ".jpg";
                                echo "<br/>Guardado en: " . "../img_equipo/" . $id . ".jpg";

                                $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $sql = "UPDATE equipos SET nombre = ?, apellido = ?, cargo = ?, frase = ?, twitter = ?, facebook = ?, foto=? WHERE id_equipo = ?";
                                $stmt = $PDO->prepare($sql);
                                $stmt->execute(array($nombres, $apellido, $cargo, $frase, $twitter, $facebook, $url, $id));
                                $PDO = null;
                                header("Location: equipos.php");
                            }
                        } else {
                            echo "<script type=\"text/javascript\">alert('La imagen pesa mas de 2 MB');</script>";
                        }
                    } else {
                        echo "<script type=\"text/javascript\">alert('La imagen debe ser exactamende de 214px de alto x 238px de ancho');</script>";
                    }
                }
            }
    }
}
else {
    // read data
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT nombre, apellido, cargo, frase, twitter, facebook, foto  FROM equipos WHERE id_equipo = ?";
    $stmt = $PDO->prepare($sql);
    $stmt->execute(array($id));
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $PDO = null;
    if(empty($data)) {
        header("Location: equipos.php");
    }
    $nombres = $data['nombre'];
    $apellido= $data['apellido'];
    $cargo = $data['cargo'];
    $frase = $data['frase'];
    $twitter = $data['twitter'];
    $facebook = $data['facebook'];
    $url= $data['foto'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Winefun | Equipos</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../estilos2.php';?>
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
                        Modificar Equipo</div>
                </div>
                <div class="clearfix">
                </div>

                <form method="post" class="form" role="form" enctype="multipart/form-data">
                    <div class='form-group <?php print(!empty($nombreError)?"has-error":""); ?>'>
                        <input type='text' name='nombre' placeholder='Nombre' required='required' id='nombre' class='form-control' autocomplete="off" maxlength="45" value='<?php print($nombres); ?>'>
                        <?php print(!empty($nombreError)?"<span class='help-block'>$nombreError</span>":""); ?>
                    </div>
                    <div class='form-group <?php print(!empty($apellidoError)?"has-error":""); ?>'>
                        <input type='text' name='apellido' placeholder='Apellido' required='required' id='apellido' class='form-control' autocomplete="off" maxlength="60" value='<?php print($apellido); ?>'>
                        <?php print(!empty($apellidoError)?"<span class='help-block'>$apellidoError</span>":""); ?>
                    </div>
                    <div class='form-group <?php print(!empty($cargoError)?"has-error":""); ?>'>
                        <input type='text' name='cargo' placeholder='Cargo' required='required' id='cargo' class='form-control' autocomplete="off" maxlength="40" value='<?php print($cargo); ?>'>
                        <?php print(!empty($cargoError)?"<span class='help-block'>$cargoError</span>":""); ?>
                    </div>
                    <div class='form-group <?php print(!empty($fraseError)?"has-error":""); ?>'>
                        <input type='text' name='frase' placeholder='Frase' required='required' id='frase' class='form-control' autocomplete="off" maxlength="175" value='<?php print($frase); ?>'>
                        <?php print(!empty($fraseError)?"<span class='help-block'>$fraseError</span>":""); ?>
                    </div>
                    <div class='form-group <?php print(!empty($twitterError)?"has-error":""); ?>'>
                        <input type='text' name='twitter' placeholder='Twitter'  required='required' id='twitter' class='form-control' autocomplete="off" maxlength="250" value='<?php print($twitter); ?>'>
                        <?php print(!empty($twitterError)?"<span class='help-block'>$twitterError</span>":""); ?>
                    </div>
                    <div class='form-group <?php print(!empty($facebookError)?"has-error":""); ?>'>
                        <input type='text' name='facebook' placeholder='Facebook' required='required' id='facebook' class='form-control' autocomplete="off" maxlength="250" value='<?php print($facebook); ?>'>
                        <?php print(!empty($facebookError)?"<span class='help-block'>$facebookError</span>":""); ?>
                    </div>
                    <div class='form-group'>
                        <input type="hidden" name="foto" value='<?php print($url); ?>'/>
                        <img  name="foto" id="foto" src='../<?php print($url); ?>' border='0' width='150' height='200'>
                        <input type="file" name="archivo" id="archivo" accept="image/png, image/jpeg, image/gif"/>
                    </div>
                    <div class='form-actions'>
                        <button type='submit' class='btn btn-primary'>Actualizar</button>
                        <a class='btn btn btn-default' href='equipos.php'>Regresar</a>
                    </div>
                </form>

            </div>
            <!--END TITLE & BREADCRUMB PAGE-->
            <!--BEGIN CONTENT-->
            <div class="page-content"></div>
            <!--END CONTENT-->
        </div>
        <!--END PAGE WRAPPER-->
    </div>
</div>
<?php include '../funciones2.php';?>
</body>
</html>
