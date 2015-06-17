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
if(!empty($_GET['id_pregunta'])) {
    $id = $_GET['id_pregunta'];
}
if($id == null) {
    header("Location: preguntas.php");
}
require("../../bd.php");
if(!empty($_POST)){
    // validation errors
    $preguntaError = null;
    $respuestaError = null;
    // post values
    $pregunta = $_POST['pregunta'];
    $respuesta = $_POST['respuesta'];

    // validate input
    if(empty($titulo)) {
        $preguntaError = "Por favor ingrese una pregunta.";
        $valid = false;
    }

    if(empty($subtitulo)) {
        $respuestaError = "Por favor ingrese .";
        $valid = false;
    }

    // update data
    if($valid) {
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE preguntas SET pregunta = ?, respuesta = ? WHERE id_pregunta = ?";
        $stmt = $PDO->prepare($sql);
        $stmt->execute(array($pregunta, $respuesta));
        $PDO = null;
        header("Location: preguntas.php");
    }
}
else {
    // read data
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT pregunta, respuesta FROM preguntas WHERE id_pregunta = ?";
    $stmt = $PDO->prepare($sql);
    $stmt->execute(array($id_pregunta));
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $PDO = null;
    if(empty($data)) {
        header("Location: preguntas.php");
    }
    $pregunta = $data['pregunta'];
    $respuesta= $data['respuesta'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Winefun | Preguntas</title>
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
                        Modificar Pregunta</div>
                </div>
                <div class="clearfix">
                </div>
s
                <form method='POST'>
                    <div class='form-group <?php print(!empty($preguntaError)?"has-error":""); ?>'>
                        <label for='pregunta'>Pregunta</label>
                        <input type='text' name='pregunta' placeholder='Pregunta' required='required' id='pregunta' class='form-control' value='<?php print($pregunta); ?>'>
                        <?php print(!empty($preguntaError)?"<span class='help-block'>$preguntaError</span>":""); ?>
                    </div>
                    <div class='form-group <?php print(!empty($respuestaError)?"has-error":""); ?>'>
                        <label for='respuesta'>Respuesta</label>
                        <input type='text' name='respuesta' placeholder='Respuesta' required='required' id='respuesta' class='form-control' value='<?php print($respuesta); ?>'>
                        <?php print(!empty($respuestaError)?"<span class='help-block'>$respuestaError</span>":""); ?>
                    </div>
                    <div class='form-actions'>
                        <button type='submit' class='btn btn-primary'>Actualizar</button>
                        <a class='btn btn btn-default' href='preguntas.php'>Regresar</a>
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
