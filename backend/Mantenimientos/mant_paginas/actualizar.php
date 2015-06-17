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
if(!empty($_GET['id_pagina'])) {
    $id = $_GET['id_pagina'];
}
if($id == null) {
    header("Location: paginas.php");
}
require("../../bd.php");
if(!empty($_POST)){
    // validation errors
    $encabezadoError = null;
    $fraseError = null;
    $estadoError = null;
    // post values
    $encabezado = $_POST['encabezado'];
    $frase = $_POST['frase'];

    // validate input
    $valid = true;
    if(empty($encabezado)) {
        $encabezadoError = "Por favor ingrese un encabezado.";
        $valid = false;
    }

    if(empty($frase)) {
        $fraseError = "Por favor ingrese una frase.";
        $valid = false;
    }
    // update data
    if($valid) {
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE paginas SET encabezado = ?, frase = ?, estado =? WHERE id_pagina = ?";
        $stmt = $PDO->prepare($sql);
        $stmt->execute(array($encabezado, $frase, 1, $id));
        $PDO = null;
        header("Location: paginas.php");
    }
}
else {
    // read data
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT encabezado, frase FROM paginas WHERE id_pagina = ?";
    $stmt = $PDO->prepare($sql);
    $stmt->execute(array($id));
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $PDO = null;
    if(empty($data)) {
        header("Location: paginas.php");
    }
    $encabezado = $data['encabezado'];
    $frase= $data['frase'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Winefun | Paginas</title>
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
                        Modificar Pagina</div>
                </div>
                <div class="clearfix">
                </div>

                <form method='POST'>
                    <div class='form-group <?php print(!empty($encabezadoError)?"has-error":""); ?>'>
                        <label for='encabezado'>Encabezado</label>
                        <input type='text' name='encabezado' placeholder='Encabezado' required='required' id='encabezado' class='form-control' value='<?php print($encabezado); ?>'>
                        <?php print(!empty($encabezadoError)?"<span class='help-block'>$encabezadoError</span>":""); ?>
                    </div>
                    <div class='form-group <?php print(!empty($fraseError)?"has-error":""); ?>'>
                        <label for='frase'>Frase</label>
                        <input type='text' name='frase' placeholder='Frase' required='required' id='frase' class='form-control' value='<?php print($frase); ?>'>
                        <?php print(!empty($fraseError)?"<span class='help-block'>$fraseError</span>":""); ?>
                    </div>
                    <div class='form-actions'>
                        <button type='submit' class='btn btn-primary'>Actualizar</button>
                        <a class='btn btn btn-default' href='paginas.php'>Regresar</a>
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
