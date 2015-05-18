<?php
if(!empty($_POST)) {
    // validation errors
    $urlError = null;
    $tituloError = null;
    $descripcionError = null;
    // post values
    $url = $_POST['url'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];

    // validate input
    $valid = true;
    if(empty($url)) {
        $urlError = "Por favor ingrese la url de la imagen.";
        $valid = false;
    }


    if(empty($titulo)) {
        $tituloError = "Por favor ingrese el titulo.";
        $valid = false;
    }

    if(empty($descripcion)) {
        $descripcionError = "Por favor ingrese la descripcion.";
        $valid = false;
    }

    // insert data
    if($valid) {
        require("../../bd.php");
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO imagenes_servicios(url, titulo, descripcion) values(?, ?, ?)";
        $stmt = $PDO->prepare($sql);
        $stmt->execute(array($url, $titulo, $descripcion));
        $PDO = null;
        header("Location: imagenes_servicios.php");
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Mantenimiento | Imagenes</title>
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
                        Crear Imagen</div>
                </div>
                <div class="clearfix">

                </div>
                <div class='row'>
                    <form method='POST'>
                        <div class='form-group <?php print(!empty($urlError)?"has-error":""); ?>'>
                            <input type='text' name='url' placeholder='Url' required='required' id='url' class='form-control' value='<?php print(!empty($url)?$url:""); ?>'>
                            <?php print(!empty($urlError)?"<span class='help-block'>$urlError</span>":""); ?>
                        </div>
                        <div class='form-group <?php print(!empty($tituloError)?"has-error":""); ?>'>
                            <input type='text' name='titulo' placeholder='Titulo' required='required' id='titulo' class='form-control' value='<?php print(!empty($titulo)?$titulo:""); ?>'>
                            <?php print(!empty($tituloError)?"<span class='help-block'>$tituloError</span>":""); ?>
                        </div>
                        <div class='form-group <?php print(!empty($descripcionError)?"has-error":""); ?>'>
                            <input type='text' name='descripcion' placeholder='Descripción' required='required' id='descripcion' class='form-control' value='<?php print(!empty($descripcion)?$descripcion:""); ?>'>
                            <?php print(!empty($descripcionError)?"<span class='help-block'>$descripcionError</span>":""); ?>
                        </div>
                        <div class='form-actions'>
                            <button type='submit' class='btn btn-success'>Crear</button>
                            <a class='btn btn btn-default' href='imagenes_servicios.php'>Regresar</a>
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