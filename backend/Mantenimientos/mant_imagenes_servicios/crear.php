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
require("../../bd.php");
if(!empty($_POST)) {
    error_reporting(E_ALL ^ E_NOTICE);
    // validation errors
    $urlError = null;
    $tituloError = null;
    $descripcionError = null;
    // post values
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $tipo_servicio = $_POST['tipo'];
    // validate input
    $valid = true;

    if(empty($titulo)) {
        $tituloError = "Por favor ingrese el titulo.";
        $valid = false;
    }

    if(empty($descripcion)) {
        $descripcionError = "Por favor ingrese la descripcion.";
        $valid = false;
    }

    // insert data
    if (ctype_space($titulo) || ctype_space($descripcion)) {
        echo"<script type=\"text/javascript\">alert('No se puede dejar datos en blanco');</script>";
    }
    else if (strlen(trim($titulo, ' ')) <= 2)
    {
        echo"<script type=\"text/javascript\">alert('El nombre debe de tener al menos tres caracteres');</script>";
    }
    else if (strlen(trim($descripcion, ' ')) <= 4)
    {
        echo"<script type=\"text/javascript\">alert('La descripcion debe de tener al menos cinco caracteres');</script>";
    }
    else if(!preg_match('/^([a-z A-Z ñáéíóú ÑÁÉÍÓÚ Üü ]{2,60})$/i',$titulo)){
        echo"<script type=\"text/javascript\">alert('El titulo no debe tener números');</script>";
    }
    else {
    if($valid) {
        try {
        //SUBIR IMAGEN URL
        if ($_FILES['archivo']['name'] == "") {
            echo "<script type=\"text/javascript\">alert('Tienes que subir una imagen');</script>";
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
            if ($ancho == 720 && $alto == 480) {
                /*Compara el peso de la imagen, debe ser menor a 2 MB  (Esto es mas codigo de validacion [extension y tipo])$ext_correcta && $tipo_correcto*/
                if ($tamano <= $limite) {
                    if ($_FILES['archivo']['error'] > 0) {
                        echo 'Error: ' . $_FILES['archivo']['error'] . '<br/>';
                    } else {
                        echo 'Nombre: ' . $nombre . '<br/>';
                        echo 'Tipo: ' . $tipo . '<br/>';
                        echo 'Tamaño: ' . ($tamano / 1024) . ' Kb<br/>';
                        echo 'Guardado en: ' . $nombre_tmp;

                        if (file_exists('../img_servicios/' . $nombre)) {
                            echo '<br/>El archivo ya existe: ' . $nombre;
                        } else {
                            $sql = "SELECT MAX(id_imagen) as id_ser FROM imagenes_servicios";
                            foreach ($PDO->query($sql) as $row) {
                                $idservicio = "$row[id_ser]";
                                $id = $idservicio + 1;
                            }
                            move_uploaded_file($nombre_tmp, "../img_servicios/" . $id . ".jpg");
                            $url = "img_servicios/" . $id . ".jpg";
                            echo "<br/>Guardado en: " . "../img_servicios/" . $id . ".jpg";

                            /*SELECCIONAR EL ID DEL TIPO DE USUARIO DONDE EL NOMBRE SEA el tipo seleccionado*/
                            $sql2 = "SELECT id_servicio FROM servicios WHERE tipo='" . $_POST['tipo'] . "'";
                            foreach ($PDO->query($sql2) as $row2) {
                                $id_servicio = "$row2[id_servicio]";
                            }
                            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $sql = "INSERT INTO imagenes_servicios(url, titulo, descripcion, id_servicio) values(?, ?, ?, ?)";
                            $stmt = $PDO->prepare($sql);
                            $stmt->execute(array($url, $titulo, $descripcion, $id_servicio));
                            header("Location: imagenes_servicios.php");
                        }
                    }
                } else {
                    echo "<script type=\"text/javascript\">alert('La imagen pesa mas de 2 MB');</script>";
                }
            } else {
                echo "<script type=\"text/javascript\">alert('La imagen debe ser exactamende de 720px de alto x 480px de ancho');</script>";

            }
        }
        }catch (Exception $e){
            echo"<script type=\"text/javascript\">alert('La imagen con este titulo ya existe');</script>";
        }
    }
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
                    <form action="#" method="post" class="form" role="form" enctype="multipart/form-data">
                        <div class='form-group <?php print(!empty($tituloError)?"has-error":""); ?>'>
                            <input type='text' name='titulo' placeholder='Titulo' required='required' id='titulo' class='form-control' autocomplete="off"  maxlength="25" value='<?php print(!empty($titulo)?$titulo:""); ?>'>
                            <?php print(!empty($tituloError)?"<span class='help-block'>$tituloError</span>":""); ?>
                        </div>
                        <div class='form-group <?php print(!empty($descripcionError)?"has-error":""); ?>'>
                            <input type='text' name='descripcion' placeholder='Descripción' required='required' id='descripcion' class='form-control' autocomplete="off"  maxlength="60" value='<?php print(!empty($descripcion)?$descripcion:""); ?>'>
                            <?php print(!empty($descripcionError)?"<span class='help-block'>$descripcionError</span>":""); ?>
                        </div>
                        <div class='form-group'>
                            <input type="file" name="archivo" id="archivo" accept="image/png, image/jpeg, image/gif"/>
                        </div>
                        <div class='form-group'>
                            <label for='genero'>Tipo de servicio</label>
                            <select name='tipo' required='required' id='tipo' class='form-control'>
                                <option ></option>
                                <?php
                                $sql = "SELECT tipo FROM servicios ORDER BY id_servicio ASC ";
                                $data = "";
                                foreach($PDO->query($sql) as $row) {
                                    $data .= "<option value= '$row[tipo]'>$row[tipo]</option>";
                                }
                                print($data);
                                $PDO = null;
                                ?>
                            </select>
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