<?php
if(!empty($_POST)) {
    // validation errors
    $tituloError = null;
    $subtituloError = null;
    $leyendeError = null;
    $imagenError = null;
    // post values
    $titulo = $_POST['titulo'];
    $subtitulo = $_POST['subtitulo'];
    $leyenda = $_POST['leyenda'];
    $imagen = $_POST['imagen'];

    // validate input
    $valid = true;
    if(empty($titulo)) {
        $tituloError = "Por favor ingrese un titulo.";
        $valid = false;
    }

    if(empty($subtitulo)) {
        $subtituloError = "Por favor ingrese el subtitulo.";
        $valid = false;
    }

    if(empty($leyenda)) {
        $leyendaError = "Por favor ingrese la leyenda.";
        $valid = false;
    }

    if(empty($imagen)) {
        $imagenError = "Por favor ingrese una imagen.";
        $valid = false;
    }
    // insert data
    if($valid) {
        require("../../bd.php");
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO noticias(titulo, subtitulo, leyenda, imagen) values(?, ?, ?, ?)";
        $stmt = $PDO->prepare($sql);
        $stmt->execute(array($titulo, $subtitulo, $leyenda, $imagen ));
        $PDO = null;
        header("Location: funcion.php");
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Mantenimiento | Noticias</title>
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
                        Crear Noticias</div>
                </div>
                <div class="clearfix">

                </div>
                <div class='row'>
                    <form method='POST'>
                        <div class='form-group <?php print(!empty($tituloError)?"has-error":""); ?>'>
                            <input type='text' name='titulo' placeholder='Titulo' required='required' id='titulo' class='form-control' value='<?php print(!empty($titulo)?$titulo:""); ?>'>
                            <?php print(!empty($tituloError)?"<span class='help-block'>$tituloError</span>":""); ?>
                        </div>
                        <div class='form-group <?php print(!empty($subtituloError)?"has-error":""); ?>'>
                            <input type='text' name='subtitulo' placeholder='Subtitulo' required='required' id='subtitulo' class='form-control' value='<?php print(!empty($subtitulo)?$titulo:""); ?>'>
                            <?php print(!empty($subtituloError)?"<span class='help-block'>$subtituloError</span>":""); ?>
                        </div>
                        <div class='form-group <?php print(!empty($leyendaError)?"has-error":""); ?>'>
                            <input type='text' name='leyenda' placeholder='Leyenda' required='required' id='leyenda' class='form-control' value='<?php print(!empty($leyenda)?$leyenda:""); ?>'>
                            <?php print(!empty($leyendaError)?"<span class='help-block'>$leyendaError</span>":""); ?>
                        </div>
                        <div class='form-group <?php print(!empty($imagenError)?"has-error":""); ?>'>
                            <input type='text' name='imagen' placeholder='Imagen' required='required' id='imagen' class='form-control' value='<?php print(!empty($imagen)?$imagen:""); ?>'>
                            <?php print(!empty($imagenError)?"<span class='help-block'>$imagenError</span>":""); ?>
                        </div>
                        <div class='form-actions'>
                            <button type='submit' class='btn btn-success'>Crear</button>
                            <a class='btn btn btn-default' href='noticias.php'>Regresar</a>
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