<?php
if(!empty($_POST)) {
    // validation errors
    $preguntaError = null;
    $respuestaError = null;
    // post values
    $pregunta = $_POST['pregunta'];
    $respuesta = $_POST['respuesta'];

    // validate input
    $valid = true;
    if(empty($titulo)) {
        $preguntaError = "Por favor ingrese una pregunta.";
        $valid = false;
    }

    if(empty($subtitulo)) {
        $respuestaError = "Por favor ingrese .";
        $valid = false;
    }

    // insert data
    if($valid) {
        require("bd.php");
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO preguntas(pregunta, respuesta) values(?, ?)";
        $stmt = $PDO->prepare($sql);
        $stmt->execute(array($pregunta, $respuesta ));
        $PDO = null;
        header("Location: preguntas.php");
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Mantenimiento | Preguntas</title>
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
                        Crear Preguntas</div>
                </div>
                <div class="clearfix">

                </div>
                <div class='row'>
                    <form method='POST'>
                        <div class='form-group <?php print(!empty($preguntaError)?"has-error":""); ?>'>
                            <input type='text' name='pregunta' placeholder='Pregunta' required='required' id='pregunta' class='form-control' value='<?php print(!empty($pregunta)?$pregunta:""); ?>'>
                            <?php print(!empty($preguntaError)?"<span class='help-block'>$preguntaError</span>":""); ?>
                        </div>
                        <div class='form-group <?php print(!empty($respuestaError)?"has-error":""); ?>'>
                            <input type='text' name='respuesta' placeholder='Respuesta' required='required' id='respuesta' class='form-control' value='<?php print(!empty($respuesta)?$respuesta:""); ?>'>
                            <?php print(!empty($respuestaError)?"<span class='help-block'>$respuestaError</span>":""); ?>
                        </div>
                        <div class='form-actions'>
                            <button type='submit' class='btn btn-success'>Crear</button>
                            <a class='btn btn btn-default' href='preguntas.php'>Regresar</a>
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
<?php include '../funciones2.php';?>
</body>
</html>