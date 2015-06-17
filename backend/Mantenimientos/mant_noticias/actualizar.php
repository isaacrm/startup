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
if(!empty($_GET['id_noticia'])) {
    $id = $_GET['id_noticia'];
}
if($id == null) {
    header("Location: noticia.php");
}
require("../../bd.php");
if(!empty($_POST)){
    // validation errors
    $tituloError = null;
    $subtituloError = null;
    $leyendeError = null;

    // post values
    $titulo = $_POST['titulo'];
    $subtitulo = $_POST['subtitulo'];
    $leyenda = $_POST['leyenda'];


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
    require("../../bd.php");
    // update data
    if($valid) {
        if (!isset($_FILES['archivo'])) {
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE noticias SET titulo = ?, subtitulo = ?, leyenda = ? WHERE id_noticia = ?";
            $stmt = $PDO->prepare($sql);
            $stmt->execute(array($titulo, $subtitulo, $leyenda, $id));
            $PDO = null;
            header("Location: noticias.php");
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
            $limite = 500 * 1024;

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
                        move_uploaded_file($nombre_tmp, "../img_empleados/" . $nombre);
                        $url = "img_empleados/" . $nombre;
                        echo "<br/>Guardado en: " . "../img_empleados/" . $nombre;

                        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = "UPDATE noticias SET titulo = ?, subtitulo = ?, leyenda = ?, foto = ? WHERE id_noticia = ?";
                        $stmt = $PDO->prepare($sql);
                        $stmt->execute(array($titulo, $subtitulo, $leyenda, $url , $id));
                        $PDO = null;
                        header("Location: noticias.php");
                    }
                }
            } else {
                echo 'Archivo inválido';
            }
        }
    }
}
else {
    // read data
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT titulo, subtitulo, leyenda, foto FROM noticias WHERE id_noticia = ?";
    $stmt = $PDO->prepare($sql);
    $stmt->execute(array($id));
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $PDO = null;
    if(empty($data)) {
        header("Location: noticias.php");
    }
    $titulo = $data['titulo'];
    $subtitulo= $data['subtitulo'];
    $leyenda = $data['leyenda'];
    $imagen = $data['foto'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Winefun | Noticias</title>
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
                        Modificar Noticias</div>
                </div>
                <div class="clearfix">
                </div>

                <form method='POST' action="#" >
                    <div class='form-group <?php print(!empty($tituloError)?"has-error":""); ?>'>
                        <label for='titulo'>Titulo</label>
                        <input type='text' name='titulo' placeholder='Titulo' required='required' id='titulo' class='form-control' value='<?php print($titulo); ?>'>
                        <?php print(!empty($tituloError)?"<span class='help-block'>$tituloError</span>":""); ?>
                    </div>
                    <div class='form-group <?php print(!empty($subtituloError)?"has-error":""); ?>'>
                        <label for='subtitulo'>Subtitulo</label>
                        <input type='text' name='subtitulo' placeholder='Subtitulo' required='required' id='subtitulo' class='form-control' value='<?php print($subtitulo); ?>'>
                        <?php print(!empty($subtituloError)?"<span class='help-block'>$subtituloError</span>":""); ?>
                    </div>
                    <div class='form-group <?php print(!empty($leyendaError)?"has-error":""); ?>'>
                        <label for='leyenda'>Leyenda</label>
                        <input type='text' name='leyenda' placeholder='Leyenda' required='required' id='leyenda' class='form-control' value='<?php print($leyenda); ?>'>
                        <?php print(!empty($leyendaError)?"<span class='help-block'>$leyendaError</span>":""); ?>
                    </div>
                    <div class='form-group'>
                        <input type="file" name="archivo" id="archivo" accept="image/png, image/jpeg, image/gif"/>
                    </div>
                    <div class='form-actions'>
                        <button type='submit' class='btn btn-primary'>Actualizar</button>
                        <a class='btn btn btn-default' href='noticias.php'>Regresar</a>
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
