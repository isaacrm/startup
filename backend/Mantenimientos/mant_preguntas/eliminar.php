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
    $id = base64_decode ($_GET['id_pregunta']);
}
if($id == null) {
    header("Location: preguntas.php");
}

// Delete Data
if(!empty($_POST)) {
    require("../../bd.php");
    $id = $_POST['id_pregunta'];
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM preguntas WHERE id_pregunta = ?";
    $stmt = $PDO->prepare($sql);
    $stmt->execute(array($id));
    $PDO = null;
    header("Location: preguntas.php");
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
                        Eliminar Pregunta</div>
                </div>
                <div class="clearfix">
                </div>
                <div class='container'>
                <div class='row'>
                    <form method='POST'>
                        <input type='hidden' name='id_pregunta' value='<?php print($id); ?>'>
                        <p class='alert bg-danger'>¿Borrar datos?</p>
                        <div class='form-actions'>
                            <button type='submit' class='btn btn-danger'>Si</button>
                            <a class='btn btn btn-default' href='preguntas.php'>No</a>
                        </div>
                    </form>
                </div> <!-- /row -->
                </div>
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
