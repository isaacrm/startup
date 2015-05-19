<?php
if(!empty($_POST)) {
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

    // insert data
    if($valid) {
        //SUBIR IMAGEN URL
        if (!isset($_FILES['archivo'])) {
            echo 'Ha habido un error, tienes que elegir una imagen<br/>';
            echo '<a href="noticias.php">Subir archivo</a>';
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
                        echo "<br/>Guardado en: " . "Manteniminetos/img_empleados/" . $nombre;
                        require("../../bd.php");
                        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = "INSERT INTO noticias(titulo, subtitulo, leyenda, foto) values(?, ?, ?, ?)";
                        $stmt = $PDO->prepare($sql);
                        $stmt->execute(array($titulo, $subtitulo, $leyenda, $url));
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
                    <form action="#" method="post"  enctype="multipart/form-data" >
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
                        <div class='form-group'>
                            <input type="file" name="archivo" id="archivo" accept="image/png, image/jpeg, image/gif"/>
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