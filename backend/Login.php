<?php

/*caturamos nuestros datos que fueron enviados desde el formulario mediante el metodo POST
**y los almacenamos en variables.*/
if(!empty($_POST)) {
    $usuario = $_POST["usuario"];
    $contraseña = sha1($_POST["contraseña"]);

    /*Consulta de mysql con la que indicamos que necesitamos que seleccione
    **solo los campos que tenga como nombre_administrador el que el formulario
    **le ha enviado*/
    require("bd2.php");
    $result = mysql_query("SELECT * FROM usuarios WHERE alias ='$usuario' AND estado=1");
//Validamos si el nombre del administrador existe en la base de datos o es correcto
    if ($row = mysql_fetch_array($result)) {
//Si el usuario es correcto ahora validamos su contraseña
        if ($row["contraseña"] == $contraseña) {
            //Creamos sesión
            session_start();
            //Almacenamos el nombre de usuario en una variable de sesión usuario
            $_SESSION['alias'] = $usuario;
            //Redireccionamos a la pagina: index.php
            header("Location: index.php");
        } else {
            //En caso que la contraseña sea incorrecta enviamos un msj y redireccionamos a login.php
            ?>

            <script language="JavaScript">
                alert("Contraseña Incorrecta");
                location.href = "Login.php";
            </script>

        <?php
        }
    } else {
        //en caso que el nombre de administrador es incorrecto enviamos un msj y redireccionamos a login.php
        ?>
        <script language="JavaScript">
            alert("El nombre de usuario es incorrecto!");
            location.href = "Login.php";
        </script>
        }

    <?php
    }

//Mysql_free_result() se usa para liberar la memoria empleada al realizar una consulta
    mysql_free_result($result);
    /*Mysql_close() se usa para cerrar la conexión a la Base de datos y es
    **necesario hacerlo para no sobrecargar al servidor, bueno en el caso de
    **programar una aplicación que tendrá muchas visitas ;) .*/
    mysql_close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,800italic,400,700,800">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <link type="text/css" rel="stylesheet" href="Mantenimientos/styles/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="Mantenimientos/styles/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="Mantenimientos/styles/main.css">
    <link type="text/css" rel="stylesheet" href="Mantenimientos/styles/style-responsive.css">
</head>
<body style="background: url('Mantenimientos/images/bg/bg.jpg') center center fixed;">
    <div class="page-form">
        <div class="panel panel-blue">
            <div class="panel-body pan">
                <form action="#" class="form-horizontal">
                <div class="form-body pal">
                    <div class="col-md-12 text-center">
                        <h1 style="margin-top: -90px; font-size: 48px;">
                            WineFun</h1>
                        <br />
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <img src="Mantenimientos/images/avatar/profile-pic.png" class="img-responsive" style="margin-top: -35px;" />
                        </div>
                        <div class="col-md-9 text-center">
                            <h1>
                                Bienvenido/a.</h1>
                            <br />
                            <p>
                                WineFun. Crreamos tu mundo, creamos tus ideas.</p>
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-md-12">
                            <div class="input-icon right">
                                <i class="fa fa-user"></i>
                                <input id="usuario" name="usuario" type="text" placeholder="Usuario" required="required"  class="form-control" /></div>
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-md-12">
                            <div class="input-icon right">
                                <i class="fa fa-lock"></i>
                                <input id="password" type="password" name="contraseña" placeholder="Contraseña" required="required" class="form-control" /></div>
                        </div>
                    </div>
                    <div class="form-group mbn">
                        <div class="col-lg-12" align="right">
                            <div class="form-group mbn">
                                <div class="col-lg-3">
                                    &nbsp;
                                </div>
                                <div class="col-lg-9">
                                    <a href="Login.php" class="btn btn-default">¿Olvidaste tu Contraseña??</a>&nbsp;&nbsp;
                                    <button type="submit" name="iniciar" class="btn btn-default" value="Iniciar Sesión">
                                        Entrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="col-lg-12 text-center">
            <p>&nbsp;</p>
        </div>
    </div>
</body>
</html>