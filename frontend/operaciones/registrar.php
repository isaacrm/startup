<?php
require("../bd.php");
if(!empty($_POST)) {
    error_reporting(E_ALL ^ E_NOTICE);


    // post values
    $nombres = $_POST['nombres'];
    $alias= $_POST['alias'];
    $apellidos = $_POST['apellidos'];
    $identificador = $_POST['identificador'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $sexo = $_POST['sexo'];
    $fecha_nacimiento = date('Y-m-d', strtotime($_POST['fecha_nacimiento']));
    $contra = sha1($_POST['contra']);
    $tipo_usuario = $_POST['tipo'];
    // validate input
    $valid = true;

    // $regex = '/(^\d{8})-(\d$)/';
    //if (!preg_match($regex, $identificador)) {
    // echo 'El DUI NO es válido';
    //}

    // insert data

    if (ctype_space($nombres) || ctype_space($apellidos) || ctype_space($identificador) || ctype_space($telefono) || ctype_space($correo)) {
        echo"<script type=\"text/javascript\">alert('No se puede dejar datos en blanco');</script>";
    } else if (!isset($fecha_nacimiento)) {
        echo"<script type=\"text/javascript\">alert('Debe seleccionar una fecha');</script>";
    }
    /*Comprueba si hay espacios que se puedan tomar como caracter al inicio o al final en nombres, apellidos, alias y contraseña*/
    else if (strlen(trim($nombres, ' ')) <= 1)
    {
        echo"<script type=\"text/javascript\">alert('El nombre debe de tener al menos dos caracteres');</script>";
    }
    else if (strlen(trim($apellidos, ' ')) <= 1)
    {
        echo"<script type=\"text/javascript\">alert('El apellido debe de tener al menos dos caracteres');</script>";
    }
    else if (strlen(trim($alias, ' ')) <= 3)
    {
        echo"<script type=\"text/javascript\">alert('El nombre debe de tener al menos cuatro caracteres');</script>";
    }
    else if (strlen(trim($contra, ' ')) <= 3)
    {
        echo"<script type=\"text/javascript\">alert('El apellido debe de tener al menos cuatro caracteres');</script>";
    }
    /*VAlida solo letras en nombre y apellido*/
    else if(!preg_match('/^([a-z A-Z ñáéíóú ÑÁÉÍÓÚ Üü ]{2,60})$/i',$nombres)){
        echo"<script type=\"text/javascript\">alert('Los nombres no tienen números');</script>";
    }
    else if(!preg_match('/^([a-z A-Z ñáéíóú ÑÁÉÍÓÚ Üü ]{2,60})$/i',$apellidos)){
        echo"<script type=\"text/javascript\">alert('Los apellidos no tienen números');</script>";
    }
    /*Valida DUI*/
    else if (!preg_match('/^\d{8}-\d{1}$/', $identificador)){
        echo"<script type=\"text/javascript\">alert('Formato de DUI incorrecto. Ej. XXXXXXXX-X');</script>";
    }
    /*Valida numero de telefono formato El Salvador*/
    else if (!preg_match('/^[2|6|7]{1}\d{3}-\d{4}$/', $telefono)){
        echo"<script type=\"text/javascript\">alert('Formato de Teléfono incorrecto. Ej. (2,6 o 7)XXX-XXXX');</script>";
    }
    /*Valida correo electronico*/
    else if (!preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $correo)){
        echo"<script type=\"text/javascript\">alert('Formato de Correo Electrónico erróneo. Ej. hola.mundo@algo.algo');</script>";
    }
    else {
        if ($valid) {
            //SUBIR IMAGEN URL
            if ($_FILES['archivo']['name']=="") {
                echo"<script type=\"text/javascript\">alert('Tienes que subir una imagen');</script>";
            }
            else {
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
                if ($ancho == 150 && $alto == 195) {
                    /*Compara el peso de la imagen, debe ser menor a 2 MB  (Esto es mas codigo de validacion [extension y tipo])$ext_correcta && $tipo_correcto*/
                    if ($tamano <= $limite) {
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
                                $sql = "SELECT MAX(id_empleado) as id_emp FROM empleados";
                                foreach ($PDO->query($sql) as $row) {
                                    $idempleado = "$row[id_emp]";
                                    $id= $idempleado+1;
                                }
                                move_uploaded_file($nombre_tmp, "../img_empleados/" . $id . ".jpg");
                                $url = "img_empleados/" . $id . ".jpg";
                                echo "<br/>Guardado en: " . "../img_empleados/" . $id . ".jpg";

                                $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $sql = "INSERT INTO empleados(nombres, apellidos, identificador, telefono, correo, sexo, fecha_nacimiento, foto) values(?, ?, ?, ?, ?, ?, ?,?)";
                                $stmt = $PDO->prepare($sql);
                                $stmt->execute(array($nombres, $apellidos, $identificador, $telefono, $correo, $sexo, $fecha_nacimiento, $url));

                                /*SELECCIONAR EL ID DEL ULTIMO EMPLEADO INGRESADO*/
                                $sql = "SELECT MAX(id_empleado) as id_emp FROM empleados";
                                foreach ($PDO->query($sql) as $row) {
                                    $idemp = "$row[id_emp]";
                                }
                                /*SELECCIONAR EL ID DEL TIPO DE USUARIO DONDE EL NOMBRE SEA el tipo seleccionado*/
                                $sql2 = "SELECT id_tipo_usuario FROM tipos_usuarios  WHERE nombre='" . $_POST['tipo'] . "'";
                                foreach ($PDO->query($sql2) as $row2) {
                                    $idtip = "$row2[id_tipo_usuario]";
                                }
                                $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $sql = "INSERT INTO usuarios(alias,contrasena, estado, id_empleado, id_tipo_usuario) values(?, ?, ?, ?, ?)";
                                $stmt = $PDO->prepare($sql);
                                $stmt->execute(array($alias, $contra, 1, $idemp, $idtip));
                                header("Location: empleados.php");
                            }
                        }
                    } else {
                        echo "<script type=\"text/javascript\">alert('La imagen pesa mas de 2 MB');</script>";
                    }
                }else {
                    echo "<script type=\"text/javascript\">alert('La imagen debe ser exactamende de 150px de alto x 195px de ancho');</script>";

                }
            }
        }

    }
}
?>