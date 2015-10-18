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
if(!empty($_GET['id_politica'])) {
    $id = base64_decode ($_GET['id_politica']);
}
if($id == null) {
    header("Location: politicas.php");
}
require("../../bd.php");
if(!empty($_POST)){
    // validation errors
    $tituloError = null;
    $subtituloError = null;

    // post values
    $titulo = strip_tags($_POST['titulo']);
    $descripcion = strip_tags($_POST['descripcion']);
    // validate input
    $valid = true;
    if(empty($titulo)) {
        $tituloError = "Por favor ingrese un titulo.";
        $valid = false;
    }

    if(empty($descripcion)) {
        $subtituloError = "Por favor ingrese el subtitulo.";
        $valid = false;
    }

    // update data
    if($valid) {
    try {
    if (ctype_space($titulo) || ctype_space($descripcion) ) {
        echo"<script type=\"text/javascript\">alert('No se puede dejar datos en blanco');</script>";
    }
    else if (strlen(trim($titulo, ' ')) <= 3)
    {
        echo"<script type=\"text/javascript\">alert('El titulo debe de tener al menos cuatro caracteres');</script>";
    }
    else if (strlen(trim($descripcion, ' ')) <= 5)
    {
        echo"<script type=\"text/javascript\">alert('El subtitulo debe de tener al menos 6 caracteres');</script>";
    }

    else if(!preg_match('/^([a-z A-Z ñáéíóú ÑÁÉÍÓÚ Üü ]{2,60})$/i',$titulo)){
        echo"<script type=\"text/javascript\">alert('El titulo no debe tener números');</script>";
    }
    else {
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE politicas SET titulo = ?, descripcion=? WHERE id_politica = ?";
        $stmt = $PDO->prepare($sql);
        $stmt->execute(array($titulo, $descripcion, $id));
        header("Location: politicas.php");
    }
    } catch (Exception $e) {
    echo"<script type=\"text/javascript\">alert('Esta politica ya existe');</script>";
}
  }

}
else {
    // read data
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT titulo, descripcion FROM politicas WHERE id_politica = ?";
    $stmt = $PDO->prepare($sql);
    $stmt->execute(array($id));
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $PDO = null;
    if(empty($data)) {
        header("Location: politicas.php");
    }
    $titulo = $data['titulo'];
    $descripcion= $data['descripcion'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Winefun | Politicas</title>
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
                        Modificar Politica</div>
                </div>
                <div class="clearfix">
                </div>

                <form method='POST'>
                    <div class='form-group <?php print(!empty($tituloError)?"has-error":""); ?>'>
                        <label for='titulo'>Titulo</label>
                        <input type='text' name='titulo' placeholder='Titulo' required='required' id='titulo' class='form-control' autocomplete="off" maxlength="25" value='<?php print($titulo); ?>'>
                        <?php print(!empty($tituloError)?"<span class='help-block'>$tituloError</span>":""); ?>
                    </div>
                    <div class='form-group <?php print(!empty($subtituloError)?"has-error":""); ?>'>
                        <label for='subtitulo'>Subtitulo</label>
                        <input type='text' name='descripcion' placeholder='Descripción' required='required' id='descripcion' class='form-control' autocomplete="off" maxlength="100" value='<?php print($descripcion); ?>'>
                        <?php print(!empty($subtituloError)?"<span class='help-block'>$subtituloError</span>":""); ?>
                    </div>
                    <div class='form-actions'>
                        <button type='submit' class='btn btn-primary'>Actualizar</button>
                        <a class='btn btn btn-default' href='politicas.php'>Regresar</a>
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
