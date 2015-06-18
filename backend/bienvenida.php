<?php include "controlador.php"?>
<?php
require("bd.php");
if(!empty($_POST)) {
    // validation errors
    $nombresError = null;
    $apellidosError = null;
    $identificadorError = null;
    $telefonoError = null;
    $correoError = null;
    $generoError = null;
    $aliasError = null;
    $contraseñaError = null;
    $confirmarError = null;
    // post values
    $nombres = $_POST['nombres'];
    $alias= $_POST['alias'];
    $apellidos = $_POST['apellidos'];
    $identificador = $_POST['identificador'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $sexo = $_POST['sexo'];
    $alias = $_POST['alias'];
    $fecha_nacimiento = date('Y-m-d', strtotime($_POST['fecha_nacimiento']));
    $contra = sha1($_POST['contra']);
    // validate input
    $valid = true;

       // $regex = '/(^\d{8})-(\d$)/';
    //if (!preg_match($regex, $identificador)) {
       // echo 'El DUI NO es válido';
    //}

    if (empty($nombres)) {
        $nombresError = "Por favor ingrese los nombres.";
        $valid = false;
    }

    if (empty($apellidos)) {
        $apellidosError = "Por favor ingrese los apellidos.";
        $valid = false;
    }

    if (empty($identificador)) {
        $identificadorError = "Por favor ingrese la DUI.";
        $valid = false;
    }

    if (empty($telefono)) {
        $telefonosError = "Por favor ingrese el telefono.";
        $valid = false;
    }

    if (empty($correo)) {
        $correoError = "Por favor ingrese el correo.";
        $valid = false;
    }

    if (empty($sexo)) {
        $sexoError = "Por favor seleccione el sexo.";
        $valid = false;
    }

    if (empty($alias)) {
        $aliasError = "Por favor ingrese el alias.";
        $valid = false;
    }

    if (empty($contra)) {
        $contraseñaError = "Por favor ingrese la contraseña.";
        $valid = false;
    }

    // insert data
    if ($_POST['contra'] != $_POST['confirmar']) {
        $_POST['contra']="";
        $_POST['confirmar']="";
    } else {
        if ($valid) {
            //SUBIR IMAGEN URL
            if (!isset($_FILES['archivo'])) {
                echo 'Ha habido un error, tienes que elegir una imagen<br/>';
                echo '<a href="bienvenida.php">Subir archivo</a>';
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
                $limite = 5000 * 1024;

                if ($ext_correcta && $tipo_correcto && $tamano <= $limite) {
                    if ($_FILES['archivo']['error'] > 0) {
                        echo 'Error: ' . $_FILES['archivo']['error'] . '<br/>';
                    } else {
                        echo 'Nombre: ' . $nombre . '<br/>';
                        echo 'Tipo: ' . $tipo . '<br/>';
                        echo 'Tamaño: ' . ($tamano / 1024) . ' Kb<br/>';
                        echo 'Guardado en: ' . $nombre_tmp;

                        if (file_exists('Mantenimients/img_empleados/' . $nombre)) {
                            echo '<br/>El archivo ya existe: ' . $nombre;
                        } else {
                            move_uploaded_file($nombre_tmp, "Mantenimientos/img_empleados/" . $nombre);
                            $url = "img_empleados/" . $nombre;
                            echo "<br/>Guardado en: " . "Manteniminetos/img_empleados/" . $nombre;
                            /*INGRESA DATOS DE EMPLEADOS*/
                            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $sql = "INSERT INTO empleados(nombres, apellidos, identificador, telefono, correo, sexo, fecha_nacimiento, foto) values(?, ?, ?, ?, ?, ?, ?,?)";
                            $stmt = $PDO->prepare($sql);
                            $stmt->execute(array($nombres, $apellidos, $identificador, $telefono, $correo, $sexo, $fecha_nacimiento, $url));

                        }
                    }
                } else {
                    echo 'Archivo inválido';
                }
                /*GUARDAR TIPOS DE USUARIOS*/
                $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO tipos_usuarios(nombre,descripcion, agregar, modificar, eliminar, consultar) values(?, ?, ?, ?, ?, ?)";
                $stmt = $PDO->prepare($sql);
                $stmt->execute(array('Administrador', 'El que controla todo',1 ,1 ,1 ,1));


                /*SELECCIONAR EL ID DEL ULTIMO EMPLEADO INGRESADO*/
                $sql= "SELECT MAX(id_empleado) as id_emp FROM empleados";
                foreach($PDO->query($sql) as $row) {
                    $idemp = "$row[id_emp]";
                }

                /*SELECCIONAR EL ID DEL TIPO DE USUARIO DONDE EL NOMBRE SEA ADMINISTRADOR*/
                $sql2 = "SELECT id_tipo_usuario FROM tipos_usuarios  WHERE nombre='Administrador'";
                foreach($PDO->query($sql2) as $row2) {
                    $idtip = "$row2[id_tipo_usuario]";
                }
                /*INGRESAR USUARIOS*/
                $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO usuarios(alias,contrasena, estado, id_empleado, id_tipo_usuario) values(?, ?, ?, ?, ?)";
                $stmt = $PDO->prepare($sql);
                $stmt->execute(array($alias, $contra, 1, $idemp, $idtip));
                $PDO = null;
                header("Location: Login.php");
            }
        }

    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!--ESTILOLS Y FUNCIONESVARIOS -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="css/estilos.css">
    <!--SCRIPT Y ESTILOS DE BOOTSTRAP -->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js" type="text/javascript"></script>
    <!--SCRIPT DE VALIDACIONES-->
    <script type="text/javascript"  src="js/validaciones.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/funciones.js"></script>
    <!--SCRIPT DE DATETIMEPICKER -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
    <link type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,800italic,400,700,800">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <link type="text/css" rel="stylesheet" href="Mantenimientos/styles/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="Mantenimientos/styles/main.css">
    <link type="text/css" rel="stylesheet" href="Mantenimientos/styles/style-responsive.css">
</head>

<body style="background: url('Mantenimientos/images/bg/bg.jpg') center center fixed;">
<div class="page-form">
    <div class="panel panel-blue">
        <div class="panel-body pan">
            <form action="#" method="post" class="form" role="form" enctype="multipart/form-data">
                <div class='form-group <?php print(!empty($nombresError)?"has-error":""); ?>'>
                    <input class="form-control" name="nombres" placeholder="Nombres" required='required' id='nombres' type="text" autofocus value='<?php print(!empty($nombres)?$nombres:""); ?>'  />
                    <?php print(!empty($nombresError)?"<span class='help-block'>$nombresError</span>":""); ?>
                </div>
                <div class='form-group <?php print(!empty($apellidosError)?"has-error":""); ?>'>
                    <input class="form-control" name="apellidos" placeholder="Apellidos" type="text" required='required' id='apellidos'  value='<?php print(!empty($apellidos)?$apellidos:""); ?>' />
                    <?php print(!empty($apellidosError)?"<span class='help-block'>$apellidosError</span>":""); ?>
                </div>
                <div class='form-group <?php print(!empty($identificadorError)?"has-error":""); ?>'>
                    <input class="form-control" name="identificador" placeholder="DUI" type="text" required='required' id='identificador'  value='<?php print(!empty($identificador)?$identificador:""); ?>' />
                    <?php print(!empty($identificadorError)?"<span class='help-block'>$identificadorError</span>":""); ?>
                </div>
                <div class='form-group <?php print(!empty($telefonosError)?"has-error":""); ?>'>
                    <input class="form-control" name="telefono" placeholder="Telefono" type="text" required='required' id='telefono'   value='<?php print(!empty($telefono)?$telefono:""); ?>'/>
                    <?php print(!empty($telefonosError)?"<span class='help-block'>$telefonosError</span>":""); ?>
                </div>
                <div class='form-group <?php print(!empty($correoError)?"has-error":""); ?>'>
                    <input class="form-control" name="correo" placeholder="Correo" type="email" required='required' id='correo'  value='<?php print(!empty($correo)?$correo:""); ?>' />
                    <?php print(!empty($correoError)?"<span class='help-block'>$correoError</span>":""); ?>
                </div>
                <div class="form-group">
                    <div class="input-group input-append date" id="dateRangePicker">
                        <input type="text" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" readonly  value='<?php print(!empty($fecha_nacimiento)?$fecha_nacimiento:""); ?>'/>
                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                </div>
                <div class='form-group <?php print(!empty($generoError)?"has-error":""); ?>'>
                    <select name='sexo' required='required' id='sexo' class='form-control'>
                        <option></option>
                        <option value='Masculino' <?php print(isset($sexo) && $sexo == "Masculino"?"selected":""); ?>>Masculino</option>
                        <option value='Femenino' <?php print(isset($sexo) && $sexo == "Femenino"?"selected":""); ?>>Femenino</option>
                    </select>
                    <?php print(!empty($generoError)?"<span class='help-block'>$generoError</span>":""); ?>
                </div>
                <div class='form-group'>
                    <input type="file" name="archivo" id="archivo" accept="image/png, image/jpeg, image/gif"/>
                </div>
                <div class='form-group <?php print(!empty($aliasError)?"has-error":""); ?>'>
                    <input class="form-control" name="alias" placeholder="Alias" type="text" required='required' id='alias'  value='<?php print(!empty($alias)?$alias:""); ?>'/>
                    <?php print(!empty($aliasError)?"<span class='help-block'>$nombresError</span>":""); ?>
                </div>
                <div class='form-group <?php print(!empty($contraseñaError)?"has-error":""); ?>'>
                    <input class="form-control" name="contra" placeholder="Contraseña" type="password" required='required' id='contra' autofocus />
                </div>
                <div class='form-group <?php print(!empty($confirmarError)?"has-error":""); ?>'>
                    <input class="form-control" name="confirmar" placeholder="Confirmar Contraseña" type="password" required='required' id='nombres' autofocus />
                    <?php print(!empty($confirmarError)?"<span class='help-block'>$confirmarError</span>":""); ?>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit" value="Enviar"">
                Registrarse</button>
            </form>
        </div>
    </div>
    <div class="col-lg-12 text-center">
        <p>&nbsp;</p>
    </div>
</div>
</body>
</html>